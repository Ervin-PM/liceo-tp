<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetiroDiario extends Model
{
    use HasFactory;

    protected $fillable = ['alumno_id','apoderado_id','fecha_hora_salida','motivo','autorizado_por_user_id'];

    protected $casts = [
        'fecha_hora_salida' => 'datetime',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}
