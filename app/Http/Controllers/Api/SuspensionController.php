<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SuspensionService;

class SuspensionController extends Controller
{
    protected $service;

    public function __construct(SuspensionService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $q = \App\Models\Suspension::with('alumno');
        return response()->json($q->paginate($request->get('per_page',15)));
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'fecha_inicio' => 'required|date',
            'fecha_termino' => 'required|date|after_or_equal:fecha_inicio',
            'motivo' => 'required|string',
        ]);

        $res = $this->service->createIfNoOverlap($payload['alumno_id'], $payload['fecha_inicio'], $payload['fecha_termino'], $payload['motivo'], $request->user()->id, $payload['resolucion_nro'] ?? null);
        if (! $res['success']) return response()->json(['message' => $res['message']], 422);
        return response()->json(['suspension_id' => $res['suspension_id']], 201);
    }
}
