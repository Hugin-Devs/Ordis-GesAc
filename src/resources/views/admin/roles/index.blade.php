@extends('layouts.admin')

@section('title', 'Roles y Permisos')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h1 class="h2 text-dark">Roles y Permisos</h1>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-dark" style="background-color: #1A1A1A; border-color: #1A1A1A;">
            Crear Nuevo Rol
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark" style="background-color: #1A1A1A;">
                        <tr>
                            <th>Rol</th>
                            <th>Permisos</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td class="fw-bold">{{ $role->name }}</td>
                                <td>
                                    @foreach($role->permissions as $permission)
                                        <span class="badge bg-secondary">{{ $permission->name }}</span>
                                    @endforeach
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-outline-dark">
                                        Editar Permisos
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
