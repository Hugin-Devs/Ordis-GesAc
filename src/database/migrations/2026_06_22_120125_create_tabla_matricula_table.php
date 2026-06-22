<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tabla_matricula', function (Blueprint $table) {
            $table->id('id_matricula');
            $table->unsignedBigInteger('id_estudiante_fk');
            $table->foreign('id_estudiante_fk')->references('id_estudiante')->on('tabla_estudiante');
            $table->unsignedBigInteger('id_periodo_fk');
            $table->foreign('id_periodo_fk')->references('id_periodo')->on('tabla_periodo_academico');
            $table->unsignedBigInteger('id_fase_fk');
            $table->foreign('id_fase_fk')->references('id_fase')->on('tabla_fase_academica');
            $table->dateTime('fecha_inscripcion');
            $table->string('estado_matricula');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabla_matricula');
    }
};
