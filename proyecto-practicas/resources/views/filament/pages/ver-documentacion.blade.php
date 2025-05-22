<x-filament::page>
    <div class="mb-4">
        @if($indexUrl)
            <a href="{{ $indexUrl }}" class="text-blue-600 hover:underline">
                &larr; Volver al índice
            </a>
        @else
            <a href="javascript:history.back()" class="text-blue-600 hover:underline">
                &larr; Volver
            </a>
        @endif
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
</x-filament::page>
