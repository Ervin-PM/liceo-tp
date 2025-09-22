<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasoConvivencia extends Model
{
    use HasFactory;

    protected $fillable = ['alumno_id','tipo','descripcion','estado','acciones','responsable_user_id','fecha'];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}
