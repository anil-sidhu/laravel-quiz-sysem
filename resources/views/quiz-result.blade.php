<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <title>Quiz Result | The Coding Skills</title>
    @vite('resources/css/app.css')
    <style>
        @php
            $percentage = ($correctAnswers * 100) / count($resultData);
            $strokeColor = $percentage >= 70 ? '#059669' : ($percentage >= 50 ? '#d97706' : '#dc2626');
        @endphp
        
        .score-circle {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: conic-gradient(
                {{ $strokeColor }} {{ $percentage * 3.6 }}deg,
                #e5e7eb {{ $percentage * 3.6 }}deg
            );
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .score-circle::before {
            content: '';
            position: absolute;
            width: 140px;
            height: 140px;
            background: white;
            border-radius: 50%;
        }
        .score-inner {
            position: relative;
            z-index: 1;
            text-align: center;
        }
        .result-card {
            transition: all 0.3s ease;
        }
        .result-card:hover {
            transform: translateY(-2px);
        }
        .expand-btn {
            transition: transform 0.3s ease;
        }
        .expand-btn.expanded {
            transform: rotate(180deg);
        }
        .answer-details {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
        }
        .answer-details.expanded {
            max-height: 200px;
            padding-top: 12px;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in {
            animation: fadeInUp 0.5s ease forwards;
        }
        .animate-delay-1 { animation-delay: 0.1s; opacity: 0; }
        .animate-delay-2 { animation-delay: 0.2s; opacity: 0; }
        .animate-delay-3 { animation-delay: 0.3s; opacity: 0; }
        .certificate-btn {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: #ffffff !important;
            box-shadow: 0 4px 15px rgba(5, 150, 105, 0.4);
            transition: all 0.3s ease;
        }
        .certificate-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(5, 150, 105, 0.5);
        }
    </style>
</head>
<body>
  <x-user-navbar></x-user-navbar> 
    
    @php
        $totalQuestions = count($resultData);
        $percentage = round(($correctAnswers * 100) / $totalQuestions);
        $isPassed = $percentage >= 70;
        $quizName = session('currentQuiz')['quizName'] ?? 'Quiz';
        
        // Store score in session for certificate generation
        $currentQuiz = session('currentQuiz', []);
        $currentQuiz['score'] = $percentage;
        session(['currentQuiz' => $currentQuiz]);
    @endphp
    
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4">
        <div class="max-w-4xl mx-auto">
            
            <!-- Result Header Card -->
            <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 mb-6 animate-fade-in">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    
                    <!-- Score Circle -->
                    <div class="flex-shrink-0">
                        <div class="score-circle shadow-lg">
                            <div class="score-inner">
                                <div class="text-4xl font-bold {{ $isPassed ? 'text-green-600' : ($percentage >= 50 ? 'text-yellow-600' : 'text-red-600') }}">
                                    {{ $percentage }}%
                                </div>
                                <div class="text-gray-500 text-sm">Score</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Result Details -->
                    <div class="flex-grow text-center md:text-left">
                        <h1 class="text-3xl sm:text-4xl font-bold mb-2 {{ $isPassed ? 'text-green-700' : ($percentage >= 50 ? 'text-yellow-700' : 'text-red-700') }}">
                            @if($isPassed)
                                Congratulations!
                            @elseif($percentage >= 50)
                                Good Effort!
                            @else
                                Keep Practicing!
                            @endif
                        </h1>
                        <p class="text-gray-600 text-lg mb-4">
                            You got <span class="font-bold text-green-600">{{ $correctAnswers }}</span> out of 
                            <span class="font-bold">{{ $totalQuestions }}</span> questions correct
                        </p>
                        
                        <!-- Stats Badges -->
                        <div class="flex flex-wrap justify-center md:justify-start gap-3 mb-6">
                            <div class="bg-green-100 text-green-800 px-4 py-2 rounded-full flex items-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-semibold">{{ $correctAnswers }} Correct</span>
                            </div>
                            <div class="bg-red-100 text-red-800 px-4 py-2 rounded-full flex items-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-semibold">{{ $totalQuestions - $correctAnswers }} Incorrect</span>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row flex-wrap justify-center md:justify-start gap-3">
                            @if($isPassed)
                                <a href="/certificate" class="certificate-btn px-8 py-4 rounded-xl font-bold text-lg inline-flex items-center justify-center gap-3">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                    </svg>
                                    <span style="color: #ffffff !important;">Download Certificate</span>
                                </a>
        @endif
                            <a href="/" class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-6 py-4 rounded-xl font-semibold text-lg inline-flex items-center justify-center gap-2 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                <span>Try Another Quiz</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Detailed Results -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in animate-delay-1">
                <div class="bg-gradient-to-r from-green-700 to-green-800 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Detailed Review
                    </h2>
                </div>
                
                <div class="divide-y divide-gray-100">
                    @foreach($resultData as $key => $item)
                        <div class="result-card p-4 sm:p-5 {{ $item->is_correct ? 'bg-green-50/50' : 'bg-red-50/50' }} hover:bg-opacity-75">
                            <div class="flex items-start gap-4">
                                <!-- Question Number -->
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white {{ $item->is_correct ? 'bg-green-500' : 'bg-red-500' }}">
                                        {{ $key + 1 }}
                                    </div>
                                </div>
                                
                                <!-- Question Content -->
                                <div class="flex-grow min-w-0">
                                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 sm:gap-4">
                                        <p class="text-gray-800 font-medium leading-relaxed flex-grow">{{ $item->question }}</p>
                                        
                                        <!-- Status Badge -->
                                        <div class="flex-shrink-0">
                    @if($item->is_correct)
                                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Correct
                                                </span>
                    @else
                                                <button onclick="toggleAnswer({{ $key }})" class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800 hover:bg-red-200 transition-colors cursor-pointer">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Incorrect
                                                    <svg class="w-4 h-4 expand-btn" id="expand-{{ $key }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                    </svg>
                                                </button>
                    @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Answer Details (for incorrect answers) -->
                                    @if(!$item->is_correct)
                                        <div id="answer-{{ $key }}" class="answer-details mt-3 border-t border-red-200">
                                            <div class="grid sm:grid-cols-2 gap-3 pt-3">
                                                <div class="bg-red-100 rounded-lg p-3">
                                                    <p class="text-xs text-red-600 font-semibold mb-1">Your Answer</p>
                                                    <p class="text-red-800 font-medium">{{ $item->user_answer ?? 'Not answered' }}</p>
                                                </div>
                                                <div class="bg-green-100 rounded-lg p-3">
                                                    <p class="text-xs text-green-600 font-semibold mb-1">Correct Answer</p>
                                                    <p class="text-green-800 font-medium">{{ $item->correct_answer ?? 'Option ' . strtoupper($item->correct_ans ?? '') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Bottom Actions -->
            <div class="mt-6 text-center animate-fade-in animate-delay-2">
                <p class="text-gray-500 mb-4">Want to improve your score?</p>
                <a href="/" class="inline-flex items-center gap-2 text-green-700 hover:text-green-800 font-semibold transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Browse More Quizzes
                </a>
            </div>
        </div>
    </div>
    
<x-footer-user></x-footer-user>
    
    <script>
        function toggleAnswer(index) {
            const details = document.getElementById(`answer-${index}`);
            const expandBtn = document.getElementById(`expand-${index}`);
            
            details.classList.toggle('expanded');
            expandBtn.classList.toggle('expanded');
        }
        
        // Auto-expand all incorrect answers after 2 seconds
        setTimeout(() => {
            document.querySelectorAll('.answer-details').forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add('expanded');
                    document.getElementById(`expand-${el.id.split('-')[1]}`)?.classList.add('expanded');
                }, index * 100);
            });
        }, 1500);
        
        // Clear quiz timer from session storage on results page
        sessionStorage.clear();
    </script>
</body>
</html>
