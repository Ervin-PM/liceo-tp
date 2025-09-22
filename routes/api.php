<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('auth/login', '\\App\\Http\\Controllers\\Api\\AuthController@login');
    Route::post('auth/logout', '\\App\\Http\\Controllers\\Api\\AuthController@logout')->middleware('auth:sanctum');
    Route::get('me', '\\App\\Http\\Controllers\\Api\\AuthController@me')->middleware('auth:sanctum');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('dashboard/today', '\\App\\Http\\Controllers\\Api\\DashboardController@today');

        Route::apiResource('alumnos', '\\App\\Http\\Controllers\\Api\\AlumnoController');
        Route::apiResource('asistencias', '\\App\\Http\\Controllers\\Api\\AsistenciaController')->only(['index','store']);
        Route::apiResource('retiros', '\\App\\Http\\Controllers\\Api\\RetiroDiarioController')->only(['store','index']);
        Route::apiResource('suspensiones', '\\App\\Http\\Controllers\\Api\\SuspensionController')->only(['index','store']);
        Route::apiResource('retiros-def', '\\App\\Http\\Controllers\\Api\\RetiroDefinitivoController')->only(['store','index']);
    });
});
