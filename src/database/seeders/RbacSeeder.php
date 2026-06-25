<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;

class RbacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear Permisos
        $permisos = [
            ['name' => 'Editar Persona', 'slug' => 'edit-persona'],
            ['name' => 'Eliminar Persona', 'slug' => 'delete-persona'],
            ['name' => 'Crear Persona', 'slug' => 'create-persona'],
            ['name' => 'Ver Personas', 'slug' => 'view-personas'],
            ['name' => 'Ver Dashboard Admin', 'slug' => 'view-admin-dashboard'],
            ['name' => 'Gestionar Roles y Permisos', 'slug' => 'manage-roles'],
        ];

        foreach ($permisos as $p) {
            Permission::firstOrCreate(['slug' => $p['slug']], $p);
        }

        // Crear Roles
        $admin = Role::firstOrCreate(['slug' => 'admin'], ['name' => 'Administrador']);
        $coordinador = Role::firstOrCreate(['slug' => 'coordinador'], ['name' => 'Coordinador']);

        // Asignar permisos al Admin (todos)
        $admin->permissions()->sync(Permission::all());

        // Asignar permisos al Coordinador (algunos)
        $coordinador->permissions()->sync(Permission::whereIn('slug', ['edit-persona', 'create-persona', 'view-personas', 'view-admin-dashboard'])->get());

        // Asignar rol Admin al usuario admin@ordis.com si existe
        $user = User::where('email', 'admin@ordis.com')->first();
        if ($user) {
            $user->roles()->syncWithoutDetaching([$admin->id]);
        }
    }
}
