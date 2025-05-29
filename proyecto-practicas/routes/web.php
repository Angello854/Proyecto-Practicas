<?php

use App\Http\Controllers\DocumentacionAlumnoController;
use App\Http\Controllers\DocumentacionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\IssuesController;
use App\Models\Asignatura;
use App\Models\Curso;
use App\Models\Empresa;
use App\Models\Tarea;
use App\Models\Titulacion;
use App\Models\User;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use League\CommonMark\CommonMarkConverter;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::prefix('documentacion')->name('documentacion.')->group(function () {
    Route::get('/', [DocumentacionController::class, 'index'])->name('index');
    Route::get('/{file}', [DocumentacionController::class, 'show'])->where('file', '.*')->name('ver');
    Route::get('/alumno', fn () => view('filament.pages.documentacion-alumno'))->name('alumno');
    Route::get('/tutor-laboral', fn () => view('filament.pages.documentacion-tutor-laboral'))->name('tutor-laboral');
    Route::get('/tutor-docente', fn () => view('filament.pages.documentacion-tutor-docente'))->name('tutor-docente');
});

Route::get('/incidencias/{incidencia}', [IncidenciaController::class, 'show'])
    ->name('incidencias.show');


Route::get('/test-github', function () {
    try {
        $owner = config('github.repository.owner');
        $repo = config('github.repository.name');

        // Obtener info del repositorio
        $repository = GitHub::repository()->show($owner, $repo);

        // Obtener issues
        $issues = GitHub::issues()->all($owner, $repo, ['state' => 'open']);

        return response()->json([
            'repo' => $repository['name'],
            'issues_count' => count($issues),
            'first_issue' => $issues[0] ?? null
        ]);

    } catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

Route::get('/debug-github', function () {
    return response()->json([
        'env_token_exists' => !empty(env('GITHUB_TOKEN')),
        'env_token_preview' => substr(env('GITHUB_TOKEN') ?: '', 0, 10) . '...',
        'config_token_exists' => !empty(config('github.connections.main.token')),
        'config_token_preview' => substr(config('github.connections.main.token') ?: '', 0, 10) . '...',
        'config_owner' => config('github.repository.owner'),
        'config_repo' => config('github.repository.name'),
        'default_connection' => config('github.default'),
    ]);
});

// Rutas para Issues
Route::prefix('issues')->name('issues.')->group(function () {
    Route::get('/', [IssuesController::class, 'index'])->name('index');
    Route::get('/{number}', [IssuesController::class, 'show'])->name('show')->where('number', '[0-9]+');
    Route::get('/api', [IssuesController::class, 'api'])->name('api');
});




