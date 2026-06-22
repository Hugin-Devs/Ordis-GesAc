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
        Schema::create('tabla_estudiante_representante', function (Blueprint $table) {
            $table->unsignedBigInteger('id_estudiante_fk');
            $table->foreign('id_estudiante_fk')->references('id_estudiante')->on('tabla_estudiante');
            $table->unsignedBigInteger('id_representante_fk');
            $table->foreign('id_representante_fk')->references('id_representante')->on('tabla_representante');
            $table->string('parentesco');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabla_estudiante_representante');
    }
};
