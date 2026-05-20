<?php

namespace App\Http\Controllers;

use App\Models\Agenda_ODS;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class Agenda_ODSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // Usamos withCount para obtener los totales de las relaciones
            $query = Agenda_ODS::withCount(['ods']);

            if ($request->has('all') && $request->all === 'true') {
                $data = $query->get();

                // Transformación para UTF-8 y manejo de atributos
                $data->transform(function ($item) {
                    $attributes = $item->toArray(); // Usamos toArray para incluir los campos _count
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
        $inputs = $request->all();

        // Si el usuario intenta enviar el PEI como ACTIVO (1)
        if ($request->estado_ag_ods == 1) {
            // Verificamos si ya existe AL MENOS UNO activo en la base de datos
            $existeActivo = Agenda_ODS::where('estado_ag_ods', 1)->exists();

            if ($existeActivo) {
                // Si ya hay uno, forzamos este nuevo a ser INACTIVO (0)
                $inputs['estado_ag_ods'] = 0;
            }
        }

        $res = Agenda_ODS::create($inputs);

        return response()->json([
            'data' => $res,
            'mensaje' => $res->estado_ag_ods == 0 && $request->estado_ag_ods == 1
                ? "Agregado, pero se guardó como Inactivo porque ya existe una Agenda ODS activo."
                : "Agregado con Éxito!!",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $res = Agenda_ODS::find($id);
        if (isset($res)) {
            return response()->json([
                'data' => $res,
                'mensaje' => "Encontrado con Éxito!!",
            ]);
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "La Agenda ODS con id: $id no Existe",
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $res = Agenda_ODS::find($id);

        if (isset($res)) {
            $res->nombre_ag_ods = $request->nombre_ag_ods;
            $res->anio_ag_ods = $request->anio_ag_ods;
            $res->link_ag_ods = $request->link_ag_ods;

            // Lógica de validación de estado
            if ($request->estado_ag_ods == 1) {
                // Buscamos si hay otro PEI activo que NO SEA el que estamos editando
                $otroActivo = Agenda_ODS::where('estado_ag_ods', 1)
                    ->where('id_ag_ods', '!=', $id)
                    ->exists();

                if ($otroActivo) {
                    $res->estado_ag_ods = 0;
                    $mensajeFinal = "Actualizado, pero se cambió a Inactivo porque ya existe otra Agenda ODS activa.";
                } else {
                    $res->estado_ag_ods = 1;
                    $mensajeFinal = "Actualizado con Éxito!!";
                }
            } else {
                $res->estado_ag_ods = 0;
                $mensajeFinal = "Actualizado con Éxito!!";
            }

            if ($res->save()) {
                return response()->json([
                    'data' => $res,
                    'mensaje' => $mensajeFinal,
                ]);
            }

            return response()->json(['error' => true, 'mensaje' => 'Error al Actualizar'], 500);
        }

        return response()->json(['error' => true, 'mensaje' => "La Agenda ODS con id: $id no Existe"], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $res = Agenda_ODS::find($id);
        if (isset($res)) {
            $res->estado_ag_ods = 0;
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
                    'mensaje' => "La Agenda ODS no existe (puede que ya la haya eliminado)",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "La Agenda ODS con id: $id no Existe",
            ]);
        }
    }
    public function habilitar(string $id)
    {
        // 1. Verificar si ya existe algún PlANDE activo
        $existeActivo = Agenda_ODS::where('estado_ag_ods', 1)->exists();

        if ($existeActivo) {
            return response()->json([
                'status' => false,
                'mensaje' => "No se puede habilitar: Ya existe una Agenda ODS activa actualmente. Por favor, desactive la anterior primero."
            ], 422); // Código 422: Entidad no procesable (error de validación de negocio)
        }

        // 2. Si no hay activos, procedemos a buscar y habilitar
        $res = Agenda_ODS::find($id);

        if (isset($res)) {
            $res->estado_ag_ods = 1;

            if ($res->save()) {
                return response()->json([
                    'status' => true,
                    'data' => $res,
                    'mensaje' => "¡Agenda ODS Habilitada con Éxito!",
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'mensaje' => "Error interno al intentar guardar los cambios.",
                ], 500);
            }
        } else {
            return response()->json([
                'status' => false,
                'mensaje' => "La Agenda ODS con id: $id no existe o fue eliminada.",
            ], 404);
        }
    }
}
