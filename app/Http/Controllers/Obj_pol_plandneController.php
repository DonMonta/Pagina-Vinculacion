<?php

namespace App\Http\Controllers;

use App\Models\Obj_pol_plandne;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class Obj_pol_plandneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Obj_pol_plandne::select(
                'obj_pol_plandne.*'
            );

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();

        $res = Obj_pol_plandne::create($inputs);

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
        $res = Obj_pol_plandne::select(
            'obj_pol_plandne.*'
        )->where('id_pladne', $id)
            ->get();
        if ($res->isEmpty()) {
            return response()->json([
                'data' => [],
                'mensaje' => "El objeto de política con id: $id no Existe",
            ], 404);
        } else {
            return response()->json([
                'data' => $res,
                'mensaje' => "Objeto de política encontrado con id: $id",
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $res = Obj_pol_plandne::find($id);

        if (isset($res)) {
            $res->id_pladne = $request->id_pladne;
            $res->cod_obj_pol = $request->cod_obj_pol;
            $res->detalle_obj_pol = $request->detalle_obj_pol;

            if ($res->save()) {
                return response()->json([
                    'data' => $res,
                    'mensaje' => "Actualizado con Éxito!!",
                ]);
            }

            return response()->json(['error' => true, 'mensaje' => 'Error al Actualizar'], 500);
        }

        return response()->json(['error' => true, 'mensaje' => "El objeto de política con id: $id no Existe"], 404);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $res = Obj_pol_plandne::find($id);
        if (isset($res)) {
            $res->delete();
            $data = $res->toArray();
            if ($data) {

                return response()->json([
                    'data' => $data,
                    'mensaje' => "Eliminado con Éxito!!",
                ]);
            } else {
                return response()->json([
                    'data' => $data,
                    'mensaje' => "El objeto de política no existe (puede que ya la haya eliminado)",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "El objeto de política con id: $id no Existe",
            ]);
        }
    }
}
