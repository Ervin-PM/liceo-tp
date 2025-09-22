<?php

namespace App\Services;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Exports\AsistenciaExport;
use Illuminate\Support\Collection;

class ReportService
{
    public function asistenciaPdf($data)
    {
        $html = View::make('reportes.asistencia.pdf', ['data' => $data])->render();
        // If barryvdh/laravel-dompdf is installed, use it; otherwise return the HTML as text with header
        if (class_exists(\Barryvdh\DomPDF\Facade::class)) {
            $pdf = \Barryvdh\DomPDF\Facade::loadHTML($html);
            return $pdf->stream('reporte_asistencia_' . now()->format('Ymd_His') . '.pdf');
        }

        return response($html)->header('Content-Type','application/pdf');
    }

    public function asistenciaExcel($collection)
    {
        // Normalize to Collection
        $collection = $collection instanceof Collection ? $collection : collect($collection);

        // If maatwebsite/excel is installed, generate using the export class
        if (class_exists(\Maatwebsite\Excel\Excel::class) && class_exists(AsistenciaExport::class)) {
            $export = new AsistenciaExport($collection);
            return \Maatwebsite\Excel\Facades\Excel::download($export, 'asistencia_' . now()->format('Ymd_His') . '.xlsx');
        }

        // Fallback to CSV response
        $csv = "Apellidos,Nombres,Curso,Fecha,Estado,Comentario\n";
        foreach ($collection as $r) {
            $apellidos = $r->alumno->apellidos ?? '';
            $nombres = $r->alumno->nombres ?? '';
            $curso = $r->alumno->curso->nombre ?? ($r->curso->nombre ?? '');
            $fecha = $r->fecha ?? '';
            $estado = $r->estado ?? '';
            $comentario = isset($r->comentario) ? str_replace(["\r","\n"], [' ', ' '], $r->comentario) : '';
            $csv .= sprintf('"%s","%s","%s","%s","%s","%s"\n', $apellidos, $nombres, $curso, $fecha, $estado, $comentario);
        }

        return response($csv)->header('Content-Type','text/csv');
    }
}
