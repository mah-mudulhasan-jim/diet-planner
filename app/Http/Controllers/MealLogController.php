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
}