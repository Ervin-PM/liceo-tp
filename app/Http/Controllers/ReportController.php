<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReportService;
use App\Models\Asistencia;

class ReportController extends Controller
{
    public function asistencia(Request $request)
    {
        $asistencias = Asistencia::with(['alumno','alumno.curso'])->latest()->limit(200)->get();
        return view('reportes.asistencia.index', compact('asistencias'));
    }

    public function asistenciaPdf(Request $request)
    {
        $service = new ReportService();
        $asistencias = Asistencia::with(['alumno','alumno.curso'])->latest()->get();
        return $service->asistenciaPdf($asistencias);
    }

    public function asistenciaExcel(Request $request)
    {
        $service = new ReportService();
        $asistencias = Asistencia::with(['alumno','alumno.curso'])->latest()->get();
        return $service->asistenciaExcel($asistencias);
    }
}
