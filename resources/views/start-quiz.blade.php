<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <title>{{ str_replace('-',' ', $quizName)}} | The Coding Skills</title>
    <meta name="description" content="Take the {{ str_replace('-',' ', $quizName)}} quiz at The Coding Skills. Test your knowledge with {{ $quizCount ?? 0 }} questions.">
    @vite('resources/css/app.css')
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        .start-btn {
            background: linear-gradient(135deg, #166534 0%, #14532d 100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(22, 101, 52, 0.3);
        }
        .start-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(22, 101, 52, 0.4);
        }
        .start-btn:active {
            transform: translateY(-1px);
        }
        .info-card {
            transition: all 0.3s ease;
        }
        .info-card:hover {
            transform: translateY(-5px);
        }
        .animate-fade-in {
            animation: fadeInUp 0.6s ease forwards;
        }
        .animate-delay-1 { animation-delay: 0.1s; opacity: 0; }
        .animate-delay-2 { animation-delay: 0.2s; opacity: 0; }
        .animate-delay-3 { animation-delay: 0.3s; opacity: 0; }
        .animate-delay-4 { animation-delay: 0.4s; opacity: 0; }
        .instruction-item {
            transition: all 0.3s ease;
        }
        .instruction-item:hover {
            transform: translateX(5px);
            background: rgba(22, 101, 52, 0.05);
        }
    </style>
</head>
<body>
    <x-user-navbar></x-user-navbar>
    
    @if(session('message-success'))
        <div class="w-full max-w-4xl mx-auto p-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-md text-center">
                <p class="font-semibold">{{ session('message-success') }}</p>
            </div>
        </div>
    @endif
    
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-green-50/30 to-gray-100 flex flex-col items-center py-8 px-4">
        
        @if(isset($noQuestions) && $noQuestions)
            <!-- No Questions Available -->
            <div class="max-w-md text-center">
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Coming Soon!</h2>
                    <p class="text-gray-600 mb-6">No questions are available for this quiz yet. Please try again later.</p>
                    <a href="/" class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-800 px-6 py-3 rounded-xl font-semibold transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Browse Other Quizzes
                    </a>
                </div>
            </div>
        @else
            <!-- Quiz Start Card -->
            <div class="w-full max-w-2xl">
                
                <!-- Quiz Title Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-6 animate-fade-in">
                    <div class="bg-gradient-to-r from-green-700 via-green-600 to-emerald-600 px-6 py-8 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full mb-4 float-animation">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-2">
                            {{ str_replace('-', ' ', $quizName) }}
                        </h1>
                        <p class="text-green-100 text-lg">Test Your Knowledge</p>
                    </div>
                    
                    <!-- Quiz Info Cards -->
                    <div class="p-6">
                        <div class="grid grid-cols-3 gap-4 mb-6">
                            <div class="info-card bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 text-center animate-fade-in animate-delay-1">
                                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="text-2xl font-bold text-blue-700">{{ $quizCount }}</div>
                                <div class="text-sm text-blue-600">Questions</div>
                            </div>
                            
                            <div class="info-card bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-4 text-center animate-fade-in animate-delay-2">
                                <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="text-2xl font-bold text-purple-700">45 min</div>
                                <div class="text-sm text-purple-600">Time Limit</div>
                            </div>
                            
                            <div class="info-card bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-4 text-center animate-fade-in animate-delay-3">
                                <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                </div>
                                <div class="text-2xl font-bold text-orange-700">5</div>
                                <div class="text-sm text-orange-600">Max Attempts</div>
                            </div>
                        </div>
                        
                        <!-- Instructions -->
                        <div class="bg-gray-50 rounded-xl p-5 mb-6 animate-fade-in animate-delay-3">
                            <h3 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Instructions
                            </h3>
                            <ul class="space-y-2 text-gray-600 text-sm">
                                <li class="instruction-item flex items-start gap-3 p-2 rounded-lg">
                                    <span class="flex-shrink-0 w-6 h-6 bg-green-100 text-green-700 rounded-full flex items-center justify-center text-xs font-bold">1</span>
                                    <span>Read each question carefully before selecting an answer</span>
                                </li>
                                <li class="instruction-item flex items-start gap-3 p-2 rounded-lg">
                                    <span class="flex-shrink-0 w-6 h-6 bg-green-100 text-green-700 rounded-full flex items-center justify-center text-xs font-bold">2</span>
                                    <span>Select one option from the four choices provided</span>
                                </li>
                                <li class="instruction-item flex items-start gap-3 p-2 rounded-lg">
                                    <span class="flex-shrink-0 w-6 h-6 bg-green-100 text-green-700 rounded-full flex items-center justify-center text-xs font-bold">3</span>
                                    <span>You have 45 minutes to complete the quiz</span>
                                </li>
                                <li class="instruction-item flex items-start gap-3 p-2 rounded-lg">
                                    <span class="flex-shrink-0 w-6 h-6 bg-green-100 text-green-700 rounded-full flex items-center justify-center text-xs font-bold">4</span>
                                    <span>Score 70% or above to earn your certificate!</span>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Start Button or Login/Signup -->
                        <div class="text-center animate-fade-in animate-delay-4">
                            @if(session('user'))
                                <a href="/mcq/{{ session('firstMCQ')->id.'/'.$quizName }}" 
                                   class="start-btn inline-flex items-center justify-center gap-3 text-white px-12 py-4 rounded-xl font-bold text-lg w-full sm:w-auto">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Start Quiz</span>
                                </a>
                                <p class="text-gray-500 text-sm mt-4">Press Enter or click to begin</p>
                            @else
                                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6">
                                    <p class="text-yellow-800 font-medium flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                        Please login or signup to start the quiz
                                    </p>
                                </div>
                                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                    <a href="/user-signup-quiz" 
                                       class="start-btn inline-flex items-center justify-center gap-2 text-white px-8 py-4 rounded-xl font-bold text-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                        </svg>
                                        <span>Sign Up to Start</span>
                                    </a>
                                    <a href="/user-login-quiz" 
                                       class="inline-flex items-center justify-center gap-2 bg-white border-2 border-green-700 text-green-700 hover:bg-green-50 px-8 py-4 rounded-xl font-bold text-lg transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                        </svg>
                                        <span>Login to Start</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Good Luck Message -->
                <div class="text-center animate-fade-in animate-delay-4">
                    <p class="text-gray-500 flex items-center justify-center gap-2">
                        <span class="text-2xl">🍀</span>
                        <span class="font-medium">Good luck! You've got this!</span>
                        <span class="text-2xl">🍀</span>
                    </p>
                </div>
            </div>
        @endif
    </div>
    
    @if(!session('user') && !session('admin'))
        @include('components.lead-modal', ['closable' => true])
    @endif
    
    <script>
        // Keyboard shortcut to start quiz
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                const startBtn = document.querySelector('.start-btn');
                if (startBtn && startBtn.getAttribute('href')) {
                    window.location.href = startBtn.getAttribute('href');
                }
            }
        });
    </script>
</body>
</html>
