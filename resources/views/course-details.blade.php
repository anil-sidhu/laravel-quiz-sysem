<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <title>{{$course->title}} | Free coding course | Free tutorial, notes and code</title>
    <meta name="description" content="{{$course->title}} | {{$course->description}}">
    <meta name="keywords" content="{{$course->title}}, free {{$course->title}}, {{$course->title}} notes, {{$course->title}} code, Free tutorial ">
    @vite('resources/css/app.css')
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
        }
        .card-gradient {
            background: linear-gradient(145deg, rgba(30, 41, 59, 0.8) 0%, rgba(15, 23, 42, 0.9) 100%);
            border: 1px solid rgba(139, 92, 246, 0.1);
        }
        .card-gradient:hover {
            border-color: rgba(139, 92, 246, 0.3);
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -15px rgba(139, 92, 246, 0.2);
        }
        .live-training-cta {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.9) 0%, rgba(15, 23, 42, 0.95) 100%);
            border: 1px solid rgba(16, 185, 129, 0.35);
        }
        .btn-gradient {
            background: linear-gradient(135deg, #7c3aed 0%, #2563eb 100%);
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px -10px rgba(124, 58, 237, 0.5);
        }
        .topic-number {
            background: linear-gradient(135deg, #7c3aed 0%, #2563eb 100%);
        }
        .glow-text {
            text-shadow: 0 0 40px rgba(139, 92, 246, 0.3);
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        .progress-bar {
            background: linear-gradient(90deg, #7c3aed, #2563eb, #06b6d4);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }
        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>
</head>
<body class="gradient-bg min-h-screen">
    <x-user-navbar></x-user-navbar> 
    
    <!-- Hero Section -->
    <div class="relative overflow-hidden py-16 px-4">
        <!-- Background decorations -->
        <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
        
        <div class="max-w-6xl mx-auto relative z-10">
            <!-- Breadcrumb -->
            <div class="flex items-center gap-2 text-sm text-slate-400 mb-6">
                <a href="/" class="hover:text-white transition">Home</a>
                <span>›</span>
                <a href="/courses" class="hover:text-white transition">Courses</a>
                <span>›</span>
                <span class="text-purple-400">{{$course->title}}</span>
            </div>
            
            <!-- Course Title -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-purple-500/20 border border-purple-500/30 rounded-full text-purple-300 text-sm mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Free Video Course
                </div>
                <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4 glow-text">{{$course->title}}</h1>
                <p class="text-slate-400 text-lg max-w-2xl mx-auto">{{ $course->description ?? 'Complete tutorial with notes and source code' }}</p>
                
                <!-- Stats -->
                <div class="flex flex-wrap justify-center gap-6 mt-8">
                    <div class="flex items-center gap-2 text-slate-300">
                        <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <span><strong class="text-white">{{ count($topics) }}</strong> Topics</span>
                    </div>
                    <div class="flex items-center gap-2 text-slate-300">
                        <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span><strong class="text-white">Free</strong> Forever</span>
                    </div>
                    <div class="flex items-center gap-2 text-slate-300">
                        <div class="w-10 h-10 bg-emerald-500/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span><strong class="text-white">Source Code</strong> Included</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="max-w-6xl mx-auto px-4 pb-16">
        <!-- Live training CTA -->
        <div class="live-training-cta rounded-2xl p-6 sm:p-8 mb-12 relative overflow-hidden">
            <div class="absolute -top-20 -right-20 w-40 h-40 bg-emerald-500/15 rounded-full blur-3xl float-animation"></div>
            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="flex-1">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-sm mb-4">
                        Live instructor-led training
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-white mb-3">Prefer live classes &amp; mentorship?</h2>
                    <p class="text-slate-400 max-w-xl">We run live MERN and MEAN programs. Meeting links and updates are shared by SMS or WhatsApp. Call or message us to learn more.</p>
                    <p class="text-amber-200/90 text-sm mt-3">Money-back guarantee — ask us for full terms.</p>
                </div>
                <div class="flex flex-col sm:flex-row flex-shrink-0 gap-3">
                    <a href="tel:+919958194988" class="btn-gradient text-white px-6 py-3 rounded-xl font-semibold inline-flex items-center justify-center gap-2 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        Call now
                    </a>
                    <a href="https://wa.me/919958194988" target="_blank" rel="noopener noreferrer" class="bg-emerald-600 hover:bg-emerald-500 text-white px-6 py-3 rounded-xl font-semibold inline-flex items-center justify-center gap-2 transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.435 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Topics Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-white flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-blue-500 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                    </div>
                    Course Content
                </h2>
                <span class="text-slate-400 text-sm">{{ count($topics) }} lessons</span>
            </div>
            
            <!-- Progress indicator -->
            <div class="mb-8 bg-slate-800/50 rounded-full p-1">
                <div class="progress-bar h-2 rounded-full" style="width: 0%"></div>
            </div>
        </div>
        
        <!-- Topics Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            @foreach($topics as $index => $topic)
            <a href="/topic/{{$topic->course_id}}/{{$topic->id}}/{{str_replace(' ', '-',$topic->title)}}" 
               class="card-gradient rounded-xl p-5 flex gap-4 transition-all duration-300 group">
                <!-- Topic Number -->
                <div class="flex-shrink-0">
                    <div class="topic-number w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </div>
                </div>
                
                <!-- Topic Content -->
                <div class="flex-1 min-w-0">
                    <h3 class="text-white font-semibold text-lg mb-2 group-hover:text-purple-300 transition-colors truncate">
                        {{$topic->title}}
                    </h3>
                    <div class="flex items-center gap-4 text-sm">
                        <span class="text-slate-500 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $topic->created_at ? $topic->created_at->format('M d, Y') : '-' }}
                        </span>
                        <span class="text-purple-400 font-medium group-hover:translate-x-1 transition-transform flex items-center gap-1">
                            Read
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </div>
                </div>
                
                <!-- Hover indicator -->
                <div class="flex-shrink-0 self-center opacity-0 group-hover:opacity-100 transition-opacity">
                    <div class="w-8 h-8 bg-purple-500/20 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        
        @if(count($topics) == 0)
        <div class="text-center py-16">
            <div class="w-20 h-20 bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-white mb-2">Content Coming Soon</h3>
            <p class="text-slate-400">This course is being prepared. Check back soon!</p>
        </div>
        @endif
    </div>
    
    <x-footer-user></x-footer-user>
    
    @if(!session('user') && !session('admin'))
        @include('components.lead-modal', ['closable' => true])
    @endif

</body>
</html>
