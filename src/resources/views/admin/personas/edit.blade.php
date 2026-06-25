@extends('layouts.admin')

@section('title', 'Editar Persona')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h1 class="h2 text-dark">Editar Persona</h1>
        <a href="{{ route('admin.personas.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <p class="text-muted">Formulario para editar la información de la persona y actualizar el estado de su cuenta. Los campos marcados con <span class="text-danger">*</span> son obligatorios.</p>

            <form action="{{ route('admin.personas.update', $persona->cedula_identidad) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Cédula de Identidad</label>
                    <input type="number" class="form-control bg-light text-muted" name="cedula_identidad" value="{{ $persona->cedula_identidad }}" readonly>
                    <small class="form-text text-muted">La cédula de identidad es el identificador principal y no se puede modificar.</small>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Nombres <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nombres') is-invalid @enderror" name="nombres" value="{{ old('nombres', $persona->nombres) }}" required>
                    @error('nombres') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Apellidos <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('apellidos') is-invalid @enderror" name="apellidos" value="{{ old('apellidos', $persona->apellidos) }}" required>
                    @error('apellidos') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Correo Electrónico <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo', $persona->correo) }}" required>
                    @error('correo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Teléfono <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono', $persona->telefono) }}" required>
                    @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Dirección de Habitación <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('direccion_habitacion') is-invalid @enderror" name="direccion_habitacion" rows="3" required>{{ old('direccion_habitacion', $persona->direccion_habitacion) }}</textarea>
                    @error('direccion_habitacion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                @if($persona->user)
                    <div class="mb-3">
                        <label class="form-label fw-bold">Rol del Usuario <span class="text-danger">*</span></label>
                        <select class="form-select @error('rol') is-invalid @enderror" name="rol" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->slug }}" {{ old('rol', $persona->user->role) == $role->slug ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('rol') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Estado de la Cuenta <span class="text-danger">*</span></label>
                        <select class="form-select @error('estado_cuenta') is-invalid @enderror" name="estado_cuenta" required>
                            <option value="Activo" {{ old('estado_cuenta', $persona->user->estado_cuenta) == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ old('estado_cuenta', $persona->user->estado_cuenta) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado_cuenta') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                @endif

                <button type="submit" class="btn btn-dark mt-3" style="background-color: #1A1A1A; border-color: #1A1A1A;">Guardar Cambios</button>
            </form>
        </div>
    </div>
</div>
@endsection
