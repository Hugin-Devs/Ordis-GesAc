<?php

namespace Database\Seeders;

use App\Models\Persona;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear la persona
        Persona::create([
            'cedula_identidad' => 12345678,
            'nombres' => 'Admin',
            'apellidos' => 'Sistema',
            'correo' => 'admin@ordis.com',
            'telefono' => '04120000000',
            'direccion_habitacion' => 'Dirección del Sistema',
        ]);

        // Crear el usuario usando el modelo User de Laravel
        User::create([
            'name' => 'admin',
            'email' => 'admin@ordis.com',
            'password' => Hash::make('password123'),
            'cedula_persona_fk' => 12345678,
            'estado_cuenta' => 'Activo',
        ]);
    }
}
