<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAsistenciaRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('asistencia.take');
    }

    public function rules()
    {
        return [
            'fecha' => 'required|date',
            'curso_id' => 'nullable|exists:cursos,id',
            'asistencias' => 'required|array',
            'asistencias.*.alumno_id' => 'required|exists:alumnos,id',
            'asistencias.*.estado' => 'required|in:presente,ausente,atraso,justificado',
        ];
    }

    public function messages()
    {
        return [
            'fecha.required' => 'La fecha es obligatoria.',
        ];
    }
}
