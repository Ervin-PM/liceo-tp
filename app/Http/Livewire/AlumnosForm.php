<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Alumno;

class AlumnosForm extends Component
{
    public $alumnoId;
    public $nombres;
    public $apellidos;
    public $documento_identidad;

    protected $rules = [
        'nombres' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'documento_identidad' => 'nullable|string',
    ];

    public function mount($alumnoId = null)
    {
        if ($alumnoId) {
            $a = Alumno::findOrFail($alumnoId);
            $this->alumnoId = $a->id;
            $this->nombres = $a->nombres;
            $this->apellidos = $a->apellidos;
            $this->documento_identidad = $a->documento_identidad;
        }
    }

    public function save()
    {
        $this->validate();
        if ($this->alumnoId) {
            $a = Alumno::find($this->alumnoId);
            $a->update([
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'documento_identidad' => $this->documento_identidad,
            ]);
            session()->flash('success', 'Alumno actualizado.');
        } else {
            Alumno::create([
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'documento_identidad' => $this->documento_identidad,
            ]);
            session()->flash('success', 'Alumno creado.');
            $this->reset(['nombres','apellidos','documento_identidad']);
        }
    }

    public function render()
    {
        return view('livewire.alumnos-form');
    }
}
