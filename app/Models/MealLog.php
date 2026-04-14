<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealLog extends Model
{
    protected $fillable = [
        'user_id',
        'food_id',
        'date',
        'meal_type',
        'quantity_g',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}