@extends('layouts.admin')

@section('title', 'Dashboard - Admin')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Dashboard</h1>
    <p>Bienvenido al Panel de Administración de Ordis-GesAc.</p>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Usuarios Activos: 10</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Módulos Activos: 5</div>
            </div>
        </div>
    </div>
</div>
@endsection
