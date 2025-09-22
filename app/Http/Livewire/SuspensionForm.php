<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Alumno;
use App\Services\SuspensionService;

class SuspensionForm extends Component
{
    public $alumno_id;
    public $fecha_inicio;
    public $fecha_termino;
    public $motivo;
    public $resolucion_nro;

    protected $rules = [
        'alumno_id' => 'required|exists:alumnos,id',
        'fecha_inicio' => 'required|date',
        'fecha_termino' => 'required|date|after_or_equal:fecha_inicio',
        'motivo' => 'required|string|max:1000',
    ];

    protected $service;

    public function mount(SuspensionService $service)
    {
        $this->service = $service;
        $this->fecha_inicio = now()->toDateString();
        $this->fecha_termino = now()->addDays(1)->toDateString();
    }

    public function submit()
    {
        $this->validate();

        $result = $this->service->createIfNoOverlap($this->alumno_id, $this->fecha_inicio, $this->fecha_termino, $this->motivo, auth()->id(), $this->resolucion_nro);

        if (! $result['success']) {
            $this->addError('overlap', $result['message']);
            return;
        }

        session()->flash('success', 'Suspensión registrada.');
        $this->reset(['alumno_id','motivo','resolucion_nro']);
    }

    public function render()
    {
        $alumnos = Alumno::orderBy('apellidos')->get();
        return view('livewire.suspension-form', compact('alumnos'));
    }
}
