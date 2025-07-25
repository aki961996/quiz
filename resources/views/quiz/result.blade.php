@extends('layouts.app')
@section('title', 'Quiz Results')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6">
        <div class="max-w-3xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Quiz Results</h1>
                <div class="w-full bg-gray-200 rounded-full h-4 mb-2">
                    <div class="bg-blue-600 h-4 rounded-full transition-all duration-500 ease-out"
                        style="width: {{ $score }}%"></div>
                </div>
                <p class="text-lg text-gray-600">{{ round($score) }}% Score</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                <div class="bg-white p-4 rounded-lg shadow-sm text-center hover:shadow-md transition-shadow duration-200">
                    <p class="text-sm text-gray-500">Correct</p>
                    <p class="text-2xl font-bold text-green-600">{{ $correctCount }}</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm text-center hover:shadow-md transition-shadow duration-200">
                    <p class="text-sm text-gray-500">Total</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalQuestions }}</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm text-center hover:shadow-md transition-shadow duration-200">
                    <p class="text-sm text-gray-500">Percentage</p>
                    <p class="text-2xl font-bold text-blue-600">{{ round($score) }}%</p>
                </div>
            </div>

            <!-- Questions List -->
            <div class="space-y-4 mb-10">
                @foreach ($questionsWithAnswers as $qa)
                    <div class="bg-white p-5 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-4">
                                <div
                                    class="flex items-center justify-center w-8 h-8 rounded-full {{ $qa['is_correct'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $loop->iteration }}
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900 mb-3">{{ $qa['question'] }}</h3>

                                <div class="space-y-2">
                                    <div>
                                        <p class="text-sm text-gray-500">Your answer:</p>
                                        <p class="{{ $qa['is_correct'] ? 'text-green-600' : 'text-red-600' }} font-medium">
                                            {{ $qa['user_answer'] }}
                                        </p>
                                    </div>

                                    @unless ($qa['is_correct'])
                                        <div>
                                            <p class="text-sm text-gray-500">Correct answer:</p>
                                            <p class="text-green-600 font-medium">{{ $qa['correct_answer'] }}</p>
                                        </div>
                                    @endunless
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Success Badge -->
            @if ($score >= 80)
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8 rounded animate-pulse">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                <span class="font-bold">Excellent!</span> You scored above 80%.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Actions -->
            <div class="quiz-actions-container">
                <a href="{{ route('quiz.index') }}" class="quiz-action-btn quiz-primary-btn">
                    Try Another Quiz
                </a>
                <button onclick="window.print()" class="quiz-action-btn quiz-secondary-btn">
                    Print Results
                    </a>
            </div>
        </div>
    </div>
@endsection
