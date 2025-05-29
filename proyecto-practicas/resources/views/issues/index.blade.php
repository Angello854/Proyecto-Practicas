@extends('layouts.issues')

@section('title', 'Issues del Repositorio')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                Issues de {{ $owner }}/{{ $repo }}
            </h1>
            <p class="text-gray-600">
                Gestión y seguimiento de issues del repositorio
            </p>
        </div>

        <!-- Filtros -->
        <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
            <form method="GET" class="flex flex-wrap gap-4 items-end">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                    <select name="state" class="border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="open" {{ request('state', 'open') == 'open' ? 'selected' : '' }}>Abiertas</option>
                        <option value="closed" {{ request('state') == 'closed' ? 'selected' : '' }}>Cerradas</option>
                        <option value="all" {{ request('state') == 'all' ? 'selected' : '' }}>Todas</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ordenar por</label>
                    <select name="sort" class="border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="created" {{ request('sort', 'created') == 'created' ? 'selected' : '' }}>Fecha de creación</option>
                        <option value="updated" {{ request('sort') == 'updated' ? 'selected' : '' }}>Última actualización</option>
                        <option value="comments" {{ request('sort') == 'comments' ? 'selected' : '' }}>Comentarios</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Dirección</label>
                    <select name="direction" class="border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="desc" {{ request('direction', 'desc') == 'desc' ? 'selected' : '' }}>Descendente</option>
                        <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascendente</option>
                    </select>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                    Filtrar
                </button>
            </form>
        </div>

        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="text-green-800 text-2xl font-bold">{{ count(array_filter($issues, fn($issue) => $issue['state'] == 'open')) }}</div>
                <div class="text-green-600 text-sm">Issues Abiertas</div>
            </div>
            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                <div class="text-purple-800 text-2xl font-bold">{{ count($issues) }}</div>
                <div class="text-purple-600 text-sm">Total Mostradas</div>
            </div>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="text-blue-800 text-2xl font-bold">{{ $state }}</div>
                <div class="text-blue-600 text-sm">Estado Actual</div>
            </div>
        </div>

        <!-- Lista de Issues -->
        <div class="space-y-4">
            @forelse($issues as $issue)
                <div class="bg-white rounded-lg shadow-sm border hover:shadow-md transition-shadow">
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <!-- Título -->
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-lg font-semibold text-gray-900 hover:text-blue-600">
                                        <a href="{{ route('issues.show', $issue['number']) }}">
                                            {{ $issue['title'] }}
                                        </a>
                                    </h3>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $issue['state'] == 'open' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800' }}">
                                    {{ ucfirst($issue['state']) }}
                                </span>
                                </div>

                                <!-- Metadatos -->
                                <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
                                    <span>#{{ $issue['number'] }}</span>
                                    <span>por {{ $issue['user']['login'] }}</span>
                                    <span>{{ \Carbon\Carbon::parse($issue['created_at'])->diffForHumans() }}</span>
                                    @if($issue['comments'] > 0)
                                        <span>{{ $issue['comments'] }} comentario{{ $issue['comments'] != 1 ? 's' : '' }}</span>
                                    @endif
                                </div>

                                <!-- Labels -->
                                @if(!empty($issue['labels']))
                                    <div class="flex flex-wrap gap-2 mb-3">
                                        @foreach($issue['labels'] as $label)
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium border"
                                                  style="background-color: #{{ $label['color'] }}20; border-color: #{{ $label['color'] }}40; color: #{{ $label['color'] }}">
                                            {{ $label['name'] }}
                                        </span>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Descripción -->
                                @if($issue['body'])
                                    <div class="text-gray-600 text-sm line-clamp-2">
                                        {{ Str::limit(strip_tags($issue['body']), 150) }}
                                    </div>
                                @endif
                            </div>

                            <!-- Avatar -->
                            <div class="ml-4">
                                <img src="{{ $issue['user']['avatar_url'] }}"
                                     alt="{{ $issue['user']['login'] }}"
                                     class="w-10 h-10 rounded-full">
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="text-gray-400 text-6xl mb-4">📝</div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No se encontraron issues</h3>
                    <p class="text-gray-500">No hay issues que coincidan con los filtros seleccionados.</p>
                </div>
            @endforelse
        </div>
    </div>

    @if(session('error'))
        <div class="fixed bottom-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded max-w-md">
            {{ session('error') }}
        </div>
    @endif
@endsection
