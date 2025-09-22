<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('casos_convivencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumno_id')->constrained('alumnos')->cascadeOnDelete();
            $table->enum('tipo', ['conducta','convivencia','otro'])->default('otro');
            $table->text('descripcion');
            $table->enum('estado', ['abierto','en_proceso','cerrado'])->default('abierto');
            $table->text('acciones')->nullable();
            $table->foreignId('responsable_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->date('fecha')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('casos_convivencia');
    }
};
