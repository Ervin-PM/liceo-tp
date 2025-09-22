<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','nivel','letra','especialidad','profesor_jefe_user_id','anio_lectivo'];

    public function alumnos()
    {
        return $this->hasMany(Alumno::class);
    }
}
