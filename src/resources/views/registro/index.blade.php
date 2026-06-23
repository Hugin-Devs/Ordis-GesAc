@extends('layouts.app')

@section('title', 'Registro')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Módulo de Registro</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Registrar Persona</h5>
                        <p class="card-text">Gestionar el registro de nuevos usuarios en el sistema.</p>
                        <a href="#" class="btn btn-custom">Acceder</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Registrar Estudiante</h5>
                        <p class="card-text">Inscripción de nuevos estudiantes.</p>
                        <a href="#" class="btn btn-custom">Acceder</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
