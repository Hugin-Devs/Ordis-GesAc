<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Ordis-GesAc')</title>
    <link href="{{ asset('bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body { background-color: #f0f0f0; }
        .sidebar { height: 100vh; width: 250px; position: fixed; top: 0; left: 0; background-color: #1A1A1A; color: white; }
        .main-content { margin-left: 250px; padding: 20px; width: calc(100% - 250px); }
        .btn-custom { background-color: #003882; color: white; border: none; }
        .btn-custom:hover { background-color: #00285e; color: white; }
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; width: 100%; }
        }
    </style>
</head>
<body>

    <!-- Sidebar Desktop -->
    <div class="sidebar d-none d-md-flex flex-column p-3">
        <h4 class="text-center">Panel Admin</h4>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link text-white">Dashboard</a></li>
            
            <li class="nav-header text-uppercase text-secondary mt-3 mb-1" style="font-size: 0.75rem; font-weight: bold;">Administración</li>
            <li><a href="{{ route('admin.personas.index') }}" class="nav-link text-white">Gestión de Personas</a></li>
            @can('manage-roles')
            <li><a href="{{ route('admin.roles.index') }}" class="nav-link text-white">Roles y Permisos</a></li>
            @endcan
            
            <li class="nav-header text-uppercase text-secondary mt-3 mb-1" style="font-size: 0.75rem; font-weight: bold;">Académico</li>
            <li><a href="#" class="nav-link text-white">Oferta Académica</a></li>
            <li><a href="#" class="nav-link text-white">Períodos Académicos</a></li>
            <li><a href="#" class="nav-link text-white">Carga Docente</a></li>
            <li><a href="#" class="nav-link text-white">Matrículas</a></li>
        </ul>
        <hr>
        <form action="/logout" method="POST">
            @csrf
            <button class="btn btn-custom w-100">Cerrar Sesión</button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Mobile Header (Visible only on mobile) -->
        <nav class="navbar navbar-light bg-light d-md-none mb-3">
            <div class="container-fluid">
                <span class="navbar-brand">Panel Admin</span>
            </div>
        </nav>
        
        @yield('content')
    </div>

    <script src="{{ asset('bootstrap.bundle.min.js') }}"></script>
</body>
</html>
