<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DirectorCarrerasController;
use App\Http\Controllers\PeiController;

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

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('auth:api')->group(function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });
}); 

//Route::get('/',[AuthController::class,'unauthorized'])->name('login');
