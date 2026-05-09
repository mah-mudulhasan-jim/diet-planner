<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'user_id', 
        'nutritionist_id', 
        'scheduled_at', 
        'status', 
        'notes'
    ];

    // Relationship: The client who booked it
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship: The expert who receives it
    public function nutritionist()
    {
        return $this->belongsTo(User::class, 'nutritionist_id');
    }
}