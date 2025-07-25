<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;
     protected $fillable = [
        'user_quiz_attempt_id', 'question_id', 'user_answer', 
        'is_correct', 'time_taken'
    ];
    public function attempt()
    {
        return $this->belongsTo(UserQuizAttempt::class, 'user_quiz_attempt_id');
    }
     public function question()
    {
        return $this->belongsTo(Question::class);
    }

}
