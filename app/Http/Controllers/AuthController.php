<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
//use App\Models\RegistroTitulos;
use App\Models\informacionpersonal;
use App\Models\InformacionPersonalD;
use App\Models\Invi_deta_inte;
use Illuminate\Validation\Rule;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use App\Models\Bitacora;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'LoginUsu' => 'required|string',
            'ClaveUsu' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $CIInfPer = $request->input('LoginUsu');
        $codigo_dactilar = $request->input('ClaveUsu');
        $perfilesPermitidos = ['sotics', 'atics', 'sa', 'vinc', 'avinc'];
        $user = User::select('ciinfper', 'NombUsu', 'LoginUsu', 'email', 'idperfil', 'ClaveUsu', 'StatusUsu')
            ->where('LoginUsu', $CIInfPer)
            ->where('StatusUsu', 1)
            ->whereIn('idperfil', $perfilesPermitidos)
            ->first();
        $estudiante = informacionpersonal::where('CIInfPer', $CIInfPer)->first();
        $docente  = InformacionPersonalD::select('CIInfPer', 'LoginUsu', 'ClaveUsu', 'ApellInfPer', 'mailPer', 'TipoInfPer')
            ->where('LoginUsu', $CIInfPer)
            ->where('StatusPer', 1)
            ->first();

        if ($user) {

            if (md5($codigo_dactilar) !== $user->ClaveUsu) {
                return response()->json([
                    'error' => true,
                    'mensaje' => 'Usuario correcto pero la clave es incorrecta',
                ], Response::HTTP_UNAUTHORIZED);
            }
            // --- INICIO DE REGISTRO EN BITÁCORA ---
            try {
                Bitacora::create([
                    'bt_usuario'     => $user->ciinfper,
                    'bt_fechahora'   => Carbon::now(), // Fecha y hora actual
                    'bt_accion'      => 'INICIO DE SESIÓN VINCULACIÓN-DASHBOARD',
                    'bt_ippc'        => $request->ip(), // Obtiene la IP del dispositivo
                    'bt_observacion' => 'INICIO DE SESIÓN DEL USUARIO: ' . $user->NombUsu,
                ]);
            } catch (\Exception $e) {
                // Logueamos el error por si falla la inserción en bitácora, 
                // pero permitimos que el login continúe.
                Log::error("Error al registrar bitácora: " . $e->getMessage());
            }
            // --- FIN DE REGISTRO EN BITÁCORA ---

            $token = auth()->login($user);

            return response()->json([
                'mensaje' => 'Autenticación exitosa',
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => config('jwt.ttl') * 60,
                'name' => $user->NombUsu,
                'email' => $user->email,
                'Role' => $user->idperfil,
                'cedula' => $user->ciinfper,
            ]);
        }elseif($docente){
            
            if (md5($codigo_dactilar) !== $docente->ClaveUsu) {
                return response()->json([
                    'error' => true,
                    'mensaje' => 'Usuario correcto pero la clave es incorrecta',
                ], Response::HTTP_UNAUTHORIZED);
            }

            // --- REGISTRO EN BITÁCORA DOCENTE ---
            try {
                Bitacora::create([
                    'bt_usuario'     => $docente->CIInfPer,
                    'bt_fechahora'   => Carbon::now(),
                    'bt_accion'      => 'INICIO DE SESIÓN DOCENTE VINCULACIÓN',
                    'bt_ippc'        => $request->ip(),
                    'bt_observacion' => 'INICIO DE SESIÓN DOCENTE: ' . $docente->ApellInfPer,
                ]);
            } catch (\Exception $e) {
                Log::error("Error al registrar bitácora DOCENTE: " . $e->getMessage());
            }
            // --- BÚSQUEDA DE PROYECTOS Y FUNCIONES DEL DOCENTE ---
            // Traemos las relaciones 'invi_proyectos' y 'funciones' usando Eager Loading
            $asignacionesProyectos = Invi_deta_inte::with(['invi_proyectos', 'funciones'])
                ->where('ciinfper_doc', $docente->CIInfPer)
                // ->where('estado', 1) // Opcional: Descomenta si necesitas filtrar solo integrantes activos
                ->get();
            if ($asignacionesProyectos->isEmpty()) {
                $token = auth('docente')->login($docente);

                return response()->json([
                    'mensaje' => 'No se encontraron proyectos asignados al docente',
                    'token'   => $token,
                    'token_type' => 'bearer',
                    'expires_in' => config('jwt.ttl') * 60,
                    'name'       => $docente->NombInfPer . ' ' .  $docente->ApellInfPer . ' ' . $docente->ApellMatInfPer,
                    'email'      => $docente->mailPer,
                    'cedula'     => $docente->CIInfPer,
                    'Role'       => $docente->TipoInfPer,
                ]);
            }
            $ids_proyectos = [];
            $detalles_proyectos = [];

            foreach ($asignacionesProyectos as $asignacion) {
                if ($asignacion->invi_proyectos) {
                    $ids_proyectos[] = $asignacion->proyect_id;
                    
                    $detalles_proyectos[] = [
                        'proyect_id'     => $asignacion->proyect_id,
                        'proyect_cod'    => $asignacion->invi_proyectos->proyect_cod,
                        'proyect_titulo' => $asignacion->invi_proyectos->proyect_titulo,
                        'id_funcion'     => $asignacion->id_funcion,
                        'funcion'        => $asignacion->funciones ? $asignacion->funciones->nombre_funcion : 'Sin función asignada'
                    ];
                }
            }

            // Aseguramos que los IDs de proyectos sean únicos por si está registrado 2 veces en un mismo proyecto
            $ids_proyectos = array_values(array_unique($ids_proyectos));
            // --- FIN BÚSQUEDA DE PROYECTOS ---
            // Generamos Token explícitamente para este modelo alternativo
            $token = auth('docente')->login($docente);

            return response()->json([
                'mensaje'            => 'Autenticación exitosa',
                'token'              => $token,
                'token_type'         => 'bearer',
                'expires_in'         => config('jwt.ttl') * 60,
                'name'               => $docente->NombInfPer . ' ' .  $docente->ApellInfPer . ' ' . $docente->ApellMatInfPer,
                'email'              => $docente->mailPer,
                'cedula'             => $docente->CIInfPer,
                'Role'               => $docente->TipoInfPer,
                'proyectos_ids'      => $ids_proyectos,          // Retorna array ej: [1, 5, 8]
                'proyectos_detalles' => $detalles_proyectos      // Retorna array de objetos con nombre de proyecto y función
            ]);

        } 
        elseif ($estudiante) {
            // Validamos la clave dactilar (asumo que se guarda sin MD5, si lleva md5 ajusta la comparación)
            if (md5($codigo_dactilar) !== $estudiante->codigo_dactilar) {
                return response()->json([
                    'error' => true,
                    'mensaje' => 'Usuario correcto pero la clave es incorrecta',
                ], Response::HTTP_UNAUTHORIZED);
            }

            // Obtener ID del periodo lectivo activo para la subconsulta
            $idPerActivo = DB::table('periodolectivo')->where('StatusPerLec', 1)->value('idper');
            // Ejecutar tu consulta para saber si está matriculado
            $matricula = DB::table('informacionpersonal')
                ->select(
                    'informacionpersonal.CIInfPer',
                    'informacionpersonal.NombInfPer',
                    'informacionpersonal.ApellInfPer',
                    'informacionpersonal.mailInst',
                    'carrera.idCarr',
                    'carrera.NombCarr',
                    'facultad.siglas',
                    'detalle_matricula.nivel'
                )
                ->join('factura', 'factura.cedula', '=', 'informacionpersonal.CIInfPer')
                ->join('detalle_matricula', 'factura.id', '=', 'detalle_matricula.idfactura')
                ->join('carrera', 'carrera.idCarr', '=', 'detalle_matricula.idcarr')
                ->join('facultad', 'facultad.idfacultad', '=', 'carrera.idfacultad')
                ->where('factura.idper', $idPerActivo)
                ->where('carrera.StatusCarr', 1)
                ->whereIn('factura.tipo_documento', ['MATRICULA', 'MATRÍCULA'])
                ->where('carrera.optativa', 0)
                ->where('informacionpersonal.CIInfPer', $CIInfPer)
                ->first();
            if (!$matricula) {
                return response()->json([
                    'error' => true,
                    'mensaje' => 'Usuario correcto pero aun no se ha matriculado en el periodo lectivo activo',
                ], Response::HTTP_FORBIDDEN); // 403 Forbidden 
            }

            // --- REGISTRO EN BITÁCORA ESTUDIANTE ---
            try {
                Bitacora::create([
                    'bt_usuario'     => $estudiante->CIInfPer,
                    'bt_fechahora'   => Carbon::now(),
                    'bt_accion'      => 'INICIO DE SESIÓN ESTUDIANTE VINCULACIÓN',
                    'bt_ippc'        => $request->ip(),
                    'bt_observacion' => 'INICIO DE SESIÓN ESTUDIANTE: ' . $estudiante->NombInfPer . ' ' . $estudiante->ApellInfPer,
                ]);
            } catch (\Exception $e) {
                Log::error("Error al registrar bitácora ESTUDIANTE: " . $e->getMessage());
            }

            // Generamos Token explícitamente para este modelo alternativo
            $token = auth('estudiante')->login($estudiante);

            return response()->json([
                'mensaje'    => 'Autenticación exitosa',
                'token'      => $token,
                'token_type' => 'bearer',
                'expires_in' => config('jwt.ttl') * 60,
                'name'       => $estudiante->NombInfPer . ' ' . $estudiante->ApellInfPer,
                'email'      => $estudiante->mailInst,
                'cedula'    => $estudiante->CIInfPer,
                'Role'       => 'est', // Retornamos Rol estático 'est' como solicitaste
                'carrera'    => $matricula->NombCarr,
                'nivel'      => $matricula->nivel,
                'IDCarrera'  => $matricula->idCarr,
                'facultad'    => $matricula->siglas,
            ]);
        } else {

            return response()->json([
                'error' => true,
                'mensaje' => "El Usuario: $CIInfPer no Existe",
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function me()
    {
        // 1. Verificamos si es un usuario administrativo/docente
        if (auth('api')->check()) {
            return response()->json(auth('api')->user());
        }
        if (auth('docente')->check()) {
            return response()->json(auth('docente')->user());
        }
        // 2. Verificamos si es un estudiante
        if (auth('estudiante')->check()) {
            return response()->json(auth('estudiante')->user());
        }

        // Si el token llegó pero expiró o no pertenece a ningún guard válido
        return response()->json([
            'error' => 'No autorizado o sesión expirada'
        ], Response::HTTP_UNAUTHORIZED);
    }
    public function logout()
    {
        try {
            $token = JWTAuth::getToken();
            if (!$token) {
                return response()->json(['error' => 'No hay token activo'], Response::HTTP_BAD_REQUEST);
            }

            // Invalidamos el token globalmente (bloquea el token tanto para api como estudiante)
            JWTAuth::invalidate($token);

            // Forzamos el cierre de sesión en los estados locales de los guards
            auth('api')->logout();
            auth('docente')->logout();
            auth('estudiante')->logout();

            return response()->json(['message' => 'Has cerrado sesión exitosamente'], Response::HTTP_OK);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'Token inválido o ya revocado'], Response::HTTP_UNAUTHORIZED);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo cerrar sesión'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function refresh()
    {
        try {
            $token = JWTAuth::getToken();
            if (!$token) {
                return response()->json(['error' => 'No hay token'], Response::HTTP_BAD_REQUEST);
            }
            $nuevo_token = JWTAuth::refresh();
            JWTAuth::invalidate($token);
            return $this->respondWithToken($nuevo_token);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'Token inválido'], Response::HTTP_UNAUTHORIZED);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo refrescar sesion'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ], Response::HTTP_OK);
    }
}
