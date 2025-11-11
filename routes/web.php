<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TVController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\SearchController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/tv', [TVController::class, 'index'])->name('tv.index');
Route::get('/anime', [AnimeController::class, 'index'])->name('anime.index');

// Detail Pages
Route::get('/movie/{id}', [MovieController::class, 'show'])->name('movie.show');
Route::get('/tv/{id}', [TVController::class, 'show'])->name('tv.show');
Route::get('/anime/{id}', [AnimeController::class, 'show'])->name('anime.show');

// Player
Route::get('/watch/{type}/{tmdbId}', [PlayerController::class, 'watch'])->name('player.watch');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Auth Routes (Laravel Breeze)
require __DIR__.'/auth.php';