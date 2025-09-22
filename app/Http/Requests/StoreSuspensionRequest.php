<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSuspensionRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('suspensiones.create');
    }

    public function rules()
    {
        return [
            'alumno_id' => 'required|exists:alumnos,id',
            'fecha_inicio' => 'required|date',
            'fecha_termino' => 'required|date|after_or_equal:fecha_inicio',
            'motivo' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'fecha_termino.after_or_equal' => 'La fecha de término debe ser posterior o igual a la fecha de inicio.',
        ];
    }
}
