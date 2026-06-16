<?php

namespace App\Http\Controllers;

use App\Models\Invi_equipo_depart;
use App\Models\Invi_equipo_roles;

use Illuminate\Http\Request;

class Invi_equipo_departController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $searchQuery = $request->input('search_query');
            $query = Invi_equipo_depart::select(
                'invi_equipo_depart.*',
                'invi_equipo_roles.*',
                'informacionpersonal_d.NombInfPer',
                'informacionpersonal_d.ApellInfPer',
                'informacionpersonal_d.ApellMatInfPer'
            )
                ->join('invi_equipo_roles', 'invi_equipo_roles.id_equipo_roles', '=', 'invi_equipo_depart.id_equipo_roles')
                ->join('informacionpersonal_d', 'informacionpersonal_d.CIInfPer', '=', 'invi_equipo_depart.ciinfper_doc')
                ->where('tipo_rol', '=', 'VINCULACIÓN');

            if ($searchQuery) {
                $query->where(function ($q) use ($searchQuery) {
                    $q->where('invi_equipo_depart.ciinfper_doc', 'LIKE', '%' . $searchQuery . '%');
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
    public function getEquipoVinculacion()
    {
        // 1. Traer los miembros de vinculación con sus relaciones
        $miembros = Invi_equipo_depart::with(['equipo_roles', 'informacionpersonald'])
            ->where('estado_equipo_dep', 1)
            ->whereHas('equipo_roles', function($query) {
                $query->where('tipo_rol', 'VINCULACIÓN')
                      ->where('estado_rol', 1);
            })
            ->get()
            ->map(function($item) {
                return [
                    'ci' => $item->ciinfper_doc,
                    'nombre' => $item->informacionpersonald->NombInfPer . ' ' . $item->informacionpersonald->ApellInfPer . ' ' . $item->informacionpersonald->ApellMatInfPer,
                    'rol' => $item->equipo_roles->nombre_rol,
                    'detalle' => $item->equipo_roles->detalle_rol,
                    'funciones' => $item->equipo_roles->funciones_rol
                ];
            })->toArray();

        if (count($miembros) === 0) {
            return response()->json([]);
        }

        // 2. Lógica para poner al Director en el centro exacto
        $directorIndex = -1;
        foreach ($miembros as $index => $miembro) {
            // Buscamos la palabra "director" en el nombre del rol
            if (stripos($miembro['rol'], 'director') !== false) {
                $directorIndex = $index;
                break;
            }
        }

        if ($directorIndex !== -1) {
            // Extraemos al director del grupo
            $director = array_splice($miembros, $directorIndex, 1)[0];
            
            // Calculamos la mitad del array restante
            $mitad = floor(count($miembros) / 2);
            
            // Insertamos al director en el centro
            array_splice($miembros, $mitad, 0, [$director]);
        }

        return response()->json($miembros);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ciinfper_doc' => 'required|digits:10',
            'id_equipo_roles' => 'required|integer',
        ]);

        try {
            // Validamos por BD que no le estén inyectando un rol ocupado por un activo distinto a él
            $existeOcupado = Invi_equipo_depart::where('id_equipo_roles', $request->id_equipo_roles)
                ->where('estado_equipo_dep', 1)
                ->where('ciinfper_doc', '!=', $request->ciinfper_doc)
                ->first();

            if ($existeOcupado) {
                return response()->json(['mensaje' => 'Este rol ya se encuentra asignado a otra persona activa.'], 422);
            }

            Invi_equipo_depart::create([
                'ciinfper_doc' => $request->ciinfper_doc,
                'id_equipo_roles' => $request->id_equipo_roles,
                'estado_equipo_dep' => 1
            ]);

            return response()->json(['mensaje' => 'Registrado con éxito']);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error al guardar los datos'], 500);
        }
    }
    public function getRolesVinculacion(Request $request)
    {
        try {
            $idExcluir = $request->input('id_excluir');

            $roles = Invi_equipo_roles::where('tipo_rol', 'VINCULACIÓN')
                ->where('estado_rol', 1)
                ->get();

            // Obtenemos los asignados, pero excluimos el ID que estamos editando
            $queryAsignados = Invi_equipo_depart::where('estado_equipo_dep', 1);

            if ($idExcluir) {
                $queryAsignados->where('id_equipo_depart', '!=', $idExcluir);
            }

            $asignados = $queryAsignados->pluck('ciinfper_doc', 'id_equipo_roles')->toArray();

            $roles->transform(function ($rol) use ($asignados) {
                $rol->is_assigned = isset($asignados[$rol->id_equipo_roles]);
                $rol->asignado_a = $asignados[$rol->id_equipo_roles] ?? null;
                return $rol;
            });

            return response()->json(['data' => $roles]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $res = Invi_equipo_depart::find($id);
        if (isset($res)) {
            return response()->json([
                'data' => $res,
                'mensaje' => "Encontrado con Éxito!!",
            ]);
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "El Equipo de Departamento con id: $id no Existe",
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'ciinfper_doc' => 'required|digits:10',
            'id_equipo_roles' => 'required|integer',
        ]);

        try {
            $asignacion = Invi_equipo_depart::findOrFail($id);

            // Validamos que el rol no esté ocupado por OTRA persona
            $existeOcupado = Invi_equipo_depart::where('id_equipo_roles', $request->id_equipo_roles)
                ->where('estado_equipo_dep', 1)
                ->where('id_equipo_depart', '!=', $id) // ignoramos el registro actual
                ->first();

            if ($existeOcupado) {
                return response()->json(['mensaje' => 'Este rol ya se encuentra asignado a otra persona.'], 422);
            }

            $asignacion->update([
                'ciinfper_doc' => $request->ciinfper_doc,
                'id_equipo_roles' => $request->id_equipo_roles,
                'estado_equipo_dep' => $request->estado_equipo_dep ?? $asignacion->estado_equipo_dep
            ]);

            return response()->json(['mensaje' => 'Actualizado con éxito']);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error al actualizar'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $res = Invi_equipo_depart::find($id);
        if (isset($res)) {
            $res->estado_equipo_dep = 0;
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
        $res = Invi_equipo_depart::find($id);
        if (isset($res)) {
            $res->estado_equipo_dep = 1;
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
                    'mensaje' => "El Equipo no existe (puede que ya la haya eliminado)",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "El Equipo con id: $id no Existe",
            ]);
        }
    }
}
