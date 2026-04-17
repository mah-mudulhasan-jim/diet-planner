<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
    'name',
    'email',
    'password',
    'role',
    'height_cm',
    'current_weight_kg',
    'goal_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Calculates Daily Calorie Target based on weight and goal
    public function getDailyCalorieTargetAttribute()
    {
        // Simple Base Metabolic Rate (BMR) estimate: Weight(kg) * 24
        $baseCalories = $this->current_weight_kg * 24;

        if ($this->goal_type === 'lose') {
            return $baseCalories - 500; // Caloric deficit
        } elseif ($this->goal_type === 'gain') {
            return $baseCalories + 500; // Caloric surplus
        }

        return $baseCalories; // Maintenance
    }
    
    public function weightLogs()
    {
        return $this->hasMany(WeightLog::class);
    }

    public function mealLogs()
    {
        return $this->hasMany(MealLog::class);
    }
}
