<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('retiros_diarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumno_id')->constrained('alumnos')->cascadeOnDelete();
            $table->foreignId('apoderado_id')->constrained('apoderados')->cascadeOnDelete();
            $table->dateTime('fecha_hora_salida');
            $table->string('motivo');
            $table->foreignId('autorizado_por_user_id')->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['fecha_hora_salida']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('retiros_diarios');
    }
};
