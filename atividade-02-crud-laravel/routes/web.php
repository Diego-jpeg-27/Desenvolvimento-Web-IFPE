<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/animes-lista', [AnimeController::class, 'lista'])->name('animes.lista');
Route::resource('animes', AnimeController::class);