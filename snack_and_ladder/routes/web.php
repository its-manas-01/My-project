<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [GameController::class, 'index'])->name('game.index');

Route::post('/start', [GameController::class, 'startGame'])->name('game.start');
Route::post('/roll', [GameController::class, 'rollDice'])->name('game.roll');
Route::post('/reset', [GameController::class, 'resetGame'])->name('game.reset');