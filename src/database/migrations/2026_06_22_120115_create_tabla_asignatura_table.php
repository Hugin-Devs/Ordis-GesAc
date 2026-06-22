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
        Schema::create('tabla_asignatura', function (Blueprint $table) {
            $table->id('id_asignatura');
            $table->unsignedBigInteger('id_fase_fk');
            $table->foreign('id_fase_fk')->references('id_fase')->on('tabla_fase_academica');
            $table->string('nombre_asignatura');
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabla_asignatura');
    }
};
