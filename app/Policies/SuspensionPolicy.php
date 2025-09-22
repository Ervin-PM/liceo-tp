<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Suspension;

class SuspensionPolicy
{
    public function create(User $user)
    {
        return $user->can('suspensiones.create');
    }

    public function view(User $user)
    {
        return $user->can('suspensiones.view');
    }

    public function update(User $user)
    {
        return $user->can('suspensiones.update');
    }
}
