@extends('layouts.admin')

@section('title', 'Gestión de Personas')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h1 class="h2 text-dark">Gestión de Personas</h1>
        @can('create-persona')
        <a href="{{ route('admin.personas.create') }}" class="btn btn-dark" style="background-color: #1A1A1A; border-color: #1A1A1A;">
            Registrar Persona
        </a>
        @endcan
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <p class="text-muted">Listado general de usuarios, estudiantes, profesores y representantes registrados en el sistema.</p>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark" style="background-color: #1A1A1A;">
                        <tr>
                            <th>Cédula</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($personas as $persona)
                            <tr>
                                <td class="fw-bold">{{ $persona->cedula_identidad }}</td>
                                <td>{{ $persona->nombres }}</td>
                                <td>{{ $persona->apellidos }}</td>
                                <td>{{ $persona->correo }}</td>
                                <td>{{ $persona->telefono }}</td>
                                <td>
                                    @if($persona->user)
                                        @php
                                            $roleBadgeColor = match($persona->user->role) {
                                                'admin' => 'bg-danger',
                                                'profesor' => 'bg-info text-dark',
                                                'estudiante' => 'bg-primary',
                                                'representante' => 'bg-success',
                                                default => 'bg-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $roleBadgeColor }}">{{ ucfirst($persona->user->role) }}</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Sin usuario</span>
                                    @endif
                                </td>
                                <td>
                                    @if($persona->user)
                                        @if($persona->user->estado_cuenta === 'Activo')
                                            <span class="badge bg-success-subtle text-success border border-success-subtle">Activo</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Inactivo</span>
                                        @endif
                                    @else
                                        <span class="badge bg-light text-dark border">-</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        @can('edit-persona')
                                        <a href="{{ route('admin.personas.edit', $persona->cedula_identidad) }}" class="btn btn-sm btn-outline-dark">
                                            Editar
                                        </a>
                                        @endcan
                                        @can('delete-persona')
                                        <form action="{{ route('admin.personas.destroy', $persona->cedula_identidad) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de que desea dar de baja a esta persona? Esto también desactivará su cuenta.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                Dar de baja
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">No hay personas registradas para mostrar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $personas->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
