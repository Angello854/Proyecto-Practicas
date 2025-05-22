<?php

use App\Http\Controllers\DocumentacionController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\File;
use League\CommonMark\CommonMarkConverter;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/documentacion', [DocumentacionController::class, 'index'])->name('documentacion.index');
Route::get('/documentacion/{file}', [DocumentacionController::class, 'show'])->where('file', '.*')->name('documentacion.ver');
