<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\NutritionistProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class NutritionistSeeder extends Seeder
{
    public function run()
    {
        // Expert 1
        $expert1 = User::create([
            'name' => 'Dr. Sarah Jenkins',
            'email' => 'sarah@dietplanner.test',
            'password' => Hash::make('password'),
            'role' => 'nutritionist',
            'height_cm' => 165,
            'current_weight_kg' => 60,
            'goal_type' => 'maintain',
        ]);

        NutritionistProfile::create([
            'user_id' => $expert1->id,
            'specialty' => 'Sports Nutrition',
            'bio' => 'Former Olympic dietician specializing in muscle gain and peak athletic performance. I will help you hit those protein macros effortlessly.',
            'is_verified' => true,
            'consultation_fee' => 50,
        ]);

        // Expert 2
        $expert2 = User::create([
            'name' => 'Marcus Thorne',
            'email' => 'marcus@dietplanner.test',
            'password' => Hash::make('password'),
            'role' => 'nutritionist',
            'height_cm' => 180,
            'current_weight_kg' => 80,
            'goal_type' => 'maintain',
        ]);

        NutritionistProfile::create([
            'user_id' => $expert2->id,
            'specialty' => 'Weight Loss & Fasting',
            'bio' => 'Certified nutritionist focused on sustainable fat loss, intermittent fasting, and metabolic health. Let\'s build a routine you actually enjoy.',
            'is_verified' => true,
            'consultation_fee' => 35,
        ]);

        // Expert 3
        $expert3 = User::create([
            'name' => 'Elena Rodriguez',
            'email' => 'elena@dietplanner.test',
            'password' => Hash::make('password'),
            'role' => 'nutritionist',
            'height_cm' => 160,
            'current_weight_kg' => 55,
            'goal_type' => 'maintain',
        ]);

        NutritionistProfile::create([
            'user_id' => $expert3->id,
            'specialty' => 'Plant-Based Diets',
            'bio' => 'Expert in vegan and vegetarian meal planning. I ensure you get complete amino acid profiles and essential micronutrients on a plant-based diet.',
            'is_verified' => true,
            'consultation_fee' => 40,
        ]);
    }
}