<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'quiz_type_id', 'time_limit', 
        'questions_count', 'is_active'
    ];

     public function quizType()
    {
        return $this->belongsTo(QuizType::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function attempts()
    {
        return $this->hasMany(UserQuizAttempt::class);
    }
}
