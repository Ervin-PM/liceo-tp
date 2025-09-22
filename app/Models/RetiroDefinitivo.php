<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetiroDefinitivo extends Model
{
    use HasFactory;

    protected $fillable = ['alumno_id','fecha','motivo','registrado_por_user_id','resolucion_adjunta_path'];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}
