<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeightLog extends Model
{
    protected $fillable = [
        'user_id',
        'weight_kg',
        'date',
    ];

    // This creates the relationship back to the User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
