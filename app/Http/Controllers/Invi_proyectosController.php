<?php

namespace App\Http\Controllers;

use App\Models\Invi_proyectos;
use App\Models\Invi_detalle_integrante;
use App\Models\InformacionPersonalD;
use App\Models\InformacionPersonal;
use App\Models\Carreras;
use App\Models\Invi_funcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Invi_proyectosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $searchQuery = $request->input('search_query');
            $query = Invi_proyectos::select(
                'invi_proyectos.*'
            )->where('proyect_tipo', '=', 'VINCULACIÓN');
            if (! empty($searchQuery)) {
                $query->where(function ($q) use ($searchQuery) {
                    $q->where('invi_proyectos.proyect_cod', 'LIKE', "%{$searchQuery}%");
                });
            }

            if ($request->has('all') && $request->all === 'true') {
                $data = $query->get();

                // Convertir los datos a UTF-8 válido
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

            // Paginación por defecto
            $data = $query->paginate(20);
            if ($data->isEmpty()) {
                return response()->json([
                    'data' => [],
                    'message' => 'No se encontraron datos'
                ], 200);
            }

            $data->getCollection()->transform(function ($item) {
                $attributes = $item->getAttributes();
                foreach ($attributes as $key => $value) {
                    if (is_string($value)) {
                        $attributes[$key] = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                    }
                }
                return $attributes;
            });
            return response()->json([
                'data' => $data->items(),
                'pagination' => [
                    'current_page' => $data->currentPage(),
                    'per_page' => $data->perPage(),
                    'total' => $data->total(),
                    'last_page' => $data->lastPage(),
                ],

            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al procesar los datos: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();

        $res = Invi_proyectos::create($inputs);

        return response()->json([
            'data' => $res,
            'mensaje' => 'Agregado con Éxito!!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $proyecto = Invi_proyectos::with([
            'invi_detalle_fac_proy.facultades',
            'invi_detalle_fac_proy.facultades_priori',
            'invi_detalle_integrante.funciones',
            'invi_detalle_integrante.carreras',
            'invi_detalle_integrante.informacionPersonalD',
            'invi_detalle_integrante.informacionpersonal'
        ])->findOrFail($id);

        // 1. Extraer la facultad prioritaria (solo la primera que encuentre, ya que es la misma para el proyecto)
        // Usamos optional() por si por alguna razón no hay registros aún.
        $facultadPrincipal = $proyecto->invi_detalle_fac_proy
            ->whereNotNull('id_facultad_priori')
            ->first()?->facultades_priori;

        // 2. Extraer todas las facultades participantes de forma única
        // Mapeamos para obtener solo el objeto de la facultad y eliminamos duplicados por su ID
        $facultadesParticipantes = $proyecto->invi_detalle_fac_proy
            ->map(function ($detalle) {
                return $detalle->facultades;
            })
            ->filter() // Elimina nulos si los hubiera
            ->unique('idfacultad')
            ->values(); // Reindexa el array

        // 3. Formatear la respuesta JSON
        return response()->json([
            'proyect_id' => $proyecto->proyect_id,
            'proyect_nombre' => $proyecto->proyect_nombre,
            'proyect_titulo' => $proyecto->proyect_titulo,
            'fechainicio' => $proyecto->fechainicio,
            'fechafin' => $proyecto->fechafin,
            // Agregamos los campos limpios
            'facultades_priori' => $facultadPrincipal,
            'facultades' => $facultadesParticipantes,
            // Los integrantes los pasamos tal cual
            'invi_detalle_integrante' => $proyecto->invi_detalle_integrante
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $res = Invi_proyectos::find($id);
        if (isset($res)) {
            $res->proyect_cod = $request->proyect_cod;
            $res->proyect_nombre = $request->proyect_nombre;
            $res->proyect_titulo = $request->proyect_titulo;
            $res->fechainicio = $request->fechainicio;
            $res->fechafin = $request->fechafin;
            $res->proyect_tipo = $request->proyect_tipo;
            if ($res->save()) {
                return response()->json([
                    'data' => $res,
                    'mensaje' => 'Actualizado con Éxito!!',
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'mensaje' => 'Error al Actualizar',
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "El proyecto con id: $id no Existe",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function buscarIntegrante(Request $request)
    {
        $cedula = $request->cedula;
        $proyect_id_actual = $request->proyect_id;
        // Nueva variable para saber si estamos en modo reemplazo
        $es_reemplazo = $request->es_reemplazo;

        // 1. Buscar Datos Personales
        $docente = InformacionPersonalD::where('CIInfPer', $cedula)->first();
        $estudiante = InformacionPersonal::where('CIInfPer', $cedula)->first();

        if (!$docente && !$estudiante) {
            return response()->json(['message' => 'Integrante no encontrado en la base de datos institucional.'], 404);
        }

        $persona = $docente ?: $estudiante;
        $tipo = $docente ? 'doc' : 'est';

        // 2. Validar estado en proyectos de VINCULACIÓN
        $proyectoActivo = Invi_detalle_integrante::where(function ($q) use ($cedula) {
            $q->where('ciinfper_doc', $cedula)->orWhere('ciinfper_est', $cedula);
        })
            ->where('reemplazado', 0)
            ->whereHas('invi_proyectos', function ($query) {
                $query->where('proyect_tipo', 'VINCULACIÓN');
            })
            ->with('invi_proyectos')
            ->first();

        if ($proyectoActivo) {
            // CASO A: Está en OTRO proyecto (Bloqueo total)
            if ($proyectoActivo->proyect_id != $proyect_id_actual) {
                return response()->json([
                    'message' => "El integrante ya está activo en otro proyecto: " . $proyectoActivo->invi_proyectos->proyect_nombre
                ], 422);
            }

            // CASO B: Está en el MISMO proyecto
            // Si NO es un reemplazo (o sea, es un 'Añadir Nuevo'), lanzamos error.
            if (!$es_reemplazo) {
                return response()->json([
                    'message' => "Este integrante ya forma parte de los miembros activos de este proyecto."
                ], 422);
            }
        }

        return response()->json([
            'cedula' => $persona->CIInfPer,
            'nombre_completo' => "{$persona->NombInfPer} {$persona->ApellInfPer} {$persona->ApellMatInfPer}",
            'tipo' => $tipo
        ]);
    }
    public function guardarCambios(Request $request)
    {
        try {
            DB::beginTransaction();

            $modo = $request->modo;
            $form = $request->form;
            $reemplazoConfig = $request->reemplazo_config;
            $proyect_id = $request->proyect_id;

            if ($modo === 'nuevo') {
                // Validar que no se agregue Director/Subdirector si ya existen
                if (in_array($form['id_funcion'], [1, 2])) {
                    $existe = Invi_detalle_integrante::where('proyect_id', $request->proyect_id)
                        ->where('id_funcion', $form['id_funcion'])
                        ->where('reemplazado', 0)
                        ->exists();
                    if ($existe) return response()->json(['message' => 'Ya existe un directivo activo.'], 422);
                }

                Invi_detalle_integrante::create([
                    'proyect_id'    => $proyect_id,
                    'ciinfper_doc'  => $form['tipo_nuevo'] == 'doc' ? $form['cedula_nueva'] : null,
                    'ciinfper_est'  => $form['tipo_nuevo'] == 'est' ? $form['cedula_nueva'] : null,
                    'horas'         => $form['horas'],
                    'reemplazado'   => 0,
                    'id_funcion'    => $form['id_funcion'],
                    'idCarr'        => $form['idCarr'],
                    'anexo_integrante' => $form['anexo_integrante'],
                ]);
            } else {
                // MODO EDICIÓN
                $registroOriginal = Invi_detalle_integrante::findOrFail($request->id_deta_invi_proyect);

                if ($form['reemplazado'] == 1) {
                    // 1. Procesar al que SALE (Registro Original)
                    if ($reemplazoConfig['mantener_docente']) {
                        $registroOriginal->update([
                            'reemplazado' => 1,
                            'id_funcion'  => $reemplazoConfig['nueva_funcion_reemplazado'],
                            'horas'       => $reemplazoConfig['nuevas_horas_reemplazado'] ?? 0
                        ]);
                    } else {
                        $registroOriginal->update([
                            'reemplazado' => 1,
                            'id_funcion'  => null,
                            'horas'       => 0
                        ]);
                    }

                    // 2. Procesar al que ENTRA (El reemplazo)
                    $cedulaNueva = $form['cedula_nueva'];

                    // BUSCAMOS si esta persona ya estaba en el proyecto (aunque sea con otro rol)
                    $integranteExistente = Invi_detalle_integrante::where('proyect_id', $proyect_id)
                        ->where(function ($q) use ($cedulaNueva) {
                            $q->where('ciinfper_doc', $cedulaNueva)
                                ->orWhere('ciinfper_est', $cedulaNueva);
                        })
                        ->first();

                    $datosNuevoRol = [
                        'proyect_id'    => $proyect_id,
                        'ciinfper_doc'  => $form['tipo_nuevo'] == 'doc' ? $cedulaNueva : null,
                        'ciinfper_est'  => $form['tipo_nuevo'] == 'est' ? $cedulaNueva : null,
                        'horas'         => $form['horas'],
                        'reemplazado'   => 0, // El nuevo rol siempre entra como activo
                        'id_funcion'    => $form['id_funcion'],
                        'idCarr'        => $form['idCarr'],
                        'anexo_integrante' => $form['anexo_integrante'],
                    ];

                    if ($integranteExistente) {
                        // SI YA EXISTÍA: Lo actualizamos en lugar de crear uno nuevo
                        $integranteExistente->update($datosNuevoRol);
                    } else {
                        // SI NO EXISTÍA: Lo creamos
                        Invi_detalle_integrante::create($datosNuevoRol);
                    }
                } else {
                    // Edición simple sin reemplazo
                    $registroOriginal->update([
                        'id_funcion' => $form['id_funcion'],
                        'idCarr'     => $form['idCarr'],
                        'horas'      => $form['horas'],
                        'anexo_integrante' => $form['anexo_integrante'],
                        'reemplazado' => 0
                    ]);
                }
            }

            DB::commit();
            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function catalogos()
    {
        $facultad = ['1', '2', '3', '4', '5', '11'];

        return response()->json([
            'funciones' => Invi_funcion::where('estado', 1)
                ->where('tipo_funcion', '=', 'VINCULACIÓN')
                ->get(),
            'carreras' => Carreras::where('StatusCarr', '=', 1)
                ->wherein('idfacultad', $facultad)
                ->where('NombCarr', 'NOT LIKE', '%TRABAJO DE INTEGRACIÓN CURRICULAR%')
                ->get(),
        ]);
    }

    public function inhabilitar(Request $request)
    {
        $integrante = Invi_detalle_integrante::findOrFail($request->id);

        $integrante->update([
            'horas' => 0,
            'reemplazado' => 1,
            'id_funcion' => null
        ]);

        return response()->json(['message' => 'Integrante inhabilitado correctamente']);
    }
    public function uploadArchivo(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf|mimetypes:application/pdf|max:10240', // 10MB
            'ci' => 'required|alpha_dash',
            'old_filename' => 'nullable|string',
        ]);

        try {
            $ci = basename($request->ci);
            $file = $request->file('file');
            if (!$file->isValid()) {
                throw new \Exception("Archivo inválido o corrupto.");
            }
            if ($request->filled('old_filename')) {
                $oldFilename = basename($request->old_filename); // Seguridad extra
                $oldPath = public_path("Documentos/Vinculación/AnexoIntegrante/{$ci}/{$oldFilename}");
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            // Crear carpeta si no existe
            $directory = public_path("Documentos/Vinculación/AnexoIntegrante/{$ci}");

            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true, true);
            }

            // Generar nombre: CI + _ + aleatorio + _ + fecha (Ymd_His)
            $aleatorio = bin2hex(random_bytes(8)); // 16 caracteres hex
            $fechaHora = date("Ymd_His");          // Ej: 20251112_1741
            $extension = $file->getClientOriginalExtension(); // pdf

            $filename = "{$ci}_{$aleatorio}_{$fechaHora}.{$extension}";

            // Guardar archivo
            $file->move($directory, $filename);

            // URL pública
            $url = url('Documentos/Vinculación/AnexoIntegrante/' . $ci . '/' . $filename);

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
