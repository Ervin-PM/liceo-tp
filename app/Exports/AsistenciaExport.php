<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class AsistenciaExport implements FromCollection, WithHeadings
{
    protected $collection;

    public function __construct($collection)
    {
        // Accept either Collection or array
        $this->collection = $collection instanceof Collection ? $collection : collect($collection);
    }

    public function collection()
    {
        return $this->collection->map(function ($r) {
            return [
                'apellidos' => $r->alumno->apellidos ?? '',
                'nombres' => $r->alumno->nombres ?? '',
                'curso' => $r->alumno->curso->nombre ?? ($r->curso->nombre ?? ''),
                'fecha' => $r->fecha ?? '',
                'estado' => $r->estado ?? '',
                'comentario' => $r->comentario ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return ['Apellidos','Nombres','Curso','Fecha','Estado','Comentario'];
    }
}
