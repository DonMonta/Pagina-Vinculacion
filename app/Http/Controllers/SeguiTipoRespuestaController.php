<?php

namespace App\Http\Controllers;

use App\Models\SeguiTipoRespuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Bitacora;
use Carbon\Carbon;

class SeguiTipoRespuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $idPregunta = $request->query('idPregunta');

            if (!$idPregunta) {
                return response()->json(['error' => 'El parámetro idPregunta es obligatorio'], 400);
            }

            $query = SeguiTipoRespuesta::where('IDPREGUNTA', $idPregunta)->orderBy('ID', 'asc');

            // Si se requiere todo el listado sin paginación
            if ($request->has('all') && $request->query('all') === 'true') {
                $data = $query->get();

                // Conversión UTF-8 limpia para caracteres especiales
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

            // Paginado en caso de requerirse a futuro
            $data = $query->paginate(20);
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
            return response()->json(['error' => 'Error al listar opciones: ' . $e->getMessage()], 500);
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
            $res = SeguiTipoRespuesta::create([
                'TIPORESPUESTA' => $request->TIPORESPUESTA,
                'IDPREGUNTA' => $request->IDPREGUNTA,
                'UP' => $user->ciinfper,
                'FINS' => now(),
                'UD' => $user->ciinfper,
                'FDEL' => now(),
                'valor' => $request->valor,
            ]);
            DB::commit();
            Bitacora::create([
                'bt_usuario'     => $user->ciinfper,
                'bt_fechahora'   => Carbon::now(),
                'bt_accion'      => "Crear Tipo de Respuesta" . " - VINCULACIÓN",
                'bt_ippc'        => $request->ip(),
                'bt_observacion' => "USUARIO: {$user->NombUsu} REALIZÓ: Crear Tipo de Respuesta de pregunta {$request->IDPREGUNTA} CON VALOR: {$request->valor}",
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
        $data =  SeguiTipoRespuesta::select(
            'seguitiporespuesta.*',
        )
            ->where('seguitiporespuesta.IDPREGUNTA', $id)
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
        $res = SeguiTipoRespuesta::find($id);
        if (isset($res)) {
            DB::beginTransaction();
            $user = Auth::user();
            $res->TIPORESPUESTA = $request->TIPORESPUESTA;
            $res->IDPREGUNTA = $request->IDPREGUNTA;
            $res->UP = $user->ciinfper;
            $res->valor = $request->valor;

            if ($res->save()) {
                DB::commit();
                Bitacora::create([
                    'bt_usuario'     => $user->ciinfper,
                    'bt_fechahora'   => Carbon::now(),
                    'bt_accion'      => "Actualizar Tipo de Respuesta" . " - VINCULACIÓN",
                    'bt_ippc'        => $request->ip(),
                    'bt_observacion' => "USUARIO: {$user->NombUsu} REALIZÓ: Actualizar Tipo de Respuesta de pregunta {$request->IDPREGUNTA} CON VALOR: {$request->valor}",
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
        $res = SeguiTipoRespuesta::find($id);
        if (isset($res)) {
            $res->delete();
            $data = $res->toArray();
            Bitacora::create([
                'bt_usuario'     => Auth::user()->ciinfper,
                'bt_fechahora'   => Carbon::now(),
                'bt_accion'      => "Eliminar Tipo de Respuesta" . " - VINCULACIÓN",
                'bt_ippc'        => $request->ip(),
                'bt_observacion' => "USUARIO: " . Auth::user()->NombUsu . "REALIZÓ: Eliminó la respuesta {$data['TIPORESPUESTA']} del pregunta {$data['IDPREGUNTA']} del formulario con id {$data['ID']}",
            ]);

            return response()->json([
                'data' => $res,
                'mensaje' => "Opción eliminada con éxito!!",
            ]);
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "Opción con id: $id no Existe",
            ]);
        }
    }
}
