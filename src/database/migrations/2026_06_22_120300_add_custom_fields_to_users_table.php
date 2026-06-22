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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('cedula_persona_fk')->nullable();
            $table->string('estado_cuenta')->default('Activo');
            $table->dateTime('ultimo_acceso')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['cedula_persona_fk', 'estado_cuenta', 'ultimo_acceso']);
        });
    }
};
