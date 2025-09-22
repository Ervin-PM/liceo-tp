<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ApoderadoFactory extends Factory
{
    public function definition()
    {
        return [
            'nombres' => $this->faker->firstName,
            'apellidos' => $this->faker->lastName,
            'documento_identidad' => $this->faker->unique()->numerify('#########'),
            'parentesco' => 'Padre',
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'direccion' => $this->faker->address,
            'autorizado' => true,
        ];
    }
}
