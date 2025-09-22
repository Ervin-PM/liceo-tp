<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('documento_identidad')->unique()->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('genero', ['M','F','X'])->default('X');
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('curso_id')->nullable()->constrained('cursos')->nullOnDelete();
            $table->enum('estado', ['activo','suspendido','retirado_definitivo'])->default('activo');
            $table->date('fecha_ingreso')->nullable();
            $table->timestamp('fecha_retiro_at')->nullable();
            $table->foreignId('apoderado_principal_id')->nullable()->constrained('apoderados')->nullOnDelete();
            $table->text('observaciones')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['nombres','apellidos']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
};
