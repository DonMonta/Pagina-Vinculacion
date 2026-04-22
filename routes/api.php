<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DirectorCarrerasController;
use App\Http\Controllers\PeiController;
use App\Http\Controllers\Subsistemas_peiController;
use App\Http\Controllers\Objetivos_peiController;

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

    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('auth:api')->group(function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });
}); 

//Route::get('/',[AuthController::class,'unauthorized'])->name('login');
