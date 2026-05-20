<?php

namespace App\Http\Controllers;

use App\Models\SeguiPreguntas;
use App\Models\SeguiTipoRespuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Bitacora;
use Carbon\Carbon;


class SeguiPreguntasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // 🔹 Capturamos el ID del formulario desde la URL (?idFormulario=...)
            $idFormulario = $request->query('idFormulario');

            // Usamos withCount para obtener los totales de las relaciones
            $query = SeguiPreguntas::withCount(['seguitiporespuesta'])
                ->where('seguipreguntas.IDFORMULARIO', $idFormulario) // 🔹 Usamos la variable capturada
                ->orderBy('seguipreguntas.ID', 'asc');

            // Si el usuario pide todos los datos (all=true)
            if ($request->has('all') && $request->query('all') === 'true') {
                $data = $query->get();

                $data->transform(function ($item) {
                    $attributes = $item->toArray();
                    foreach ($attributes as $key => $value) {
                        if (is_string($value)) {
                            $attributes[$key] = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                        }
                    }
                    return $attributes;
                });

                return response()->json(['data' => $data]);
            }

            // Paginación por defecto (si no se envía all=true)
            $data = $query->paginate(20);

            if ($data->isEmpty()) {
                return response()->json([
                    'data' => [],
                    'message' => 'No se encontraron datos'
                ], 200);
            }

            $data->getCollection()->transform(function ($item) {
                $attributes = $item->toArray();
                foreach ($attributes as $key => $value) {
                    if (is_string($value)) {
                        $attributes[$key] = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                    }
                }
                return $attributes;
            });

            return response()->json([
                'data' => $data->items(),
                'current_page' => $data->currentPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
                'last_page' => $data->lastPage(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al procesar los datos: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $res = SeguiPreguntas::create([
                'PREGUNTA'       => $request->PREGUNTA,
                'IDFORMULARIO'   => $request->IDFORMULARIO,
                'UP'             => $user->ciinfper,
                'FINS'           => now(),
                'UD'             => $user->ciinfper,
                'FDEL'           => now(),
                'tipo'           => $request->tipo,
            ]);
            DB::commit();
            Bitacora::create([
                'bt_usuario'     => $user->ciinfper,
                'bt_fechahora'   => Carbon::now(),
                'bt_accion'      => "Crear Pregunta" . " - VINCULACIÓN",
                'bt_ippc'        => $request->ip(),
                'bt_observacion' => "USUARIO: {$user->NombUsu} REALIZÓ: Crear Pregunta de tipo {$request->tipo} CON NOMBRE: {$request->PREGUNTA}",
            ]);
            return response()->json([
                'data' => $res,
                'mensaje' => "Agregado con Éxito!!",
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al procesar los datos: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $res = SeguiPreguntas::find($id);
        if (isset($res)) {
            return response()->json([
                'data' => $res,
                'mensaje' => "Encontrado con Éxito!!",
            ]);
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "La Pregunta con id: $id no Existe",
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $res = SeguiPreguntas::find($id);
        if (isset($res)) {
            DB::beginTransaction();
            $user = Auth::user();
            $res->PREGUNTA = $request->PREGUNTA;
            $res->IDFORMULARIO = $request->IDFORMULARIO;
            $res->UP = $user->ciinfper;



            if ($res->save()) {
                DB::commit();
                Bitacora::create([
                    'bt_usuario'     => $user->ciinfper,
                    'bt_fechahora'   => Carbon::now(),
                    'bt_accion'      => "Actualizar Pregunta" . " - VINCULACIÓN",
                    'bt_ippc'        => $request->ip(),
                    'bt_observacion' => "USUARIO: {$user->NombUsu} REALIZÓ: Actualizar Pregunta de tipo {$request->tipo} CON NOMBRE: {$request->PREGUNTA}",
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
        $res = SeguiPreguntas::find($request->id);
        if (isset($res)) {
            $res->delete();
            $data = $res->toArray();
            if ($data) {
                Bitacora::create([
                    'bt_usuario'     => Auth::user()->ciinfper,
                    'bt_fechahora'   => Carbon::now(),
                    'bt_accion'      => "Eliminar Pregunta" . " - VINCULACIÓN",
                    'bt_ippc'        => $request->ip(),
                    'bt_observacion' => "USUARIO: " . Auth::user()->NombUsu . "REALIZÓ: Eliminó la pregunta {$data['PREGUNTA']} del formulario con id {$data['IDFORMULARIO']}",
                ]);

                return response()->json([
                    'data' => $data,
                    'mensaje' => "Eliminado con Éxito!!",
                ]);
            } else {
                return response()->json([
                    'data' => $data,
                    'mensaje' => "El ods no existe (puede que ya lo haya eliminado)",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "El ods con id: $request->id no Existe",
            ]);
        }
    }
}
