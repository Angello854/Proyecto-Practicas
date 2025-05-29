@extends('layouts.app')

@section('title', 'Issue #' . $issue['number'])

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav class="mb-6">
            <a href="{{ route('issues.index') }}" class="text-blue-600 hover:text-blue-800">← Volver a Issues</a>
        </nav>

        <!-- Header de la Issue -->
        <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <h1 class="text-2xl font-bold text-gray-900">{{ $issue['title'] }}</h1>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        {{ $issue['state'] == 'open' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800' }}">
                        {{ ucfirst($issue['state']) }}
                    </span>
                    </div>

                    <div class="flex items-center gap-4 text-sm text-gray-500">
                        <span class="font-medium">#{{ $issue['number'] }}</span>
                        <span>Creada por <strong>{{ $issue['user']['login'] }}</strong></span>
                        <span>{{ \Carbon\Carbon::parse($issue['created_at'])->format('d M Y, H:i') }}</span>
                        @if($issue['updated_at'] != $issue['created_at'])
                            <span>Actualizada {{ \Carbon\Carbon::parse($issue['updated_at'])->diffForHumans() }}</span>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <img src="{{ $issue['user']['avatar_url'] }}"
                         alt="{{ $issue['user']['login'] }}"
                         class="w-12 h-12 rounded-full border-2 border-gray-200">

                    <a href="{{ $issue['html_url'] }}"
                       target="_blank"
                       class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm transition-colors">
                        Ver en GitHub ↗
                    </a>
                </div>
            </div>

            <!-- Labels -->
            @if(!empty($issue['labels']))
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach($issue['labels'] as $label)
                        <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium border"
                              style="background-color: #{{ $label['color'] }}20; border-color: #{{ $label['color'] }}40; color: #{{ $label['color'] }}">
                        {{ $label['name'] }}
                    </span>
                    @endforeach
                </div>
            @endif

            <!-- Asignados -->
            @if(!empty($issue['assignees']))
                <div class="mb-4">
                    <span class="text-sm font-medium text-gray-700 mr-2">Asignado a:</span>
                    <div class="inline-flex items-center gap-2">
                        @foreach($issue['assignees'] as $assignee)
                            <div class="flex items-center gap-1">
                                <img src="{{ $assignee['avatar_url'] }}"
                                     alt="{{ $assignee['login'] }}"
                                     class="w-6 h-6 rounded-full">
                                <span class="text-sm text-gray-600">{{ $assignee['login'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Contenido de la Issue -->
        @if($issue['body'])
            <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Descripción</h2>
                <div class="prose max-w-none text-gray-700">
                    {!! nl2br(e($issue['body'])) !!}
                </div>
            </div>
        @endif

        <!-- Comentarios -->
        @if(!empty($comments))
            <div class="bg-white rounded-lg shadow-sm border p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-6">
                    Comentarios ({{ count($comments) }})
                </h2>

                <div class="space-y-6">
                    @foreach($comments as $comment)
                        <div class="border-l-4 border-gray-200 pl-4">
                            <div class="flex items-center gap-3 mb-3">
                                <img src="{{ $comment['user']['avatar_url'] }}"
                                     alt="{{ $comment['user']['login'] }}"
                                     class="w-8 h-8 rounded-full">
                                <div>
                                    <span class="font-medium text-gray-900">{{ $comment['user']['login'] }}</span>
                                    <span class="text-sm text-gray-500 ml-2">
                                    {{ \Carbon\Carbon::parse($comment['created_at'])->diffForHumans() }}
                                </span>
                                </div>
                            </div>

                            <div class="prose max-w-none text-gray-700 ml-11">
                                {!! nl2br(e($comment['body'])) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm border p-6">
                <div class="text-center py-8">
                    <div class="text-gray-400 text-4xl mb-3">💬</div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Sin comentarios</h3>
                    <p class="text-gray-500">Esta issue no tiene comentarios aún.</p>
                </div>
            </div>
        @endif
    </div>

    @if(session('error'))
        <div class="fixed bottom-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded max-w-md">
            {{ session('error') }}
        </div>
    @endif
@endsection
