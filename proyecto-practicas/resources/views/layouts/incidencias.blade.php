<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Documentación')</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tema claro/oscuro y fuente -->
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>

    <!-- Estilos personalizados para texto y markdown -->
    <style>
        .prose h1, .prose h2, .prose h3, .prose p, .prose ul, .prose ol, .prose blockquote, .prose table {
            color: inherit;
        }

        .prose a {
            color: #2563eb;
            text-decoration: underline;
        }

        .prose code {
            background-color: #f3f4f6;
            padding: 0.2em 0.4em;
            border-radius: 0.25rem;
        }

        .dark .prose code {
            background-color: #1f2937;
        }

        .prose pre {
            background-color: #f3f4f6;
            padding: 1em;
            border-radius: 0.5rem;
            overflow-x: auto;
        }

        .dark .prose pre {
            background-color: #1f2937;
        }

        .prose blockquote {
            border-left: 4px solid #d1d5db;
            padding-left: 1em;
            color: #4b5563;
        }

        .dark .prose blockquote {
            border-left-color: #374151;
            color: #d1d5db;
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 font-sans antialiased">

<!-- Navigation -->
<nav class="bg-white dark:bg-gray-800 border-b shadow-sm">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <a href="/" class="text-xl font-bold text-gray-900 dark:text-white">Inicio</a>
            <div class="flex gap-6">
                <a href="{{ route('issues.index') }}" class="text-gray-600 dark:text-gray-300 hover:text-blue-600">Issues</a>
                <a href="{{ route('documentacion.index') }}" class="text-gray-600 dark:text-gray-300 hover:text-blue-600">Documentación</a>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="max-w-4xl mx-auto px-4 py-8">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-white dark:bg-gray-800 border-t mt-12 py-6 text-center text-sm text-gray-500 dark:text-gray-400">
    © {{ date('Y') }} Proyecto Prácticas. Desarrollado con Laravel y Filament.
</footer>

</body>
</html>
