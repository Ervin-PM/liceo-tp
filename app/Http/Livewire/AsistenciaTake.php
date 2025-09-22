<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Curso;
use App\Models\Alumno;
use App\Services\AsistenciaService;

class AsistenciaTake extends Component
{
    public $curso_id;
    public $fecha;
    public $alumnos = [];

    protected $rules = [
        'curso_id' => 'nullable|exists:cursos,id',
        'fecha' => 'required|date',
    ];

    protected $service;

    public function mount(AsistenciaService $service)
    {
        $this->service = $service;
        $this->fecha = now()->toDateString();
    }

    public function loadAlumnos()
    {
        $this->validateOnly('curso_id');
        $this->alumnos = Alumno::where('curso_id', $this->curso_id)->get()->map(function($a){
            return ['alumno_id' => $a->id, 'nombres' => $a->nombres, 'apellidos' => $a->apellidos, 'estado' => 'presente'];
        })->toArray();
    }

    public function submit()
    {
        $this->validate();
        $created = 0; $skipped = 0;
        foreach ($this->alumnos as $row) {
            $ok = $this->service->createIfNotExists($row['alumno_id'], $this->fecha, $row['estado'], $row['comentario'] ?? null, auth()->id());
            $ok ? $created++ : $skipped++;
        }

        session()->flash('success', "Asistencias procesadas: {$created}. Filtradas: {$skipped}.");
    }

    public function render()
    {
        $cursos = Curso::orderBy('nombre')->get();
        return view('livewire.asistencia-take', compact('cursos'));
    }
}
