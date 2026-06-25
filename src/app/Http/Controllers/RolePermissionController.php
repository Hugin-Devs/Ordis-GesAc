<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RolePermissionController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('manage-roles');
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $this->authorize('manage-roles');
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $this->authorize('manage-roles');
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:roles,slug',
        ]);

        Role::create($request->all());
        return redirect()->route('admin.roles.index')->with('success', 'Rol creado correctamente.');
    }

    public function edit($id)
    {
        $this->authorize('manage-roles');
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('manage-roles');
        $role = Role::findOrFail($id);
        $role->permissions()->sync($request->permissions ?? []);
        return redirect()->route('admin.roles.index')->with('success', 'Permisos actualizados correctamente.');
    }
}
