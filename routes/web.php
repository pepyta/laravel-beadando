<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource("games", GameController::class);
Route::resource("teams", TeamController::class);

Route::get('/leaderboard', [LeaderboardController::class, "index"]);

Route::middleware('auth')->group(function () {
    Route::resource("favorites", FavoriteController::class);
    Route::resource("/teams/{team}/players", PlayerController::class);
    Route::resource("/games/{game}/events", EventController::class);
    Route::patch("/games/{game}/finish", [GameController::class, 'finish'])->name('games.finish');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
