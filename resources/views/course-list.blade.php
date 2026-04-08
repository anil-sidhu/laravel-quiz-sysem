<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>All Courses | React, Angular, Laravel & More | The Coding Skills</title>
    <meta name="description" content="Explore our complete catalog of courses covering various programming languages, frameworks, and development technologies.">
    <meta name="keywords" content="@foreach($courses as $course) {{$course->title}}, @endforeach">
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
        
        .gradient-text-pink {
            background: linear-gradient(135deg, #ec4899 0%, #f97316 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
        }
        
        .course-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }
        
        .course-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ec4899, #f97316);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        
        .course-card:hover::before {
            transform: scaleX(1);
        }
        
        .course-card:hover {
            border-color: rgba(236, 72, 153, 0.4);
            box-shadow: 0 0 50px rgba(236, 72, 153, 0.15);
            transform: translateY(-8px);
        }
        
        .icon-gradient {
            background: linear-gradient(135deg, #ec4899 0%, #f97316 100%);
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #ec4899 0%, #f97316 100%);
            transition: all 0.3s ease;
        }
        
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px -10px rgba(236, 72, 153, 0.6);
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .search-glow:focus {
            box-shadow: 0 0 30px rgba(236, 72, 153, 0.3);
        }
    </style>
</head>
<body class="bg-slate-950 min-h-screen">
    <x-user-navbar></x-user-navbar> 
    
    <!-- Hero Section -->
    <section class="hero-gradient py-16 sm:py-24 relative overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-24 h-24 bg-pink-500/20 rounded-full blur-xl floating"></div>
            <div class="absolute top-40 right-20 w-32 h-32 bg-orange-500/20 rounded-full blur-xl floating" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-20 left-1/3 w-20 h-20 bg-purple-500/20 rounded-full blur-xl floating" style="animation-delay: 2s;"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <!-- Breadcrumb -->
                <div class="inline-flex items-center gap-2 text-slate-400 text-sm mb-6">
                    <a href="/" class="hover:text-white transition-colors">Home</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="text-pink-400">Courses</span>
                </div>
                
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 bg-pink-500/20 border border-pink-500/30 rounded-full px-4 py-2 mb-8">
                    <svg class="w-5 h-5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-pink-300 text-sm font-medium">{{ count($courses) }} Video Courses Available</span>
                </div>
                
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white mb-6">
                    Learn from 
                    <span class="gradient-text-pink">Expert Tutorials</span>
                </h1>
                <p class="text-slate-400 text-lg max-w-2xl mx-auto mb-10">
                    Master programming with our comprehensive video courses. From beginner to advanced, 
                    learn at your own pace with practical examples.
                </p>
                
                <!-- Search Bar -->
                <div class="max-w-xl mx-auto">
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" id="courseSearch" placeholder="Search courses..." 
                               class="w-full pl-12 pr-4 py-4 bg-white/5 border border-white/10 rounded-2xl text-white placeholder-slate-500 focus:outline-none focus:border-pink-500/50 search-glow transition-all"
                               onkeyup="filterCourses()">
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Courses Grid -->
    <section class="py-16 bg-slate-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filter Tags -->
            <div class="flex flex-wrap items-center gap-3 mb-10">
                <span class="text-slate-400 text-sm">Popular:</span>
                <button class="bg-white/5 hover:bg-pink-500/20 border border-white/10 hover:border-pink-500/30 text-white text-sm px-4 py-2 rounded-full transition-all" onclick="setSearch('React')">React</button>
                <button class="bg-white/5 hover:bg-pink-500/20 border border-white/10 hover:border-pink-500/30 text-white text-sm px-4 py-2 rounded-full transition-all" onclick="setSearch('JavaScript')">JavaScript</button>
                <button class="bg-white/5 hover:bg-pink-500/20 border border-white/10 hover:border-pink-500/30 text-white text-sm px-4 py-2 rounded-full transition-all" onclick="setSearch('Node')">Node.js</button>
                <button class="bg-white/5 hover:bg-pink-500/20 border border-white/10 hover:border-pink-500/30 text-white text-sm px-4 py-2 rounded-full transition-all" onclick="setSearch('Laravel')">Laravel</button>
            </div>
            
            <!-- Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="coursesGrid">
                @foreach($courses as $course)
                <div class="course-card rounded-2xl overflow-hidden course-item" data-title="{{ strtolower($course->title) }}">
                    <!-- Thumbnail Area -->
                    <div class="h-40 bg-gradient-to-br from-pink-500/20 to-orange-500/20 flex items-center justify-center relative">
                        @php
                            $courseIcons = [
                                'React' => '⚛️', 'Angular' => '🅰️', 'Laravel' => '🔴', 'Node' => '🟢',
                                'JavaScript' => '⚡', 'HTML' => '🌐', 'CSS' => '🎨', 'Python' => '🐍'
                            ];
                            $icon = '📚';
                            foreach($courseIcons as $name => $emoji) {
                                if(stripos($course->title, $name) !== false) {
                                    $icon = $emoji;
                                    break;
                                }
                            }
                        @endphp
                        <span class="text-6xl">{{ $icon }}</span>
                        
                        <!-- Play Button Overlay -->
                        <div class="absolute inset-0 flex items-center justify-center bg-black/0 hover:bg-black/30 transition-colors group cursor-pointer">
                            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="bg-pink-500 text-white text-xs px-3 py-1 rounded-full font-semibold">
                                Video Course
                            </span>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-3 line-clamp-2 group-hover:text-pink-300 transition-colors">
                            {{ $course->title }}
                        </h3>
                        
                        @if($course->description)
                        <p class="text-slate-400 text-sm mb-4 line-clamp-3">
                            {{ Str::limit($course->description, 120) }}
                        </p>
                        @endif
                        
                        <!-- Meta -->
                        <div class="flex items-center gap-3 mb-4">
                            <span class="flex items-center gap-1 text-slate-400 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Self-paced
                            </span>
                            <span class="flex items-center gap-1 text-slate-400 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                                </svg>
                                Hindi
                            </span>
                        </div>
                        
                        <!-- CTA Button -->
                        <a href="/course-details/{{$course->id}}/{{str_replace(' ', '-',$course->title)}}" 
                           class="btn-gradient w-full py-3 rounded-xl text-white font-semibold flex items-center justify-center gap-2">
                            <span>View Course</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Empty State -->
            <div id="emptyState" class="hidden text-center py-16">
                <div class="text-6xl mb-4">🎬</div>
                <h3 class="text-2xl font-bold text-white mb-2">No courses found</h3>
                <p class="text-slate-400">Try adjusting your search term</p>
            </div>
        </div>
    </section>
    
    <x-footer-user></x-footer-user>
    
    <script>
        function filterCourses() {
            const searchTerm = document.getElementById('courseSearch').value.toLowerCase();
            const cards = document.querySelectorAll('.course-item');
            const emptyState = document.getElementById('emptyState');
            let visibleCount = 0;
            
            cards.forEach(card => {
                const title = card.getAttribute('data-title');
                if (title.includes(searchTerm)) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        }
        
        function setSearch(term) {
            document.getElementById('courseSearch').value = term;
            filterCourses();
        }
    </script>
</body>
</html>
