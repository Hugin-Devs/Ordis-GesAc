@extends('layouts.admin')

@section('title', 'Editar Permisos del Rol')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h1 class="h2 text-dark">Editar Permisos: {{ $role->name }}</h1>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    @foreach($permissions as $permission)
                        <div class="col-md-4 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="perm-{{ $permission->id }}"
                                    {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="perm-{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-dark mt-3" style="background-color: #1A1A1A; border-color: #1A1A1A;">Guardar Permisos</button>
            </form>
        </div>
    </div>
</div>
@endsection
