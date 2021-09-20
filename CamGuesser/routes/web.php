<?php

use App\Http\Controllers\EUGameController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaderboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/classic-mode', [GameController::class, 'index']);
Route::get('/europe-mode', [EUGameController::class, 'index']);
Route::post('/leaderboard', [LeaderboardController::class, 'update']);
Route::get('/leaderboard', [LeaderboardController::class, 'index']);
