<?php

namespace App\Http\Controllers;

use App\Models\Invi_proyectos;
use App\Models\Invi_detalle_integrante;
use App\Models\InformacionPersonalD;
use App\Models\InformacionPersonal;
use App\Models\Carreras;
use App\Models\Invi_funcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Invi_proyectosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $searchQuery = $request->input('search_query');
            $query = Invi_proyectos::select(
                'invi_proyectos.*'
            )->where('proyect_tipo', '=', 'VINCULACIÓN');
            if (! empty($searchQuery)) {
                $query->where(function ($q) use ($searchQuery) {
                    $q->where('invi_proyectos.proyect_cod', 'LIKE', "%{$searchQuery}%");
                });
            }

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
                'pagination' => [
                    'current_page' => $data->currentPage(),
                    'per_page' => $data->perPage(),
                    'total' => $data->total(),
                    'last_page' => $data->lastPage(),
                ],

            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al procesar los datos: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();

        $res = Invi_proyectos::create($inputs);

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
        $proyecto = Invi_proyectos::with([
            'invi_detalle_fac_proy.facultades',
            'invi_detalle_fac_proy.facultades_priori',
            'invi_detalle_integrante.funciones',
            'invi_detalle_integrante.carreras',
            'invi_detalle_integrante.informacionPersonalD',
            'invi_detalle_integrante.informacionpersonal'
        ])->findOrFail($id);

        return response()->json($proyecto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $res = Invi_proyectos::find($id);
        if (isset($res)) {
            $res->proyect_cod = $request->proyect_cod;
            $res->proyect_nombre = $request->proyect_nombre;
            $res->proyect_titulo = $request->proyect_titulo;
            $res->fechainicio = $request->fechainicio;
            $res->fechafin = $request->fechafin;
            $res->proyect_tipo = $request->proyect_tipo;
            if ($res->save()) {
                return response()->json([
                    'data' => $res,
                    'mensaje' => 'Actualizado con Éxito!!',
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'mensaje' => 'Error al Actualizar',
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "El proyecto con id: $id no Existe",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function buscarIntegrante(Request $request)
    {
        $cedula = $request->cedula;
        
        // Buscar en ambas tablas de información personal
        $docente = InformacionPersonalD::where('CIInfPer', $cedula)->first();
        $estudiante = InformacionPersonal::where('CIInfPer', $cedula)->first();

        if (!$docente && !$estudiante) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        $persona = $docente ?: $estudiante;
        return response()->json([
            'cedula' => $persona->CIInfPer,
            'nombre_completo' => "{$persona->NombInfPer} {$persona->ApellInfPer} {$persona->ApellMatInfPer}",
            'tipo' => $docente ? 'doc' : 'est'
        ]);
    }
    public function reemplazarIntegrante(Request $request)
    {
        return DB::transaction(function () use ($request) {
            // 1. Actualizar integrante actual
            $actual = Invi_detalle_integrante::findOrFail($request->id_detalle_actual);
            $actual->update([
                'reemplazado' => 1,
                'id_funcion' => null,
                'horas' => 0
            ]);

            // 2. Crear nuevo integrante
            $nuevo = new Invi_detalle_integrante();
            $nuevo->proyect_id = $actual->proyect_id;
            if ($request->tipo === 'doc') {
                $nuevo->ciinfper_doc = $request->cedula;
            } else {
                $nuevo->ciinfper_est = $request->cedula;
            }
            $nuevo->horas = $request->horas;
            $nuevo->id_funcion = $request->id_funcion;
            $nuevo->idCarr = $request->idCarr;
            $nuevo->reemplazado = 0;
            $nuevo->save();

            return response()->json(['message' => 'Reemplazo exitoso']);
        });
    }
    public function catalogos()
    {
        return response()->json([
            'funciones' => Invi_funcion::where('estado', 1)
            ->where('tipo_funcion', '=', 'VINCULACIÓN')
            ->get(),
            'carreras' => Carreras::where('StatusCarr', 1)
            ->where('NombCarr', 'NOT LIKE', '%TRABAJO DE INTEGRACIÓN CURRICULAR%')
            ->get(),
        ]);
    }
    public function actualizarIntegrante(Request $request, $id)
    {
        $integrante = Invi_detalle_integrante::findOrFail($id);
        
        $integrante->update([
            'horas' => $request->horas,
            'id_funcion' => $request->id_funcion,
            'idCarr' => $request->idCarr,
            'reemplazado' => $request->reemplazado ?? 0
        ]);

        return response()->json(['message' => 'Información actualizada con éxito']);
    }
    public function inhabilitar(Request $request)
    {
        $integrante = Invi_detalle_integrante::findOrFail($request->id);

        $integrante->update([
            'horas' => 0,
            'reemplazado' => 1,
            'id_funcion' => null
        ]);

        return response()->json(['message' => 'Integrante inhabilitado correctamente']);
    }
    public function reemplazar(Request $request)
    {
        return DB::transaction(function () use ($request) {
            // 1. Procesar al integrante que sale (el actual)
            $actual = Invi_detalle_integrante::findOrFail($request->id_detalle_actual);
            $actual->update([
                'reemplazado' => 1,
                'id_funcion' => null,
                'horas' => 0
            ]);

            // 2. Crear al nuevo integrante (el reemplazo)
            // Validamos si es docente o estudiante según el 'tipo' enviado desde Vue
            $nuevo = new Invi_detalle_integrante();
            $nuevo->proyect_id = $actual->proyect_id;
            
            if ($request->nuevo['tipo'] === 'doc') {
                $nuevo->ciinfper_doc = $request->nuevo['cedula'];
                $nuevo->ciinfper_est = null;
            } else {
                $nuevo->ciinfper_est = $request->nuevo['cedula'];
                $nuevo->ciinfper_doc = null;
            }

            $nuevo->horas = $request->nuevo['horas'];
            $nuevo->id_funcion = $request->nuevo['id_funcion'];
            $nuevo->idCarr = $request->nuevo['idCarr'];
            $nuevo->reemplazado = 0; // El nuevo entra activo
            $nuevo->save();

            return response()->json([
                'message' => 'Reemplazo procesado correctamente',
                'nuevo_id' => $nuevo->id_deta_invi_proyect
            ]);
        });
    }

}
