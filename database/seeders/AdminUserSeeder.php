<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $email = 'admin@liceo.test';

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => 'Administrador',
                'password' => bcrypt('Password123*'),
                'telefono' => null,
                'force_password_change' => true,
            ]
        );

        if (method_exists($user, 'assignRole')) {
            $user->assignRole('Administrador');
        }
    }
}
