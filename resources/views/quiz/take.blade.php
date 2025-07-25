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
            background: rgba(255, 165, 0, 0.8);
            border: none;
            color: white;
            padding: 15px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .timer-container {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255,255,255,0.9);
            padding: 15px 25px;
            border-radius: 10px;
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding-top: 100px;
        }

        .question-card {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            text-align: center;
        }

        .question-text {
            color: white;
            font-size: 2rem;
            font-weight: 600;
            line-height: 1.4;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .options-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .option-btn {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            border-radius: 15px;
            padding: 25px 30px;
            color: white;
            font-size: 1.4rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .option-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .option-btn.selected {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            transform: scale(1.02);
        }

        .option-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .option-btn:hover::before {
            left: 100%;
        }

        .progress-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            height: 6px;
            background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
            transition: width 0.3s ease;
            z-index: 1000;
        }

        @media (max-width: 768px) {
            .options-container {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .question-text {
                font-size: 1.5rem;
            }
            
            .option-btn {
                font-size: 1.2rem;
                padding: 20px 25px;
            }
            
            .timer-container {
                font-size: 1.2rem;
                padding: 10px 15px;
            }
        }
    </style>
@endsection
@section('content')
    <button class="back-btn" onclick="history.back()">←</button>
    
    <div class="timer-container">
        <span id="timer">0:00</span>
    </div>

    <div class="container">
        <div class="question-card">
            <h2 class="question-text">{{ $currentQuestion->question }}</h2>
        </div>

        <div class="options-container">
            @foreach($currentQuestion->options as $index => $option)
                <button class="option-btn" data-answer="{{ $option }}" onclick="selectOption(this, '{{ $option }}')">
                    {{ $option }}
                </button>
            @endforeach
        </div>
    </div>

    <div class="progress-bar" id="progress-bar"></div>
    @endsection
@section('script')
    <script>
        let selectedOption = null;
        let questionStartTime = Date.now();
        let questionTimeLimit = {{ $currentQuestion->time_limit }};
        let remainingTime = questionTimeLimit;
      
        function updateTimer() {
            let minutes = Math.floor(remainingTime / 60);
            let seconds = remainingTime % 60;
            document.getElementById('timer').textContent = 
                `${minutes}:${seconds.toString().padStart(2, '0')}`;
            
          
            let progress = ((questionTimeLimit - remainingTime) / questionTimeLimit) * 100;
            document.getElementById('progress-bar').style.width = progress + '%';
            
            remainingTime--;
            
            if (remainingTime < 0) {
                autoSubmit();
            }
        }
        
        let timerInterval = setInterval(updateTimer, 1000);
        updateTimer(); 
        
        function selectOption(button, answer) {
          
            document.querySelectorAll('.option-btn').forEach(btn => {
                btn.classList.remove('selected');
            });
            
           
            button.classList.add('selected');
            selectedOption = answer;
            
            // Auto submit after 1 second
            setTimeout(() => {
                if (selectedOption === answer) {
                    submitAnswer();
                }
            }, 1000);
        }
        
        function autoSubmit() {
            clearInterval(timerInterval);
            if (!selectedOption) {
              
                selectedOption = document.querySelector('.option-btn').dataset.answer;
            }
            submitAnswer();
        }
        
        function submitAnswer() {
            clearInterval(timerInterval);
            let timeTaken = Math.floor((Date.now() - questionStartTime) / 1000);
            
            let formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
            formData.append('question_id', '{{ $currentQuestion->id }}');
            formData.append('answer', selectedOption);
            formData.append('time_taken', timeTaken);
            
            fetch('{{ route("quiz.answer", $attempt) }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload(); // Load next question
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
@endsection