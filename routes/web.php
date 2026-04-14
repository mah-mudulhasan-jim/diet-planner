<?php

use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealLogController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    // Fetch the user's weight history, newest first
    $weightLogs = $user->weightLogs()->orderBy('date', 'desc')->get();
    
    return view('dashboard', compact('user', 'weightLogs'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/weight-logs', [WeightLogController::class, 'store'])->name('weight.store');
    Route::get('/meals', [MealLogController::class, 'index'])->name('meals.index');
    Route::post('/meals', [MealLogController::class, 'store'])->name('meals.store');
});

require __DIR__.'/auth.php';
