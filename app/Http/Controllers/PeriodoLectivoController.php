<?php

namespace App\Http\Controllers;

use App\Models\PeriodoLectivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PeriodoLectivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        try {
            $query = PeriodoLectivo::select(
                'periodolectivo.*'
            )->orderby('periodolectivo.idper', 'desc');

            if ($request->has('all') && $request->all === 'true') {
                $data = $query->get();

                return response()->json(['data' => $data]);
            }

            // Paginación por defecto
            $data = $query->get();
            if ($data->isEmpty()) {
                return response()->json([
                    'data' => [],
                    'message' => 'No se encontraron datos'
                ], 200);
            }

            return response()->json([
                'data' => $data->items(),
                'pagination' => [
                    'current_page' => $data->currentPage(),
                    'last_page' => $data->lastPage(),
                    'per_page' => $data->perPage(),
                    'total' => $data->total(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener los datos',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
}
