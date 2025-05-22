<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @filamentStyles
    @vite('resources/css/app.css')
    @cookieconsentscripts
</head>
<body>
{{ $slot }}

@filamentScripts
@vite('resources/js/app.js')

@cookieconsentview
</body>
</html>
