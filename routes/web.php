<?php

use App\Http\Controllers\MatchesController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\TeamController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'auth' => auth()->user(),
        'appVersion' => Config::get('app.version'),
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
  Route::resource('teams', TeamController::class)
    ->names('teams');
});

Route::middleware(['auth'])->group(function () {
  Route::resource('players', PlayerController::class)
    ->names('players');
});

Route::middleware(['auth'])->group(function () {
  Route::resource('matches', MatchesController::class)
    ->names('matches');
});

Route::middleware(['auth'])->group(function () {
  Route::resource('results', ResultController::class)
    ->names('results');
});


require __DIR__.'/auth.php';
