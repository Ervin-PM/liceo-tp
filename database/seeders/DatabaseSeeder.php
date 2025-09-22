<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            AdminUserSeeder::class,
        ]);

        // Sample data
        \App\Models\Curso::factory()->count(3)->create()->each(function($curso){
            \App\Models\Apoderado::factory()->count(2)->create();
        });

        // Create some alumnos
        \App\Models\Alumno::factory()->count(20)->create();
    }
}
