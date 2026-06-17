<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformacionPersonald;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Http;

class InformacionPersonal_DController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Aplica paginación al resultado del filtro
        $data = InformacionPersonald::select('informacionpersonal_d.*')
            ->where('informacionpersonal_d.CIInfPer', $id)
            ->paginate(20);
        if ($data->isEmpty()) {
            return response()->json(['error' => 'No se encontraron datos para el ID especificado'], 404);
        }

        // Convertir los campos a UTF-8 válido para cada página
        $data->getCollection()->transform(function ($item) {
            $attributes = $item->getAttributes();

            foreach ($attributes as $key => $value) {
                if (in_array($key, ['fotografia']) && !empty($value)) {
                    // ✅ Convertir BLOB a base64
                    $attributes[$key] = base64_encode($value);
                } elseif (is_string($value) && !in_array($key, ['fotografia'])) {
                    $attributes[$key] = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                }
            }

            return $attributes;
        });

        // Retornar la respuesta JSON con los metadatos de paginación
        try {
            return response()->json([
                'data' => $data->items(),
                'current_page' => $data->currentPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
                'last_page' => $data->lastPage(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al codificar los datos a JSON: ' . $e->getMessage()], 500);
        }
    }
    //Metodo para buscar un docente por su cédula sin fotografía
    public function getDocente(Request $request)
    {
        $cedula = $request->cedula;
        $docente = InformacionPersonalD::select(
            'informacionpersonal_d.CIInfPer',
            'informacionpersonal_d.ApellInfPer',
            'informacionpersonal_d.ApellMatInfPer',
            'informacionpersonal_d.NombInfPer'
        )
            ->where('CIInfPer', $cedula)
            ->where('StatusPer', 1)
            ->first();
        if (!$docente) {
            return response()->json(['message' => 'Docente no encontrado en la base de datos institucional.'], 404);
        }
        return response()->json([
            'data' => $docente,
            'mensaje' => "Encontrado con Éxito!!",
        ]);
    }
        // 1. Extraer la fotografia

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getFotografia($ci)
    {
        try {
            // 1. Obtener SÓLO la columna 'fotografia' para el CI específico
            $persona = InformacionPersonald::where('CIInfPer', $ci)
                ->select('fotografia')
                ->first();

            // 2. Verificar si el usuario existe y si tiene foto
            if (!$persona || empty($persona->fotografia)) {
                // Devolver una respuesta HTTP 404 o una foto predeterminada pequeña
                return response()->json(['error' => 'Fotografía no encontrada.'], 404);
            }

            $fotoBinaria = $persona->fotografia;

            // 3. Determinar el MIME type (es un paso crítico, asume que es JPEG/PNG si no tienes metadata)
            // Opcional: Si almacenas el MIME type en la DB, úsalo aquí. Si no, usa finfo para detectarlo (esto es más seguro).
            $mime = 'image/jpeg'; // MIME type por defecto

            // Intenta determinar el MIME type si el ambiente lo permite y no satura
            if (extension_loaded('fileinfo')) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $detectedMime = finfo_buffer($finfo, $fotoBinaria);
                finfo_close($finfo);

                if ($detectedMime && strpos($detectedMime, 'image') === 0) {
                    $mime = $detectedMime;
                }
            }

            // 4. Devolver la imagen como una respuesta binaria (STREAM)
            // Esto evita convertir el BLOB entero a Base64 en el servidor, lo que previene la saturación de memoria.
            return Response::make($fotoBinaria, 200)
                ->header('Content-Type', $mime)
                ->header('Content-Disposition', 'inline; filename="foto_' . $ci . '"');
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json(['error' => 'Error al obtener la fotografía: ' . $e->getMessage()], 500);
        }
    }
    public function getSinfondoFotografia($ci)
    {
        try {
            // 1. Obtener la fotografía binaria desde la base de datos
            $persona = InformacionPersonald::where('CIInfPer', $ci)
                ->select('fotografia')
                ->first();

            if (!$persona || empty($persona->fotografia)) {
                return response()->json(['error' => 'Fotografía no encontrada.'], 404);
            }

            $fotoBinaria = $persona->fotografia;

            // 2. Enviar la imagen binaria a la IA de Remove.bg
            // Usamos el cliente HTTP nativo de Laravel (instalado vía Composer)
            $response = Http::withHeaders([
                'X-Api-Key' => env('REMOVE_BG_API_KEY')
            ])->attach(
                'image_file',       // Nombre del campo que espera la API
                $fotoBinaria,       // Los bytes de la foto de tu BD
                'director_foto.jpg' // Nombre ficticio del archivo
            )->post('https://api.remove.bg/v1.0/removebg', [
                'size' => 'auto',   // 'auto' para máxima calidad o 'preview' para ahorrar créditos
            ]);

            // 3. Verificar si la IA respondió correctamente
            if ($response->failed()) {
                return response()->json([
                    'error' => 'La IA de recortes falló.',
                    'detalle' => $response->json()['errors'][0]['title'] ?? 'Error desconocido'
                ], $response->status());
            }

            // 4. La API nos devuelve directamente los bytes del PNG ya transparente
            $fotoProcesada = $response->body();

            // 5. Enviar el resultado final a Vue como un flujo de imagen PNG limpia
            return Response::make($fotoProcesada, 200)
                ->header('Content-Type', 'image/png')
                ->header('Content-Disposition', 'inline; filename="foto_ia_' . $ci . '.png"')
                ->header('Cache-Control', 'public, max-age=86400'); // Caché por un día para no gastar de más tu API

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error del servidor: ' . $e->getMessage()], 500);
        }
    }
}
