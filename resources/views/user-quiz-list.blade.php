<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{str_replace('-',' ', $category)}} MCQ Quiz | The Coding Skills</title>
    <meta name="description" content="{{str_replace('-',' ', $category)}} Quiz, {{str_replace('-',' ', $category)}} objective Questions, structured notes from coding YouTube Channel, and practical code examples">
    <meta name="keywords" content="{{str_replace('-',' ', $category)}} Quiz, {{str_replace('-',' ', $category)}} Interview Questions, programming language MCQs">
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #7c3aed 0%, #2563eb 50%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
        }
        
        .quiz-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }
        
        .quiz-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(124, 58, 237, 0.1), transparent);
            transition: left 0.5s ease;
        }
        
        .quiz-card:hover::before {
            left: 100%;
        }
        
        .quiz-card:hover {
            border-color: rgba(124, 58, 237, 0.5);
            box-shadow: 0 0 50px rgba(124, 58, 237, 0.2);
            transform: translateY(-8px);
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #7c3aed 0%, #2563eb 100%);
            transition: all 0.3s ease;
        }
        
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px -10px rgba(124, 58, 237, 0.6);
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .difficulty-easy { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
        .difficulty-medium { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }
        .difficulty-hard { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); }
    </style>
</head>
<body class="bg-slate-950 min-h-screen">
    <x-user-navbar></x-user-navbar>
    
    <!-- Hero Section -->
    <section class="hero-gradient py-16 sm:py-20 relative overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-10 left-10 w-20 h-20 bg-purple-500/20 rounded-full blur-xl floating"></div>
            <div class="absolute bottom-10 right-20 w-32 h-32 bg-blue-500/20 rounded-full blur-xl floating" style="animation-delay: 1s;"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <!-- Breadcrumb -->
                <div class="inline-flex items-center gap-2 text-slate-400 text-sm mb-6">
                    <a href="/" class="hover:text-white transition-colors">Home</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <a href="/categories-list" class="hover:text-white transition-colors">Categories</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="text-purple-400">{{ str_replace('-', ' ', $category) }}</span>
                </div>
                
                <!-- Category Icon -->
                @php
                    $categoryIcons = [
                        'JavaScript' => '⚡', 'Node' => '🟢', 'Angular' => '🅰️', 'PHP' => '🐘',
                        'JAVA' => '☕', 'TypeScript' => '📘', 'Vue' => '💚', 'Next' => '▲',
                        'React' => '⚛️', 'Python' => '🐍', 'CSS' => '🎨', 'HTML' => '🌐'
                    ];
                    $icon = '📚';
                    foreach($categoryIcons as $name => $emoji) {
                        if(stripos($category, $name) !== false) {
                            $icon = $emoji;
                            break;
                        }
                    }
                @endphp
                <div class="text-6xl mb-6">{{ $icon }}</div>
                
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white mb-4">
                    <span class="gradient-text">{{ str_replace('-', ' ', $category) }}</span>
                </h1>
                <p class="text-slate-400 text-lg max-w-2xl mx-auto">
                    Test your {{ str_replace('-', ' ', $category) }} knowledge with our curated collection of quizzes
                </p>
                
                <!-- Stats -->
                <div class="flex items-center justify-center gap-6 mt-8">
                    <div class="bg-white/5 border border-white/10 rounded-xl px-6 py-3">
                        <div class="text-2xl font-bold text-white">{{ count($quizData) }}</div>
                        <div class="text-slate-400 text-sm">Available Quizzes</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Quizzes Grid -->
    <section class="py-16 bg-slate-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(count($quizData) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($quizData as $key => $item)
                    <div class="quiz-card rounded-2xl p-6 group">
                        <div class="relative z-10">
                            <!-- Header -->
                            <div class="flex items-start justify-between mb-6">
                                <div class="w-14 h-14 bg-gradient-to-br from-purple-500/20 to-blue-500/20 rounded-xl flex items-center justify-center">
                                    <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                    </svg>
                                </div>
                                
                                <!-- Difficulty Badge -->
                                @php
                                    $mcqCount = $item->mcq_count ?? 0;
                                    $difficulty = $mcqCount > 20 ? 'hard' : ($mcqCount > 10 ? 'medium' : 'easy');
                                    $difficultyLabel = ucfirst($difficulty);
                                @endphp
                                <span class="difficulty-{{ $difficulty }} text-white text-xs px-3 py-1.5 rounded-full font-semibold">
                                    {{ $difficultyLabel }}
                                </span>
                            </div>
                            
                            <!-- Quiz Info -->
                            <h3 class="text-xl font-bold text-white mb-3 group-hover:text-purple-300 transition-colors line-clamp-2">
                                {{ $item->name }}
                            </h3>
                            
                            <!-- Meta Info -->
                            <div class="flex items-center gap-4 mb-6 text-slate-400">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $item->mcq_count }} Questions</span>
                                </div>
                            </div>
                            
                            <!-- Action Button -->
                            <a href="/start-quiz/{{$item->id}}/{{str_replace(' ','-', $item->name)}}" 
                               class="btn-gradient w-full py-3.5 rounded-xl text-white font-semibold flex items-center justify-center gap-2 group-hover:gap-3 transition-all">
                                <span>Start Quiz</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-20">
                    <div class="w-24 h-24 bg-purple-500/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">No Quizzes Available Yet</h3>
                    <p class="text-slate-400 mb-8 max-w-md mx-auto">
                        We're working on adding quizzes for this category. Check back soon or explore other categories!
                    </p>
                    <a href="/categories-list" class="btn-gradient px-8 py-3 rounded-xl text-white font-semibold inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Browse Categories
                    </a>
                </div>
            @endif
        </div>
    </section>
    
    <x-footer-user></x-footer-user>
    
    @if(!session('user') && !session('admin'))
        @include('components.lead-modal', ['closable' => true])
    @endif
</body>
</html>
