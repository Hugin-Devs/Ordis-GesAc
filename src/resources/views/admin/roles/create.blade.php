@extends('layouts.admin')

@section('title', 'Crear Nuevo Rol')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h1 class="h2 text-dark">Crear Nuevo Rol</h1>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Nombre del Rol <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Slug (Identificador) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug') }}" required>
                    <small class="text-muted">Ejemplo: 'coordinador', 'profesor' (usar minúsculas y guiones).</small>
                    @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-dark" style="background-color: #1A1A1A; border-color: #1A1A1A;">Guardar Rol</button>
            </form>
        </div>
    </div>
</div>
@endsection
