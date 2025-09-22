<?php

namespace App\Services;

use App\Models\Suspension;
use Illuminate\Support\Facades\Log;

class SuspensionService
{
    /**
     * Crea una suspensión si no existe solapamiento con otras suspensiones activas del alumno.
     * Retorna ['success' => bool, 'message' => string]
     */
    public function createIfNoOverlap(int $alumnoId, string $fechaInicio, string $fechaTermino, string $motivo, int $userId, ?string $resolucionNro = null): array
    {
        // Buscar suspensiones existentes que solapen
        $overlap = Suspension::where('alumno_id', $alumnoId)
            ->where(function($q) use ($fechaInicio, $fechaTermino){
                $q->whereBetween('fecha_inicio', [$fechaInicio, $fechaTermino])
                  ->orWhereBetween('fecha_termino', [$fechaInicio, $fechaTermino])
                  ->orWhere(function($q2) use ($fechaInicio, $fechaTermino){
                      $q2->where('fecha_inicio', '<=', $fechaInicio)->where('fecha_termino', '>=', $fechaTermino);
                  });
            })->exists();

        if ($overlap) {
            return ['success' => false, 'message' => 'La suspensión se solapa con una existente para este alumno.'];
        }

        $s = Suspension::create([
            'alumno_id' => $alumnoId,
            'fecha_inicio' => $fechaInicio,
            'fecha_termino' => $fechaTermino,
            'motivo' => $motivo,
            'emitida_por_user_id' => $userId,
            'resolucion_nro' => $resolucionNro,
        ]);

        try {
            activity()->causedBy($userId)->log("Suspensión creada: alumno {$alumnoId} {$fechaInicio} - {$fechaTermino}");
        } catch (\Throwable $e) {
            Log::debug('Activity log no disponible: ' . $e->getMessage());
        }

        return ['success' => true, 'message' => 'OK', 'suspension_id' => $s->id];
    }
}
