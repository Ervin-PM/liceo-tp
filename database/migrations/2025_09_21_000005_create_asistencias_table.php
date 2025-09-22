<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumno_id')->constrained('alumnos')->cascadeOnDelete();
            $table->date('fecha');
            $table->enum('estado', ['presente','ausente','atraso','justificado'])->default('presente');
            $table->text('comentario')->nullable();
            $table->foreignId('registrada_por_user_id')->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['alumno_id','fecha']);
            $table->index(['fecha']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('asistencias');
    }
};
