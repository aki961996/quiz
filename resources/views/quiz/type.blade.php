@extends('layouts.app')

@section('title', 'Online Quiz')
@section('style')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(255,255,255,0.2);
            border: 2px solid rgba(255,255,255,0.3);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: rgba(255,255,255,0.3);
            color: white;
            text-decoration: none;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding-top: 80px;
        }

        .page-title {
            color: #333;
            font-size: 3rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 50px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .quiz-card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 25px;
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s ease;
        }

        .quiz-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .quiz-title {
            color: white;
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .quiz-description {
            color: rgba(255,255,255,0.9);
            font-size: 1.1rem;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .quiz-info {
            display: flex;
            gap: 30px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .info-item {
            color: rgba(255,255,255,0.8);
            font-size: 1rem;
        }

        .info-label {
            font-weight: bold;
            color: white;
        }

        .start-btn {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            border-radius: 25px;
            padding: 15px 30px;
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .start-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
            text-decoration: none;
            color: white;
        }
    </style>
    @endsection
@section('content')
    <a href="{{ route('quiz.index') }}" class="back-btn">← Back</a>
    
    <div class="container">
        <h1 class="page-title">{{ $quizType->name }}</h1>
        
        @foreach($quizType->quizzes as $quiz)
            <div class="quiz-card">
                <h3 class="quiz-title">{{ $quiz->title }}</h3>
                <p class="quiz-description">{{ $quiz->description }}</p>
                
                <div class="quiz-info">
                    <div class="info-item">
                        <span class="info-label">Time Limit:</span> {{ $quiz->time_limit }} minutes
                    </div>
                    <div class="info-item">
                        <span class="info-label">Questions:</span> {{ $quiz->questions_count }}
                    </div>
                    <div class="info-item">
                        <span class="info-label">Difficulty:</span> 
                        @if($quiz->time_limit <= 10) Easy @elseif($quiz->time_limit <= 20) Medium @else Hard @endif
                    </div>
                </div>
                
                <a href="{{ route('quiz.start', $quiz) }}" class="start-btn">Start Quiz</a>
            </div>
        @endforeach
    </div>
@endsection