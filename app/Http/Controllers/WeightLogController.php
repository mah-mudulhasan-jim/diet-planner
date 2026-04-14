<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightLog;

class WeightLogController extends Controller
{
    public function store(Request $request)
    {
        // 1. Check the data is valid
        $request->validate([
            'weight_kg' => 'required|numeric|min:30|max:300',
            'date' => 'required|date|before_or_equal:today',
        ]);

        // 2. Save the log attached to the currently logged-in user
        $request->user()->weightLogs()->create([
            'weight_kg' => $request->weight_kg,
            'date' => $request->date,
        ]);

        // 3. Update the user's current weight in their profile
        $request->user()->update([
            'current_weight_kg' => $request->weight_kg
        ]);

        // 4. Send them back to the dashboard with a success message
        return back()->with('success', 'Weight logged successfully!');
    }
}