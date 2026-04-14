<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    // Force Laravel to look for the table with an 's'
    protected $table = 'foods';

    protected $fillable = [
        'name',
        'calories_per_100g',
        'protein_g',
        'carbs_g',
        'fat_g',
    ];

    // Tell it that a food item can be in many meal logs
    public function mealLogs()
    {
        return $this->hasMany(MealLog::class);
    }
}