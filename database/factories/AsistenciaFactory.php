<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AsistenciaFactory extends Factory
{
    public function definition()
    {
        return [
            'alumno_id' => null,
            'fecha' => now()->toDateString(),
            'estado' => $this->faker->randomElement(['presente','ausente','atraso','justificado']),
            'comentario' => null,
            'registrada_por_user_id' => null,
        ];
    }
}
