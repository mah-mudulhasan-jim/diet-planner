<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class NutritionistController extends Controller
{
    // Shows the directory of all verified nutritionists
    public function index()
    {
        // Fetch users who are nutritionists AND have a verified profile
        $experts = User::where('role', 'nutritionist')
            ->whereHas('nutritionistProfile', function ($query) {
                $query->where('is_verified', true);
            })
            ->with('nutritionistProfile') // Eager load the profile data
            ->get();

        return view('experts.index', compact('experts'));
    }

    // Shows a single nutritionist's profile and the booking form
    public function show(User $expert)
    {
        // Security check: Make sure this user is actually an expert
        if ($expert->role !== 'nutritionist') {
            abort(404);
        }

        $expert->load('nutritionistProfile');

        return view('experts.show', compact('expert'));
    }
}