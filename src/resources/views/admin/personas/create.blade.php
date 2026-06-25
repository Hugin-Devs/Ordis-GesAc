@extends('layouts.admin')

@section('title', 'Registrar Persona')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h1>Registrar Nueva Persona</h1>
        <a href="{{ route('admin.personas.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    <div class="card">
        <div class="card-body">
            <p>Formulario para registrar estudiantes, profesores o representantes, y crearles una cuenta de usuario. Los campos marcados con <span class="text-danger">*</span> son obligatorios.</p>
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.personas.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Cédula de Identidad <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('cedula_identidad') is-invalid @enderror" name="cedula_identidad" value="{{ old('cedula_identidad') }}" required>
                    @error('cedula_identidad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Nombres <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nombres') is-invalid @enderror" name="nombres" value="{{ old('nombres') }}" required>
                    @error('nombres') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Apellidos <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('apellidos') is-invalid @enderror" name="apellidos" value="{{ old('apellidos') }}" required>
                    @error('apellidos') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo') }}" required>
                    @error('correo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Teléfono <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required>
                    @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Dirección de Habitación <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('direccion_habitacion') is-invalid @enderror" name="direccion_habitacion" rows="3" required>{{ old('direccion_habitacion') }}</textarea>
                    @error('direccion_habitacion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Rol Principal <span class="text-danger">*</span></label>
                    <select class="form-select @error('rol') is-invalid @enderror" name="rol" required>
                        <option value="">Seleccione un rol...</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->slug }}" {{ old('rol') == $role->slug ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('rol') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Registrar y Crear Cuenta</button>
            </form>
        </div>
    </div>
</div>
@endsection
