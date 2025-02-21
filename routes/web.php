<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\GameController;

Route::get('/', [PlayerController::class, 'index'])->name('home');

Route::resource('players', PlayerController::class);
Route::resource('matches', GameController::class);

Route::get('/matches', [GameController::class, 'index'])->name('matches.index');
Route::post('/matches/generate', [GameController::class, 'generateMatches'])->name('matches.generate');
Route::get('/matches/{match}/edit', [GameController::class, 'edit'])->name('matches.edit');
Route::post('/matches', [GameController::class, 'store'])->name('matches.store');
