<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ordis-GesAc</title>
    <!-- Local Bootstrap 5 CSS -->
    <link href="{{ asset('bootstrap.min.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="card shadow-sm" style="width: 100%; max-width: 400px;">
            <div class="card-body">
                <h1 class="h3 mb-4 text-center">Login Ordis-GesAc</h1>
                <form action="/login" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Usuario o Correo</label>
                        <input type="text" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Local Bootstrap 5 JS -->
    <script src="{{ asset('bootstrap.bundle.min.js') }}"></script>
</body>
</html>
