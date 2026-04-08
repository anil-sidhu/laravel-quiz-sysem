<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Progress | The Coding Skills</title>
    <meta name="description" content="View your quiz history and progress on The Coding Skills">
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
        
        .stat-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            border-color: rgba(124, 58, 237, 0.3);
            transform: translateY(-2px);
        }
        
        .quiz-history-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .quiz-history-card:hover {
            border-color: rgba(124, 58, 237, 0.3);
            box-shadow: 0 0 30px rgba(124, 58, 237, 0.1);
            transform: translateY(-3px);
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #7c3aed 0%, #2563eb 100%);
            transition: all 0.3s ease;
        }
        
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px -10px rgba(124, 58, 237, 0.6);
        }
        
        .progress-ring {
            transform: rotate(-90deg);
        }
    </style>
</head>
<body class="bg-slate-950 min-h-screen">
    <x-user-navbar></x-user-navbar> 
    
    @php
        $user = session('user');
        $completedCount = $quizRecord->where('status', 2)->count();
        $totalCount = $quizRecord->count();
        $progressPercent = $totalCount > 0 ? round(($completedCount / $totalCount) * 100) : 0;
    @endphp
    
    <!-- Hero Section -->
    <section class="hero-gradient py-12 sm:py-16 relative overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-10 left-10 w-20 h-20 bg-purple-500/20 rounded-full blur-xl floating"></div>
            <div class="absolute bottom-10 right-20 w-32 h-32 bg-blue-500/20 rounded-full blur-xl floating" style="animation-delay: 1s;"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-12">
                <!-- Profile Section -->
                <div class="text-center lg:text-left">
                    <!-- Avatar -->
                    <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-blue-500 rounded-full flex items-center justify-center text-white text-4xl font-bold mb-4 mx-auto lg:mx-0">
                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                    </div>
                    
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-2">
                        {{ $user->name ?? 'User' }}
                    </h1>
                    <p class="text-slate-400">
                        Member since {{ $user->created_at ? $user->created_at->format('M Y') : 'Recently' }}
                    </p>
                </div>
                
                <!-- Stats Cards -->
                <div class="flex-1 w-full">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <div class="stat-card rounded-2xl p-4 text-center">
                            <div class="text-3xl font-bold text-white">{{ $totalCount }}</div>
                            <div class="text-slate-400 text-sm">Total Attempts</div>
                        </div>
                        <div class="stat-card rounded-2xl p-4 text-center">
                            <div class="text-3xl font-bold text-emerald-400">{{ $completedCount }}</div>
                            <div class="text-slate-400 text-sm">Completed</div>
                        </div>
                        <div class="stat-card rounded-2xl p-4 text-center">
                            <div class="text-3xl font-bold text-yellow-400">{{ $totalCount - $completedCount }}</div>
                            <div class="text-slate-400 text-sm">In Progress</div>
                        </div>
                        <div class="stat-card rounded-2xl p-4 text-center">
                            <div class="text-3xl font-bold text-purple-400">{{ $progressPercent }}%</div>
                            <div class="text-slate-400 text-sm">Success Rate</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Quiz History Section -->
    <section class="py-12 sm:py-16 bg-slate-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-white mb-1">
                        <span class="gradient-text">Quiz</span> History
                    </h2>
                    <p class="text-slate-400">Track your learning journey</p>
                </div>
                <a href="/categories-list" class="btn-gradient px-6 py-3 rounded-xl text-white font-semibold inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Take New Quiz
                </a>
            </div>
            
            @if(count($quizRecord) > 0)
                <!-- Quiz Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($quizRecord as $key => $record)
                    <div class="quiz-history-card rounded-2xl p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500/20 to-blue-500/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            
                            @if($record->status == 2)
                                <span class="bg-emerald-500/20 text-emerald-400 text-xs px-3 py-1.5 rounded-full font-semibold flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Completed
                                </span>
                            @else
                                <span class="bg-yellow-500/20 text-yellow-400 text-xs px-3 py-1.5 rounded-full font-semibold flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    In Progress
                                </span>
                            @endif
                        </div>
                        
                        <h3 class="text-lg font-bold text-white mb-2">{{ $record->name }}</h3>
                        
                        <div class="flex items-center gap-2 text-slate-400 text-sm mb-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>Attempt #{{ $key + 1 }}</span>
                        </div>
                        
                        @if($record->status == 2)
                            <div class="pt-4 border-t border-white/10">
                                <a href="/certificate" class="text-purple-400 hover:text-purple-300 text-sm font-semibold flex items-center gap-1 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                    </svg>
                                    View Certificate
                                </a>
                            </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-20">
                    <div class="w-24 h-24 bg-purple-500/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">No Quiz History Yet</h3>
                    <p class="text-slate-400 mb-8 max-w-md mx-auto">
                        Start taking quizzes to track your progress and earn certificates!
                    </p>
                    <a href="/categories-list" class="btn-gradient px-8 py-3 rounded-xl text-white font-semibold inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Start Your First Quiz
                    </a>
                </div>
            @endif
        </div>
    </section>
    
    <x-footer-user></x-footer-user>
</body>
</html>
