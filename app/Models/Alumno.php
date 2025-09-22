<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alumno extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombres','apellidos','documento_identidad','fecha_nacimiento','genero',
        'direccion','telefono','email','curso_id','estado','fecha_ingreso','fecha_retiro_at','apoderado_principal_id','observaciones'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_ingreso' => 'date',
        'fecha_retiro_at' => 'datetime',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function apoderadoPrincipal()
    {
        return $this->belongsTo(Apoderado::class, 'apoderado_principal_id');
    }
}
