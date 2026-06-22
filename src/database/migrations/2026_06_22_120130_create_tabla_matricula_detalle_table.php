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
        Schema::create('tabla_matricula_detalle', function (Blueprint $table) {
            $table->id('id_detalle');
            $table->unsignedBigInteger('id_matricula_fk');
            $table->foreign('id_matricula_fk')->references('id_matricula')->on('tabla_matricula');
            $table->unsignedBigInteger('id_profesor_asignatura_fk');
            $table->foreign('id_profesor_asignatura_fk')->references('id_profesor_asignatura')->on('tabla_profesor_asignatura');
            $table->string('estado_asignatura');
            $table->decimal('nota_final_definitiva', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabla_matricula_detalle');
    }
};
