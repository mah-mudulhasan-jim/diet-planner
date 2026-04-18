<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class AdminController extends Controller
{
    // Load the Admin Dashboard with all foods
    public function index()
    {
        $foods = Food::orderBy('name')->get();
        return view('admin.index', compact('foods'));
    }

    // Save a new food to the database
    public function storeFood(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:foods,name',
            'calories_per_100g' => 'required|integer|min:0',
            'protein_g' => 'required|numeric|min:0',
            'carbs_g' => 'required|numeric|min:0',
            'fat_g' => 'required|numeric|min:0',
        ]);

        Food::create($request->all());

        return back()->with('success', 'New food added to the global directory!');
    }
}