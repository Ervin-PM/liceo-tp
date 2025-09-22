<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Alumno;
use App\Models\RetiroDiario;

class RetiroDiarioForm extends Component
{
    public $alumno_id;
    public $fecha;
    public $motivo;

    protected $rules = [
        'alumno_id' => 'required|exists:alumnos,id',
        'fecha' => 'required|date',
        'motivo' => 'nullable|string|max:500',
    ];

    public function mount()
    {
        $this->fecha = now()->toDateString();
    }

    public function submit()
    {
        $this->validate();

        // simple create; controllers/services handle deeper logic elsewhere
        \App\Models\RetiroDiario::create([
            'alumno_id' => $this->alumno_id,
            'fecha' => $this->fecha,
            'motivo' => $this->motivo,
            'user_id' => auth()->id(),
        ]);

        session()->flash('success', 'Retiro diario registrado.');
        $this->reset(['alumno_id', 'motivo']);
    }

    public function render()
    {
        $alumnos = Alumno::orderBy('apellidos')->get();
        return view('livewire.retiro-diario-form', compact('alumnos'));
    }
}
