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
        Schema::create('tabla_usuario', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->integer('cedula_persona_fk');
            $table->foreign('cedula_persona_fk')->references('cedula_identidad')->on('tabla_persona');
            $table->string('nombre_usuario');
            $table->string('contrasena_hash');
            $table->string('estado_cuenta');
            $table->dateTime('ultimo_acceso')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabla_usuario');
    }
};
