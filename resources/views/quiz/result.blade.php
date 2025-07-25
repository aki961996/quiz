@extends('layouts.app')
@section('title', 'Result Quiz')
@section('style')
<style>
    .hexagon-answer {
        position: relative;
        background: linear-gradient(135deg, #4A90E2, #357ABD);
        clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%);
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 80px;
        width: 280px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .question-box {
        background: linear-gradient(135deg, #4A90E2, #357ABD);
        border-radius: 50px;
        padding: 20px 30px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        width: 100%;
        max-width: 600px;
    }
    
    .winner-box {
        background: linear-gradient(135deg, #4A90E2, #357ABD);
        border-radius: 50px;
        padding: 25px 50px;
        box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        display: inline-block;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .question-answer-row {
            flex-direction: column !important;
            gap: 15px !important;
            align-items: center !important;
        }
        
        .hexagon-answer {
            width: 220px;
            min-height: 60px;
        }
        
        .question-box {
            max-width: 400px;
            padding: 15px 25px;
        }
        
        .results-title {
            font-size: 4rem !important;
        }
        
        .winner-text {
            font-size: 2.5rem !important;
        }
        
        .question-text, .answer-text {
            font-size: 1rem !important;
        }
    }
    
    @media (max-width: 480px) {
        .hexagon-answer {
            width: 180px;
            min-height: 50px;
        }
        
        .question-box {
            max-width: 320px;
            padding: 12px 20px;
        }
        
        .results-title {
            font-size: 3rem !important;
        }
        
        .winner-text {
            font-size: 2rem !important;
        }
        
        .winner-box {
            padding: 20px 35px;
        }
    }
</style>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-400 via-pink-400 to-purple-600 py-6 px-4">
    <div class="max-w-6xl mx-auto">
        
        <!-- Results Header -->
        <div class="text-center mb-10">
            <h1 class="results-title text-6xl md:text-8xl font-bold text-black">Results</h1>
        </div>

        <!-- Questions and Answers -->
        <div class="space-y-6 mb-12">
            @foreach($questionsWithAnswers as $qa)
                <div class="question-answer-row flex flex-row items-center justify-between gap-6">
                    
                    <!-- Question Box -->
                    <div class="flex-1">
                        <div class="question-box">
                            <p class="question-text text-white text-lg md:text-xl font-medium text-center">
                                {{ $qa['question'] }}
                            </p>
                        </div>
                    </div>

                    <!-- Answer Section -->
                    <div class="flex-shrink-0">
                        @if($qa['is_correct'])
                            <!-- Correct Answer - Show in Green -->
                            <div class="hexagon-answer" style="background: linear-gradient(135deg, #4CAF50, #45a049);">
                                <p class="answer-text text-white text-lg md:text-xl font-bold text-center px-3">
                                    {{ $qa['user_answer'] }}
                                </p>
                            </div>
                        @else
                            <!-- Wrong Answer - Show User's Answer in Red -->
                            <div class="hexagon-answer" style="background: linear-gradient(135deg, #f44336, #d32f2f);">
                                <p class="answer-text text-white text-lg md:text-xl font-bold text-center px-3">
                                    {{ $qa['user_answer'] }}
                                </p>
                            </div>
                            
                            <!-- Show Correct Answer Below -->
                            <div class="mt-3 text-center">
                                <div class="hexagon-answer" style="background: linear-gradient(135deg, #4CAF50, #45a049); transform: scale(0.8);">
                                    <p class="text-white text-sm md:text-base font-bold text-center px-2">
                                        {{ $qa['correct_answer'] }}
                                    </p>
                                </div>
                                <p class="text-white text-xs mt-1 font-medium">Correct Answer</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Winner Section -->
        <div class="text-center">
            <div class="winner-box">
                <h2 class="winner-text text-white text-4xl md:text-5xl font-bold">Winner</h2>
            </div>
        </div>

    </div>
</div>
@endsection