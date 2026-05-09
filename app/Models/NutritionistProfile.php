<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionistProfile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'specialty', 'bio', 'is_verified', 'consultation_fee'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}