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
        Schema::create('tabla_profesor_asignatura', function (Blueprint $table) {
            $table->id('id_profesor_asignatura');
            $table->unsignedBigInteger('id_profesor_fk');
            $table->foreign('id_profesor_fk')->references('id_profesor')->on('tabla_profesor');
            $table->unsignedBigInteger('id_asignatura_fk');
            $table->foreign('id_asignatura_fk')->references('id_asignatura')->on('tabla_asignatura');
            $table->unsignedBigInteger('id_periodo_fk');
            $table->foreign('id_periodo_fk')->references('id_periodo')->on('tabla_periodo_academico');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabla_profesor_asignatura');
    }
};
