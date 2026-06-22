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
        Schema::create('tabla_calificacion', function (Blueprint $table) {
            $table->id('id_calificacion');
            $table->unsignedBigInteger('id_detalle_matricula_fk');
            $table->foreign('id_detalle_matricula_fk')->references('id_detalle')->on('tabla_matricula_detalle');
            $table->unsignedBigInteger('id_evaluacion_fk');
            $table->foreign('id_evaluacion_fk')->references('id_evaluacion')->on('tabla_plan_evaluacion');
            $table->decimal('nota_obtenida', 5, 2);
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabla_calificacion');
    }
};
