<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MealLog;
use App\Models\Food;

class MealLogController extends Controller
{
    // This loads the page and passes the foods to the dropdown menu
    public function index(Request $request)
    {
        $foods = Food::orderBy('name')->get();
        // Get today's meals for the logged-in user
        $todaysMeals = $request->user()->mealLogs()->with('food')->where('date', date('Y-m-d'))->get();
        
        return view('meals', compact('foods', 'todaysMeals'));
    }

    // This saves the meal when the form is submitted
    public function store(Request $request)
    {
        $request->validate([
            'food_id' => 'required|exists:foods,id',
            'meal_type' => 'required|in:breakfast,lunch,dinner,snack',
            'quantity_g' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        $request->user()->mealLogs()->create([
            'food_id' => $request->food_id,
            'meal_type' => $request->meal_type,
            'quantity_g' => $request->quantity_g,
            'date' => $request->date,
        ]);

        return back()->with('success', 'Meal logged successfully!');
    }

    // Load the History page for a specific date
    public function history(Request $request)
    {
        // If they pick a date, use it. Otherwise, default to today.
        $selectedDate = $request->input('date', date('Y-m-d'));

        // Fetch meals for that specific date
        $meals = $request->user()->mealLogs()
            ->with('food')
            ->where('date', $selectedDate)
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate the daily totals for the selected day
        $totals = [
            'calories' => 0,
            'protein' => 0,
            'carbs' => 0,
            'fat' => 0,
        ];

        foreach ($meals as $log) {
            $multiplier = $log->quantity_g / 100;
            $totals['calories'] += ($log->food->calories_per_100g * $multiplier);
            $totals['protein'] += ($log->food->protein_g * $multiplier);
            $totals['carbs'] += ($log->food->carbs_g * $multiplier);
            $totals['fat'] += ($log->food->fat_g * $multiplier);
        }

        return view('history', [
            'meals' => $meals,
            'selectedDate' => $selectedDate,
            'totals' => $totals
        ]);
    }
}