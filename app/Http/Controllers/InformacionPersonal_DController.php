<?php

namespace App\Http\Controllers;

use App\Models\InformacionPersonald;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

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
                if (in_array($key, ['fotografia']) && ! empty($value)) {
                    // ✅ Convertir BLOB a base64
                    $attributes[$key] = base64_encode($value);
                } elseif (is_string($value) && ! in_array($key, ['fotografia'])) {
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
            return response()->json(['error' => 'Error al codificar los datos a JSON: '.$e->getMessage()], 500);
        }
    }

    // Metodo para buscar un docente por su cédula sin fotografía
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
        if (! $docente) {
            return response()->json(['message' => 'Docente no encontrado en la base de datos institucional.'], 404);
        }

        return response()->json([
            'data' => $docente,
            'mensaje' => 'Encontrado con Éxito!!',
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
            if (! $persona || empty($persona->fotografia)) {
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
                ->header('Content-Disposition', 'inline; filename="foto_'.$ci.'"');
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json(['error' => 'Error al obtener la fotografía: '.$e->getMessage()], 500);
        }
    }

    public function getSinfondoFotografia($ci)
    {
        try {
            $persona = InformacionPersonald::where('CIInfPer', $ci)->select('fotografia')->first();

            if (! $persona || empty($persona->fotografia)) {
                return response()->json(['error' => 'Fotografía no encontrada.'], 404);
            }

            // Crear una imagen de GD a partir del string binario de la BD
            $imgOriginal = imagecreatefromstring($persona->fotografia);
            if (! $imgOriginal) {
                return response()->json(['error' => 'Formato de imagen no soportado por GD.'], 500);
            }

            // Obtener dimensiones
            $ancho = imagesx($imgOriginal);
            $alto = imagesy($imgOriginal);

            // Crear una nueva lona con soporte de transparencia (PNG)
            $imgFinal = imagecreatetruecolor($ancho, $alto);
            imagealphablending($imgFinal, false);
            imagesavealpha($imgFinal, true);

            // Definir el color transparente
            $transparencia = imagecolorallocatealpha($imgFinal, 0, 0, 0, 127);
            imagefill($imgFinal, 0, 0, $transparencia);

            // 1. Muestreo del color de fondo original (Esquina superior izquierda)
            $rgbFondo = imagecolorat($imgOriginal, 10, 10);
            $colorFondo = imagecolorsforindex($imgOriginal, $rgbFondo);

            $bgR = $colorFondo['red'];
            $bgG = $colorFondo['green'];
            $bgB = $colorFondo['blue'];

            // 2. Tolerancia base para la distancia de color
            $tolerancia = 65;

            for ($x = 0; $x < $ancho; $x++) {
                for ($y = 0; $y < $alto; $y++) {
                    // Obtener el color del píxel actual
                    $rgb = imagecolorat($imgOriginal, $x, $y);
                    $colores = imagecolorsforindex($imgOriginal, $rgb);

                    $r = $colores['red'];
                    $g = $colores['green'];
                    $b = $colores['blue'];

                    // 3. FILTRO DE CROMATISMO (Guardia de seguridad para colores vivos)
                    // Calculamos la diferencia entre el canal más alto y el más bajo
                    $maxCanal = max($r, $g, $b);
                    $minCanal = min($r, $g, $b);
                    $saturacionLocal = $maxCanal - $minCanal;

                    // Si la diferencia es alta, significa que el píxel tiene un color definido
                    // (como el rosa de la camisa o el tono de la piel) y NO debe ser fondo.
                    if ($saturacionLocal > 22) {
                        // Forzamos a mantener el píxel original
                        $colorPixel = imagecolorallocatealpha($imgFinal, $r, $g, $b, $colores['alpha']);
                        imagesetpixel($imgFinal, $x, $y, $colorPixel);

                        continue;
                    }

                    // 4. Si pasó el filtro de cromatismo, evaluamos la distancia euclidiana normal
                    $distanciaColor = sqrt(
                        pow($r - $bgR, 2) +
                        pow($g - $bgG, 2) +
                        pow($b - $bgB, 2)
                    );

                    if ($distanciaColor <= $tolerancia) {
                        // Es fondo o una sombra del fondo -> Volver transparente
                        imagesetpixel($imgFinal, $x, $y, $transparencia);
                    } else {
                        // Mantener el píxel original
                        $colorPixel = imagecolorallocatealpha($imgFinal, $r, $g, $b, $colores['alpha']);
                        imagesetpixel($imgFinal, $x, $y, $colorPixel);
                    }
                }
            }

            // Capturar el output del archivo binario PNG procesado internamente
            ob_start();
            imagepng($imgFinal);
            $imagenPngBinaria = ob_get_clean();

            // Liberar memoria de GD
            imagedestroy($imgOriginal);
            imagedestroy($imgFinal);

            // Retornar el flujo de la imagen transparente construida localmente
            return Response::make($imagenPngBinaria, 200)
                ->header('Content-Type', 'image/png')
                ->header('Cache-Control', 'public, max-age=86400');

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en procesamiento local: '.$e->getMessage()], 500);
        }
    }
}
