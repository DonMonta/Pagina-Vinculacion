<?php

namespace App\Http\Controllers;

use App\Models\Praempresa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Bitacora;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PraempresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $searchQuery = $request->input('search_query');

            $query = Praempresa::select('praempresa.*');

            // Capturar dirección de ordenamiento desde el frontend ('desc' por defecto)
            $direction = $request->input('direction', 'desc');
            if (!in_array($direction, ['asc', 'desc'])) {
                $direction = 'desc'; // Validación por seguridad
            }

            // Aplicar ordenamiento por fecha
            $query->orderBy('fechafin', $direction);

            // Filtro de búsqueda
            if ($searchQuery) {
                $query->where(function ($q) use ($searchQuery) {
                    $q->where('ruc', 'LIKE', '%' . $searchQuery . '%');
                });
            }

            // Respuesta para cuando piden todos los registros
            if ($request->has('all') && $request->all === 'true') {
                $data = $query->get();

                // Asegurar codificación UTF-8
                $data->transform(function ($item) {
                    $attributes = $item->getAttributes();
                    foreach ($attributes as $key => $value) {
                        if (is_string($value)) {
                            $attributes[$key] = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                        }
                    }
                    return $attributes;
                });

                return response()->json(['data' => $data]);
            }

            // Paginación por defecto (Mantiene el orden establecido arriba)
            $data = $query->paginate(20);

            if ($data->isEmpty()) {
                return response()->json(['error' => 'No se encontraron datos'], 404);
            }

            // Convertir los datos a UTF-8 válido y formatear BLOBs
            $data->getCollection()->transform(function ($item) {
                $attributes = $item->getAttributes();
                foreach ($attributes as $key => $value) {
                    if ($key === 'imagen' && !empty($value)) {
                        // ✅ Convertir BLOB a base64
                        $attributes[$key] = base64_encode($value);
                    } elseif (is_string($value) && $key !== 'imagen') {
                        $attributes[$key] = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                    }
                }
                return $attributes;
            });

            return response()->json([
                'data'         => $data->items(),
                'current_page' => $data->currentPage(),
                'per_page'     => $data->perPage(),
                'total'        => $data->total(),
                'last_page'    => $data->lastPage(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al codificar los datos a JSON: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $user = Auth::user();
        $inputs = $request->input();

        if (!empty($inputs['imagen'])) {
            $inputs['imagen'] = base64_decode($inputs['imagen']);
        }
        $inputs['usuario_id'] = $user->ciinfper;
        $res = Praempresa::create($inputs);
        $data = $res->toArray();
        if (!empty($res->imagen)) {
            $data['imagen'] = base64_encode($res->imagen);
        }
        DB::commit();
        Bitacora::create([
            'bt_usuario'     => $user->ciinfper,
            'bt_fechahora'   => Carbon::now(),
            'bt_accion'      => "Crear Empresa" . " - VINCULACIÓN",
            'bt_ippc'        => $request->ip(),
            'bt_observacion' => "USUARIO: {$user->NombUsu} REALIZÓ: Crear Empresa CON NOMBRE: {$request->NOMBRE}",
        ]);
        return response()->json([
            'message' => 'Registro creado exitosamente',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $res = Praempresa::find($id);
        if (isset($res)) {
            return response()->json([
                'data' => $res,
                'mensaje' => "Encontrado con Éxito!!",
            ]);
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "La Empresa con id: $id no Existe",
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $res = Praempresa::find($id);
        $user = Auth::user();
        if (isset($res)) {
            $res->ruc = $request->ruc;
            $res->empresa = $request->empresa;
            $res->empresacorta = $request->empresacorta;
            $res->lugar = $request->lugar;
            $res->direccion = $request->direccion;
            $res->telefono = $request->telefono;
            $res->email = $request->email;
            $res->url = $request->url;
            $res->logo = $request->logo;
            $res->tipo = $request->tipo;
            $res->titulo = $request->titulo;
            $res->representante = $request->representante;
            $res->cargo = $request->cargo;
            $res->actividad = $request->actividad;
            $res->fechafin = $request->fechafin;
            $res->tipoinstitucion = $request->tipoinstitucion;
            $res->pais = $request->pais;
            $res->ciudad = $request->ciudad;
            if (!empty($request->imagen)) {
                $res->imagen = base64_decode($request->imagen);
            }
            $res->estado_empr = $request->estado_empr;
            $res->vision = $request->vision;
            $res->mision = $request->mision;
            $res->usuario_id = $user->ciinfper;
            $res->archivo = $request->archivo;
            DB::commit();
            Bitacora::create([
                'bt_usuario'     => $user->ciinfper,
                'bt_fechahora'   => Carbon::now(),
                'bt_accion'      => "Actualizar Empresa" . " - VINCULACIÓN",
                'bt_ippc'        => $request->ip(),
                'bt_observacion' => "USUARIO: {$user->NombUsu} REALIZÓ: Actualizar Empresa CON NOMBRE: {$request->NOMBRE}",
            ]);
            if ($res->save()) {
                return response()->json([
                    'data' => $res,
                    'mensaje' => "Actualizado con Éxito!!",
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'mensaje' => "Error al Actualizar",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "La Empresa con id: $id no Existe",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $res = Praempresa::find($id);
        $user = Auth::user();
        if (isset($res)) {
            $res->estado_empr = 0;
            $res->save();
            $data = $res->toArray();
            DB::commit();
            Bitacora::create([
                'bt_usuario'     => $user->ciinfper,
                'bt_fechahora'   => Carbon::now(),
                'bt_accion'      => "Inhabilitar Empresa" . " - VINCULACIÓN",
                'bt_ippc'        => $request->ip(),
                'bt_observacion' => "USUARIO: {$user->NombUsu} REALIZÓ: Inhabilitar Empresa CON NOMBRE: {$request->NOMBRE}",
            ]);
            if ($data) {

                return response()->json([
                    'data' => $data,
                    'mensaje' => "Inhabilitado con Éxito!!",
                ]);
            } else {
                return response()->json([
                    'data' => $data,
                    'mensaje' => "La Empresa no existe (puede que ya la haya eliminado)",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "La Empresa con id: $id no Existe",
            ]);
        }
    }
    public function habilitar(Request $request)
    {
        $id = $request->id;
        $res = Praempresa::find($id);
        $user = Auth::user();

        if (isset($res)) {
            $res->estado_empr = 1;

            DB::commit();
            Bitacora::create([
                'bt_usuario'     => $user->ciinfper,
                'bt_fechahora'   => Carbon::now(),
                'bt_accion'      => "Habilitar Empresa" . " - VINCULACIÓN",
                'bt_ippc'        => $request->ip(),
                'bt_observacion' => "USUARIO: {$user->NombUsu} REALIZÓ: Habilitar Empresa CON NOMBRE: {$request->NOMBRE}",
            ]);
            if ($res->save()) {
                return response()->json([
                    'status' => true,
                    'data' => $res,
                    'mensaje' => "¡Empresa Habilitada con Éxito!",
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'mensaje' => "Error interno al intentar guardar los cambios.",
                ], 500);
            }
        } else {
            return response()->json([
                'status' => false,
                'mensaje' => "La Empresa con id: $id no existe o fue eliminado.",
            ], 404);
        }
    }
    //Metodo para subir archivo sin eliminar el anterior
    public function uploadArchivo(Request $request)
    {
        if ($request->hasFile('file')) {
            Log::info("Archivo detectado: " . $request->file('file')->getClientOriginalName());
            Log::info("Error de subida PHP: " . $request->file('file')->getError());
            Log::info("Tamaño recibido: " . $request->file('file')->getSize());
        } else {
            Log::warning("No se detectó ningún archivo en la petición.");
        }

        $request->validate([
            'file' => 'required|max:10240', // 10MB
            'ruc' => 'required|alpha_dash',
            'old_filename' => 'nullable|string',
        ]);

        try {
            $ruc = basename($request->ruc);
            $file = $request->file('file');

            if (!$file->isValid()) {
                throw new \Exception("Archivo inválido o corrupto.");
            }

            // --- SE ELIMINÓ EL BLOQUE QUE BORRABA EL ARCHIVO VIEJO ---
            // Ambos archivos (el viejo y el nuevo) ahora se mantendrán en el servidor.

            // Crear carpeta si no existe
            $directory = public_path("Documentos/Vinculación/Archivos_Empresas/{$ruc}");

            if (!File::isDirectory($directory)) {
                File::makeDirectory($directory, 0755, true, true);
            }

            // Generar nombre: RUC + _ + aleatorio + _ + fecha (Ymd_His)
            $aleatorio = bin2hex(random_bytes(8)); // 16 caracteres hex
            $fechaHora = date("Ymd_His");          // Ej: 20260602_1741
            $extension = $file->getClientOriginalExtension(); // pdf

            $filename = "{$ruc}_{$aleatorio}_{$fechaHora}.{$extension}";

            // Guardar archivo
            $file->move($directory, $filename);

            // URL pública
            $url = url('Documentos/Vinculación/Archivos_Empresas/' . $ruc . '/' . $filename);

            return response()->json([
                'status'   => true,
                'filename' => $filename,
                'url'      => $url
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Seguridad: El archivo no pudo ser procesado.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
