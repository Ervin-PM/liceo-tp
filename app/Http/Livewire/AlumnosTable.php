<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Alumno;

class AlumnosTable extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $q = Alumno::query();
        if ($this->search) {
            $q->where(function($s){
                $s->where('nombres', 'like', "%{$this->search}%")
                  ->orWhere('apellidos', 'like', "%{$this->search}%");
            });
        }

        $alumnos = $q->orderBy('apellidos')->paginate(10);

        return view('livewire.alumnos-table', compact('alumnos'));
    }
}
