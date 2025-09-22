<?php

namespace App\Services;

use App\Models\Asistencia;
use Illuminate\Support\Facades\Log;

class AsistenciaService
{
    /**
     * Crea una asistencia si no existe un registro para el mismo alumno y fecha.
     * Devuelve true si creó, false si ya existía.
     */
    public function createIfNotExists(int $alumnoId, string $fecha, string $estado, ?string $comentario, ?int $userId): bool
    {
        $exists = Asistencia::where('alumno_id', $alumnoId)->where('fecha', $fecha)->exists();
        if ($exists) {
            return false;
        }

        Asistencia::create([
            'alumno_id' => $alumnoId,
            'fecha' => $fecha,
            'estado' => $estado,
            'comentario' => $comentario,
            'registrada_por_user_id' => $userId,
        ]);

        // Opcional: registrar en activity log si está configurado
        try {
            activity()->causedBy($userId)->log("Registro asistencia: alumno {$alumnoId} fecha {$fecha}");
        } catch (\Throwable $e) {
            Log::debug('Activity log no disponible: ' . $e->getMessage());
        }

        return true;
    }
}
