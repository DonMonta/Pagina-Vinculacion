<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Carreras;
use App\Models\informacionpersonal;
use App\Models\InformacionPersonalD;
use App\Models\Invi_deta_inte;
use App\Models\Invi_funcion;
use App\Models\Invi_proyectos;
use App\Models\Objetivos_pei;
use App\Models\Pei;
use App\Models\Subsistemas_pei;
use App\Models\Invi_detalle_obj_pei;
use App\Models\Plandne;
use App\Models\Politicas_plandne;
use App\Models\Invi_detalle_obj_pol_proyect;
use App\Models\Agenda_ODS;
use App\Models\ODS;
use App\Models\Invi_detalle_ods_proyect;
use App\Models\Facultad;
use App\Models\Invi_detalle_fac_proy;
use App\Models\Invi_detalle_carr_proy;
use App\Models\Invi_detalle_dom_hum;
use App\Models\Invi_dom_huma;
use App\Models\Invi_convocatoria;
use App\Models\Invi_linea_investigacion;
use App\Models\Invi_sub_linea_inves;
use App\Models\Invi_detalle_lin_inves;
use App\Models\SubareaUnesco;
use App\Models\Invi_detalle_area_unesco;
use App\Models\Invi_tip_proyect;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class Invi_proyectosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try { // 1. Obtener parámetros de búsqueda y paginación
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
                    'message' => 'No se encontraron datos',
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

    public function getStats()
    {
        try {
            // 1. Total de proyectos de Vinculación
            $totalProyectos = Invi_proyectos::where('proyect_tipo', 'VINCULACIÓN')->count();

            // Query base para integrantes activos en proyectos de vinculación
            $baseIntegrantes = Invi_deta_inte::where('reemplazado', 0)
                ->whereHas('invi_proyectos', function ($query) {
                    $query->where('proyect_tipo', 'VINCULACIÓN');
                });

            // 2. Contamos por nombre de función (usando tu lógica semántica)
            $statsIntegrantes = $baseIntegrantes->with('funciones')
                ->get()
                ->groupBy(function ($item) {
                    $nombre = strtoupper($item->funciones->nombre_funcion ?? '');
                    if (str_contains($nombre, 'DIRECTOR') && ! str_contains($nombre, 'SUB')) {
                        return 'director';
                    }
                    if (str_contains($nombre, 'SUBDIRECTOR')) {
                        return 'subdirector';
                    }
                    if (str_contains($nombre, 'DOCENTE PARTICIPANTE')) {
                        return 'docente';
                    }

                    return 'otros';
                });

            return response()->json([
                'status' => true,
                'stats' => [
                    'total_proyectos' => $totalProyectos,
                    'total_directores' => $statsIntegrantes->get('director', collect())->count(),
                    'total_subdirectores' => $statsIntegrantes->get('subdirector', collect())->count(),
                    'total_docentes' => $statsIntegrantes->get('docente', collect())->count(),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    /**
     * Obtiene los datos para llenar el modal de edición.
     */
    public function getEdicionDatos(int $id)
    {
        $proyecto = Invi_proyectos::with(
            'invi_detalle_obj_pro_pei',
            'invi_detalle_obj_pol_proyect',
            'invi_detalle_ods_proyect',
            'invi_detalle_fac_proy',
            'invi_detalle_carr_proy',
            'invi_detalle_dom_hum',
            'invi_detalle_lin_inves',
            'invi_detalle_area_unesco'
        )->findOrFail($id);

        // 1. Obtener el PEI activo (Asumo que estado_pei = 1 o true significa activo)
        $peiActivo = Pei::where('estado_pei', 1)->first();

        $objetivos = [];
        $preseleccionados = [];

        if ($peiActivo) {
            // 2. Obtener los objetivos de este PEI con su subsistema
            $objetivos = Objetivos_pei::with('subsistemas_pei')
                ->whereHas('subsistemas_pei', function ($query) use ($peiActivo) {
                    $query->where('id_pei', $peiActivo->id_pei);
                })->get();

            // 3. Buscar el objetivo de Vinculación para preseleccionarlo por defecto
            foreach ($objetivos as $obj) {
                $nombreSubsistema = strtolower($obj->subsistemas_pei->nombre_subsistema ?? '');

                // Extraemos los que el proyecto YA tiene asignados
                $asignadosIds = $proyecto->invi_detalle_obj_pro_pei->pluck('id_obj_pei')->toArray();

                // Si el proyecto ya tiene objetivos, usamos esos. 
                // Si está vacío, preseleccionamos el de vinculación.
                if (empty($asignadosIds)) {
                    if (str_contains($nombreSubsistema, 'vinculación') || str_contains($nombreSubsistema, 'vinculacion')) {
                        $preseleccionados[] = $obj->id_obj_pei;
                    }
                } else {
                    $preseleccionados = $asignadosIds;
                }
            }
        }

        $plandneActivo = Plandne::where('estado_plandne', 1)->first();
        $politicas = [];
        $politicasSeleccionadas = $proyecto->invi_detalle_obj_pol_proyect->pluck('id_pol_pladne')->toArray();
        $objetivosPoliticasSeleccionadas = [];

        if ($plandneActivo) {
            // Obtenemos todas las políticas incluyendo su relación 'objetivos_plandne'
            $politicas = Politicas_plandne::with('objetivos_plandne')
                ->whereHas('objetivos_plandne', function ($query) use ($plandneActivo) {
                    $query->where('id_pladne', $plandneActivo->id_pladne);
                })->get();

            // FILTRADO NUEVO: Si ya hay políticas seleccionadas en el proyecto, obtenemos sus objetivos únicos
            if (!empty($politicasSeleccionadas)) {
                $objetivosPoliticasSeleccionadas = Politicas_plandne::with('objetivos_plandne')
                    ->whereIn('id_pol_pladne', $politicasSeleccionadas)
                    ->get()
                    ->pluck('objetivos_plandne')
                    ->unique('id_obj_pol_pladne')
                    ->values();
            }
        }
        $agenda_odsactiva = Agenda_ODS::where('estado_ag_ods', 1)->first();
        $ods = [];
        $odsSeleccionadas = $proyecto->invi_detalle_ods_proyect->pluck('id_ods')->toArray();
        if ($agenda_odsactiva) {
            // Obtenemos todas las políticas cuyo objetivo pertenezca a la Agenda ODS activo
            $ods = ODS::whereHas('agenda_ods', function ($query) use ($agenda_odsactiva) {
                $query->where('id_ag_ods', $agenda_odsactiva->id_ag_ods);
            })->get();
        }
        // NUEVO: Obtener catálogo total de facultades disponibles en el sistema (reutilizando tu lógica de filtros)
        $sedes_atraer = ['1', '2'];
        $facultadesCatalogo = Facultad::whereIn('idsede', $sedes_atraer)
            ->where('idfacultad', '!=', '6')
            ->whereNotNull('decano')
            ->get();

        // NUEVO: Extraer datos de facultades ya guardadas para este proyecto
        $facultadesSeleccionadas = $proyecto->invi_detalle_fac_proy->pluck('idfacultad')->toArray();

        // La facultad prioritaria se extrae del primer registro (o mapeado de la tabla pivote)
        $facultadPrioritaria = $proyecto->invi_detalle_fac_proy->first()
            ? $proyecto->invi_detalle_fac_proy->first()->id_facultad_priori
            : null;
        // NUEVO: Extraer datos de carreras ya guardadas para este proyecto
        $carrerasSeleccionadas = $proyecto->invi_detalle_carr_proy->pluck('id_carr')->toArray();

        $carreraPrioritaria = $proyecto->invi_detalle_carr_proy->first()
            ? $proyecto->invi_detalle_carr_proy->first()->id_carr_priori
            : null;
        // NUEVO: Extraer catálogo total de dominios humanísticos y los seleccionados por el proyecto
        $dominiosCatalogo = Invi_dom_huma::all();
        $dominiosSeleccionados = $proyecto->invi_detalle_dom_hum->pluck('id_dom_hum')->toArray();
        $convocatoriasCatalogo = Invi_convocatoria::where('estado', 1)->get();
        $lineasCatalogo = Invi_linea_investigacion::where('estado_lin_investiga', 1)->get();
        $sublineasCatalogo = Invi_sub_linea_inves::all();
        // NUEVO: Sublíneas que el proyecto ya tiene guardadas
        $sublineasSeleccionadas = $proyecto->invi_detalle_lin_inves->pluck('id_sublin_investiga')->toArray();
        // NUEVO: Obtener y transformar catálogo completo de la UNESCO reutilizando la lógica de tu método index
        $unescoCatalogoRaw = SubareaUnesco::all();
        $unescoCatalogo = $unescoCatalogoRaw->map(function ($item) {
            $id = trim($item->sau_id);
            $pdid = trim($item->sau_pdid ?? '');
            $descripcion = mb_convert_encoding($item->sau_descripcion, 'ISO-8859-1', 'UTF-8');
            $descripcion_limpia = preg_replace('/^' . preg_quote($id, '/') . '\s*/', '', $descripcion);

            $longitud_id = strlen($id);
            $tipo = 'Desconocido';

            if (empty($pdid) && $longitud_id === 2) {
                $tipo = 'Área de conocimiento';
            } elseif (strlen($pdid) === 2 || $longitud_id === 3) {
                $tipo = 'Subárea de conocimiento';
            } elseif (strlen($pdid) >= 3 || $longitud_id >= 4) {
                $tipo = 'Área específica de conocimiento';
            }

            return [
                'sau_id'          => $id,
                'sau_pdid'        => $pdid,
                'sau_descripcion' => trim($descripcion_limpia),
                'tipo_area'       => $tipo
            ];
        });

        // NUEVO: Extraer los ids que el proyecto ya tiene guardados en `invi_detalle_area_unesco`
        $unescoSeleccionadas = $proyecto->invi_detalle_area_unesco->pluck('id_subarea_unesco')->toArray();
        $tip_proyectCatalogo = Invi_tip_proyect::all();

        return response()->json([
            'proyecto' => $proyecto,
            'objetivos_pei' => $objetivos,
            'seleccionados' => $preseleccionados,
            'politicas_plandne' => $politicas,
            'politicas_seleccionadas' => $politicasSeleccionadas,
            'objetivos_politicas_seleccionadas' => $objetivosPoliticasSeleccionadas,
            'ods' => $ods,
            'ods_seleccionadas' => $odsSeleccionadas,
            'facultades_catalogo' => $facultadesCatalogo,
            'facultades_seleccionadas' => $facultadesSeleccionadas,
            'id_facultad_priori' => $facultadPrioritaria,
            'carreras_seleccionadas' => $carrerasSeleccionadas,
            'id_carr_priori' => $carreraPrioritaria,
            'dominios_catalogo' => $dominiosCatalogo,
            'dominios_seleccionados' => $dominiosSeleccionados,
            'convocatorias_catalogo' => $convocatoriasCatalogo,
            'lineas_catalogo' => $lineasCatalogo,
            'sublineas_catalogo' => $sublineasCatalogo,
            'sublineas_seleccionadas' => $sublineasSeleccionadas,
            'unesco_catalogo' => $unescoCatalogo,
            'unesco_seleccionadas' => $unescoSeleccionadas,
            'tip_proyect_catalogo' => $tip_proyectCatalogo
        ]);
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
            'invi_detalle_integrante.informacionpersonal',
        ])->findOrFail($id);

        // 1. Extraer la facultad prioritaria
        $facultadPrincipal = $proyecto->invi_detalle_fac_proy
            ->whereNotNull('id_facultad_priori')
            ->first()?->facultades_priori;

        // 2. Extraer todas las facultades participantes
        $facultadesParticipantes = $proyecto->invi_detalle_fac_proy
            ->map(fn($detalle) => $detalle->facultades)
            ->filter()
            ->unique('idfacultad')
            ->values();

        // 3. Ordenar integrantes por nombre de la función
        $integrantesOrdenados = $proyecto->invi_detalle_integrante->sortBy(function ($integrante) {
            // Obtenemos el nombre de la función en mayúsculas para evitar problemas de case-sensitivity
            $nombreFuncion = strtoupper($integrante->funciones?->nombre_funcion ?? '');

            // Retornamos un peso numérico basado en el texto
            return match (true) {
                str_contains($nombreFuncion, 'DIRECTOR') && ! str_contains($nombreFuncion, 'SUB') => 10,
                str_contains($nombreFuncion, 'SUBDIRECTOR') => 20,
                str_contains($nombreFuncion, 'DOCENTE') => 30,
                str_contains($nombreFuncion, 'ESTUDIANTE') => 100,
                empty($nombreFuncion) => 999, // Integrantes sin función (reemplazados)
                default => 50, // Cualquier otra función intermedia
            };
        })->values();

        // 4. Formatear la respuesta JSON
        return response()->json([
            'proyect_id' => $proyecto->proyect_id,
            'proyect_nombre' => $proyecto->proyect_nombre,
            'proyect_titulo' => $proyecto->proyect_titulo,
            'fechainicio' => $proyecto->fechainicio,
            'fechafin' => $proyecto->fechafin,
            'facultades_priori' => $facultadPrincipal,
            'facultades' => $facultadesParticipantes,
            'invi_detalle_integrante' => $integrantesOrdenados,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $proyecto = Invi_proyectos::findOrFail($id);
            $proyecto->proyect_nombre = $request->proyect_nombre;
            $proyecto->proyect_titulo = $request->proyect_titulo;
            $proyecto->proyect_nombre_en = $request->proyect_nombre_en;
            $proyecto->proyect_titulo_en = $request->proyect_titulo_en;
            $proyecto->proyect_multidis = $request->proyect_multidis;
            $proyecto->id_convocatoria = $request->id_convocatoria;
            $proyecto->id_tip_invi_proy = $request->id_tip_invi_proy;


            $proyecto->save();

            // Actualizar la tabla detalle de objetivos
            Invi_detalle_obj_pei::where('proyect_id', $id)->delete();

            if ($request->has('objetivos') && is_array($request->objetivos)) {
                foreach ($request->objetivos as $id_obj) {
                    // OJO: Tu modelo tiene public $incrementing = false. 
                    // Si la BD no tiene auto-increment en 'id_det_obj_pro_pei', 
                    // deberás generar el ID manualmente aquí.
                    Invi_detalle_obj_pei::insert([
                        'proyect_id' => $id,
                        'id_obj_pei' => $id_obj
                    ]);
                }
            }
            Invi_detalle_obj_pol_proyect::where('proyect_id', $id)->delete();
            if ($request->has('politicas') && is_array($request->politicas)) {
                foreach ($request->politicas as $id_pol) {
                    Invi_detalle_obj_pol_proyect::insert([
                        'proyect_id'   => $id,
                        'id_pol_pladne' => $id_pol
                    ]);
                }
            }
            Invi_detalle_ods_proyect::where('proyect_id', $id)->delete();
            if ($request->has('ods') && is_array($request->ods)) {
                foreach ($request->ods as $id_ods) {
                    Invi_detalle_ods_proyect::insert([
                        'proyect_id'   => $id,
                        'id_ods' => $id_ods
                    ]);
                }
            }
            // NUEVO: --- Persistencia de Facultades (invi_detalle_fac_proy) ---
            Invi_detalle_fac_proy::where('proyect_id', $id)->delete();

            // Prioridad determinada por el cliente
            $idFacultadPriori = $request->id_facultad_priori;

            if ($request->proyect_multidis == 1) {
                // Caso Multidisciplinario: Múltiples registros apuntando al mismo id_facultad_priori
                if ($request->has('facultades') && is_array($request->facultades)) {
                    foreach ($request->facultades as $id_fac) {
                        Invi_detalle_fac_proy::insert([
                            'proyect_id'         => $id,
                            'idfacultad'         => $id_fac,
                            'id_facultad_priori' => $idFacultadPriori
                        ]);
                    }
                }
            } else {
                // Caso Disciplinar Estándar: Un único registro donde la facultad es a su vez la prioritaria
                if ($idFacultadPriori) {
                    Invi_detalle_fac_proy::insert([
                        'proyect_id'         => $id,
                        'idfacultad'         => $idFacultadPriori,
                        'id_facultad_priori' => $idFacultadPriori
                    ]);
                }
            }
            // NUEVO: --- Persistencia de Carreras (invi_detalle_carr_proy) ---
            Invi_detalle_carr_proy::where('proyect_id', $id)->delete();
            $idCarrPriori = $request->id_carr_priori;

            if ($request->proyect_multidis == 1) {
                // Caso Multidisciplinario: Múltiples carreras apuntando al mismo id_carr_priori
                if ($request->has('carreras') && is_array($request->carreras)) {
                    foreach ($request->carreras as $id_carr) {
                        // OJO: Si tu base de datos no tiene autoincrementable en id_det_carr, generarlo aquí manualmente.
                        Invi_detalle_carr_proy::insert([
                            'proyect_id'     => $id,
                            'id_carr'        => $id_carr,
                            'id_carr_priori' => $idCarrPriori
                        ]);
                    }
                }
            } else {
                // Caso Disciplinar Estándar: Un único registro donde id_carr es a su vez la prioritaria
                if ($idCarrPriori) {
                    Invi_detalle_carr_proy::insert([
                        'proyect_id'     => $id,
                        'id_carr'        => $idCarrPriori,
                        'id_carr_priori' => $idCarrPriori
                    ]);
                }
            }
            Invi_detalle_dom_hum::where('proyect_id', $id)->delete();
            if ($request->has('dominios_humanisticos') && is_array($request->dominios_humanisticos)) {
                foreach ($request->dominios_humanisticos as $id_dom) {
                    Invi_detalle_dom_hum::insert([
                        'proyect_id' => $id,
                        'id_dom_hum' => $id_dom
                    ]);
                }
            }
            Invi_detalle_lin_inves::where('proyect_id', $id)->delete();

            if ($request->has('sublineas_investigacion') && is_array($request->sublineas_investigacion)) {
                foreach ($request->sublineas_investigacion as $id_sublin) {
                    // Asegúrate de generar ID manual si tu PK no es auto-increment
                    Invi_detalle_lin_inves::insert([
                        'proyect_id'          => $id,
                        'id_sublin_investiga' => $id_sublin
                    ]);
                }
            }
            Invi_detalle_area_unesco::where('proyect_id', $id)->delete();
            if ($request->has('unesco_areas') && is_array($request->unesco_areas)) {
                foreach ($request->unesco_areas as $id_unesco) {
                    // Al ser public $incrementing = false y no poseer clave primaria autoincremental en el modelo,
                    // usamos insert directo sobre las columnas fillable.
                    Invi_detalle_area_unesco::insert([
                        'proyect_id'        => $id,
                        'id_subarea_unesco' => $id_unesco
                    ]);
                }
            }

            DB::commit();
            return response()->json(['message' => 'Proyecto actualizado correctamente.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al actualizar: ' . $e->getMessage()], 500);
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
        $estudiante = informacionpersonal::where('CIInfPer', $cedula)->first();

        if (! $docente && ! $estudiante) {
            return response()->json(['message' => 'Integrante no encontrado en la base de datos institucional.'], 404);
        }

        $persona = $docente ?: $estudiante;
        $tipo = $docente ? 'doc' : 'est';

        // 2. Validar estado en proyectos de VINCULACIÓN
        $proyectoActivo = Invi_deta_inte::where(function ($q) use ($cedula) {
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
                    'message' => 'El integrante ya está activo en otro proyecto: ' . $proyectoActivo->invi_proyectos->proyect_nombre,
                ], 422);
            }

            // CASO B: Está en el MISMO proyecto
            // Si NO es un reemplazo (o sea, es un 'Añadir Nuevo'), lanzamos error.
            if (! $es_reemplazo) {
                return response()->json([
                    'message' => 'Este integrante ya forma parte de los miembros activos de este proyecto.',
                ], 422);
            }
        }

        return response()->json([
            'cedula' => $persona->CIInfPer,
            'nombre_completo' => "{$persona->NombInfPer} {$persona->ApellInfPer} {$persona->ApellMatInfPer}",
            'tipo' => $tipo,
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
            // --- OBTENER CÓDIGO DEL PROYECTO ---
            $proyecto = Invi_proyectos::find($proyect_id);
            $codigoProyect = $proyecto?->proyect_cod ?? 'S/N';
            // Buscamos la función que se intenta asignar
            $funcionSolicitada = Invi_funcion::find($form['id_funcion']);
            $nombreUpper = strtoupper($funcionSolicitada?->nombre_funcion ?? '');

            // Verificamos si es Director o Subdirector por texto
            $esDirectivo = str_contains($nombreUpper, 'DIRECTOR');
            if ($modo === 'nuevo') {
                $cedula = $form['cedula_nueva'];
                $existe = Invi_deta_inte::where('proyect_id', $proyect_id)
                    ->where(function ($q) use ($cedula) {
                        $q->where('ciinfper_doc', $cedula)->orWhere('ciinfper_est', $cedula);
                    })
                    ->where('estado', 1)
                    ->exists();

                if ($existe) {
                    DB::rollBack();

                    return response()->json(['message' => 'Esta persona ya figura como integrante activo en este proyecto.'], 422);
                }
            }
            if ($modo === 'nuevo') {
                // Validar que no se agregue Director/Subdirector si ya existen
                if ($esDirectivo) {
                    $existe = Invi_deta_inte::where('proyect_id', $request->proyect_id)
                        ->where('id_funcion', $form['id_funcion'])
                        ->where('reemplazado', 0)
                        ->where('estado', 1)
                        ->exists();
                    if ($existe) {
                        return response()->json(['message' => "Ya existe un {$funcionSolicitada->nombre_funcion} activo."], 422);
                    }
                }

                Invi_deta_inte::create([
                    'proyect_id' => $proyect_id,
                    'ciinfper_doc' => $form['tipo_nuevo'] == 'doc' ? $form['cedula_nueva'] : null,
                    'ciinfper_est' => $form['tipo_nuevo'] == 'est' ? $form['cedula_nueva'] : null,
                    'horas' => $form['horas'],
                    'reemplazado' => 0,
                    'id_funcion' => $form['id_funcion'],
                    'idCarr' => $form['idCarr'],
                    'anexo_integrante2' => $form['anexo_integrante2'],
                    'estado' => 1,
                ]);
                $accionBitacora = 'REGISTRO DE NUEVO INTEGRANTE';
                $obsBitacora = "Se agregó a la cédula {$form['cedula_nueva']} al proyecto: {$codigoProyect} con función {$nombreUpper}";
            } else {
                // MODO EDICIÓN
                $registroOriginal = Invi_deta_inte::findOrFail($request->id_deta_invi_proyect);

                if ($form['reemplazado'] == 1) {
                    // 1. Procesar al que SALE (Registro Original)
                    if ($reemplazoConfig['mantener_docente']) {
                        $registroOriginal->update([
                            'reemplazado' => 1,
                            'id_funcion' => $reemplazoConfig['nueva_funcion_reemplazado'],
                            'horas' => $reemplazoConfig['nuevas_horas_reemplazado'] ?? 0,
                            'estado' => 1,
                        ]);
                    } else {
                        $registroOriginal->update([
                            'reemplazado' => 1,
                            'id_funcion' => null,
                            'horas' => 0,
                            'estado' => 0,
                        ]);
                    }

                    // 2. Procesar al que ENTRA (El reemplazo)
                    $cedulaNueva = $form['cedula_nueva'];

                    // BUSCAMOS si esta persona ya estaba en el proyecto (aunque sea con otro rol)
                    $integranteExistente = Invi_deta_inte::where('proyect_id', $proyect_id)
                        ->where(function ($q) use ($cedulaNueva) {
                            $q->where('ciinfper_doc', $cedulaNueva)
                                ->orWhere('ciinfper_est', $cedulaNueva);
                        })
                        ->first();

                    $datosNuevoRol = [
                        'proyect_id' => $proyect_id,
                        'ciinfper_doc' => $form['tipo_nuevo'] == 'doc' ? $cedulaNueva : null,
                        'ciinfper_est' => $form['tipo_nuevo'] == 'est' ? $cedulaNueva : null,
                        'horas' => $form['horas'],
                        'reemplazado' => 0, // El nuevo rol siempre entra como activo
                        'id_funcion' => $form['id_funcion'],
                        'idCarr' => $form['idCarr'],
                        'anexo_integrante' => $form['anexo_integrante'],
                        'estado' => 1,
                    ];

                    if ($integranteExistente) {
                        // SI YA EXISTÍA: Lo actualizamos en lugar de crear uno nuevo
                        $integranteExistente->update($datosNuevoRol);
                        $accionBitacora = 'REEMPLAZO DE INTEGRANTE EXISTENTE';
                        $obsBitacora = "Reemplazo en proyecto: {$codigoProyect}. Reemplazo del integrante ID: {$request->id_deta_invi_proyect}, por un docente del mismo proyecto con cédula: {$form['cedula_nueva']}";
                    } else {
                        // SI NO EXISTÍA: Lo creamos
                        Invi_deta_inte::create($datosNuevoRol);
                        $accionBitacora = 'REEMPLAZO DE INTEGRANTE POR UN DOCENTE NUEVO';
                        $obsBitacora = "Reemplazo en proyecto: {$codigoProyect}. Reemplazo del integrante ID: {$request->id_deta_invi_proyect}, por un docente nuevo con cédula: {$form['cedula_nueva']}";
                    }
                } else {
                    // Edición simple sin reemplazo
                    $registroOriginal->update([
                        'id_funcion' => $form['id_funcion'],
                        'idCarr' => $form['idCarr'],
                        'horas' => $form['horas'],
                        // 'anexo_integrante2' => $form['anexo_integrante2'],
                        'reemplazado' => 0,
                        'estado' => 1,
                    ]);
                    $accionBitacora = 'EDICIÓN DE INTEGRANTE';
                    $obsBitacora = "Se editaron datos del integrante ID: {$request->id_deta_invi_proyect} en proyecto: {$codigoProyect}";
                }
            }

            DB::commit();
            // --- REGISTRO EN BITÁCORA (Post-Commit) ---
            try {
                $user = Auth::user(); // Obtenemos el usuario autenticado
                Bitacora::create([
                    'bt_usuario' => $user->ciinfper,
                    'bt_fechahora' => Carbon::now(),
                    'bt_accion' => $accionBitacora . ' - VINCULACIÓN',
                    'bt_ippc' => $request->ip(),
                    'bt_observacion' => "USUARIO: {$user->NombUsu} REALIZÓ: {$obsBitacora}",
                ]);
            } catch (\Exception $ex) {
                Log::error('Error bitácora en guardarCambios: ' . $ex->getMessage());
            }

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
        $request->validate([
            'id' => 'required',
            'anexo_integrante' => 'required|string',
        ]);
        $integrante = Invi_deta_inte::findOrFail($request->id);
        // Guardamos los datos necesarios para la bitácora antes de limpiar los campos
        $cedulaAfectada = $integrante->ciinfper_doc ?? $integrante->ciinfper_est;
        $codigoProyect = $integrante->invi_proyectos?->proyect_cod ?? 'S/N';

        $integrante->update([
            'horas' => 0,
            'estado' => 0,
            'id_funcion' => null,
            'anexo_integrante' => $request->anexo_integrante,
        ]);
        // --- REGISTRO EN BITÁCORA ---
        try {
            $user = Auth::user();
            Bitacora::create([
                'bt_usuario' => $user->ciinfper,
                'bt_fechahora' => Carbon::now(),
                'bt_accion' => 'INHABILITAR INTEGRANTE - VINCULACIÓN',
                'bt_ippc' => $request->ip(),
                'bt_observacion' => "USUARIO: {$user->NombUsu} INHABILITÓ AL INTEGRANTE CÉDULA: {$cedulaAfectada} DEL PROYECTO: {$codigoProyect}. MOTIVO/ANEXO: {$request->anexo_integrante}",
            ]);
        } catch (\Exception $e) {
            Log::error('Error al registrar bitácora en inhabilitar: ' . $e->getMessage());
        }
        // --- FIN REGISTRO EN BITÁCORA ---

        return response()->json(['message' => 'Integrante inhabilitado correctamente']);
    }

    public function uploadArchivo(Request $request)
    {
        if ($request->hasFile('file')) {
            Log::info('Archivo detectado: ' . $request->file('file')->getClientOriginalName());
            Log::info('Error de subida PHP: ' . $request->file('file')->getError());
            Log::info('Tamaño recibido: ' . $request->file('file')->getSize());
        } else {
            Log::warning('No se detectó ningún archivo en la petición.');
        }
        $request->validate([
            'file' => 'required|max:10240', // 10MB
            'ci' => 'required|alpha_dash',
            'old_filename' => 'nullable|string',
        ]);

        try {
            $ci = basename($request->ci);
            $file = $request->file('file');
            if (! $file->isValid()) {
                throw new \Exception('Archivo inválido o corrupto.');
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

            if (! File::isDirectory($directory)) {
                File::makeDirectory($directory, 0755, true, true);
            }

            // Generar nombre: CI + _ + aleatorio + _ + fecha (Ymd_His)
            $aleatorio = bin2hex(random_bytes(8)); // 16 caracteres hex
            $fechaHora = date('Ymd_His');          // Ej: 20251112_1741
            $extension = $file->getClientOriginalExtension(); // pdf

            $filename = "{$ci}_{$aleatorio}_{$fechaHora}.{$extension}";

            // Guardar archivo
            $file->move($directory, $filename);

            // URL pública
            $url = url('Documentos/Vinculación/AnexoIntegrante/' . $ci . '/' . $filename);

            return response()->json([
                'status' => true,
                'filename' => $filename,
                'url' => $url,
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Seguridad: El archivo no pudo ser procesado.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function uploadArchivoDarBaja(Request $request)
    {
        if ($request->hasFile('file')) {
            Log::info('Archivo detectado: ' . $request->file('file')->getClientOriginalName());
            Log::info('Error de subida PHP: ' . $request->file('file')->getError());
            Log::info('Tamaño recibido: ' . $request->file('file')->getSize());
        } else {
            Log::warning('No se detectó ningún archivo en la petición.');
        }
        $request->validate([
            'file' => 'required|max:10240', // 10MB
            'ci' => 'required|alpha_dash',
            'old_filename' => 'nullable|string',
        ]);

        try {
            $ci = basename($request->ci);
            $file = $request->file('file');
            if (! $file->isValid()) {
                throw new \Exception('Archivo inválido o corrupto.');
            }
            if ($request->filled('old_filename')) {
                $oldFilename = basename($request->old_filename); // Seguridad extra
                $oldPath = public_path("Documentos/Vinculación/Bajas_Docentes/Anexo/{$ci}/{$oldFilename}");
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            // Crear carpeta si no existe
            $directory = public_path("Documentos/Vinculación/Bajas_Docentes/Anexo/{$ci}");

            if (! File::isDirectory($directory)) {
                File::makeDirectory($directory, 0755, true, true);
            }

            // Generar nombre: CI + _ + aleatorio + _ + fecha (Ymd_His)
            $aleatorio = bin2hex(random_bytes(8)); // 16 caracteres hex
            $fechaHora = date('Ymd_His');          // Ej: 20251112_1741
            $extension = $file->getClientOriginalExtension(); // pdf

            $filename = "{$ci}_{$aleatorio}_{$fechaHora}.{$extension}";

            // Guardar archivo
            $file->move($directory, $filename);

            // URL pública
            $url = url('Documentos/Vinculación/Bajas_Docentes/Anexo/' . $ci . '/' . $filename);

            return response()->json([
                'status' => true,
                'filename' => $filename,
                'url' => $url,
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Seguridad: El archivo no pudo ser procesado.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getDirectoresProyectosVinculacion(Request $request): JsonResponse
    {
        try {
            // 1. Consulta base utilizando Eager Loading para optimizar el rendimiento e incluir los títulos académicos
            $integrantes = Invi_deta_inte::with([
                'invi_proyectos',
                'funciones',
                'carreras.facultades',
                'informacionPersonalD.titulos.nivel', // <-- Incluimos la relación anidada para evaluar los títulos
            ])
                // Integrantes en estado 1 (Activos)
                ->where('estado', 1)

                // Filtramos por el tipo de proyecto
                ->whereHas('invi_proyectos', function ($query) {
                    $query->where('proyect_tipo', 'VINCULACION');
                })

                // Filtramos de forma estricta para evitar "Subdirector"
                ->whereHas('funciones', function ($query) {
                    $query->where('tipo_funcion', 'VINCULACIÓN')
                        ->where('nombre_funcion', 'LIKE', '%Director%')
                        ->where('nombre_funcion', 'NOT LIKE', '%Subdirector%'); // <-- Excluimos explícitamente Subdirector
                })
                ->get();

            $resultado = [];

            foreach ($integrantes as $integrante) {
                $persona = $integrante->informacionPersonalD;

                if (! $persona) {
                    continue; // Si el integrante no tiene registro de información de personal, pasamos al siguiente
                }

                // 2. Lógica de Género para Nombres y Cargos
                $esMujer = strtoupper(trim($persona->GeneroPer)) === 'F';
                $cargoFormateado = $esMujer ? 'Directora' : 'Director';

                // 3. Procesar títulos académicos filtrando por nv_numnivel (Eager Loaded)
                $tituloGrado = $persona->titulos->first(function ($titulo) {
                    return optional($titulo->nivel)->nv_numnivel == 3; // TERCER NIVEL
                });

                $tituloPosgrado = $persona->titulos->first(function ($titulo) {
                    return optional($titulo->nivel)->nv_numnivel == 4; // CUARTO NIVEL
                });

                $prefijoNombre = '';
                $sufijoNombre = '';

                // A. Mapeo ampliado de PREFIJOS (3er Nivel)
                if ($tituloGrado) {
                    $textoGrado = mb_strtolower($tituloGrado->ad_titulo);

                    if (str_contains($textoGrado, 'licencia')) {
                        $prefijoNombre = $esMujer ? 'Lcda.' : 'Lcdo.';
                    } elseif (
                        str_contains($textoGrado, 'ingenier') || str_contains($textoGrado, 'ing.') ||
                        str_contains($textoGrado, 'ingeniería') || str_contains($textoGrado, 'tecnolog')
                    ) {
                        $prefijoNombre = 'Ing.';
                    } elseif (str_contains($textoGrado, 'econom') || str_contains($textoGrado, 'econ.')) {
                        $prefijoNombre = 'Econ.';
                    } elseif (str_contains($textoGrado, 'abogad') || str_contains($textoGrado, 'abg.')) {
                        $prefijoNombre = 'Abg.';
                    } elseif (str_contains($textoGrado, 'arquitect') || str_contains($textoGrado, 'arq.')) {
                        $prefijoNombre = 'Arq.';
                    } else {
                        $prefijoNombre = 'Prof.';
                    }
                } else {
                    $prefijoNombre = $esMujer ? 'Sra.' : 'Sr.';
                }

                // B. Definir el SUFIJO (4to Nivel)
                if ($tituloPosgrado) {
                    $textoPosgrado = mb_strtolower($tituloPosgrado->ad_titulo);

                    if (str_contains($textoPosgrado, 'phd') || str_contains($textoPosgrado, 'doctorado') || str_contains($textoPosgrado, 'doctor')) {
                        $sufijoNombre = ', PhD';
                    } elseif (str_contains($textoPosgrado, 'msc') || str_contains($textoPosgrado, 'science') || str_contains($textoPosgrado, 'ciencias')) {
                        $sufijoNombre = ', MSc.';
                    } else {
                        $sufijoNombre = ', Mgtr.';
                    }
                }

                // Formatear Nombres y Apellidos en formato Title Case
                $nombreRaw = trim($persona->NombInfPer . ' ' . $persona->ApellInfPer . ' ' . $persona->ApellMatInfPer);
                $nombresFormateados = mb_convert_case(mb_strtolower($nombreRaw, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');

                // Construcción del nombre con rango académico completo
                $nombreCompletoConTitulo = trim("{$prefijoNombre} {$nombresFormateados}{$sufijoNombre}");

                // 4. Obtener y formatear el Nombre de la Carrera
                $nombreCarrera = 'No asignada';
                if ($integrante->carreras) {
                    $nombreCarreraRaw = trim($integrante->carreras->NombCarr);
                    $nombreCarrera = mb_convert_case(mb_strtolower($nombreCarreraRaw, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
                }
                $carreraLimpia = preg_replace('/\s*-\s*\d+.*$/', '', $nombreCarrera);

                // 2. Convertimos de "INGENIERIA QUIMICA" a "Ingeniería Química" (Title Case)
                $nombreCarreraFinal = mb_convert_case($carreraLimpia, MB_CASE_TITLE, "UTF-8");
                // 5. Obtener la Facultad y sus Siglas
                $nombreFacultad = 'No asignada';
                $siglasFacultad = 'No asignada';
                if ($integrante->carreras && $integrante->carreras->facultades->isNotEmpty()) {
                    $facultadAsociada = $integrante->carreras->facultades->first();
                    $nombreFacultad = mb_convert_case(mb_strtolower(trim($facultadAsociada->facultad), 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
                    $siglasFacultad = trim($facultadAsociada->siglas);
                }

                // 6. Estructura del objeto individual
                $resultado[] = [
                    'cedula' => $persona->CIInfPer,
                    'nombres_apellidos' => $nombresFormateados,      // Solo nombres limpios
                    'nombre_con_titulo' => $nombreCompletoConTitulo, // Formato "Ing. Juan Perez, MSc."
                    'funcion' => $integrante->funciones->nombre_funcion ?? 'Desconocida',
                    'cargo_genero' => $cargoFormateado,         // Regresa "Director" o "Directora"
                    'carrera' => $nombreCarreraFinal,
                    'facultad' => $nombreFacultad,
                    'siglas' => $siglasFacultad,
                    'proyecto_nombre' => $integrante->invi_proyectos->proyect_nombre ?? 'No registrado',
                    'titulo_grado' => $tituloGrado ? $tituloGrado->ad_titulo : null,
                    'titulo_posgrado' => $tituloPosgrado ? $tituloPosgrado->ad_titulo : null,
                ];
            }

            // 7. Retornar la respuesta JSON
            return response()->json([
                'success' => true,
                'total' => count($resultado),
                'data' => $resultado,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Ocurrió un error al consultar los directores de proyectos.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
    public function getSubDireProyectosVinculacion(Request $request): JsonResponse
    {
        try {
            // 1. Consulta base utilizando Eager Loading para optimizar el rendimiento e incluir los títulos académicos
            $integrantes = Invi_deta_inte::with([
                'invi_proyectos',
                'funciones',
                'carreras.facultades',
                'informacionPersonalD.titulos.nivel', // <-- Incluimos la relación anidada para evaluar los títulos
            ])
                // Integrantes en estado 1 (Activos)
                ->where('estado', 1)

                // Filtramos por el tipo de proyecto
                ->whereHas('invi_proyectos', function ($query) {
                    $query->where('proyect_tipo', 'VINCULACION');
                })

                // Filtramos de forma estricta para evitar "Subdirector"
                ->whereHas('funciones', function ($query) {
                    $query->where('tipo_funcion', 'VINCULACIÓN')
                        ->where('nombre_funcion', 'LIKE', '%Subdirector%'); // <-- Excluimos explícitamente Subdirector
                })
                ->get();

            $resultado = [];

            foreach ($integrantes as $integrante) {
                $persona = $integrante->informacionPersonalD;

                if (! $persona) {
                    continue; // Si el integrante no tiene registro de información de personal, pasamos al siguiente
                }

                // 2. Lógica de Género para Nombres y Cargos
                $esMujer = strtoupper(trim($persona->GeneroPer)) === 'F';
                $cargoFormateado = $esMujer ? 'Subdirectora' : 'Subdirector';

                // 3. Procesar títulos académicos filtrando por nv_numnivel (Eager Loaded)
                $tituloGrado = $persona->titulos->first(function ($titulo) {
                    return optional($titulo->nivel)->nv_numnivel == 3; // TERCER NIVEL
                });

                $tituloPosgrado = $persona->titulos->first(function ($titulo) {
                    return optional($titulo->nivel)->nv_numnivel == 4; // CUARTO NIVEL
                });

                $prefijoNombre = '';
                $sufijoNombre = '';

                // A. Mapeo ampliado de PREFIJOS (3er Nivel)
                if ($tituloGrado) {
                    $textoGrado = mb_strtolower($tituloGrado->ad_titulo);

                    if (str_contains($textoGrado, 'licencia')) {
                        $prefijoNombre = $esMujer ? 'Lcda.' : 'Lcdo.';
                    } elseif (
                        str_contains($textoGrado, 'ingenier') || str_contains($textoGrado, 'ing.') ||
                        str_contains($textoGrado, 'ingeniería') || str_contains($textoGrado, 'tecnolog')
                    ) {
                        $prefijoNombre = 'Ing.';
                    } elseif (str_contains($textoGrado, 'econom') || str_contains($textoGrado, 'econ.')) {
                        $prefijoNombre = 'Econ.';
                    } elseif (str_contains($textoGrado, 'abogad') || str_contains($textoGrado, 'abg.')) {
                        $prefijoNombre = 'Abg.';
                    } elseif (str_contains($textoGrado, 'arquitect') || str_contains($textoGrado, 'arq.')) {
                        $prefijoNombre = 'Arq.';
                    } else {
                        $prefijoNombre = 'Prof.';
                    }
                } else {
                    $prefijoNombre = $esMujer ? 'Sra.' : 'Sr.';
                }

                // B. Definir el SUFIJO (4to Nivel)
                if ($tituloPosgrado) {
                    $textoPosgrado = mb_strtolower($tituloPosgrado->ad_titulo);

                    if (str_contains($textoPosgrado, 'phd') || str_contains($textoPosgrado, 'doctorado') || str_contains($textoPosgrado, 'doctor')) {
                        $sufijoNombre = ', PhD';
                    } elseif (str_contains($textoPosgrado, 'msc') || str_contains($textoPosgrado, 'science') || str_contains($textoPosgrado, 'ciencias')) {
                        $sufijoNombre = ', MSc.';
                    } else {
                        $sufijoNombre = ', Mgtr.';
                    }
                }

                // Formatear Nombres y Apellidos en formato Title Case
                $nombreRaw = trim($persona->NombInfPer . ' ' . $persona->ApellInfPer . ' ' . $persona->ApellMatInfPer);
                $nombresFormateados = mb_convert_case(mb_strtolower($nombreRaw, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');

                // Construcción del nombre con rango académico completo
                $nombreCompletoConTitulo = trim("{$prefijoNombre} {$nombresFormateados}{$sufijoNombre}");

                // 4. Obtener y formatear el Nombre de la Carrera
                $nombreCarrera = 'No asignada';
                if ($integrante->carreras) {
                    $nombreCarreraRaw = trim($integrante->carreras->NombCarr);
                    $nombreCarrera = mb_convert_case(mb_strtolower($nombreCarreraRaw, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
                }
                $carreraLimpia = preg_replace('/\s*-\s*\d+.*$/', '', $nombreCarrera);

                // 2. Convertimos de "INGENIERIA QUIMICA" a "Ingeniería Química" (Title Case)
                $nombreCarreraFinal = mb_convert_case($carreraLimpia, MB_CASE_TITLE, "UTF-8");
                // 5. Obtener la Facultad y sus Siglas
                $nombreFacultad = 'No asignada';
                $siglasFacultad = 'No asignada';
                if ($integrante->carreras && $integrante->carreras->facultades->isNotEmpty()) {
                    $facultadAsociada = $integrante->carreras->facultades->first();
                    $nombreFacultad = mb_convert_case(mb_strtolower(trim($facultadAsociada->facultad), 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
                    $siglasFacultad = trim($facultadAsociada->siglas);
                }

                // 6. Estructura del objeto individual
                $resultado[] = [
                    'cedula' => $persona->CIInfPer,
                    'nombres_apellidos' => $nombresFormateados,      // Solo nombres limpios
                    'nombre_con_titulo' => $nombreCompletoConTitulo, // Formato "Ing. Juan Perez, MSc."
                    'funcion' => $integrante->funciones->nombre_funcion ?? 'Desconocida',
                    'cargo_genero' => $cargoFormateado,         // Regresa "Director" o "Directora"
                    'carrera' => $nombreCarreraFinal,
                    'facultad' => $nombreFacultad,
                    'siglas' => $siglasFacultad,
                    'proyecto_nombre' => $integrante->invi_proyectos->proyect_nombre ?? 'No registrado',
                    'titulo_grado' => $tituloGrado ? $tituloGrado->ad_titulo : null,
                    'titulo_posgrado' => $tituloPosgrado ? $tituloPosgrado->ad_titulo : null,
                ];
            }

            // 7. Retornar la respuesta JSON
            return response()->json([
                'success' => true,
                'total' => count($resultado),
                'data' => $resultado,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Ocurrió un error al consultar los directores de proyectos.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
    public function getDocentesProyectosVinculacion(Request $request): JsonResponse
    {
        try {
            // 1. Consulta base utilizando Eager Loading para optimizar el rendimiento e incluir los títulos académicos
            $integrantes = Invi_deta_inte::with([
                'invi_proyectos',
                'funciones',
                'carreras.facultades',
                'informacionPersonalD.titulos.nivel', // <-- Incluimos la relación anidada para evaluar los títulos
            ])
                // Integrantes en estado 1 (Activos)
                ->where('estado', 1)

                // Filtramos por el tipo de proyecto
                ->whereHas('invi_proyectos', function ($query) {
                    $query->where('proyect_tipo', 'VINCULACION');
                })

                // Filtramos de forma estricta para evitar "Subdirector"
                ->whereHas('funciones', function ($query) {
                    $query->where('tipo_funcion', 'VINCULACIÓN')
                        ->where('nombre_funcion', 'LIKE', '%Docente%')
                        ->where('nombre_funcion', 'NOT LIKE', '%Director%')
                        ->where('nombre_funcion', 'NOT LIKE', '%Subdirector%'); // <-- Excluimos explícitamente Subdirector
                })
                ->get();

            $resultado = [];

            foreach ($integrantes as $integrante) {
                $persona = $integrante->informacionPersonalD;

                if (! $persona) {
                    continue; // Si el integrante no tiene registro de información de personal, pasamos al siguiente
                }

                // 2. Lógica de Género para Nombres y Cargos
                $esMujer = strtoupper(trim($persona->GeneroPer)) === 'F';
                $cargoFormateado = $esMujer ? 'Docente' : 'Docente';

                // 3. Procesar títulos académicos filtrando por nv_numnivel (Eager Loaded)
                $tituloGrado = $persona->titulos->first(function ($titulo) {
                    return optional($titulo->nivel)->nv_numnivel == 3; // TERCER NIVEL
                });

                $tituloPosgrado = $persona->titulos->first(function ($titulo) {
                    return optional($titulo->nivel)->nv_numnivel == 4; // CUARTO NIVEL
                });

                $prefijoNombre = '';
                $sufijoNombre = '';

                // A. Mapeo ampliado de PREFIJOS (3er Nivel)
                if ($tituloGrado) {
                    $textoGrado = mb_strtolower($tituloGrado->ad_titulo);

                    if (str_contains($textoGrado, 'licencia')) {
                        $prefijoNombre = $esMujer ? 'Lcda.' : 'Lcdo.';
                    } elseif (
                        str_contains($textoGrado, 'ingenier') || str_contains($textoGrado, 'ing.') ||
                        str_contains($textoGrado, 'ingeniería') || str_contains($textoGrado, 'tecnolog')
                    ) {
                        $prefijoNombre = 'Ing.';
                    } elseif (str_contains($textoGrado, 'econom') || str_contains($textoGrado, 'econ.')) {
                        $prefijoNombre = 'Econ.';
                    } elseif (str_contains($textoGrado, 'abogad') || str_contains($textoGrado, 'abg.')) {
                        $prefijoNombre = 'Abg.';
                    } elseif (str_contains($textoGrado, 'arquitect') || str_contains($textoGrado, 'arq.')) {
                        $prefijoNombre = 'Arq.';
                    } else {
                        $prefijoNombre = 'Prof.';
                    }
                } else {
                    $prefijoNombre = $esMujer ? 'Sra.' : 'Sr.';
                }

                // B. Definir el SUFIJO (4to Nivel)
                if ($tituloPosgrado) {
                    $textoPosgrado = mb_strtolower($tituloPosgrado->ad_titulo);

                    if (str_contains($textoPosgrado, 'phd') || str_contains($textoPosgrado, 'doctorado') || str_contains($textoPosgrado, 'doctor')) {
                        $sufijoNombre = ', PhD';
                    } elseif (str_contains($textoPosgrado, 'msc') || str_contains($textoPosgrado, 'science') || str_contains($textoPosgrado, 'ciencias')) {
                        $sufijoNombre = ', MSc.';
                    } else {
                        $sufijoNombre = ', Mgtr.';
                    }
                }

                // Formatear Nombres y Apellidos en formato Title Case
                $nombreRaw = trim($persona->NombInfPer . ' ' . $persona->ApellInfPer . ' ' . $persona->ApellMatInfPer);
                $nombresFormateados = mb_convert_case(mb_strtolower($nombreRaw, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');

                // Construcción del nombre con rango académico completo
                $nombreCompletoConTitulo = trim("{$prefijoNombre} {$nombresFormateados}{$sufijoNombre}");

                // 4. Obtener y formatear el Nombre de la Carrera
                $nombreCarrera = 'No asignada';
                if ($integrante->carreras) {
                    $nombreCarreraRaw = trim($integrante->carreras->NombCarr);
                    $nombreCarrera = mb_convert_case(mb_strtolower($nombreCarreraRaw, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
                }
                $carreraLimpia = preg_replace('/\s*-\s*\d+.*$/', '', $nombreCarrera);

                // 2. Convertimos de "INGENIERIA QUIMICA" a "Ingeniería Química" (Title Case)
                $nombreCarreraFinal = mb_convert_case($carreraLimpia, MB_CASE_TITLE, "UTF-8");
                // 5. Obtener la Facultad y sus Siglas
                $nombreFacultad = 'No asignada';
                $siglasFacultad = 'No asignada';
                if ($integrante->carreras && $integrante->carreras->facultades->isNotEmpty()) {
                    $facultadAsociada = $integrante->carreras->facultades->first();
                    $nombreFacultad = mb_convert_case(mb_strtolower(trim($facultadAsociada->facultad), 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
                    $siglasFacultad = trim($facultadAsociada->siglas);
                }

                // 6. Estructura del objeto individual
                $resultado[] = [
                    'cedula' => $persona->CIInfPer,
                    'nombres_apellidos' => $nombresFormateados,      // Solo nombres limpios
                    'nombre_con_titulo' => $nombreCompletoConTitulo, // Formato "Ing. Juan Perez, MSc."
                    'funcion' => $integrante->funciones->nombre_funcion ?? 'Desconocida',
                    'cargo_genero' => $cargoFormateado,         // Regresa "Director" o "Directora"
                    'carrera' => $nombreCarreraFinal,
                    'facultad' => $nombreFacultad,
                    'siglas' => $siglasFacultad,
                    'proyecto_nombre' => $integrante->invi_proyectos->proyect_nombre ?? 'No registrado',
                    'titulo_grado' => $tituloGrado ? $tituloGrado->ad_titulo : null,
                    'titulo_posgrado' => $tituloPosgrado ? $tituloPosgrado->ad_titulo : null,
                ];
            }

            // 7. Retornar la respuesta JSON
            return response()->json([
                'success' => true,
                'total' => count($resultado),
                'data' => $resultado,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Ocurrió un error al consultar los directores de proyectos.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
    public function getEstProyectosVinculacion(Request $request): JsonResponse
    {
        try {
            // 1. Consulta base utilizando Eager Loading para optimizar el rendimiento e incluir los títulos académicos
            $integrantes = Invi_deta_inte::with([
                'invi_proyectos',
                'funciones',
                'carreras.facultades',
                'informacionpersonal', // <-- Incluimos la relación anidada para evaluar los títulos
            ])
                // Integrantes en estado 1 (Activos)
                ->where('estado', 1)

                // Filtramos por el tipo de proyecto
                ->whereHas('invi_proyectos', function ($query) {
                    $query->where('proyect_tipo', 'VINCULACION');
                })

                // Filtramos de forma estricta para evitar "Subdirector"
                ->whereHas('funciones', function ($query) {
                    $query->where('tipo_funcion', 'VINCULACIÓN')
                        ->where('nombre_funcion', 'LIKE', '%Estudiante%')
                        ->where('nombre_funcion', 'NOT LIKE', '%Docente%')
                        ->where('nombre_funcion', 'NOT LIKE', '%Director%')
                        ->where('nombre_funcion', 'NOT LIKE', '%Subdirector%'); // <-- Excluimos explícitamente Subdirector
                })
                ->get();

            $resultado = $integrantes->map(function ($integrante) {

                // Los directores generalmente son docentes (informacionPersonalD), 
                // pero validamos ambas relaciones por seguridad.
                $persona = $integrante->informacionpersonal;

                // Formatear Nombres y Apellidos (Title Case)
                $nombresCompletos = 'Datos no registrados';
                if ($persona) {
                    $nombreRaw = trim($persona->NombInfPer . ' ' . $persona->ApellInfPer . ' ' . $persona->ApellMatInfPer);
                    // Convertimos todo a minúscula primero y luego a Title Case
                    $nombresCompletos = mb_convert_case(mb_strtolower($nombreRaw, 'UTF-8'), MB_CASE_TITLE, "UTF-8");
                }

                // 4. Obtener y formatear el Nombre de la Carrera
                $nombreCarrera = 'No asignada';
                if ($integrante->carreras) {
                    $nombreCarreraRaw = trim($integrante->carreras->NombCarr);
                    $nombreCarrera = mb_convert_case(mb_strtolower($nombreCarreraRaw, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
                }
                $carreraLimpia = preg_replace('/\s*-\s*\d+.*$/', '', $nombreCarrera);

                // 2. Convertimos de "INGENIERIA QUIMICA" a "Ingeniería Química" (Title Case)
                $nombreCarreraFinal = mb_convert_case($carreraLimpia, MB_CASE_TITLE, "UTF-8");
                // 5. Obtener la Facultad y sus Siglas
                $nombreFacultad = 'No asignada';
                $siglasFacultad = 'No asignada';
                if ($integrante->carreras && $integrante->carreras->facultades->isNotEmpty()) {
                    $facultadAsociada = $integrante->carreras->facultades->first();
                    $nombreFacultad = mb_convert_case(mb_strtolower(trim($facultadAsociada->facultad), 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
                    $siglasFacultad = trim($facultadAsociada->siglas);
                }

                // Retornamos el objeto estructurado
                return [
                    'nombres_apellidos' => $nombresCompletos,
                    'funcion'           => $integrante->funciones->nombre_funcion ?? 'Desconocida',
                    'carrera'           => $nombreCarreraFinal,
                    'facultad'          => $nombreFacultad,
                    'siglas'            => $siglasFacultad,
                    // Agrego estos campos extra porque suelen ser muy útiles para el Frontend
                    'proyecto_nombre'   => $integrante->invi_proyectos->proyect_nombre ?? 'No registrado',
                    'cedula'            => $persona ? $persona->CIInfPer : null
                ];
            });

            // 3. Retornar la respuesta JSON
            return response()->json([
                'success' => true,
                'total'   => $resultado->count(),
                'data'    => $resultado
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Ocurrió un error al consultar los directores de proyectos.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
    public function getProyectosVinculacionInfo(): JsonResponse
    {
        try {
            // 1. Consulta base con Eager Loading para toda la jerarquía de relaciones
            $proyectos = Invi_proyectos::with([
                'invi_detalle_fac_proy.facultades_priori.linea_investigacion.sub_linea_investigacion.carreras'
            ])
                ->where('proyect_tipo', 'VINCULACION')
                ->get();

            $hoy = Carbon::now();
            $resultado = [];

            foreach ($proyectos as $proyecto) {
                // 2. Lógica de Fechas y Estado
                $estadoProyecto = 'Desconocido';
                $duracionTotalTexto = 'Fechas no definidas';
                $tiempoRestanteTexto = 'No calculable';

                if ($proyecto->fechainicio && $proyecto->fechafin) {
                    $inicio = Carbon::parse($proyecto->fechainicio)->startOfDay();
                    $fin = Carbon::parse($proyecto->fechafin)->endOfDay();

                    // Calculamos la duración total en meses y días
                    $mesesDuracion = $inicio->diffInMonths($fin);
                    $diasDuracion = $inicio->copy()->addMonths($mesesDuracion)->diffInDays($fin);
                    $duracionTotalTexto = "{$mesesDuracion} meses y {$diasDuracion} días";

                    // Evaluamos el estado actual
                    if ($hoy->greaterThan($fin)) {
                        $estadoProyecto = 'Finalizado';
                        $tiempoRestanteTexto = 'El proyecto ya finalizó';
                    } elseif ($hoy->lessThan($inicio)) {
                        $estadoProyecto = 'Por iniciar';
                        $diasParaInicio = $hoy->diffInDays($inicio);
                        $tiempoRestanteTexto = "Inicia en {$diasParaInicio} días";
                    } else {
                        $estadoProyecto = 'Vigente';
                        $mesesRestantes = $hoy->diffInMonths($fin);
                        $diasRestantes = $hoy->copy()->addMonths($mesesRestantes)->diffInDays($fin);

                        $textoRestante = [];
                        if ($mesesRestantes > 0) $textoRestante[] = "{$mesesRestantes} meses";
                        if ($diasRestantes > 0) $textoRestante[] = "{$diasRestantes} días";

                        $tiempoRestanteTexto = !empty($textoRestante)
                            ? implode(' y ', $textoRestante) . ' restantes'
                            : 'Finaliza hoy';
                    }
                }

                // 3. Extracción de Líneas y Sublíneas de Investigación
                $lineasInvestigacion = [];
                $facultadPrincipal = null;

                // Verificamos que tenga detalles y extraemos la facultad prioritaria (principal)
                if ($proyecto->invi_detalle_fac_proy->isNotEmpty()) {
                    $detallePriori = $proyecto->invi_detalle_fac_proy->firstWhere('id_facultad_priori', '!=', null);

                    if ($detallePriori && $detallePriori->facultades_priori) {
                        $facultad = $detallePriori->facultades_priori;
                        $facultadPrincipal = $facultad->facultad . ' (' . $facultad->siglas . ')';

                        // Mapeamos las líneas de investigación de esa facultad
                        foreach ($facultad->linea_investigacion as $linea) {

                            // Mapeamos las sublíneas correspondientes a esta línea
                            $sublineas = $linea->sub_linea_investigacion->map(function ($sublinea) {
                                $nombreCarreraLimpio = 'No asignada';

                                if ($sublinea->carreras) {
                                    $nombreRaw = trim($sublinea->carreras->NombCarr);
                                    // Utilizamos preg_replace para eliminar un guion seguido de espacios opcionales y números al final
                                    // Ej: "Quimica -2020" o "Quimica - 2020" -> "Quimica"
                                    $nombreCarreraLimpio = trim(preg_replace('/-\s*\d+.*$/', '', $nombreRaw));
                                }
                                return [
                                    'nombre_sublinea' => $sublinea->nombre_sublin,
                                    'objeto_estudio'  => $sublinea->objeto_estudio_sublin,
                                    'carrera_aplica'  => $nombreCarreraLimpio
                                ];
                            });

                            $lineasInvestigacion[] = [
                                'nombre_linea' => $linea->nombre_lin,
                                'estado_linea' => $linea->estado_lin_investiga == 1 ? 'Activa' : 'Inactiva',
                                'sublineas'    => $sublineas->toArray()
                            ];
                        }
                    }
                }

                // 4. Construcción del Objeto Final
                $resultado[] = [
                    'codigo_proyecto'   => $proyecto->proyect_cod,
                    'nombre_proyecto'   => $proyecto->proyect_nombre,
                    'estado_temporal'   => $estadoProyecto,
                    'fechas' => [
                        'inicio'        => $proyecto->fechainicio,
                        'fin'           => $proyecto->fechafin,
                    ],
                    'metricas_tiempo' => [
                        'duracion_total'  => $duracionTotalTexto,
                        'tiempo_restante' => $tiempoRestanteTexto
                    ],
                    'facultad_principal' => $facultadPrincipal ?? 'No definida',
                    'lineas_investigacion' => $lineasInvestigacion
                ];
            }

            return response()->json([
                'success' => true,
                'total'   => count($resultado),
                'data'    => $resultado
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error'   => 'Error al procesar los proyectos de vinculación.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
