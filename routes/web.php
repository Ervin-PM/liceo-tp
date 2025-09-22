<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::resource('alumnos', '\\App\\Http\\Controllers\\AlumnoController');
    Route::resource('cursos', '\\App\\Http\\Controllers\\CursoController');
    Route::resource('apoderados', '\\App\\Http\\Controllers\\ApoderadoController');

    Route::resource('asistencia', '\\App\\Http\\Controllers\\AsistenciaController')->only(['index','create','store']);
    Route::get('asistencia/tomar', '\\App\\Http\\Controllers\\AsistenciaController@tomar')->name('asistencia.tomar');

    Route::resource('retiros', '\\App\\Http\\Controllers\\RetiroDiarioController')->only(['index','create','store']);
    Route::get('retiros/form', '\\App\\Http\\Controllers\\RetiroDiarioController@form')->name('retiros.form');

    Route::resource('suspensiones', '\\App\\Http\\Controllers\\SuspensionController');
    Route::get('suspensiones/form', '\\App\\Http\\Controllers\\SuspensionController@create')->name('suspensiones.form');

    Route::resource('retiros-def', '\\App\\Http\\Controllers\\RetiroDefinitivoController');

    Route::resource('convivencia', '\\App\\Http\\Controllers\\CasoConvivenciaController');

    Route::get('reportes/asistencia', '\\App\\Http\\Controllers\\ReportController@asistencia')->name('reportes.asistencia');
    Route::get('reportes/asistencia.pdf', '\\App\\Http\\Controllers\\ReportController@asistenciaPdf')->name('reportes.asistencia.pdf');
    Route::get('reportes/asistencia.excel', '\\App\\Http\\Controllers\\ReportController@asistenciaExcel')->name('reportes.asistencia.excel');
});
