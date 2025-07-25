<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgetController;
use App\Http\Controllers\QuizAttemptController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'login')->name('login');
    Route::post('login', 'auth_login')->name('auth_login');

    Route::get('register', 'register')->name('register');
    Route::post('register', 'create_user')->name('create_user');

    Route::get('verify/{token}', 'verify');

    Route::post('logout', 'logout')->name('logout');

    //forgetpassword
    Route::get('forgot-password', [ForgetController::class, 'forgotPassword'])->name('forgot-password');
    Route::post('forgot-password', [ForgetController::class, 'postForgotPassword'])->name('post-forgot-password');
    Route::get('reset/{token}', [ForgetController::class, 'resetPassword'])->name('reset');
    Route::post('reset/{token}', [ForgetController::class, 'postReset'])->name('Post-reset');
});

Route::group(['middleware' => 'adminuser'], function () {

     Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
     Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
     Route::get('/quiz/type/{quizType}', [QuizController::class, 'showType'])->name('quiz.type');
    Route::get('/quiz/{quiz}', [QuizController::class, 'show'])->name('quiz.show');
    Route::get('/quiz/{quiz}/start', [QuizController::class, 'start'])->name('quiz.start');
    
    Route::get('/quiz-attempt/{attempt}', [QuizAttemptController::class, 'take'])->name('quiz.take');
    Route::post('/quiz-attempt/{attempt}/answer', [QuizAttemptController::class, 'submitAnswer'])->name('quiz.answer');
    Route::get('/quiz-attempt/{attempt}/complete', [QuizAttemptController::class, 'completeQuiz'])->name('quiz.complete');


});
