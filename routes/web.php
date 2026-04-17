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
    
    // Fetch the user's weight history
    $weightLogs = $user->weightLogs()->orderBy('date', 'desc')->get();

    // Fetch ONLY today's meals to calculate the progress bar
    $todaysMeals = $user->mealLogs()->with('food')->where('date', date('Y-m-d'))->get();

    // Math: Sum up the calories for today
    $caloriesEaten = 0;
    foreach ($todaysMeals as $log) {
        $multiplier = $log->quantity_g / 100;
        $caloriesEaten += ($log->food->calories_per_100g * $multiplier);
    }
    $caloriesEaten = round($caloriesEaten);

    return view('dashboard', compact('user', 'weightLogs', 'caloriesEaten'));
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
