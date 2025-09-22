<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlumnoRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('alumnos.create');
    }

    public function rules()
    {
        return [
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'documento_identidad' => 'nullable|string|unique:alumnos,documento_identidad',
            'fecha_nacimiento' => 'nullable|date',
        ];
    }

    public function messages()
    {
        return [
            'nombres.required' => 'El nombre es obligatorio.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'documento_identidad.unique' => 'El documento ya está registrado.',
        ];
    }
}
