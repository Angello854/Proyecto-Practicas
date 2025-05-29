@extends('layouts.incidencias')

@section('content')
    <div class="max-w-4xl mx-auto p-6 space-y-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $incidencia->titulo }}</h1>

        <div class="prose dark:prose-invert max-w-none">
            {!! $incidencia->contenido !!}
        </div>
    </div>
@endsection
