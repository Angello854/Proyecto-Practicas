<x-filament-panels::page>
    @if($isLoading)
        <div class="flex items-center justify-center p-12">
            <div class="flex items-center gap-3">
                <svg class="animate-spin h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-gray-600">Cargando issues...</span>
            </div>
        </div>
    @elseif($error)
        <x-filament::card class="p-6">
            <div class="text-center">
                <div class="text-red-500 text-4xl mb-4">⚠️</div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Error</h3>
                <p class="text-red-600">{{ $error }}</p>
                <button wire:click="loadIssues" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Reintentar
                </button>
            </div>
        </x-filament::card>
    @else
        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <x-filament::card class="p-4">
                <div class="text-green-600 text-2xl font-bold">{{ $stats['open_issues'] ?? 0 }}</div>
                <div class="text-gray-600 text-sm">Issues Abiertas</div>
            </x-filament::card>

            <x-filament::card class="p-4">
                <div class="text-purple-600 text-2xl font-bold">{{ $stats['closed_issues'] ?? 0 }}</div>
                <div class="text-gray-600 text-sm">Issues Cerradas</div>
            </x-filament::card>

            <x-filament::card class="p-4">
                <div class="text-blue-600 text-2xl font-bold">{{ $stats['total_issues'] ?? 0 }}</div>
                <div class="text-gray-600 text-sm">Total Issues</div>
            </x-filament::card>
        </div>

        <!-- Lista de Issues Recientes -->
        <x-filament::card>
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-semibold text-gray-900">Issues Recientes</h2>
                    <a href="{{ route('issues.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        Ver todas las issues →
                    </a>
                </div>

                @if(empty($issues))
                    <div class="text-center py-8">
                        <div class="text-gray-400 text-4xl mb-3">📝</div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No hay issues</h3>
                        <p class="text-gray-500">No se encontraron issues en el repositorio.</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach(array_slice($issues, 0, 5) as $issue)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-2">
                                            <h3 class="font-medium text-gray-900 hover:text-blue-600">
                                                <a href="{{ route('issues.show', $issue['number']) }}" class="hover:underline">
                                                    {{ $issue['title'] }}
                                                </a>
                                            </h3>
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                {{ $issue['state'] == 'open' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800' }}">
                                                {{ ucfirst($issue['state']) }}
                                            </span>
                                        </div>

                                        <div class="flex items-center gap-4 text-sm text-gray-500 mb-2">
                                            <span>#{{ $issue['number'] }}</span>
                                            <span>por {{ $issue['user']['login'] }}</span>
                                            <span>{{ \Carbon\Carbon::parse($issue['created_at'])->diffForHumans() }}</span>
                                            @if($issue['comments'] > 0)
                                                <span>{{ $issue['comments'] }} comentario{{ $issue['comments'] != 1 ? 's' : '' }}</span>
                                            @endif
                                        </div>

                                        @if(!empty($issue['labels']))
                                            <div class="flex flex-wrap gap-1">
                                                @foreach(array_slice($issue['labels'], 0, 3) as $label)
                                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium border"
                                                          style="background-color: #{{ $label['color'] }}20; border-color: #{{ $label['color'] }}40; color: #{{ $label['color'] }}">
                                                        {{ $label['name'] }}
                                                    </span>
                                                @endforeach
                                                @if(count($issue['labels']) > 3)
                                                    <span class="text-xs text-gray-500">+{{ count($issue['labels']) - 3 }} más</span>
                                                @endif
                                            </div>
                                        @endif

                                        @if(!empty($issue['body']))
                                            <div class="mt-2 text-sm text-gray-600 line-clamp-2">
                                                {{ Str::limit(strip_tags($issue['body']), 100) }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="ml-4">
                                        <img src="{{ $issue['user']['avatar_url'] }}"
                                             alt="{{ $issue['user']['login'] }}"
                                             class="w-8 h-8 rounded-full">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if(count($issues) > 5)
                        <div class="mt-4 text-center">
                            <a href="{{ route('issues.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Ver {{ count($issues) - 5 }} issues más →
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </x-filament::card>
    @endif
</x-filament-panels::page>
