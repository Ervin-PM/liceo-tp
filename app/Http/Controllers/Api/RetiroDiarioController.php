<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RetiroDiario;

class RetiroDiarioController extends Controller
{
    public function index(Request $request)
    {
        $q = RetiroDiario::with('alumno','apoderado');
        return response()->json($q->paginate($request->get('per_page',15)));
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'apoderado_id' => 'required|exists:apoderados,id',
            'fecha_hora_salida' => 'required|date',
            'motivo' => 'required|string',
        ]);

        $payload['autorizado_por_user_id'] = $request->user()->id;
        $r = RetiroDiario::create($payload);

        return response()->json($r, 201);
    }
}
