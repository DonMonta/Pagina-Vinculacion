<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\Invi_sub_linea_inves;

use Illuminate\Http\Request;

class Invi_sub_linea_invesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {}
    public function getCarrerasPorFacultad(string $idfacultad)
    {
        // Asumiendo que StatusCarr = 1 significa habilitada
        $carrerasomitir = ['7109'];
        $carreras = Carreras::where('idfacultad', $idfacultad)
            ->where('StatusCarr', 1)
            ->whereNotIn('idCarr', $carrerasomitir)
            ->where('NombCarr', 'NOT LIKE', '%TRABAJO DE INTEGRACIÓN CURRICULAR%')
            ->get();

        return response()->json([
            'data' => $carreras,
            'message' => 'Carreras obtenidas con éxito'
        ], 200);
    }
    public function getSublineasPorLinea(string $id_lin_investiga)
    {
        $sublineas = Invi_sub_linea_inves::with('carreras') // Trae la relación de la carrera
            ->where('id_lin_investiga', $id_lin_investiga)
            ->get();

        return response()->json([
            'data' => $sublineas,
            'message' => 'Sub-líneas obtenidas con éxito'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $res = Invi_sub_linea_inves::create($inputs);

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $res = Invi_sub_linea_inves::find($id);
        if (isset($res)) {
            $res->id_lin_investiga = $request->id_lin_investiga;
            $res->idCarr = $request->idCarr;
            $res->nombre_sublin = $request->nombre_sublin;
            $res->objeto_estudio_sublin = $request->objeto_estudio_sublin;
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
                'mensaje' => "La Sub-línea de Investigación con id: $id no Existe",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $res = Invi_sub_linea_inves::find($id);
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
                    'mensaje' => "La Sub-línea de Investigación no existe (puede que ya la haya eliminado)",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "La Sub-línea de Investigación con id: $id no Existe",
            ]);
        }
    }
}
