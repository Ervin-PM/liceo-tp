<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSuspensionRequest;
use App\Services\SuspensionService;

class SuspensionController extends Controller
{
    protected $service;

    public function __construct(SuspensionService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('suspensiones.index');
    }

    public function create()
    {
        return view('suspensiones.create');
    }

    public function store(StoreSuspensionRequest $request)
    {
        $data = $request->validated();

        $ok = $this->service->createIfNoOverlap($data['alumno_id'], $data['fecha_inicio'], $data['fecha_termino'], $data['motivo'], $request->user()->id, $data['resolucion_nro'] ?? null);

        if (! $ok['success']) {
            return redirect()->back()->withErrors(['error' => $ok['message']])->withInput();
        }

        return redirect()->route('suspensiones.index')->with('success', 'Suspensión creada correctamente.');
    }
}

