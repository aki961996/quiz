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
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .main-title {
            color: #333;
            font-size: 4rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .sub-title {
            color: #333;
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 50px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .quiz-types-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            max-width: 1200px;
            width: 100%;
        }

        .quiz-type-btn {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            border-radius: 50px;
            padding: 25px 40px;
            color: white;
            font-size: 1.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 80px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            position: relative;
            overflow: hidden;
        }

        .quiz-type-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            text-decoration: none;
            color: white;
        }

        .quiz-type-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .quiz-type-btn:hover::before {
            left: 100%;
        }

        .quiz-type-btn.history {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .quiz-type-btn.geography {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .quiz-type-btn.food {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .quiz-type-btn.general {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .quiz-type-btn.arts {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .quiz-type-btn.film {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #333;
        }

        @media (max-width: 768px) {
            .quiz-types-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .main-title {
                font-size: 2.5rem;
            }

            .sub-title {
                font-size: 1.8rem;
            }

            .quiz-type-btn {
                font-size: 1.4rem;
                padding: 20px 30px;
            }
        }

        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255,255,255,0.2);
            border: 2px solid rgba(255,255,255,0.3);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: rgba(255,255,255,0.3);
            color: white;
            text-decoration: none;
        }
    </style>
@endsection

@section('content')
    @auth
        <form method="POST" action="{{ route('logout') }}" style="position: absolute; top: 20px; right: 20px;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    @endauth

    <h1 class="main-title">Online Quiz</h1>
    <h2 class="sub-title">Select Quiz Type</h2>

    <div class="quiz-types-container">
        @foreach($quizTypes as $type)
            <a href="{{ route('quiz.type', $type->id) }}" 
               class="quiz-type-btn {{ strtolower(str_replace([' ', '&'], ['', ''], $type->name)) }}">
                {{ $type->name }}
            </a>
        @endforeach
    </div>
@endsection
