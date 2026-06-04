<?php

namespace App\Http\Controllers;

use App\Models\SeguiFormulario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Bitacora;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\SeguiEncuesta;
use App\Models\SeguiDetalleEncuesta;
use Illuminate\Http\Response;

class SeguiFormularioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = SeguiFormulario::select(
                'seguiformulario.ID',
                'seguiformulario.NOMBRE',
                'seguiformulario.ACTIVO',
                'seguiformulario.UP',
                'seguiformulario.FINS',
                'seguiformulario.UD',
                'seguiformulario.FDEL',
                'seguiformulario.TOTAL',
                'seguiformulario.porcentaje',
                'seguiformulario.tipoencuesta'
            )
                ->addSelect([
                    // 🔹 Subconsulta 1: Cuenta las preguntas vinculadas al formulario
                    'total_preguntas' => DB::table('seguipreguntas')
                        ->selectRaw('COUNT(*)')
                        ->whereColumn('seguipreguntas.IDFORMULARIO', 'seguiformulario.ID'),

                    // 🔹 Subconsulta 2: Cuenta las encuestas/respuestas vinculadas al formulario
                    'total_encuestas' => DB::table('seguiencuesta')
                        ->selectRaw('COUNT(DISTINCT seguiencuesta.ID)')
                        ->whereColumn('seguiencuesta.idformulario', 'seguiformulario.ID')
                ])
                ->where('seguiformulario.tipoencuesta', 'LIKE', '%CÁTEDRA%')
                ->orderBy('seguiformulario.ID', 'desc');

            // Si el usuario pide todos los datos (sin paginación)
            if ($request->has('all') && $request->all === 'true') {
                $data = $query->get();

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

            // Paginación (por defecto 20)
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
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en el servidor: ' . $e->getMessage()], 500);
        }
    }
    public function getformGraduados(Request $request)
    {
        try {
            $query = SeguiFormulario::select(
                'seguiformulario.ID',
                'seguiformulario.NOMBRE',
                'seguiformulario.ACTIVO',
                'seguiformulario.UP',
                'seguiformulario.FINS',
                'seguiformulario.UD',
                'seguiformulario.FDEL',
                'seguiformulario.TOTAL',
                'seguiformulario.porcentaje',
                'seguiformulario.tipoencuesta'
            )
                ->addSelect([
                    // 🔹 Subconsulta 1: Cuenta las preguntas vinculadas al formulario
                    'total_preguntas' => DB::table('seguipreguntas')
                        ->selectRaw('COUNT(*)')
                        ->whereColumn('seguipreguntas.IDFORMULARIO', 'seguiformulario.ID'),

                    // 🔹 Subconsulta 2: Cuenta las encuestas/respuestas vinculadas al formulario
                    'total_encuestas' => DB::table('seguiencuesta')
                        ->selectRaw('COUNT(DISTINCT seguiencuesta.ID)')
                        ->whereColumn('seguiencuesta.idformulario', 'seguiformulario.ID')
                ])
                ->where('seguiformulario.tipoencuesta', 'LIKE', '%Graduados%')
                ->orderBy('seguiformulario.ID', 'desc');

            // Si el usuario pide todos los datos (sin paginación)
            if ($request->has('all') && $request->all === 'true') {
                $data = $query->get();

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

            // Paginación (por defecto 20)
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
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en el servidor: ' . $e->getMessage()], 500);
        }
    }
    //Funcion para obtener el formulario de inscripcion de catedra habilitado
    public function getCatedraInscripcion(Request $request)
    {
        // 1. Buscar el formulario activo de tipo Inscripción
        $data = SeguiFormulario::where('seguiformulario.tipoencuesta', 'LIKE', '%Inscripción%')
            ->where('seguiformulario.ACTIVO', 1)
            ->first();

        $yaInscrito = false;

        // 2. Si hay un formulario activo y se envió la cédula, validar si ya existe la encuesta
        if ($data && $request->has('cedula')) {
            $yaInscrito = SeguiEncuesta::where('cedula_estudiante', $request->cedula)
                ->where('idformulario', $data->ID)
                ->exists(); // Retorna true si ya se inscribió
        }

        return response()->json([
            'data' => $data,
            'yaInscrito' => $yaInscrito
        ]);
    }
    public function getCatedraEvaluacion(Request $request)
    {
        // 1. Buscar el formulario activo de tipo Examen
        $data = SeguiFormulario::where('seguiformulario.tipoencuesta', 'LIKE', '%Examen%')
            ->where('seguiformulario.ACTIVO', 1)
            ->first();

        $yaEvlauado = false;

        // 2. Si hay un formulario activo y se envió la cédula, validar si ya existe la encuesta
        if ($data && $request->has('cedula')) {
            $yaEvlauado = SeguiEncuesta::where('cedula_estudiante', $request->cedula)
                ->where('idformulario', $data->ID)
                ->exists(); // Retorna true si ya se evaluó
        }

        return response()->json([
            'data' => $data,
            'yaEvlauado' => $yaEvlauado
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $res = SeguiFormulario::create([
                'NOMBRE'       => $request->NOMBRE,
                'tipoencuesta' => $request->tipoencuesta,
                'ACTIVO'       => 1,      // Forzado a 1 en el store
                'FINS'         => now(),  // Fecha y hora actual
                'UP'           => $user->ciinfper,
            ]);
            DB::commit();
            Bitacora::create([
                'bt_usuario'     => $user->ciinfper,
                'bt_fechahora'   => Carbon::now(),
                'bt_accion'      => "Crear Formulario" . " - VINCULACIÓN",
                'bt_ippc'        => $request->ip(),
                'bt_observacion' => "USUARIO: {$user->NombUsu} REALIZÓ: Crear Formulario de tipo {$request->tipoencuesta} CON NOMBRE: {$request->NOMBRE}",
            ]);
            return response()->json([
                'data' => $res,
                'mensaje' => "Agregado con Éxito!!",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al procesar los datos: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data =  SeguiFormulario::select(
            'seguiformulario.ID',
            'seguiformulario.NOMBRE',
            'seguiformulario.ACTIVO',
            'seguiformulario.UP',
            'seguiformulario.FINS',
            'seguiformulario.UD',
            'seguiformulario.FDEL',
            'seguiformulario.TOTAL',
            'seguiformulario.porcentaje',
            'seguiformulario.tipoencuesta',
            DB::raw('COUNT(seguipreguntas.ID) as total_preguntas'), // 🔹
            DB::raw('COUNT(seguiencuesta.ID) as total_encuestas'), // 🔹
        )
            ->leftJoin('seguipreguntas', 'seguipreguntas.IDFORMULARIO', '=', 'seguiformulario.ID')
            ->leftJoin('seguiencuesta', 'seguiencuesta.idformulario', '=', 'seguiformulario.ID')
            ->groupBy(
                'seguiformulario.ID',
                'seguiformulario.NOMBRE',
                'seguiformulario.ACTIVO',
                'seguiformulario.UP',
                'seguiformulario.FINS',
                'seguiformulario.UD',
                'seguiformulario.FDEL',
                'seguiformulario.TOTAL',
                'seguiformulario.porcentaje',
                'seguiformulario.tipoencuesta',
            )
            ->where('seguiformulario.ID', $id)
            ->paginate(20);

        if ($data->isEmpty()) {
            return response()->json([
                'data' => [],
                'message' => 'No se encontraron datos'
            ], 200);
        }

        // Convertir los campos a UTF-8 válido para cada página
        $data->getCollection()->transform(function ($item) {
            $attributes = $item->getAttributes();
            foreach ($attributes as $key => $value) {
                if (is_string($value)) {
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


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $res = SeguiFormulario::find($id);
        if (isset($res)) {
            DB::beginTransaction();
            $user = Auth::user();
            $res->NOMBRE = $request->NOMBRE;
            $res->ACTIVO = $request->ACTIVO;
            $res->tipoencuesta = $request->tipoencuesta;
            $res->UP = $user->ciinfper;


            if ($res->save()) {
                DB::commit();
                Bitacora::create([
                    'bt_usuario'     => $user->ciinfper,
                    'bt_fechahora'   => Carbon::now(),
                    'bt_accion'      => "Actualizar Formulario" . " - VINCULACIÓN",
                    'bt_ippc'        => $request->ip(),
                    'bt_observacion' => "USUARIO: {$user->NombUsu} REALIZÓ: Actualizar Formulario de tipo {$request->tipoencuesta} CON NOMBRE: {$request->NOMBRE}",
                ]);
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
                'mensaje' => "El formulario con id: $id no Existe",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $res = SeguiFormulario::find($id);
        if (isset($res)) {
            $res->ACTIVO = 0;
            $res->UD = Auth::user()->ciinfper;
            $res->FDEL = now();
            $res->save();
            Bitacora::create([
                'bt_usuario'     => Auth::user()->ciinfper,
                'bt_fechahora'   => Carbon::now(),
                'bt_accion'      => "Inhabilitar Formulario" . " - VINCULACIÓN",
                'bt_ippc'        => $request->ip(),
                'bt_observacion' => "USUARIO: " . Auth::user()->NombUsu . "REALIZÓ: Inhabilitó el formulario {$res->NOMBRE} del usuario {$res->UP}",
            ]);

            return response()->json([
                'data' => $res,
                'mensaje' => "Formulario inhabilitado con éxito!!",
            ]);
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "Formulario con id: $id no Existe",
            ]);
        }
    }
    public function habilitar(Request $request)
    {
        $id = $request->id;
        $res = SeguiFormulario::find($request->id);
        if (isset($res)) {
            $res->ACTIVO = 1;
            $res->save();
            Bitacora::create([
                'bt_usuario'     => Auth::user()->ciinfper,
                'bt_fechahora'   => Carbon::now(),
                'bt_accion'      => "Habilitar Formulario" . " - VINCULACIÓN",
                'bt_ippc'        => $request->ip(),
                'bt_observacion' => "USUARIO: " . Auth::user()->NombUsu . "REALIZÓ: Habilitó el formulario {$res->NOMBRE} del usuario {$res->UP}",
            ]);

            return response()->json([
                'data' => $res,
                'mensaje' => "Formulario habilitada con éxito!!",
            ]);
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "Formulario con id: $id no Existe",
            ]);
        }
    }
    public function getFormularioInscripcion()
    {
        try {
            $formulario = SeguiFormulario::where('seguiformulario.tipoencuesta', 'LIKE', '%Inscripción%')
                ->where('ACTIVO', 1)
                ->with(['seguipreguntas' => function ($query) {
                    // Si tienes soft deletes o filtros de preguntas, añádelos aquí
                }, 'seguipreguntas.seguitiporespuesta'])
                ->first();

            if (!$formulario) {
                return response()->json([
                    'success' => false,
                    'message' => 'No hay ningún formulario de inscripción activo en este momento.'
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'success' => true,
                'data' => $formulario
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error("Error al obtener formulario de inscripción: " . $e->getMessage());
            return response()->json([
                'error' => 'Error interno del servidor al cargar el formulario.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getFormularioEvaluacion()
    {
        try {
            $formulario = SeguiFormulario::where('seguiformulario.tipoencuesta', 'LIKE', '%Examen%')
                ->where('ACTIVO', 1)
                ->with(['seguipreguntas' => function ($query) {
                    // Selecciona 10 preguntas de forma aleatoria
                    $query->inRandomOrder()->limit(10)->with('seguitiporespuesta');
                }])
                ->first();

            if (!$formulario) {
                return response()->json([
                    'success' => false,
                    'message' => 'No hay ningún formulario de evaluación activo en este momento.'
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'success' => true,
                'data' => $formulario
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error("Error al obtener formulario de evaluación: " . $e->getMessage());
            return response()->json([
                'error' => 'Error interno del servidor al cargar el formulario.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function guardarInscripcion(Request $request)
    {
        $request->validate([
            'idformulario'      => 'required|integer',
            'cedula_estudiante' => 'required|string',
            'idcarr'            => 'required',
            'respuestas'        => 'required|array',
        ]);

        DB::beginTransaction();
        try {
            // 1. Registrar la cabecera de la encuesta
            $encuesta = SeguiEncuesta::create([
                'cedula_estudiante' => $request->cedula_estudiante,
                'fecha'             => Carbon::now()->format('Y-m-d'),
                'idformulario'      => $request->idformulario,
                'idcarr'            => $request->idcarr,
                'encuestador'       => '', // TODO: Cambiar por el nombre del encuestador
            ]);

            // 2. Registrar cada una de las respuestas en el detalle
            foreach ($request->respuestas as $resp) {

                // SI ES SELECCIÓN MÚLTIPLE (idtiporespuesta llega como un Array del Front)
                if (isset($resp['idtiporespuesta']) && is_array($resp['idtiporespuesta'])) {
                    foreach ($resp['idtiporespuesta'] as $idOpcion) {
                        SeguiDetalleEncuesta::create([
                            'idseguiencuesta' => $encuesta->getKey(),
                            'idpregunta'      => $resp['idpregunta'],
                            'idtiporespuesta' => $idOpcion,
                            'textorespuesta'  => '', // No lleva texto por ser opción fija
                        ]);
                    }
                }
                // SI ES ABIERTA O SELECCIÓN ÚNICA
                else {
                    // EXPLICACIÓN: Si idtiporespuesta es null (Pregunta Abierta), le asignamos 0 
                    // para que pase la restricción NOT NULL de la base de datos de forma segura.
                    $idTipoRespuestaFinal = (!isset($resp['idtiporespuesta']) || is_null($resp['idtiporespuesta'])) ? 0 : $resp['idtiporespuesta'];

                    SeguiDetalleEncuesta::create([
                        'idseguiencuesta' => $encuesta->getKey(),
                        'idpregunta'      => $resp['idpregunta'],
                        'idtiporespuesta' => $idTipoRespuestaFinal,
                        'textorespuesta'  => $resp['textorespuesta'] ?? '',
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Tu inscripción ha sido procesada y guardada con éxito.'
            ], \Illuminate\Http\Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error al guardar inscripción de estudiante: " . $e->getMessage());
            return response()->json([
                'error' => 'No se pudo procesar la inscripción. Inténtalo de nuevo más tarde.'
            ], \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function guardarEvaluacion(Request $request)
    {
        $request->validate([
            'idformulario'      => 'required|integer',
            'cedula_estudiante' => 'required|string',
            'idcarr'            => 'required',
            'respuestas'        => 'required|array',
        ]);

        DB::beginTransaction();
        try {
            // 1. Registrar la cabecera de la encuesta
            $encuesta = SeguiEncuesta::create([
                'cedula_estudiante' => $request->cedula_estudiante,
                'fecha'             => Carbon::now()->format('Y-m-d'),
                'idformulario'      => $request->idformulario,
                'idcarr'            => $request->idcarr,
                'encuestador'       => '', // TODO: Cambiar por el nombre del encuestador
            ]);

            // 2. Registrar cada una de las respuestas en el detalle
            foreach ($request->respuestas as $resp) {

                // SI ES SELECCIÓN MÚLTIPLE (idtiporespuesta llega como un Array del Front)
                if (isset($resp['idtiporespuesta']) && is_array($resp['idtiporespuesta'])) {
                    foreach ($resp['idtiporespuesta'] as $idOpcion) {
                        SeguiDetalleEncuesta::create([
                            'idseguiencuesta' => $encuesta->getKey(),
                            'idpregunta'      => $resp['idpregunta'],
                            'idtiporespuesta' => $idOpcion,
                            'textorespuesta'  => '', // No lleva texto por ser opción fija
                        ]);
                    }
                }
                // SI ES ABIERTA O SELECCIÓN ÚNICA
                else {
                    // EXPLICACIÓN: Si idtiporespuesta es null (Pregunta Abierta), le asignamos 0 
                    // para que pase la restricción NOT NULL de la base de datos de forma segura.
                    $idTipoRespuestaFinal = (!isset($resp['idtiporespuesta']) || is_null($resp['idtiporespuesta'])) ? 0 : $resp['idtiporespuesta'];

                    SeguiDetalleEncuesta::create([
                        'idseguiencuesta' => $encuesta->getKey(),
                        'idpregunta'      => $resp['idpregunta'],
                        'idtiporespuesta' => $idTipoRespuestaFinal,
                        'textorespuesta'  => $resp['textorespuesta'] ?? '',
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Tu evaluación ha sido procesada y guardada con éxito.'
            ], \Illuminate\Http\Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error al guardar evaluación de estudiante: " . $e->getMessage());
            return response()->json([
                'error' => 'No se pudo procesar la evaluación. Inténtalo de nuevo más tarde.'
            ], \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getEstudiantesInscritos(Request $request, string $idFormulario)
    {
        // 1. Obtener las cédulas de los estudiantes que llenaron este formulario
        $cedulasInscritas = SeguiEncuesta::where('idformulario', $idFormulario)
            ->pluck('cedula_estudiante')
            ->toArray();

        if (empty($cedulasInscritas)) {
            return response()->json([
                'total' => 0,
                'esEvaluacion' => false,
                'estudiantes' => []
            ]);
        }

        // 2. Ejecutar la consulta SQL para los datos del estudiante
        $estudiantes = DB::table('informacionpersonal')
            ->select(
                'informacionpersonal.CIInfPer',
                'informacionpersonal.NombInfPer',
                'informacionpersonal.ApellInfPer',
                'informacionpersonal.ApellMatInfPer',
                'informacionpersonal.mailInst',
                'carrera.NombCarr',
                'carrera.idCarr',
                'facultad.siglas as facultad_siglas',
                'detalle_matricula.nivel'
            )
            ->join('factura', 'factura.cedula', '=', 'informacionpersonal.CIInfPer')
            ->join('detalle_matricula', 'factura.id', '=', 'detalle_matricula.idfactura')
            ->join('carrera', 'carrera.idCarr', '=', 'detalle_matricula.idcarr')
            ->join('facultad', 'facultad.idfacultad', '=', 'carrera.idfacultad')
            ->whereIn('informacionpersonal.CIInfPer', $cedulasInscritas)
            ->where('factura.idper', function ($query) {
                $query->select('idper')->from('periodolectivo')->where('StatusPerLec', 1)->limit(1);
            })
            ->where('carrera.StatusCarr', 1)
            ->whereIn('factura.tipo_documento', ['MATRICULA', 'MATRÍCULA'])
            ->where('carrera.optativa', 0)
            ->where('carrera.NombCarr', 'NOT LIKE', '%TRABAJO DE INTEGRACIÓN CURRICULAR%')
            ->distinct()
            ->get();

        // 3. Obtener el puntaje sumado de todos los estudiantes para este formulario
        $puntajes = DB::table('seguiencuesta')
            ->join('seguidetalleencuesta', 'seguiencuesta.ID', '=', 'seguidetalleencuesta.idseguiencuesta')
            ->join('seguitiporespuesta', 'seguidetalleencuesta.idtiporespuesta', '=', 'seguitiporespuesta.ID')
            ->where('seguiencuesta.idformulario', $idFormulario)
            ->whereNotNull('seguitiporespuesta.valor') // Solo contamos si el campo "valor" no es null
            ->select('seguiencuesta.cedula_estudiante', DB::raw('SUM(seguitiporespuesta.valor) as puntaje_total'))
            ->groupBy('seguiencuesta.cedula_estudiante')
            ->pluck('puntaje_total', 'cedula_estudiante');

        // Identificar si este formulario realmente es una evaluación evaluada
        $esEvaluacion = $puntajes->isNotEmpty();

        // 4. Mapear la calificación a cada estudiante
        foreach ($estudiantes as $estudiante) {
            if ($esEvaluacion) {
                // Si el estudiante respondió la evaluación, se asigna el puntaje, de lo contrario 0.
                $estudiante->puntaje = $puntajes->has($estudiante->CIInfPer) ? (int)$puntajes[$estudiante->CIInfPer] : 0;
            } else {
                // Es solo una encuesta, no lleva calificación.
                $estudiante->puntaje = null;
            }
        }

        return response()->json([
            'total' => $estudiantes->count(),
            'esEvaluacion' => $esEvaluacion,
            'estudiantes' => $estudiantes
        ]);
    }
    public function getEncuestadosGraduados(Request $request, string $idFormulario)
    {
        // 1. Obtener las cédulas de los estudiantes que llenaron este formulario
        $cedulasInscritas = SeguiEncuesta::where('idformulario', $idFormulario)
            ->pluck('cedula_estudiante')
            ->toArray();

        if (empty($cedulasInscritas)) {
            return response()->json([
                'total' => 0,
                'esEvaluacion' => false,
                'estudiantes' => []
            ]);
        }

        // 2. Ejecutar la consulta SQL para los datos del estudiante
        $estudiantes = DB::table('informacionpersonal')
            ->whereIn('informacionpersonal.CIInfPer', $cedulasInscritas)
            ->leftJoin('factura', function ($join) {
                $join->on('factura.cedula', '=', 'informacionpersonal.CIInfPer')
                    ->whereIn('factura.tipo_documento', ['MATRICULA', 'MATRÍCULA'])
                    ->where('factura.idper', function ($query) {
                        $query->select('idper')->from('periodolectivo')->where('StatusPerLec', 1)->limit(1);
                    });
            })
            ->leftJoin('detalle_matricula', 'factura.id', '=', 'detalle_matricula.idfactura')

            // 🔴 NUEVO: Unimos la tabla registrotitulos usando la cédula para rescatar a los egresados
            ->leftJoin('registrotitulos', 'registrotitulos.ciinfper', '=', 'informacionpersonal.CIInfPer')

            // 🔴 MODIFICADO: Condición inteligente para carrera. 
            // Si detalle_matricula.idcarr es null (es egresado), utilizará registrotitulos.idcarr
            ->leftJoin('carrera', function ($join) {
                $join->on('carrera.idCarr', '=', DB::raw('COALESCE(detalle_matricula.idcarr, registrotitulos.idcarr)'))
                    ->where('carrera.StatusCarr', 1)
                    ->where('carrera.optativa', 0)
                    ->where('carrera.NombCarr', 'NOT LIKE', '%TRABAJO DE INTEGRACIÓN CURRICULAR%');
            })
            ->leftJoin('facultad', 'facultad.idfacultad', '=', 'carrera.idfacultad')
            ->select(
                'informacionpersonal.CIInfPer',
                'informacionpersonal.NombInfPer',
                'informacionpersonal.ApellInfPer',
                'informacionpersonal.ApellMatInfPer',
                'informacionpersonal.mailInst',
                'carrera.NombCarr',
                'carrera.idCarr',
                'facultad.siglas as facultad_siglas',
                // 🔴 MODIFICADO: Si no tiene nivel de matrícula vigente, se marca como EGRESADO/GRADUADO
                DB::raw("COALESCE(detalle_matricula.nivel, 'GRADUADO') as nivel")
            )
            ->distinct()
            ->get();

        // 3. Determinar de forma segura si el formulario es una Evaluación o una Encuesta común
        $esEvaluacion = DB::table('seguiencuesta')
            ->join('seguidetalleencuesta', 'seguiencuesta.ID', '=', 'seguidetalleencuesta.idseguiencuesta')
            ->join('seguitiporespuesta', 'seguidetalleencuesta.idtiporespuesta', '=', 'seguitiporespuesta.ID')
            ->where('seguiencuesta.idformulario', $idFormulario)
            ->whereNotNull('seguitiporespuesta.valor')
            ->exists();

        // 4. Obtener el puntaje sumado de los estudiantes SOLO si se determinó que es una evaluación
        $puntajes = [];
        if ($esEvaluacion) {
            $puntajes = DB::table('seguiencuesta')
                ->join('seguidetalleencuesta', 'seguiencuesta.ID', '=', 'seguidetalleencuesta.idseguiencuesta')
                ->join('seguitiporespuesta', 'seguidetalleencuesta.idtiporespuesta', '=', 'seguitiporespuesta.ID')
                ->where('seguiencuesta.idformulario', $idFormulario)
                ->select(
                    'seguiencuesta.cedula_estudiante',
                    DB::raw('SUM(COALESCE(seguitiporespuesta.valor, 0)) as puntaje_total')
                )
                ->groupBy('seguiencuesta.cedula_estudiante')
                ->pluck('puntaje_total', 'cedula_estudiante');
        }

        // 5. Mapear la calificación correspondiente a cada estudiante encontrado
        foreach ($estudiantes as $estudiante) {
            if ($esEvaluacion) {
                $estudiante->puntaje = isset($puntajes[$estudiante->CIInfPer]) ? (int)$puntajes[$estudiante->CIInfPer] : 0;
            } else {
                $estudiante->puntaje = null;
            }
        }

        return response()->json([
            'total' => $estudiantes->count(),
            'esEvaluacion' => $esEvaluacion,
            'estudiantes' => $estudiantes
        ]);
    }
    public function getDetalleRespuestasEstudiante(Request $request, string $idFormulario, string $cedula)
    {
        // 1. Obtener los datos de la cabecera de la encuesta del estudiante
        $encuesta = SeguiEncuesta::where('idformulario', $idFormulario)
            ->where('cedula_estudiante', $cedula)
            ->first();

        if (!$encuesta) {
            return response()->json(['error' => 'No se encontró registro de encuesta.'], 404);
        }

        // 2. Obtener los datos personales con la consulta proporcionada
        $datosPersona = DB::table('informacionpersonal')
            ->select(
                'informacionpersonal.CIInfPer',
                'informacionpersonal.NombInfPer',
                'informacionpersonal.ApellInfPer',
                'informacionpersonal.ApellMatInfPer',
                'informacionpersonal.mailInst',
                'carrera.NombCarr',
                'facultad.siglas as facultad_siglas',
                'detalle_matricula.nivel'
            )
            ->join('factura', 'factura.cedula', '=', 'informacionpersonal.CIInfPer')
            ->join('detalle_matricula', 'factura.id', '=', 'detalle_matricula.idfactura')
            ->join('carrera', 'carrera.idCarr', '=', 'detalle_matricula.idcarr')
            ->join('facultad', 'facultad.idfacultad', '=', 'carrera.idfacultad')
            ->where('informacionpersonal.CIInfPer', $cedula)
            ->where('factura.idper', function ($query) {
                $query->select('idper')->from('periodolectivo')->where('StatusPerLec', 1)->limit(1);
            })
            ->where('carrera.StatusCarr', 1)
            ->whereIn('factura.tipo_documento', ['MATRICULA', 'MATRÍCULA'])
            ->where('carrera.optativa', 0)
            ->where('carrera.NombCarr', 'NOT LIKE', '%TRABAJO DE INTEGRACIÓN CURRICULAR%')
            ->distinct()
            ->first();

        // 3. Traer SOLO las preguntas que el estudiante respondió (Inner Join)
        $respuestas = DB::table('seguipreguntas')
            // CAMBIO AQUÍ: 'join' en lugar de 'leftJoin' asegura que no traiga preguntas vacías
            ->join('seguidetalleencuesta', function ($join) use ($encuesta) {
                $join->on('seguidetalleencuesta.idpregunta', '=', 'seguipreguntas.ID')
                    ->where('seguidetalleencuesta.idseguiencuesta', '=', $encuesta->ID);
            })
            ->leftJoin('seguitiporespuesta', 'seguitiporespuesta.ID', '=', 'seguidetalleencuesta.idtiporespuesta')
            ->where('seguipreguntas.IDFORMULARIO', $idFormulario)
            ->select(
                'seguipreguntas.PREGUNTA',
                'seguipreguntas.tipo as tipo_pregunta',
                'seguidetalleencuesta.textorespuesta',
                'seguitiporespuesta.TIPORESPUESTA as opcion_seleccionada',
                'seguitiporespuesta.valor'
            )
            ->get();

        return response()->json([
            'persona' => $datosPersona,
            'respuestas' => $respuestas
        ]);
    }
    public function getDetalleRespuestasGraduados(Request $request, string $idFormulario, string $cedula)
    {
        // 1. Obtener los datos de la cabecera de la encuesta del estudiante
        $encuesta = SeguiEncuesta::where('idformulario', $idFormulario)
            ->where('cedula_estudiante', $cedula)
            ->first();

        if (!$encuesta) {
            return response()->json(['error' => 'No se encontró registro de encuesta.'], 404);
        }

        // 2. Obtener los datos personales aplicando la solución en cascada (Estudiantes activos / Egresados)
        $datosPersona = DB::table('informacionpersonal')
            ->where('informacionpersonal.CIInfPer', $cedula)
            ->leftJoin('factura', function ($join) {
                $join->on('factura.cedula', '=', 'informacionpersonal.CIInfPer')
                    ->whereIn('factura.tipo_documento', ['MATRICULA', 'MATRÍCULA'])
                    ->where('factura.idper', function ($query) {
                        $query->select('idper')->from('periodolectivo')->where('StatusPerLec', 1)->limit(1);
                    });
            })
            ->leftJoin('detalle_matricula', 'factura.id', '=', 'detalle_matricula.idfactura')

            // 🔴 NUEVO: Unimos la tabla registrotitulos para dar soporte a egresados
            ->leftJoin('registrotitulos', 'registrotitulos.ciinfper', '=', 'informacionpersonal.CIInfPer')

            // 🔴 MODIFICADO: Combinación inteligente de carreras usando COALESCE
            ->leftJoin('carrera', function ($join) {
                $join->on('carrera.idCarr', '=', DB::raw('COALESCE(detalle_matricula.idcarr, registrotitulos.idcarr)'))
                    ->where('carrera.StatusCarr', 1)
                    ->where('carrera.optativa', 0)
                    ->where('carrera.NombCarr', 'NOT LIKE', '%TRABAJO DE INTEGRACIÓN CURRICULAR%');
            })
            ->leftJoin('facultad', 'facultad.idfacultad', '=', 'carrera.idfacultad')
            ->select(
                'informacionpersonal.CIInfPer',
                'informacionpersonal.NombInfPer',
                'informacionpersonal.ApellInfPer',
                'informacionpersonal.ApellMatInfPer',
                'informacionpersonal.mailInst',
                'carrera.NombCarr',
                'carrera.idCarr',
                'facultad.siglas as facultad_siglas',
                // 🔴 MODIFICADO: Si no posee matrícula en el periodo actual, se marca como Egresado/Graduado
                DB::raw("COALESCE(detalle_matricula.nivel, 'EGRESADO/GRADUADO') as nivel")
            )
            ->distinct()
            ->first();

        // 3. Traer SOLO las preguntas que el estudiante respondió (Inner Join)
        $respuestas = DB::table('seguipreguntas')
            ->join('seguidetalleencuesta', function ($join) use ($encuesta) {
                $join->on('seguidetalleencuesta.idpregunta', '=', 'seguipreguntas.ID')
                    ->where('seguidetalleencuesta.idseguiencuesta', '=', $encuesta->ID);
            })
            ->leftJoin('seguitiporespuesta', 'seguitiporespuesta.ID', '=', 'seguidetalleencuesta.idtiporespuesta')
            ->where('seguipreguntas.IDFORMULARIO', $idFormulario)
            ->select(
                'seguipreguntas.PREGUNTA',
                'seguipreguntas.tipo as tipo_pregunta',
                'seguidetalleencuesta.textorespuesta',
                'seguitiporespuesta.TIPORESPUESTA as opcion_seleccionada',
                'seguitiporespuesta.valor'
            )
            ->get();

        return response()->json([
            'persona' => $datosPersona,
            'respuestas' => $respuestas
        ]);
    }
    public function getPromedioEstudiante(Request $request, string $cedula)
    {
        try {
            // 1. Construir la subconsulta para obtener los últimos 2 periodos cerrados
            // equivalentes a: SELECT idper FROM periodolectivo WHERE idper < (MAX(idper)...) ORDER BY idper DESC LIMIT 2
            $subquery = DB::table('periodolectivo')
                ->select('idper')
                ->where('idper', '<', function ($query) {
                    $query->select(DB::raw('MAX(idper)'))
                        ->from('periodolectivo')
                        ->where('StatusPerLec', 1);
                })
                ->orderBy('idper', 'DESC')
                ->limit(2);

            // 2. Construir la consulta principal uniendo la subconsulta
            $resultado = DB::table('notasalumnoasignatura as n')
                ->joinSub($subquery, 'p', function ($join) {
                    $join->on('p.idper', '=', 'n.idPer');
                })
                ->select(
                    'n.CIInfPer',
                    DB::raw('ROUND(AVG(n.CalifFinal), 2) AS promedio_final')
                )
                ->whereNotIn('n.idAsig', [8807, 8808, 68628, 68629, 68630, 68631, 69122, 69123])
                ->where('n.CIInfPer', $cedula)
                ->whereNotNull('n.CalifFinal')
                ->whereRaw('IFNULL(n.retirado, 0) = 0')
                ->whereRaw('IFNULL(n.anulada, 0) = 0')
                ->whereRaw('IFNULL(n.convalidacion, 0) = 0')
                ->groupBy('n.CIInfPer')
                ->first();

            // 3. Validar si el estudiante tiene notas en esos periodos
            if (!$resultado) {
                return response()->json([
                    'success' => true,
                    'promedio_final' => 0,
                    'message' => 'No se encontraron notas válidas para los últimos dos periodos o el estudiante no existe.'
                ], 200);
            }

            // 4. Retornar el promedio
            return response()->json([
                'success' => true,
                'promedio_final' => $resultado->promedio_final,
                'cedula' => $resultado->CIInfPer
            ], 200);
        } catch (\Exception $e) {
            Log::error("Error al obtener el promedio del estudiante {$cedula}: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Error interno del servidor al calcular el promedio.'
            ], 500);
        }
    }
}
