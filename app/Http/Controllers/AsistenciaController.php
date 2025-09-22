<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreAsistenciaRequest;
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
        return view('asistencia.index');
    }
    
    public function tomar()
    {
        return view('asistencias.tomar');
    }

    public function create()
    {
        return view('asistencia.create');
    }

    public function store(StoreAsistenciaRequest $request)
    {
        $data = $request->validated();
        $fecha = $data['fecha'];
        $entries = $data['asistencias'];

        $created = 0;
        $skipped = [];

        DB::beginTransaction();
        try {
            foreach ($entries as $row) {
                $alumnoId = $row['alumno_id'];
                $estado = $row['estado'];
                $comentario = $row['comentario'] ?? null;

                // Use service to create or skip if exists
                $result = $this->service->createIfNotExists($alumnoId, $fecha, $estado, $comentario, $request->user()->id);
                if ($result === true) {
                    $created++;
                } else {
                    $skipped[] = $alumnoId;
                }
            }

            DB::commit();

            $msg = "Asistencias procesadas: {$created}.";
            if (count($skipped) > 0) {
                $msg .= " Filtradas (ya existentes): " . implode(',', $skipped) . ".";
            }

            return redirect()->route('asistencia.index')->with('success', $msg);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('asistencia.index')->with('error', 'Error al guardar asistencias: ' . $e->getMessage());
        }
    }
}

