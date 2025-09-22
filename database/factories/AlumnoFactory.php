<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AlumnoFactory extends Factory
{
    public function definition()
    {
        return [
            'nombres' => $this->faker->firstName,
            'apellidos' => $this->faker->lastName,
            'documento_identidad' => $this->faker->unique()->numerify('#########'),
            'fecha_nacimiento' => $this->faker->date(),
            'genero' => $this->faker->randomElement(['M','F','X']),
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'curso_id' => null,
            'estado' => 'activo',
            'fecha_ingreso' => now()->subYears(1)->toDateString(),
            'observaciones' => null,
        ];
    }
}
