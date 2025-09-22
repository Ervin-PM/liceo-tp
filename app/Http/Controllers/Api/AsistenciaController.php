<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Services\AsistenciaService;

class AsistenciaController extends Controller
{
    protected $service;

    public function __construct(AsistenciaService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $q = Asistencia::with('alumno');
        if ($request->has('fecha')) $q->where('fecha', $request->fecha);
        if ($request->has('curso_id')) $q->whereHas('alumno', fn($q2)=> $q2->where('curso_id', $request->curso_id));
        return response()->json($q->paginate($request->get('per_page',15)));
    }

    public function store(Request $request)
    {
        // expects payload: fecha, asistencias: [{alumno_id, estado, comentario}]
        $payload = $request->validate([
            'fecha' => 'required|date',
            'asistencias' => 'required|array',
            'asistencias.*.alumno_id' => 'required|exists:alumnos,id',
            'asistencias.*.estado' => 'required|in:presente,ausente,atraso,justificado',
        ]);

        $created = 0; $skipped = 0;
        foreach ($payload['asistencias'] as $row) {
            $ok = $this->service->createIfNotExists($row['alumno_id'], $payload['fecha'], $row['estado'], $row['comentario'] ?? null, $request->user()->id);
            $ok ? $created++ : $skipped++;
        }

        return response()->json(['created' => $created, 'skipped' => $skipped]);
    }
}
