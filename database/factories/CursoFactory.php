<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CursoFactory extends Factory
{
    public function definition()
    {
        return [
            'nombre' => $this->faker->randomElement(['2° Medio A','2° Medio B','1° Medio A']),
            'nivel' => $this->faker->randomElement(['1','2','3','4']),
            'letra' => $this->faker->randomLetter,
            'especialidad' => null,
            'anio_lectivo' => date('Y'),
        ];
    }
}
