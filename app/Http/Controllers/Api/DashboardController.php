<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Asistencia;

class DashboardController extends Controller
{
    public function today(Request $request)
    {
        $totalAlumnos = Alumno::count();
        $hoy = now()->toDateString();
        $asistenciasHoy = Asistencia::where('fecha', $hoy)->count();
        $retirosHoy = \App\Models\RetiroDiario::whereDate('fecha_hora_salida', $hoy)->count();

        return response()->json([
            'total_alumnos' => $totalAlumnos,
            'asistencias_hoy' => $asistenciasHoy,
            'retiros_hoy' => $retirosHoy,
        ]);
    }
}
