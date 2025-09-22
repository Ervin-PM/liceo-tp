<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('suspensions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumno_id')->constrained('alumnos')->cascadeOnDelete();
            $table->date('fecha_inicio');
            $table->date('fecha_termino');
            $table->text('motivo');
            $table->foreignId('emitida_por_user_id')->constrained('users')->nullOnDelete();
            $table->string('resolucion_nro')->nullable();
            $table->string('adjunto_path')->nullable();
            $table->timestamps();

            $table->index(['alumno_id','fecha_inicio','fecha_termino']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('suspensions');
    }
};
