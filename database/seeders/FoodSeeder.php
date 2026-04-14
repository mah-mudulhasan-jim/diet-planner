<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodSeeder extends Seeder
{
    public function run(): void
    {
        $foods = [
            ['name' => 'Chicken Breast (Cooked)', 'calories_per_100g' => 165, 'protein_g' => 31.0, 'carbs_g' => 0.0, 'fat_g' => 3.6],
            ['name' => 'White Rice (Cooked)', 'calories_per_100g' => 130, 'protein_g' => 2.7, 'carbs_g' => 28.0, 'fat_g' => 0.3],
            ['name' => 'Whole Egg (Boiled)', 'calories_per_100g' => 155, 'protein_g' => 13.0, 'carbs_g' => 1.1, 'fat_g' => 11.0],
            ['name' => 'Broccoli', 'calories_per_100g' => 34, 'protein_g' => 2.8, 'carbs_g' => 6.6, 'fat_g' => 0.4],
            ['name' => 'Apple', 'calories_per_100g' => 52, 'protein_g' => 0.3, 'carbs_g' => 14.0, 'fat_g' => 0.2],
            ['name' => 'Almonds', 'calories_per_100g' => 579, 'protein_g' => 21.0, 'carbs_g' => 22.0, 'fat_g' => 50.0],
            ['name' => 'Oats', 'calories_per_100g' => 389, 'protein_g' => 16.9, 'carbs_g' => 66.3, 'fat_g' => 6.9],
            ['name' => 'Olive Oil', 'calories_per_100g' => 884, 'protein_g' => 0.0, 'carbs_g' => 0.0, 'fat_g' => 100.0],
            ['name' => 'Banana', 'calories_per_100g' => 89, 'protein_g' => 1.1, 'carbs_g' => 22.8, 'fat_g' => 0.3],
            ['name' => 'Salmon (Cooked)', 'calories_per_100g' => 206, 'protein_g' => 22.0, 'carbs_g' => 0.0, 'fat_g' => 13.0],
        ];

        foreach ($foods as $food) {
            DB::table('foods')->insert([
                'name' => $food['name'],
                'calories_per_100g' => $food['calories_per_100g'],
                'protein_g' => $food['protein_g'],
                'carbs_g' => $food['carbs_g'],
                'fat_g' => $food['fat_g'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}