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
        Schema::create('tabla_estudiante', function (Blueprint $table) {
            $table->id('id_estudiante');
            $table->integer('cedula_persona_fk');
            $table->foreign('cedula_persona_fk')->references('cedula_identidad')->on('tabla_persona');
            $table->boolean('es_becado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabla_estudiante');
    }
};
