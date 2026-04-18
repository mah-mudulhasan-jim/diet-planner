<?php

use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealLogController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\MetricsController;
use App\Http\Controllers\AiAssistantController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    
    // Fetch the user's weight history for the list
    $weightLogs = $user->weightLogs()->orderBy('date', 'desc')->get();

    // Format data specifically for the Line Chart
    $chartData = $user->weightLogs()->orderBy('date', 'asc')->get();
    $chartDates = $chartData->pluck('date')->toJson();
    $chartWeights = $chartData->pluck('weight_kg')->toJson();

    // Fetch today's meals
    $todaysMeals = $user->mealLogs()->with('food')->where('date', date('Y-m-d'))->get();

    // Initialize all our tracking variables
    $caloriesEaten = 0;
    $proteinEaten = 0;
    $carbsEaten = 0;
    $fatEaten = 0;

    // Math: Sum up everything for today
    foreach ($todaysMeals as $log) {
        $multiplier = $log->quantity_g / 100;
        $caloriesEaten += ($log->food->calories_per_100g * $multiplier);
        $proteinEaten += ($log->food->protein_g * $multiplier);
        $carbsEaten += ($log->food->carbs_g * $multiplier);
        $fatEaten += ($log->food->fat_g * $multiplier);
    }

    // Round the values so we don't have crazy decimals
    $caloriesEaten = round($caloriesEaten);
    $proteinEaten = round($proteinEaten, 1);
    $carbsEaten = round($carbsEaten, 1);
    $fatEaten = round($fatEaten, 1);

    return view('dashboard', compact(
        'user', 'weightLogs', 'caloriesEaten', 
        'chartDates', 'chartWeights',
        'proteinEaten', 'carbsEaten', 'fatEaten'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/weight-logs', [WeightLogController::class, 'store'])->name('weight.store');
    Route::get('/meals', [MealLogController::class, 'index'])->name('meals.index');
    Route::post('/meals', [MealLogController::class, 'store'])->name('meals.store');
    Route::get('/history', [MealLogController::class, 'history'])->name('history.index');
    Route::get('/metrics', [MetricsController::class, 'index'])->name('metrics.index');
    Route::post('/ask-ai', [AiAssistantController::class, 'ask'])->name('ai.ask');
});

// ADMIN ONLY ROUTES
Route::middleware(['auth', IsAdmin::class])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/food', [AdminController::class, 'storeFood'])->name('admin.food.store');
});

require __DIR__.'/auth.php';
