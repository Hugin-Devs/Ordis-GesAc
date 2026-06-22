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
        Schema::create('tabla_plan_evaluacion', function (Blueprint $table) {
            $table->id('id_evaluacion');
            $table->unsignedBigInteger('id_profesor_asignatura_fk');
            $table->foreign('id_profesor_asignatura_fk')->references('id_profesor_asignatura')->on('tabla_profesor_asignatura');
            $table->string('nombre_evaluacion');
            $table->string('descripcion_evaluacion')->nullable();
            $table->decimal('porcentaje_peso', 5, 2);
            $table->date('fecha_estimada');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabla_plan_evaluacion');
    }
};
