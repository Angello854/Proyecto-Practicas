@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="mb-4">
            <a href="{{ $indexUrl }}" class="text-blue-600 hover:underline">
                &larr; Volver al índice
            </a>
        </div>

        <h1 class="text-2xl font-bold mb-4">{{ $fileName }}</h1>

        <div class="prose max-w-none">
            @if($html)
                {!! $html !!}
            @else
                <div class="text-center text-gray-500">
                    No se ha encontrado contenido para esta sección.
                </div>
            @endif
        </div>
    </div>
@endsection
