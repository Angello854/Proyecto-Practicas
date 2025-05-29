<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-50">
<!-- Navigation -->
<nav class="bg-white shadow-sm border-b">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center gap-8">
                <a href="/" class="text-xl font-bold text-gray-900">Inicio</a>
                <div class="flex gap-6">
                    <a href="{{ route('issues.index') }}" class="text-gray-600 hover:text-gray-900">Issues</a>
                    <a href="{{ route('documentacion.index') }}" class="text-gray-600 hover:text-gray-900">Documentación</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="min-h-screen">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-white border-t mt-12">
    <div class="container mx-auto px-4 py-6 text-center text-gray-600">
        <p>© {{ date('Y') }} Mi Aplicación. Desarrollado con Laravel y GitHub API.</p>
    </div>
</footer>
</body>
</html>
