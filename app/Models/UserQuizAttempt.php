<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuizAttempt extends Model
{
    use HasFactory;
     protected $fillable = [
        'user_id', 'quiz_id', 'started_at', 'completed_at', 
        'score', 'total_questions', 'status'
    ];
     protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

     public function answers()
    {
        return $this->hasMany(UserAnswer::class);
    }
}
