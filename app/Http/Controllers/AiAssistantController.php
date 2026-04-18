<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiAssistantController extends Controller
{
    public function ask(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:1000'
        ]);

        $user = $request->user();

        // 1. Context Injection
        $systemContext = "You are an expert Personal Health and Nutrition Assistant inside a premium Diet Planner app. 
        Your current client's profile: 
        - Weight: {$user->current_weight_kg} kg
        - Height: {$user->height_cm} cm
        - Primary Goal: " . ucfirst($user->goal_type) . " Weight. 
        
        Using valid, science-backed nutritional information from the internet, answer their question directly, concisely, and professionally. Do not use formatting like markdown bolding if it disrupts plain text flow, but keep it clean.
        
        Client's Question: ";

        $fullPrompt = $systemContext . $request->question;
        $apiKey = env('GEMINI_API_KEY');

        try {
            // 2. Call Gemini API (Added withoutVerifying() for local Windows environments)
            $response = Http::withoutVerifying()->withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $fullPrompt]
                        ]
                    ]
                ]
            ]);

            // 3. Extract successful answer
            if ($response->successful()) {
                $answer = $response->json('candidates.0.content.parts.0.text');
                return response()->json(['answer' => $answer]);
            }

            // 4. If Google rejects the request, show the EXACT reason
            $errorMessage = $response->json('error.message', 'Unknown Google API Error');
            return response()->json(['error' => 'API Error: ' . $errorMessage], 500);

        } catch (\Exception $e) {
            // 5. If Laravel can't even connect to the internet, show the EXACT reason
            return response()->json(['error' => 'Connection Error: ' . $e->getMessage()], 500);
        }
    }
}