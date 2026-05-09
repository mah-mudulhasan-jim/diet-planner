<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // 1. Allow mass assignment for these specific columns
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
        'read_at'
    ];

    // 2. Define the relationship to the User who sent it
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // 3. Define the relationship to the User receiving it
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}