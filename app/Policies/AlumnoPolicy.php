<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Alumno;

class AlumnoPolicy
{
    public function viewAny(User $user)
    {
        return $user->can('alumnos.view');
    }

    public function view(User $user, Alumno $alumno)
    {
        return $user->can('alumnos.view');
    }

    public function create(User $user)
    {
        return $user->can('alumnos.create');
    }

    public function update(User $user, Alumno $alumno)
    {
        return $user->can('alumnos.update');
    }

    public function delete(User $user, Alumno $alumno)
    {
        return $user->can('alumnos.delete');
    }
}
