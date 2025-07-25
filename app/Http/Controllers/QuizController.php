<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizType;
use App\Models\UserQuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
     public function index()
    {
        $quizTypes = QuizType::with('quizzes')->get();
        if ($quizTypes->isEmpty()) {
            return redirect()->back()->with('error', 'No quiz types available');
        }
        return view('quiz.index', compact('quizTypes'));
    }
    public function showType(QuizType $quizType)
    {
        $quizType->load('quizzes');
        return view('quiz.type', compact('quizType'));
    }

     public function start(Quiz $quiz)
    {
    // dd('done');
        $existingAttempt = UserQuizAttempt::where('user_id', Auth::id())
            ->where('quiz_id', $quiz->id)
            ->where('status', 'in_progress')
            ->first();

        if ($existingAttempt) {
            return redirect()->route('quiz.take', $existingAttempt->id);
        }

        // Create new attempt
        $attempt = UserQuizAttempt::create([
            'user_id' => Auth::id(),
            'quiz_id' => $quiz->id,
            'started_at' => now(),
            'total_questions' => $quiz->questions()->count(),
            'status' => 'in_progress'
        ]);

        return redirect()->route('quiz.take', $attempt->id);
    }


    
}
