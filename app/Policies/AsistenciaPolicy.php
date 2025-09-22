<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Asistencia;

class AsistenciaPolicy
{
    public function take(User $user)
    {
        return $user->can('asistencia.take');
    }

    public function view(User $user)
    {
        return $user->can('asistencia.view');
    }
}
