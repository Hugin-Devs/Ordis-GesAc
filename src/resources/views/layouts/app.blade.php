<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ordis-GesAc')</title>
    <link href="{{ asset('bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body { background-color: #f0f0f0; }
        .sidebar { height: 100vh; width: 250px; position: fixed; top: 0; left: 0; background-color: #003882; color: white; }
        .main-content { margin-left: 250px; padding: 20px; width: calc(100% - 250px); }
        .btn-custom { background-color: #1A1A1A; color: white; border: none; }
        .btn-custom:hover { background-color: #272727; color: white; }
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; width: 100%; }
        }
    </style>
</head>
<body>

    <!-- Sidebar Desktop -->
    <div class="sidebar d-none d-md-flex flex-column p-3">
        <h4 class="text-center">Ordis-GesAc</h4>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item"><a href="/dashboard" class="nav-link text-white">Dashboard</a></li>
            <li><a href="/registro" class="nav-link text-white">Registro</a></li>
            <li><a href="#" class="nav-link text-white">Estudiantes</a></li>
            <li><a href="#" class="nav-link text-white">Profesores</a></li>
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
                <span class="navbar-brand">Ordis-GesAc</span>
            </div>
        </nav>
        
        @yield('content')
    </div>

    <script src="{{ asset('bootstrap.bundle.min.js') }}"></script>
</body>
</html>
