<?php

use App\Http\Controllers\Api\AsignaturaController;
use App\Http\Controllers\Api\CreadorController;
use App\Http\Controllers\Api\CursoController;
use App\Http\Controllers\Api\EmpresaController;
use App\Http\Controllers\Api\IncidenciaController;
use App\Http\Controllers\Api\PluginController;
use App\Http\Controllers\Api\TareaController;
use App\Http\Controllers\Api\TitulacionController;
use App\Http\Controllers\Api\UserController;
use App\Models\Asignatura;
use App\Models\Creador;
use App\Models\Curso;
use App\Models\Empresa;
use App\Models\Incidencia;
use App\Models\Plugin;
use App\Models\Tarea;
use App\Models\Titulacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['Credenciales incorrectas.'],
        ]);
    }

    return response()->json([
        'token' => $user->createToken('token-messi')->plainTextToken,
    ]);
});

Route::get('/usuarios', [UserController::class, 'index']);
Route::post('/usuarios', [UserController::class, 'store']);

Route::get('/tareas', [TareaController::class, 'index']);
Route::post('/tareas', [TareaController::class, 'store']);


Route::get('/empresas', [EmpresaController::class, 'index']);
Route::post('/empresas', [EmpresaController::class, 'store']);

Route::get('/cursos', [CursoController::class, 'index']);
Route::post('/cursos', [CursoController::class, 'store']);

Route::get('/titulaciones', [TitulacionController::class, 'index']);
Route::post('/titulaciones', [TitulacionController::class, 'store']);

Route::get('/asignaturas', [AsignaturaController::class, 'index']);
Route::post('/asignaturas', [AsignaturaController::class, 'store']);

Route::get('/incidencias', [IncidenciaController::class, 'index']);
Route::post('/incidencias', [IncidenciaController::class, 'store']);

Route::get('/plugins', [PluginController::class, 'index']);
Route::post('/plugins', [PluginController::class, 'store']);

Route::get('/creadores', [CreadorController::class, 'index']);
Route::post('/creadores', [CreadorController::class, 'store']);

