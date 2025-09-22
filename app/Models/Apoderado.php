<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apoderado extends Model
{
    use HasFactory;

    protected $fillable = ['nombres','apellidos','documento_identidad','parentesco','telefono','email','direccion','autorizado'];

    protected $casts = [
        'autorizado' => 'boolean'
    ];
}
