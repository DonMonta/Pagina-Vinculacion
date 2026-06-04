<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DirectorCarrerasController;
use App\Http\Controllers\PeiController;
use App\Http\Controllers\Subsistemas_peiController;
use App\Http\Controllers\Objetivos_peiController;
use App\Http\Controllers\PlandneController;
use App\Http\Controllers\Obj_pol_plandneController;
use App\Http\Controllers\Politicas_plandneController;
use App\Http\Controllers\Invi_proyectosController;
use App\Http\Controllers\InformacionPersonalController;
use App\Http\Controllers\InformacionPersonal_DController;
use App\Http\Controllers\Agenda_ODSController;
use App\Http\Controllers\ODSController;
use App\Http\Controllers\SeguiFormularioController;
use App\Http\Controllers\SeguiPreguntasController;
use App\Http\Controllers\SeguiTipoRespuestaController;
use App\Http\Controllers\Invi_dom_humaController;
use App\Http\Controllers\Invi_linea_investigaController;
use App\Http\Controllers\Invi_sub_linea_invesController;
use App\Http\Controllers\SubAreaUnescoController;
use App\Http\Controllers\Zona_planificacionController;
use App\Http\Controllers\PraempresaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('vin')->group(function () {
    Route::get('getFotoDocente/{ci}', [InformacionPersonal_DController::class, 'getFotografia']);
    Route::get('getFoto/{ci}', [InformacionPersonalController::class, 'getFotografia']);
    Route::get('getFotoEmpresa/{ci}', [PraempresaController::class, 'getFotografia']);

    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('auth:api,estudiante')->group(function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        Route::apiResource("directorescarr", DirectorCarrerasController::class);
        //Definición de endpoint para el recurso Pei, perimitiendo operaciones CRUD
        Route::apiResource("pei", PeiController::class);
        //Definición de la ruta endpoint para habilitar un pei
        Route::delete('habilitar_pei/{id}', [PeiController::class, 'habilitar']);
        //Definición de la ruta endpoint para deshabilitar un pei
        Route::delete('inhabilitar_pei/{id}', [PeiController::class, 'destroy']);
        //Definición de la ruta endpoint para subir un archivo
        Route::post('subir_archivo', [PeiController::class, 'uploadArchivo']);
        //Definición de la ruta endpoint para eliminar un archivo
        Route::post('eliminar_archivo', [PeiController::class, 'deleteArchivo']);
        //Definición de la ruta endpoint para el recurso Subsistemas_pei, perimitiendo operaciones CRUD
        Route::apiResource("subsistemas_pei", Subsistemas_peiController::class);
        //Definición de la ruta endpoint para el recurso Objetivos_pei, perimitiendo operaciones CRUD
        Route::apiResource("objetivos_pei", Objetivos_peiController::class);
        Route::get('objetivos_por_pei/{id_pei}', [Objetivos_peiController::class, 'listarPorPei']);
        //Definición de la ruta endpoint para el recurso Plandne, perimitiendo operaciones CRUD
        Route::apiResource("plandne", PlandneController::class);
        //Definicio de endpoint para habilitar un plandne
        Route::delete('habilitar_plandne/{id}', [PlandneController::class, 'habilitar']);
        //Definición de endpoint para deshabilitar un plandne
        Route::delete('inhabilitar_plandne/{id}', [PlandneController::class, 'destroy']);
        //Definición de ruta endpoint para el recurso Obj_pol_plandne, perimitiendo operaciones CRUD
        Route::apiResource("obj_pol_plandne", Obj_pol_plandneController::class);
        //Definición de ruta endpoint para el recurso Politicas_plandne, perimitiendo operaciones CRUD
        Route::apiResource("politicas_plandne", Politicas_plandneController::class);
        //Definición de ruta endpoint para listar las politicas de un plandne
        Route::get('politicas_por_plandne/{id_pladne}', [Politicas_plandneController::class, 'listarPorPlandne']);
        //Definición de ruta endpoint para el recurso Invi_proyectos, perimitiendo operaciones CRUD
        Route::apiResource("invi_proyectos", Invi_proyectosController::class);
        //definción de ruta para el catalogo de integrantes
        Route::get('catalogos-integrantes', [Invi_proyectosController::class, 'catalogos']);
        Route::put('actualizar-integrante/{id}', [Invi_proyectosController::class, 'actualizarIntegrante']);
        //Definición de la ruta para buscar integrantes
        Route::get('buscar-integrantes', [Invi_proyectosController::class, 'buscarIntegrante']);
        //Definición de la ruta para inhabilitar un integrante
        Route::post('inhabilitar-integrante', [Invi_proyectosController::class, 'inhabilitar']);
        //Definición de la ruta para reemplazar un integrante
        Route::post('reemplazar-integrante', [Invi_proyectosController::class, 'reemplazarIntegrante']);
        //Definicion para obtener foto del estudiante

        //Definicion para obtener la foto del docente
        //Definición de ruta para subir un archivo
        Route::post('subir_archivo_anexo', [Invi_proyectosController::class, 'uploadArchivo']);
        //Definición de ruta para subir un archivo
        Route::post('subir_archivo_anexo_darbaja', [Invi_proyectosController::class, 'uploadArchivoDarBaja']);
        //Definición de endpoint para guardar/reemplazar un integrante (modo nuevo o reemplazo)
        Route::post('integrantes/guardar', [Invi_proyectosController::class, 'guardarCambios']);
        //Definición de endpoint para obtener las estadísticas de proyectos y integrantes
        Route::get('dashboard/stats', [Invi_proyectosController::class, 'getStats']);
        //Definición de endpoint para el recurso Agenda_ODS, perimitiendo operaciones CRUD
        Route::apiResource("agenda_ods", Agenda_ODSController::class);
        //Definición de endpoint para el recurso ODS, perimitiendo operaciones CRUD
        Route::apiResource("ods", ODSController::class);
        //Denificion de endpoint para habilitar e inhabilitar un Agenda ODS
        Route::delete('habilitar_agenda_ods/{id}', [Agenda_ODSController::class, 'habilitar']);
        Route::delete('inhabilitar_agenda_ods/{id}', [Agenda_ODSController::class, 'destroy']);
        //Definición de endpoint para el recurso SeguiFormulario, perimitiendo operaciones CRUD
        Route::apiResource("seguiformulario", SeguiFormularioController::class);
        //Definición de endpoint para obtener los formularios de graduados
        Route::get('getformGraduados', [SeguiFormularioController::class, 'getformGraduados']);
        //Definición de endpoint para habilitar e inhabilitar un formulario
        Route::delete('habilitar_formulario/{id}', [SeguiFormularioController::class, 'habilitar']);
        Route::delete('inhabilitar_formulario/{id}', [SeguiFormularioController::class, 'destroy']);
        //Definición de endpoint para el recurso SeguiPreguntas, perimitiendo operaciones CRUD
        Route::apiResource("seguipreguntas", SeguiPreguntasController::class);
        //Definción de endpoint para el recurso SeguiTipoRespuesta, perimitiendo operaciones CRUD
        Route::apiResource("seguitiporespuesta", SeguiTipoRespuestaController::class);
        //Definición de endpoint para obtener el formulario de inscripcion de catedra habilitado
        Route::get('getCatedraInscripcion', [SeguiFormularioController::class, 'getCatedraInscripcion']);
        //Definición de endpoint para obtener el formulario de evaluación de catedra habilitado
        Route::get('getCatedraEvaluacion', [SeguiFormularioController::class, 'getCatedraEvaluacion']);
        //Definición de endpoint para obtener el formulario de inscripcion de catedra habilitado
        Route::get('getFormularioInscripcion', [SeguiFormularioController::class, 'getFormularioInscripcion']);
        //Definición de endpoint para obtener el formulario de evaluación de catedra habilitado
        Route::get('getFormularioEvaluacion', [SeguiFormularioController::class, 'getFormularioEvaluacion']);
        //Definición de endpoint para guardar el formulario de inscripcion de catedra habilitado
        Route::post('guardarInscripcion', [SeguiFormularioController::class, 'guardarInscripcion']);
        //Definición de endpoint para guardar el formulario de evaluación de catedra habilitado
        Route::post('guardarEvaluacion', [SeguiFormularioController::class, 'guardarEvaluacion']);
        //Definición para obtener los estudiantes inscritos en un formulario
        Route::get('getEstudiantesInscritos/{idFormulario}', [SeguiFormularioController::class, 'getEstudiantesInscritos']);
        //Definición para obtener los estudiantes inscritos en un formulario
        Route::get('getEncuestadosGraduados/{idFormulario}', [SeguiFormularioController::class, 'getEncuestadosGraduados']);
        //Definición para obtener los detalles de respuestas de un estudiante
        Route::get('getDetalleRespuestasEstudiante/{idFormulario}/{cedula}', [SeguiFormularioController::class, 'getDetalleRespuestasEstudiante']);
        //Definición para obtener los detalles de respuestas de un graduado
        Route::get('getDetalleRespuestasGraduados/{idFormulario}/{cedula}', [SeguiFormularioController::class, 'getDetalleRespuestasGraduados']);
        //Definición de endpoint para obtener el promedio de un estudiante
        Route::get('getPromedioEstudiante/{cedula}', [SeguiFormularioController::class, 'getPromedioEstudiante']);
        //Definción del recurso Dominio Humano, perimitiendo operaciones CRUD
        Route::apiResource("invi_dom_huma", Invi_dom_humaController::class);
        //Definición del recurso Línea de Investigación, perimitiendo operaciones CRUD
        Route::apiResource("invi_linea_investiga", Invi_linea_investigaController::class);
        //Definición de endpoint para habilitar una línea de investigación
        Route::delete('habilitar_linea_investiga/{id}', [Invi_linea_investigaController::class, 'habilitar']);
        //Definición de endpoint para deshabilitar una línea de investigación
        Route::delete('inhabilitar_linea_investiga/{id}', [Invi_linea_investigaController::class, 'destroy']);
        //Definición de endpoint para obtener las facultades de una sede
        Route::get('getFacultades', [Invi_linea_investigaController::class, 'getFacultades']);
        //Definición de endpoint para obtener las carreras de una facultad
        Route::get('getCarreras/{idfacultad}', [Invi_sub_linea_invesController::class, 'getCarrerasPorFacultad']);
        //Definición de endpoint para obtener las sublineas de una línea de investigación
        Route::get('getSublineas/{id_lin_investiga}', [Invi_sub_linea_invesController::class, 'getSublineasPorLinea']);
        //Definición de recurso para las sublineas de una línea de investigación
        Route::apiResource("invi_sub_linea_inves", Invi_sub_linea_invesController::class);
        //Definición para obtener las Subareas de UNESCO
        Route::get('getSubareas', [SubAreaUnescoController::class, 'index']);
        //Definición de recurso para las zonas de planificación, perimitiendo operaciones CRUD
        Route::apiResource("zona_planificacion", Zona_planificacionController::class);
        //Definición de endpoint para obtener las provincias
        Route::get('getProvincias', [Zona_planificacionController::class, 'getProvincias']);
        //Definición de endpoint para obtener las provincias asignadas a una zona de planificación
        Route::get('getProvinciasPorZona/{id_zona_plan}', [Zona_planificacionController::class, 'getProvinciasPorZona']);
        //Definición de endpoint para guardar las provincias asignadas a una zona de planificación
        Route::post('guardarProvincias', [Zona_planificacionController::class, 'guardarProvincias']);
        //Definiciónd del recurso Empresa, perimitiendo operaciones CRUD
        Route::apiResource("empresa", PraempresaController::class);
        //Definición de endpoint para subir un archivo
        Route::post('subir_archivo', [PraempresaController::class, 'uploadArchivo']);
        //Definición de endpoint para habilitar un empresa
        Route::delete('habilitar_empresa/{id}', [PraempresaController::class, 'habilitar']);
        //Definición de endpoint para inhabilitar un empresa
        Route::delete('inhabilitar_empresa/{id}', [PraempresaController::class, 'destroy']);
    });
}); 

//Route::get('/',[AuthController::class,'unauthorized'])->name('login');
