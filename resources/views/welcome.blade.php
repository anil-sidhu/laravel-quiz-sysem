<!DOCTYPE html>
<html lang="en">
<head>
    <x-common></x-common>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>The Coding Skills | Master Programming with Quizzes & Courses</title>
    <meta name="description" content="Find coding & programming MCQs, Interview questions, notes and code for code step by step YouTube Channel in various programming languages | Anil Sidhu" />
    <meta name="keywords" content="Anil Sidhu, Interview Questions, programming language mcqs, technology quizzes for developers, coding video summaries, programming notes pdf, code snippets library, software development practice, web development mcqs, data science mcqs, the coding skills" />
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #7c3aed 0%, #2563eb 50%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .gradient-text-orange {
            background: linear-gradient(135deg, #f97316 0%, #ec4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
        }
        
        .card-gradient {
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.1) 0%, rgba(37, 99, 235, 0.1) 100%);
        }
        
        .glow-card {
            transition: all 0.3s ease;
        }
        
        .glow-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px -15px rgba(124, 58, 237, 0.4);
        }
        
        .category-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .category-card:hover {
            border-color: rgba(124, 58, 237, 0.5);
            box-shadow: 0 0 30px rgba(124, 58, 237, 0.3);
            transform: translateY(-5px);
        }
        
        .quiz-card {
            background: linear-gradient(135deg, #7c3aed 0%, #2563eb 100%);
            transition: all 0.3s ease;
        }
        
        .quiz-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 40px -10px rgba(124, 58, 237, 0.5);
        }
        
        .course-card {
            background: linear-gradient(135deg, #ec4899 0%, #f97316 100%);
            transition: all 0.3s ease;
        }
        
        .course-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 40px -10px rgba(236, 72, 153, 0.5);
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .pulse-glow {
            animation: pulseGlow 2s ease-in-out infinite;
        }
        
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 20px rgba(124, 58, 237, 0.4); }
            50% { box-shadow: 0 0 40px rgba(124, 58, 237, 0.8); }
        }
        
        .stat-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .section-gradient {
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #7c3aed 0%, #2563eb 100%);
            transition: all 0.3s ease;
        }
        
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px -10px rgba(124, 58, 237, 0.6);
        }
        
        .search-glow:focus {
            box-shadow: 0 0 30px rgba(124, 58, 237, 0.4);
        }

        /* Live training program cards (homepage) */
        .lt-card {
            position: relative;
            transition: transform 0.35s ease, box-shadow 0.35s ease;
        }
        .lt-card:hover {
            transform: translateY(-6px);
        }
        .lt-card-inner {
            position: relative;
            border-radius: 1rem;
            overflow: hidden;
            height: 100%;
            min-height: 260px;
        }
        .lt-card-glow {
            position: absolute;
            inset: -40% -20% auto auto;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            filter: blur(48px);
            opacity: 0.45;
            transition: opacity 0.35s ease;
        }
        .lt-card:hover .lt-card-glow {
            opacity: 0.7;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 antialiased">
    <x-user-navbar></x-user-navbar>
    
    <!-- Success Message -->
    @if(session('message-success'))
    <div class="fixed top-24 left-1/2 transform -translate-x-1/2 z-50" id="successMessage">
        <div class="bg-emerald-500/20 border border-emerald-500/50 text-emerald-300 px-6 py-4 rounded-xl backdrop-blur-sm">
            <p class="font-semibold">{{session('message-success')}}</p>
        </div>
    </div>
    @endif
    
    <!-- Hero Section -->
    <section class="hero-gradient min-h-[70vh] relative overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-20 h-20 bg-purple-500/20 rounded-full blur-xl floating"></div>
            <div class="absolute top-40 right-20 w-32 h-32 bg-blue-500/20 rounded-full blur-xl floating" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-20 left-1/4 w-24 h-24 bg-cyan-500/20 rounded-full blur-xl floating" style="animation-delay: 2s;"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 relative z-10">
            <div class="text-center">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 bg-purple-500/20 border border-purple-500/30 rounded-full px-4 py-2 mb-8">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                    <span class="text-purple-300 text-sm font-medium">Free Quizzes & Courses Available</span>
                </div>
                
                <!-- Headline -->
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold text-white mb-6 leading-tight">
                    Master Your
                    <span class="gradient-text"> Programming</span>
                    <br class="hidden sm:block" />
                    Skills Today
                </h1>
                
                <p class="text-slate-400 text-lg sm:text-xl max-w-2xl mx-auto mb-8">
                    Practice with 1000+ MCQs, learn from video tutorials, and earn certificates. 
                    Level up your coding journey with The Coding Skills.
                </p>

                <div class="flex flex-col sm:flex-row flex-wrap items-center justify-center gap-3 mb-4">
                    <a href="tel:+919958194988" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/15 border border-white/15 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        Call +91 99581 94988
                    </a>
                    <a href="https://wa.me/919958194988" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-emerald-600/90 hover:bg-emerald-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.435 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        WhatsApp
                    </a>
                </div>
                <p class="mb-10 max-w-xl mx-auto text-center rounded-xl border border-amber-400/30 bg-amber-950/50 px-4 py-3 text-sm sm:text-base font-medium text-amber-100 shadow-[0_0_24px_-8px_rgba(251,191,36,0.35)]">
                    <strong class="text-amber-50">Money-back guarantee</strong> — we stand behind our live training. Speak with us for full terms.
                </p>
                
                <!-- Search Bar -->
                <form action="/search-quiz" method="GET" class="max-w-xl mx-auto mb-12">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Search quizzes, courses..." 
                               class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-2xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 search-glow transition-all">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 btn-gradient px-6 py-2 rounded-xl text-white font-semibold">
                            Search
                        </button>
                    </div>
                </form>
                
                <!-- Stats -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 max-w-3xl mx-auto">
                    <div class="stat-card rounded-2xl p-4">
                        <div class="text-3xl font-bold text-white">{{ count($categories) }}+</div>
                        <div class="text-slate-400 text-sm">Categories</div>
                    </div>
                    <div class="stat-card rounded-2xl p-4">
                        <div class="text-3xl font-bold text-white">{{ count($quizData) }}+</div>
                        <div class="text-slate-400 text-sm">Quizzes</div>
                    </div>
                    <div class="stat-card rounded-2xl p-4">
                        <div class="text-3xl font-bold text-white">{{ count($courses) }}+</div>
                        <div class="text-slate-400 text-sm">Courses</div>
                    </div>
                    <div class="stat-card rounded-2xl p-4">
                        <div class="text-3xl font-bold text-white">80K+</div>
                        <div class="text-slate-400 text-sm">Students</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Categories Section -->
    <!-- <section class="section-gradient py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row items-center justify-between mb-12">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-white mb-2">
                        <span class="gradient-text">Explore</span> Categories
                    </h2>
                    <p class="text-slate-400">Choose from various programming topics</p>
                </div>
                <a href="/categories-list" class="mt-4 sm:mt-0 text-purple-400 hover:text-purple-300 font-semibold flex items-center gap-2 transition-colors">
                    View All
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                @php
                    $categoryIcons = [
                        'JavaScript' => '⚡', 'Node' => '🟢', 'Angular' => '🅰️', 'PHP' => '🐘',
                        'JAVA' => '☕', 'TypeScript' => '📘', 'Vue' => '💚', 'Next' => '▲',
                        'React' => '⚛️', 'Python' => '🐍', 'CSS' => '🎨', 'HTML' => '🌐',
                        'Laravel' => '🔴', 'MongoDB' => '🍃', 'SQL' => '🗃️', 'Git' => '📦'
                    ];
                @endphp
                @foreach($categories as $key => $category)
                <a href="user-quiz-list/{{$category->id}}/{{str_replace(' ','-',$category->name)}}" 
                   class="category-card rounded-2xl p-6 group cursor-pointer">
                    <div class="text-4xl mb-4">
                        @php
                            $icon = '📚';
                            foreach($categoryIcons as $name => $emoji) {
                                if(stripos($category->name, $name) !== false) {
                                    $icon = $emoji;
                                    break;
                                }
                            }
                        @endphp
                        {{ $icon }}
                    </div>
                    <h3 class="text-white font-semibold text-lg mb-2 group-hover:text-purple-300 transition-colors">
                        {{ $category->name }}
                    </h3>
                    <div class="flex items-center gap-2">
                        <span class="text-xs bg-purple-500/20 text-purple-300 px-2 py-1 rounded-full">
                            {{ $category->quizzes_count ?? 0 }} Quizzes
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section> -->

    <!-- Live instructor-led programs -->
    <section id="live-training" class="relative py-16 sm:py-24 px-4 sm:px-6 lg:px-8 overflow-hidden border-y border-white/5 bg-[#070b14]">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_50%_at_50%_-20%,rgba(124,58,237,0.15),transparent)] pointer-events-none"></div>
        <div class="relative max-w-6xl mx-auto">
            <div class="text-center mb-12 sm:mb-14">
                <span class="inline-flex items-center gap-2 text-emerald-400 text-xs sm:text-sm font-bold uppercase tracking-[0.2em] mb-4">Live training</span>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-white mb-4 tracking-tight">
                    Instructor-led <span class="gradient-text">MERN &amp; MEAN</span> programs
                </h2>
                <p class="text-slate-400 text-base sm:text-lg max-w-2xl mx-auto leading-relaxed">
                    Live sessions and meeting details are shared via <strong class="text-slate-300">SMS &amp; WhatsApp</strong>.
                    Choose a track to open the full curriculum on its own page — then call or message us to enroll.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 lg:gap-8">
                @foreach($trainingPrograms as $program)
                @php
                    $slug = $program['slug'];
                    $n = count($program['topics'] ?? []);
                    $skins = [
                        'mern-hero' => ['border' => 'from-cyan-400 via-violet-500 to-fuchsia-500', 'blob' => '#22d3ee', 'badge' => 'JS · React · Node · Mongo · AI Tools'],
                        'mern-master' => ['border' => 'from-violet-500 via-fuchsia-500 to-pink-500', 'blob' => '#a855f7', 'badge' => 'TS · Redux · System design · AI Tools'],
                        'mean-hero' => ['border' => 'from-amber-400 via-orange-500 to-red-500', 'blob' => '#fbbf24', 'badge' => 'Angular · Node · Express · AI Tools'],
                        'mean-master' => ['border' => 'from-emerald-400 via-teal-500 to-cyan-500', 'blob' => '#34d399', 'badge' => 'GenAI · Full-stack projects · AI Tools'],
                    ];
                    $skin = $skins[$slug] ?? ['border' => 'from-violet-500 to-blue-500', 'blob' => '#7c3aed', 'badge' => 'Live cohort'];
                @endphp
                <a href="{{ route('live-training.show', $program['slug']) }}" class="lt-card group block rounded-2xl p-[1px] bg-gradient-to-br {{ $skin['border'] }} text-slate-100 no-underline shadow-lg shadow-black/40 hover:shadow-2xl hover:shadow-violet-500/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-violet-400 focus-visible:ring-offset-2 focus-visible:ring-offset-[#070b14] visited:text-slate-100">
                    <div class="lt-card-inner bg-slate-950/95 backdrop-blur-md border border-white/5 text-slate-100">
                        <div class="lt-card-glow" style="background: {{ $skin['blob'] }};"></div>
                        <div class="relative p-6 sm:p-8 flex flex-col h-full">
                            <div class="flex items-start justify-between gap-4 mb-6">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold uppercase tracking-wider bg-white/5 text-white/80 border border-white/10">
                                    Live cohort
                                </span>
                                <span class="text-slate-400 text-sm font-medium tabular-nums">{{ $n }} modules</span>
                            </div>
                            <h3 class="text-2xl sm:text-3xl font-extrabold text-white mb-2 tracking-tight group-hover:text-white transition-colors">
                                {{ $program['title'] }}
                            </h3>
                            @if(!empty($program['subtitle']))
                            <p class="text-slate-300 text-sm sm:text-base mb-5 leading-relaxed">{{ $program['subtitle'] }}</p>
                            @endif
                            <p class="text-xs text-cyan-200/90 sm:text-sm font-semibold mb-8 font-mono tracking-wide text-balance">{{ $skin['badge'] }}</p>
                            <div class="mt-auto flex items-center justify-between pt-4 border-t border-white/10">
                                <span class="text-sm font-semibold text-violet-200 group-hover:text-white flex items-center gap-2">
                                    View full curriculum
                                    <svg class="w-5 h-5 text-violet-300 group-hover:text-white group-hover:translate-x-1 transition-all shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </span>
                                <span class="flex -space-x-1">
                                    <span class="w-8 h-8 rounded-full bg-gradient-to-br from-white/20 to-white/5 border border-white/10 flex items-center justify-center text-[10px] font-bold text-white/70">▶</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <p class="text-center mt-10 max-w-xl mx-auto rounded-xl border border-amber-400/25 bg-amber-950/45 px-4 py-3 text-sm text-amber-100">
                <strong class="text-amber-50">Money-back guarantee</strong> — ask us for full terms when you get in touch.
            </p>
        </div>
    </section>
    
    <!-- Top Quizzes Section -->
    <section class="section-gradient py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
                    <span class="gradient-text-orange">Popular</span> Quizzes
                </h2>
                <p class="text-slate-400 max-w-2xl mx-auto">Test your knowledge with our most attempted quizzes</p>
            </div>
            
            <!-- Quizzes Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($quizData as $item)
                <a href="/start-quiz/{{$item->id}}/{{str_replace(' ','-',$item->name)}}" 
                   class="quiz-card rounded-2xl p-6 group cursor-pointer relative overflow-hidden">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                            <defs>
                                <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                                    <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                                </pattern>
                            </defs>
                            <rect width="100" height="100" fill="url(#grid)"/>
                        </svg>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                            </div>
                            <span class="bg-white/20 text-white text-xs px-3 py-1 rounded-full">
                                {{ $item->records_count ?? rand(10, 100) }} attempts
                            </span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-white/90 transition-colors">
                            {{ $item->name }}
                        </h3>
                        
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-white/70 text-sm">Start Quiz →</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    
    <!-- Courses Section -->
    <!-- <section class="py-16 sm:py-24 bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row items-center justify-between mb-12">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-white mb-2">
                        <span class="gradient-text">Learn</span> with Courses
                    </h2>
                    <p class="text-slate-400">Comprehensive video tutorials for every level</p>
                </div>
                <a href="/courses" class="mt-4 sm:mt-0 text-purple-400 hover:text-purple-300 font-semibold flex items-center gap-2 transition-colors">
                    View All Courses
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courses as $course)
                <a href="/course-details/{{$course->id}}/{{str_replace(' ', '-',$course->title)}}" 
                   class="course-card rounded-2xl p-6 group cursor-pointer relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10">
                        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                            <circle cx="80" cy="20" r="30" fill="white"/>
                            <circle cx="20" cy="80" r="20" fill="white"/>
                        </svg>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        
                        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-white/90 transition-colors line-clamp-2">
                            {{ $course->title }}
                        </h3>
                        
                        <div class="flex items-center gap-2 mt-4">
                            <span class="bg-white/20 text-white text-xs px-3 py-1 rounded-full">
                                Video Course
                            </span>
                            <span class="text-white/70 text-sm ml-auto">View →</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section> -->
    
    <x-footer-user></x-footer-user>
    
    @if(!session('user') && !session('admin'))
        @include('components.lead-modal', ['closable' => true])
    @endif

    <script>
        // Auto-hide success messages
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.getElementById('successMessage');
            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.transition = 'opacity 0.5s ease-out';
                    successMessage.style.opacity = '0';
                    setTimeout(function() {
                        successMessage.style.display = 'none';
                    }, 500);
                }, 5000);
            }
        });
    </script>
</body>
</html>
