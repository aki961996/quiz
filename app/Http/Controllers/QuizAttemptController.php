<?php

namespace App\Http\Controllers;

use App\Models\UserAnswer;
use App\Models\UserQuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizAttemptController extends Controller
{
    public function take(UserQuizAttempt $attempt)
    {

        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        $quiz = $attempt->quiz->load('questions');
        $answeredQuestions = $attempt->answers()->pluck('question_id')->toArray();


        $currentQuestion = $quiz->questions()
            ->whereNotIn('id', $answeredQuestions)
            ->first();

        if (!$currentQuestion) {
            return $this->completeQuiz($attempt);
        }

        return view('quiz.take', compact('attempt', 'quiz', 'currentQuestion'));
    }

    public function submitAnswer(Request $request, UserQuizAttempt $attempt)
    {

        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer' => 'required|string',
            'time_taken' => 'required|integer'
        ]);

        $question = $attempt->quiz->questions()->findOrFail($request->question_id);
        $isCorrect = $question->correct_answer === $request->answer;

        UserAnswer::create([
            'user_quiz_attempt_id' => $attempt->id,
            'question_id' => $question->id,
            'user_answer' => $request->answer,
            'is_correct' => $isCorrect,
            'time_taken' => $request->time_taken
        ]);

        return response()->json(['success' => true]);
    }




    // public function completeQuiz(UserQuizAttempt $attempt)
    // {

    //     $correctAnswers = $attempt->answers()->where('is_correct', true)->count();
    //     $score = ($correctAnswers / $attempt->total_questions) * 100;

    //     $attempt->update([
    //         'completed_at' => now(),
    //         'score' => $score,
    //         'status' => 'completed'
    //     ]);

    //     // Get all answers with their questions 
    //     // Eager load the questions with the answers
    //     // to avoid N+1 query problem
    //     $answersWithQuestions = $attempt->answers()->with('question')->get();

    //     // Map the data for the view
    //     $questionsWithAnswers = $answersWithQuestions->map(function ($answer) {
    //         return [
    //             'question' => $answer->question ? $answer->question->question : 'Question not found',
    //             'user_answer' => $answer->user_answer,
    //             'correct_answer' => $answer->question ? $answer->question->correct_answer : 'N/A',
    //             'is_correct' => $answer->is_correct
    //         ];
    //     });


    //     return view('quiz.result', compact('attempt', 'score', 'correctAnswers', 'questionsWithAnswers'));
    // }

    // Controller (keep this the same)
public function completeQuiz(UserQuizAttempt $attempt)
{
    $correctAnswers = $attempt->answers()->where('is_correct', true)->count();
    $score = ($correctAnswers / $attempt->total_questions) * 100;

    $attempt->update([
        'completed_at' => now(),
        'score' => $score,
        'status' => 'completed'
    ]);

    $answersWithQuestions = $attempt->answers()->with('question')->get();

    $questionsWithAnswers = $answersWithQuestions->map(function ($answer) {
        return [
            'question' => $answer->question ? $answer->question->question : 'Question not found',
            'user_answer' => $answer->user_answer,
            'correct_answer' => $answer->question ? $answer->question->correct_answer : 'N/A',
            'is_correct' => $answer->is_correct
        ];
    });

    return view('quiz.result', [
        'attempt' => $attempt,
        'score' => $score,
        'correctCount' => $correctAnswers,
        'totalQuestions' => $attempt->total_questions,
        'questionsWithAnswers' => $questionsWithAnswers
    ]);
}
}
