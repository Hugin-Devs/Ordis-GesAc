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
        Schema::create('tabla_ficha_medica_fisica', function (Blueprint $table) {
            $table->id('id_ficha');
            $table->integer('cedula_persona_fk');
            $table->foreign('cedula_persona_fk')->references('cedula_identidad')->on('tabla_persona');
            $table->string('tipo_sangre');
            $table->integer('peso');
            $table->string('talla_camisa');
            $table->string('talla_pantalon');
            $table->string('talla_zapato');
            $table->json('alergias');
            $table->json('discapacidades');
            $table->json('afecciones_cronicas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabla_ficha_medica_fisica');
    }
};
