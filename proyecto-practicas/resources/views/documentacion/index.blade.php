@extends('layouts.issues')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Documentación del proyecto</h1>

        <ul class="list-disc pl-5">
            @foreach ($files as $file)
                <li class="mb-2">
                    <a href="{{ $file['url'] }}" class="text-blue-600 hover:underline">
                        {{ $file['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
