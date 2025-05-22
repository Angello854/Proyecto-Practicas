<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentación del Proyecto</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Estilo adicional para Markdown -->
    <style>
        .prose h1 { font-size: 2em; font-weight: bold; margin-top: 1em; margin-bottom: 0.5em; }
        .prose h2 { font-size: 1.5em; font-weight: bold; margin-top: 1em; margin-bottom: 0.5em; }
        .prose h3 { font-size: 1.25em; font-weight: bold; margin-top: 1em; margin-bottom: 0.5em; }
        .prose p { margin-bottom: 1em; }
        .prose ul { list-style-type: disc; margin-left: 2em; margin-bottom: 1em; }
        .prose ol { list-style-type: decimal; margin-left: 2em; margin-bottom: 1em; }
        .prose li { margin-bottom: 0.5em; }
        .prose code { background-color: #f0f0f0; padding: 0.2em 0.4em; border-radius: 3px; font-family: monospace; }
        .prose pre { background-color: #f0f0f0; padding: 1em; border-radius: 5px; margin-bottom: 1em; overflow-x: auto; }
        .prose pre code { background-color: transparent; padding: 0; }
        .prose a { color: #3182ce; text-decoration: underline; }
        .prose blockquote { border-left: 4px solid #e2e8f0; padding-left: 1em; margin-left: 0; margin-right: 0; color: #4a5568; }
        .prose table { border-collapse: collapse; width: 100%; margin-bottom: 1em; }
        .prose th, .prose td { border: 1px solid #e2e8f0; padding: 0.5em; text-align: left; }
        .prose th { background-color: #f7fafc; }
    </style>
</head>
<body class="bg-gray-50">
<div class="min-h-screen">
    @yield('content')
</div>
</body>
</html>
