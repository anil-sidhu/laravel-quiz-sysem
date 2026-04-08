<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <title> {{ str_replace('-',' ',$quizName) }} | {{$mcqData->question}} | The Coding Skills </title>
    <meta name="description" content="{{ str_replace('-',' ',$quizName) }} | {{$mcqData->question}} theCodingSkills.com structured notes from coding code step by step YouTube channel">
    <meta name="keywords" content="{{ str_replace('-',' ',$quizName) }}, {{$mcqData->question}}, Programming language MCQs, Anil sidhu, The Coding Skills">
    @vite('resources/css/app.css')
    <style>
        .option-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .option-card:hover {
            transform: translateY(-2px) scale(1.01);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }
        .option-card.selected {
            border-color: #059669;
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            transform: scale(1.02);
        }
        .option-badge {
            transition: all 0.3s ease;
        }
        .option-card.selected .option-badge {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: white;
            transform: scale(1.1);
        }
        .progress-fill {
            transition: width 0.5s ease-out;
        }
        .timer-warning {
            color: #dc2626 !important;
            animation: blink 1s infinite;
        }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .submit-btn {
            background: linear-gradient(135deg, #166534 0%, #14532d 100%);
            transition: all 0.3s ease;
        }
        .submit-btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(22, 101, 52, 0.4);
        }
        .submit-btn:active:not(:disabled) {
            transform: translateY(0);
        }
        .checkmark {
            opacity: 0;
            transform: scale(0);
            transition: all 0.3s ease;
        }
        .option-card.selected .checkmark {
            opacity: 1;
            transform: scale(1);
        }
    </style>
