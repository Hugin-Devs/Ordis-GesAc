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
        Schema::create('tabla_fase_academica', function (Blueprint $table) {
            $table->id('id_fase');
            $table->unsignedBigInteger('id_programa_fk');
            $table->foreign('id_programa_fk')->references('id_programa')->on('tabla_programa_educativo');
            $table->string('nombre_fase');
            $table->string('tipo_fase');
            $table->integer('orden_secuencia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabla_fase_academica');
    }
};
