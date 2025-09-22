<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('nivel');
            $table->string('letra');
            $table->string('especialidad')->nullable();
            $table->foreignId('profesor_jefe_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->integer('anio_lectivo');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('cursos');
    }
};