</head>
<body>
    <x-user-navbar></x-user-navbar>
    @if(session('message'))
        <p class="text-green-900 text-center py-2">{{'message'}}</p>
    @endif
    
    <div class="bg-gradient-to-br from-gray-50 to-gray-100 flex flex-col items-center min-h-screen pt-4 sm:pt-6 px-4">
        
        <!-- Quiz Header Card -->
        <div class="w-full max-w-4xl mb-4 sm:mb-6">
            <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6">
                <!-- Quiz Title -->
                <h1 class="text-lg sm:text-xl md:text-2xl text-center text-green-800 font-bold mb-4">
                    {{ str_replace('-', ' ', $quizName) }}
                </h1>
                
                <!-- Progress Section -->
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-gray-600">Progress</span>
                        <span class="text-sm font-bold text-green-700">
                            {{session('currentQuiz')['currentMcq']}} / {{session('currentQuiz')['totalMcq']}}
                        </span>
                    </div>
                    <!-- Progress Bar -->
                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                        <div class="progress-fill bg-gradient-to-r from-green-500 via-emerald-500 to-teal-500 h-3 rounded-full relative"
                             style="width: {{ (session('currentQuiz')['currentMcq'] / session('currentQuiz')['totalMcq']) * 100 }}%">
                            <div class="absolute inset-0 bg-white/20 animate-pulse"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Question Counter & Timer Row -->
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                            Question {{session('currentQuiz')['currentMcq']}}
                        </div>
                    </div>
                    <!-- Timer Display (Countdown from 45 min) -->
                    <div id="timerContainer" class="flex items-center gap-2 bg-gray-100 px-3 py-1.5 rounded-full">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span id="timer" class="text-sm font-mono font-semibold text-gray-700">45:00</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Question Card -->
        <div class="w-full max-w-4xl">
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                <!-- Question Header -->
                <div class="bg-gradient-to-r from-green-700 to-green-800 px-4 sm:px-6 py-4">
                    <h3 class="text-white font-bold text-lg sm:text-xl leading-relaxed">
                        {{$mcqData->question}}
                    </h3>
                </div>
                
                <!-- Options -->
                <form action="/submit-next/{{$mcqData->id}}" class="p-4 sm:p-6" method="post" id="quizForm">
                    @csrf
                    <input type="hidden" name="id" value="{{$mcqData->id}}">
                    <input type="hidden" name="time_spent" id="timeSpent" value="0">
                    
                    <div class="space-y-3 sm:space-y-4">
                        <!-- Option A -->
                        <label for="option_1" class="option-card flex items-center border-2 border-gray-200 p-4 rounded-xl cursor-pointer bg-white hover:border-green-300 hover:bg-green-50/50">
                            <input id="option_1" class="hidden" type="radio" value="a" name="option" onchange="selectOption(this)">
                            <div class="option-badge flex-shrink-0 w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center font-bold text-gray-600 mr-4">
                                A
                            </div>
                            <span class="text-gray-800 text-sm sm:text-base leading-relaxed flex-grow">{{$mcqData->a}}</span>
                            <div class="checkmark flex-shrink-0 ml-3">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </label>
                        
                        <!-- Option B -->
                        <label for="option_2" class="option-card flex items-center border-2 border-gray-200 p-4 rounded-xl cursor-pointer bg-white hover:border-green-300 hover:bg-green-50/50">
                            <input id="option_2" class="hidden" type="radio" value="b" name="option" onchange="selectOption(this)">
                            <div class="option-badge flex-shrink-0 w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center font-bold text-gray-600 mr-4">
                                B
                            </div>
                            <span class="text-gray-800 text-sm sm:text-base leading-relaxed flex-grow">{{$mcqData->b}}</span>
                            <div class="checkmark flex-shrink-0 ml-3">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </label>
                        
                        <!-- Option C -->
                        <label for="option_3" class="option-card flex items-center border-2 border-gray-200 p-4 rounded-xl cursor-pointer bg-white hover:border-green-300 hover:bg-green-50/50">
                            <input id="option_3" class="hidden" type="radio" value="c" name="option" onchange="selectOption(this)">
                            <div class="option-badge flex-shrink-0 w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center font-bold text-gray-600 mr-4">
                                C
                            </div>
                            <span class="text-gray-800 text-sm sm:text-base leading-relaxed flex-grow">{{$mcqData->c}}</span>
                            <div class="checkmark flex-shrink-0 ml-3">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </label>
                        
                        <!-- Option D -->
                        <label for="option_4" class="option-card flex items-center border-2 border-gray-200 p-4 rounded-xl cursor-pointer bg-white hover:border-green-300 hover:bg-green-50/50">
                            <input id="option_4" class="hidden" type="radio" value="d" name="option" onchange="selectOption(this)">
                            <div class="option-badge flex-shrink-0 w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center font-bold text-gray-600 mr-4">
                                D
                            </div>
                            <span class="text-gray-800 text-sm sm:text-base leading-relaxed flex-grow">{{$mcqData->d}}</span>
                            <div class="checkmark flex-shrink-0 ml-3">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </label>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" id="submitBtn" class="submit-btn w-full mt-6 rounded-xl px-6 py-4 text-white font-semibold text-lg flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                        <span>Submit & Continue</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Question Navigation Hint -->
        <div class="mt-4 text-center text-gray-500 text-sm">
            <p>Select an option and click submit to continue</p>
        </div>
    </div>

    <x-footer-user></x-footer-user>

    <script>
        // Countdown Timer (45 minutes = 2700 seconds)
        const QUIZ_TIME = 45 * 60; // 45 minutes in seconds
        const storageKey = 'quiz_timer_{{$mcqData->id}}';
        
        // Get remaining time from session storage or start fresh
        let remainingSeconds = parseInt(sessionStorage.getItem(storageKey)) || QUIZ_TIME;
        
        const timerEl = document.getElementById('timer');
        const timerContainer = document.getElementById('timerContainer');
        const timeSpentInput = document.getElementById('timeSpent');
        
        function updateTimer() {
            remainingSeconds--;
            
            // Save to session storage
            sessionStorage.setItem(storageKey, remainingSeconds);
            
            // Calculate time spent
            timeSpentInput.value = QUIZ_TIME - remainingSeconds;
            
            // Format display
            const mins = Math.floor(remainingSeconds / 60).toString().padStart(2, '0');
            const secs = (remainingSeconds % 60).toString().padStart(2, '0');
            timerEl.textContent = `${mins}:${secs}`;
            
            // Warning when less than 5 minutes
            if (remainingSeconds <= 300) {
                timerEl.classList.add('timer-warning');
                timerContainer.classList.add('bg-red-100');
                timerContainer.classList.remove('bg-gray-100');
            }
            
            // Auto-submit when time runs out
            if (remainingSeconds <= 0) {
                clearInterval(timerInterval);
                sessionStorage.removeItem(storageKey);
                alert('Time is up! Submitting your quiz...');
                document.getElementById('quizForm').submit();
            }
        }
        
        // Initial display
        const initMins = Math.floor(remainingSeconds / 60).toString().padStart(2, '0');
        const initSecs = (remainingSeconds % 60).toString().padStart(2, '0');
        timerEl.textContent = `${initMins}:${initSecs}`;
        
        // Check warning state on load
        if (remainingSeconds <= 300) {
            timerEl.classList.add('timer-warning');
            timerContainer.classList.add('bg-red-100');
            timerContainer.classList.remove('bg-gray-100');
        }
        
        const timerInterval = setInterval(updateTimer, 1000);
        
        // Option selection handling
        function selectOption(radio) {
            // Remove selected class from all options
            document.querySelectorAll('.option-card').forEach(card => {
                card.classList.remove('selected');
            });
            
            // Add selected class to clicked option
            radio.closest('.option-card').classList.add('selected');
            
            // Enable submit button
            document.getElementById('submitBtn').disabled = false;
        }
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            const key = e.key.toLowerCase();
            if (key === 'a') document.getElementById('option_1').click();
            if (key === 'b') document.getElementById('option_2').click();
            if (key === 'c') document.getElementById('option_3').click();
            if (key === 'd') document.getElementById('option_4').click();
            if (key === 'enter' && !document.getElementById('submitBtn').disabled) {
                document.getElementById('quizForm').submit();
            }
        });
        
        // Clear timer on form submit
        document.getElementById('quizForm').addEventListener('submit', function() {
            // Don't clear - let it persist across questions
            // sessionStorage.removeItem(storageKey);
        });
    </script>
</body>
</html>
