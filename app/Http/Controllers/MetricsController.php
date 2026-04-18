<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MetricsController extends Controller
{
    public function index(Request $request)
    {
        // Pass the logged-in user to the view so we can pre-fill their height/weight
        return view('metrics', ['user' => $request->user()]);
    }
}