<?php

namespace App\Http\Controllers;

use App\Models\SeguiFormulario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Bitacora;
use Carbon\Carbon;

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
                'current_page' => $data->currentPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
                'last_page' => $data->lastPage(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en el servidor: ' . $e->getMessage()], 500);
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
}
