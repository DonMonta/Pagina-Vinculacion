<?php

namespace App\Http\Controllers;

use App\Models\Usuario;;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RegistroTitulos;

class GraduadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getGraduadosPorPeriodo(Request $request, string $idPeriodo)
    {
        try {
            // 1. Construcción de la consulta mediante el Query Builder de Laravel
            $graduados = RegistroTitulos::from('registrotitulos as rt')
                ->join('periodolectivo as pl', function ($join) {
                    $join->on('rt.fechafin', '>=', 'pl.fechinicioperlec')
                        ->on('rt.fechafin', '<=', DB::raw('DATE_ADD(pl.fechfinalperlec, INTERVAL 10 DAY)'));
                })
                ->leftJoin('carrera as c', 'c.idCarr', '=', 'rt.idcarr')
                ->leftJoin('facultad as f', 'f.idfacultad', '=', 'c.idfacultad')
                ->where('pl.idper', $idPeriodo)
                ->where('c.NombCarr', 'NOT LIKE', '%TRABAJO DE INTEGRACIÓN CURRICULAR%')
                ->select(
                    'rt.ciinfper',
                    'rt.idcarr',
                    'c.NombCarr as nombre_carrera',
                    'rt.fechafin',
                    'pl.idper',
                    'pl.DescPerLec',
                    'f.idfacultad',
                    'f.facultad as nombre_facultad',
                    'f.siglas as facultad_siglas',
                    DB::raw("CASE
                        WHEN LEFT(pl.DescPerLec, 4) = RIGHT(pl.DescPerLec, 4) 
                            THEN CONCAT('IS-', LEFT(pl.DescPerLec, 4))
                        ELSE 
                            CONCAT('IIS-', LEFT(pl.DescPerLec, 4))
                    END AS periodo_academico")
                )
                ->groupBy(
                    'rt.ciinfper',
                    'rt.idcarr',
                    'c.NombCarr',
                    'rt.fechafin',
                    'pl.idper',
                    'pl.DescPerLec',
                    'f.idfacultad',
                    'f.facultad',
                    'f.siglas'
                )
                ->get(); // Retorna una colección nativa de Eloquent

            $totalGraduados = $graduados->count();

            // Si no existen registros en el periodo, retornamos una estructura limpia
            if ($totalGraduados === 0) {
                return response()->json([
                    'success' => true,
                    'datos_periodo' => null,
                    'total_graduados' => 0,
                    'distribucion_por_facultad' => []
                ], 200);
            }

            // 2. Extraer la información general del periodo lectivo
            $primerRegistro = $graduados->first();
            $datosPeriodo = [
                'idper' => $primerRegistro->idper,
                'descripcion' => $primerRegistro->DescPerLec,
                'codigo_academico' => $primerRegistro->periodo_academico,
            ];

            // 3. Generar la distribución estadística agrupando por FACULTAD
            $distribucionPorFacultad = $graduados->groupBy('idfacultad')
                ->map(function ($items, $idFacultad) use ($totalGraduados) {
                    $cantidad = $items->count();
                    $infoFacultad = $items->first();

                    return [
                        'id_facultad' => $idFacultad,
                        'facultad' => $infoFacultad->nombre_facultad ?? 'Facultad No Definida',
                        'siglas' => $infoFacultad->facultad_siglas ?? 'N/A',
                        'cantidad_graduados' => $cantidad,
                        'porcentaje' => round(($cantidad / $totalGraduados) * 100, 2)
                    ];
                })
                ->values() // Limpia llaves asignadas por el groupBy
                ->sortByDesc('cantidad_graduados') // Orden de mayor a menor afluencia
                ->values(); // Re-indexa el array numérico final

            return response()->json([
                'success' => true,
                'datos_periodo' => $datosPeriodo,
                'total_graduados' => $totalGraduados,
                'distribucion_por_facultad' => $distribucionPorFacultad
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al procesar estadísticas de graduados.',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }
}
