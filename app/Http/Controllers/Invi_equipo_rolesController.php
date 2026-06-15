<?php

namespace App\Http\Controllers;

use App\Models\Invi_equipo_roles;

use Illuminate\Http\Request;

class Invi_equipo_rolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $searchQuery = $request->input('search_query');
            $query = Invi_equipo_roles::select(
                'invi_equipo_roles.*'
            )
            ->where('tipo_rol', '=', 'VINCULACIÓN');

            if ($searchQuery) {
                $query->where(function ($q) use ($searchQuery) {
                    $q->where('nombre_rol', 'LIKE', '%' . $searchQuery . '%');
                });
            }
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

            // Paginación por defecto
            $data = $query->paginate(20);

            if ($data->isEmpty()) {
                return response()->json(['error' => 'No se encontraron datos'], 404);
            }

            // Convertir los datos a UTF-8 válido
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
            return response()->json(['error' => 'Error al codificar los datos a JSON: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $res = Invi_equipo_roles::create($inputs);

        return response()->json([
            'message' => 'Registro creado exitosamente',
            'data' => $res
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $res = Invi_equipo_roles::find($id);
        if (isset($res)) {
            return response()->json([
                'data' => $res,
                'mensaje' => "Encontrado con Éxito!!",
            ]);
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "El Equipo de Roles con id: $id no Existe",
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $res = Invi_equipo_roles::find($id);
        if (isset($res)) {
            $res->nombre_rol = $request->nombre_rol;
            $res->detalle_rol = $request->detalle_rol;
            $res->funciones_rol = $request->funciones_rol;
            $res->tipo_rol = $request->tipo_rol;
            $res->estado_rol = $request->estado_rol;
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
                'mensaje' => "El Equipo de Roles con id: $id no Existe",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $res = Invi_equipo_roles::find($id);
        if (isset($res)) {
            $res->estado_rol = 0;
            $res->save();
            $data = $res->toArray();
            if ($data) {

                return response()->json([
                    'data' => $data,
                    'mensaje' => "Inhabilitado con Éxito!!",
                ]);
            } else {
                return response()->json([
                    'data' => $data,
                    'mensaje' => "El Equipo de Roles no existe (puede que ya la haya eliminado)",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "El Equipo de Roles con id: $id no Existe",
            ]);
        }
    }
    public function habilitar(string $id)
    {
        $res = Invi_equipo_roles::find($id);
        if (isset($res)) {
            $res->estado_rol = 1;
            $res->save();
            $data = $res->toArray();
            if ($data) {

                return response()->json([
                    'data' => $data,
                    'mensaje' => "Habilitado con Éxito!!",
                ]);
            } else {
                return response()->json([
                    'data' => $data,
                    'mensaje' => "El Equipo de Roles no existe (puede que ya la haya eliminado)",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "El Equipo de Roles con id: $id no Existe",
            ]);
        }
    }



}
