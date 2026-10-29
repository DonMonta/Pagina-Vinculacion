<?php

namespace App\Http\Controllers;

use App\Models\Invi_Normativa;
use Illuminate\Http\Request;
use App\Models\Bitacora;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File; // Importamos la clase Facultad

class Invi_normativasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       try {
            $searchQuery = $request->input('search_query');
            $id_departamento = $request->input('id_departamento');
            
            // 1. Cambiamos withCount por with para traer los objetos relacionados
            $query = Invi_Normativa::with(['invi_tipo_normativa', 'departamento'])
            ->where('id_departamento', $id_departamento);
            
            if ($searchQuery) { 
                $query->where(function ($q) use ($searchQuery) {
                    $q->where('cod_norma', 'LIKE', '%' . $searchQuery . '%');
                });
            }

            // 2. Creamos un closure para limpiar UTF-8 que incluya las relaciones (toArray en lugar de getAttributes)
            $sanitizeUtf8 = function ($item) {
                $array = $item->toArray(); // toArray() sí incluye las relaciones cargadas en el "with"
                
                // array_walk_recursive iterará sobre los atributos principales y los de las relaciones
                array_walk_recursive($array, function (&$value) {
                    if (is_string($value)) {
                        $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                    }
                });
                
                return $array;
            };

            if ($request->has('all') && $request->all === 'true') {
                $data = $query->get();
                // Usar map() en lugar de transform() es más seguro porque retorna una nueva colección
                $dataSanitizada = $data->map($sanitizeUtf8);

                return response()->json(['data' => $dataSanitizada]);
            }

            // Paginación por defecto
            $data = $query->paginate(20);

            if ($data->isEmpty()) {
                return response()->json(['error' => 'No se encontraron datos'], 404);
            }

            // Extraemos los items y los procesamos sin alterar el objeto paginador original
            $itemsSanitizados = collect($data->items())->map($sanitizeUtf8)->all();

