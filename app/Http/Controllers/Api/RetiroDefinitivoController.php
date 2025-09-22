<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RetiroDefinitivo;

class RetiroDefinitivoController extends Controller
{
    public function index(Request $request)
    {
        $q = RetiroDefinitivo::with('alumno');
        return response()->json($q->paginate($request->get('per_page',15)));
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'fecha' => 'required|date',
            'motivo' => 'required|string',
        ]);
        $payload['registrado_por_user_id'] = $request->user()->id;
        $r = RetiroDefinitivo::create($payload);

        // actualizar estado del alumno
        $r->alumno()->update(['estado' => 'retirado_definitivo', 'fecha_retiro_at' => $payload['fecha']]);

        return response()->json($r, 201);
    }
}