            return response()->json([
                'data' => $itemsSanitizados, // Usamos el array ya procesado
                'pagination' => [
                    'current_page' => $data->currentPage(),
                    'per_page' => $data->perPage(),
                    'total' => $data->total(),
                    'last_page' => $data->lastPage(),
                ],
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
        try{
            $inputs = $request->all();
            $res = Invi_Normativa::create($inputs);
            DB::commit();
                // --- REGISTRO EN BITÁCORA (Post-Commit) ---
            try {
                $user = Auth::user(); // Obtenemos el usuario autenticado
                Bitacora::create([
                    'bt_usuario' => $user->NombUsu,
                    'bt_fechahora' => Carbon::now(),
                    'bt_accion' => 'Creación de una Normativa para el departamento - VINCULACIÓN',
                    'bt_ippc' => $request->ip(),
                    'bt_observacion' => "USUARIO: {$user->NombUsu} REALIZÓ: Creación de una Normativa con ID: {$res->id_normativas} y nombre: {$res->nombre_normativas}",
                ]);
            } catch (\Exception $ex) {
                Log::error('Error bitácora en Guardar: ' . $ex->getMessage());
            }
            return response()->json([
                'message' => 'Registro creado exitosamente',
                'data' => $res
            ], 201);

        }catch(\Exception $e){
            Log::error('Error al crear el registro: ' . $e->getMessage());
            return response()->json(['error' => 'Error al crear el registro: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $res = Invi_Normativa::find($id);
        if (isset($res)) {
            return response()->json([
                'data' => $res,
                'mensaje' => "Encontrado con Éxito!!",
            ]);
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "La Normativa con id: $id no Existe",
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try{

            $res = Invi_Normativa::find($id);
            if (isset($res)) {
                $res->id_tipo_normativa = $request->id_tipo_normativa;
                $res->cod_norma = $request->cod_norma;
                $res->nombre_normativas = $request->nombre_normativas;
                $res->elaboracion = $request->elaboracion;
                $res->revision = $request->revision;
                $res->aprobacion = $request->aprobacion;
                $res->fecha_aprobacion = $request->fecha_aprobacion;
                $res->num_resolucion = $request->num_resolucion;
                $res->estado = $request->estado;
                $res->archivo = $request->archivo;
                $res->id_departamento = $request->id_departamento;
                if ($res->save()) {
                    DB::commit();
                    // --- REGISTRO EN BITÁCORA (Post-Commit) ---
                    try {
                        $user = Auth::user(); // Obtenemos el usuario autenticado
                        Bitacora::create([
                            'bt_usuario' => $user->NombUsu,
                            'bt_fechahora' => Carbon::now(),
                            'bt_accion' => 'Actualización de una Normativa para el departamento - VINCULACIÓN',
                            'bt_ippc' => $request->ip(),
                            'bt_observacion' => "USUARIO: {$user->NombUsu} REALIZÓ: Actualización de una Normativa con ID: {$res->id_normativas} y nombre: {$res->nombre_normativas}",
                        ]);
                    } catch (\Exception $ex) {
                        Log::error('Error bitácora en Actualizar: ' . $ex->getMessage());
                    }
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
                    'mensaje' => "La Normativa con id: $id no Existe",
                ]);
            }
        }catch(\Exception $e){
            Log::error('Error al procesar los datos: ' . $e->getMessage());
            return response()->json(['error' => 'Error al procesar los datos: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        DB::beginTransaction();
        try{

            // Busca el registro de la normativa mediante su identificador único
            $res = Invi_Normativa::find($id);
            // Verifica si la normativa existe antes de proceder con la modificación
            if (isset($res)) {
                // Aplica el borrado lógico cambiando el estado a inactivo (0)
                $res->estado = 0;
                $res->save();
                // Convierte la instancia del modelo afectado a una estructura de array para devolverla
                $data = $res->toArray();
                // Evalúa que la conversión de datos se haya realizado correctamente para estructurar la respuesta
                if ($data) {
                    DB::commit();
                        // --- REGISTRO EN BITÁCORA (Post-Commit) ---
                    try {
                        $user = Auth::user(); // Obtenemos el usuario autenticado
                        Bitacora::create([
                            'bt_usuario' => $user->NombUsu,
                            'bt_fechahora' => Carbon::now(),
                            'bt_accion' => 'Inhabilitación de una normativa para el departamento - VINCULACIÓN',
                            'bt_ippc' => $request->ip(),
                            'bt_observacion' => "USUARIO: {$user->NombUsu} REALIZÓ: Inhabilitación de una normativa con ID: {$res->id_normativas} y nombre: {$res->nombre_normativas}",
                        ]);
                    } catch (\Exception $ex) {
                        Log::error('Error bitácora en Inhabilitar: ' . $ex->getMessage());
                    }
                    return response()->json([
                        'data' => $data,
                        'mensaje' => "Inhabilitado con Éxito!!",
                    ]);
                } else {
                    // Control alternativo en caso de inconsistencia con la existencia del recurso
                    return response()->json([
                        'data' => $data,
                        'mensaje' => "La normativa no existe (puede que ya la haya eliminado)",
                    ]);
                }
            } else {
                // Retorna un mensaje indicando que el registro no fue localizado en el sistema
                return response()->json([
                    'error' => true,
                    'mensaje' => "La normativa con id: $id no Existe",
                ]);
            }
        }catch(\Exception $e){
            return response()->json(['error' => 'Error al procesar los datos: ' . $e->getMessage()], 500);
        }
    }
    public function habilitar(Request $request, string $id)
    {
        DB::beginTransaction();
        try{

            $res = Invi_Normativa::find($id);
            // Verifica si la normativa existe antes de proceder con la habilitación
            if (isset($res)) {
                // Aplica el borrado lógico cambiando el estado a inactivo (0)
                $res->estado = 1;
                $res->save();
                // Convierte la instancia del modelo afectado a una estructura de array para devolverla
                $data = $res->toArray();
                // Evalúa que la conversión de datos se haya realizado correctamente para estructurar la respuesta
                if ($data) {
                    DB::commit();
                        // --- REGISTRO EN BITÁCORA (Post-Commit) ---
                    try {
                        $user = Auth::user(); // Obtenemos el usuario autenticado
                        Bitacora::create([
                            'bt_usuario' => $user->NombUsu,
                            'bt_fechahora' => Carbon::now(),
                            'bt_accion' => 'Habilitación de una normativa para el departamento - VINCULACIÓN',
                            'bt_ippc' => $request->ip(),
                            'bt_observacion' => "USUARIO: {$user->NombUsu} REALIZÓ: Habilitación de una normativa con ID: {$res->id_normativas} y nombre: {$res->nombre_normativas}",
                        ]);
                    } catch (\Exception $ex) {
                        Log::error('Error bitácora en Habilitar: ' . $ex->getMessage());
                    }
                    return response()->json([
                        'data' => $data,
                        'mensaje' => "Habilitado con Éxito!!",
                    ]);
                } else {
                    // Control alternativo en caso de inconsistencia con la existencia del recurso
                    return response()->json([
                        'data' => $data,
                        'mensaje' => "La normativa no existe (puede que ya la haya eliminado)",
                    ]);
                }
            } else {
                // Retorna un mensaje indicando que el registro no fue localizado en el sistema
                return response()->json([
                    'error' => true,
                    'mensaje' => "La normativa con id: $id no Existe",
                ]);
            }
        }catch(\Exception $e){
            return response()->json(['error' => 'Error al procesar los datos: ' . $e->getMessage()], 500);
        }
    }
    /**
     * uploadArchivo: Gestiona la carga, validación y almacenamiento de archivos adjuntos para las convocatorias.
     * * El método realiza un seguimiento mediante logs del estado del archivo recibido, 
     * valida los requisitos de seguridad y tamaño (máx. 10MB), elimina versiones anteriores 
     * para optimizar el almacenamiento, crea la estructura de directorios necesaria en el path público 
     * y genera un nombre único y seguro para mitigar colisiones o ataques de inyección de archivos.
     *
     * @param  \Illuminate\Http\Request  $request Objeto con el archivo y la metadata necesaria (cod_norma, old_filename).
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con el estado de la carga, el nuevo nombre asignado y la URL pública de acceso.
     */
    public function uploadArchivo(Request $request)
    {
        // Bloque de depuración y auditoría: Registra el estado inicial del archivo en los logs del sistema
        if ($request->hasFile('file')) { // Si el archivo existe
            Log::info('Archivo detectado: '.$request->file('file')->getClientOriginalName()); // Se registra el nombre del archivo detectado
            Log::info('Error de subida PHP: '.$request->file('file')->getError()); // Se registra el error de subida PHP
            Log::info('Tamaño recibido: '.$request->file('file')->getSize()); // Se registra el tamaño del archivo recibido
        } else {
            // Se registra un error de subida si no se detectó ningún archivo en la petición
            Log::warning('No se detectó ningún archivo en la petición.');
        }
        // Aplica reglas de validación estrictas para garantizar la seguridad del servidor
        $request->validate([
            'file' => 'required|max:10240', // 10MB
            'cod_norma' => 'required|alpha_dash',// Solo permite caracteres alfanuméricos, guiones y guiones bajos
            'old_filename' => 'nullable|string',
        ]); // Se validan los datos de la petición

        try {
            // Sanitiza el parámetro utilizando 'basename' para prevenir ataques de Directory Traversal
            $cod_norma = basename($request->cod_norma); // Se obtiene el cédula del archivo
            $file = $request->file('file'); // Se obtiene el archivo subido
            // Valida que el archivo se haya subido completamente sin corrupciones en el flujo temporal
            if (! $file->isValid()) { // Si el archivo no es válido
                throw new \Exception('Archivo inválido o corrupto.'); // Se lanza un error
            }
            // Remueve de forma permanente el archivo anterior si es reemplazado en una edición
            if ($request->filled('old_filename')) { // Si se ha proporcionado un nombre de archivo antiguo
                $oldFilename = basename($request->old_filename); // Seguridad extra
                $oldPath = public_path("Documentos/Vinculación/Normativas/{$cod_norma}/{$oldFilename}"); // Se obtiene la ruta del archivo antiguo
                if (File::exists($oldPath)) { // Si el archivo antiguo existe
                    File::delete($oldPath); // Se elimina el archivo antiguo
                }
            }

            // Crear carpeta publica si no existe
            $directory = public_path("Documentos/Vinculación/Normativas/{$cod_norma}");

            if (! File::isDirectory($directory)) { // Si la carpeta no existe
                File::makeDirectory($directory, 0755, true, true); // Se crea la carpeta
            }

            // Generar nombre: CI + _ + aleatorio + _ + fecha (Ymd_His)
            $aleatorio = bin2hex(random_bytes(8)); // 16 caracteres hex
            $fechaHora = date('Ymd_His');          // Ej: 20251112_1741
            $extension = $file->getClientOriginalExtension(); // pdf

            $filename = "{$cod_norma}_{$aleatorio}_{$fechaHora}.{$extension}"; // Se genera el nombre final del archivo

            // Guardar archivo
            $file->move($directory, $filename);

            // URL pública, para acceder al archivo desde fuera de la aplicación
            $url = url('Documentos/Vinculación/Normativas/'.$cod_norma.'/'.$filename);

            // Se devuelve un array con el mensaje de éxito y el nombre del archivo y la URL pública
            return response()->json([
                'status' => true,
                'filename' => $filename,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            // Se devuelve un array con el mensaje de error y el error generado
            return response()->json([
                'status' => false,
                'message' => 'Seguridad: El archivo no pudo ser procesado.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
