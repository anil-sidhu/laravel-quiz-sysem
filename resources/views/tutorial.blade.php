<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{$currentTopic->title}} | programming courses | The Coding Skills | Anil Sidhu</title>
    <meta name="description" content="{{$currentTopic->title}}, {{$currentTopic->keywords}} notes from coding code step by step YouTube Channel">
    <meta name="keywords" content="{{$currentTopic->title}}, {{$currentTopic->keywords}}, Anil Sidhu">
    @vite('resources/css/app.css')

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
        }
        
        .sidebar-gradient {
            background: linear-gradient(180deg, rgba(30, 41, 59, 0.95) 0%, rgba(15, 23, 42, 0.98) 100%);
            border-right: 1px solid rgba(139, 92, 246, 0.1);
        }
        
        .sidebar-gradient-right {
            background: linear-gradient(180deg, rgba(30, 41, 59, 0.95) 0%, rgba(15, 23, 42, 0.98) 100%);
            border-left: 1px solid rgba(139, 92, 246, 0.1);
        }
        
        .topic-link {
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .topic-link:hover, .topic-link.active {
            background: rgba(139, 92, 246, 0.1);
            border-left-color: #8b5cf6;
        }
        
        .course-link {
            transition: all 0.3s ease;
        }
        
        .course-link:hover {
            background: rgba(139, 92, 246, 0.1);
            transform: translateX(4px);
        }
        
        .video-container {
            background: linear-gradient(145deg, rgba(30, 41, 59, 0.8) 0%, rgba(15, 23, 42, 0.9) 100%);
            border: 1px solid rgba(139, 92, 246, 0.2);
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 20px 60px -20px rgba(139, 92, 246, 0.3);
        }
        
        .content-card {
            background: linear-gradient(145deg, rgba(30, 41, 59, 0.6) 0%, rgba(15, 23, 42, 0.8) 100%);
            border: 1px solid rgba(139, 92, 246, 0.1);
        }
        
        /* Content Typography */
        .prose-dark h1, .prose-dark h2, .prose-dark h3, .prose-dark h4, .prose-dark h5, .prose-dark h6 {
            color: #f1f5f9;
            margin: 1.5em 0 0.75em;
            font-weight: 600;
            line-height: 1.3;
        }
        
        .prose-dark h1 { font-size: 1.875em; }
        .prose-dark h2 { font-size: 1.5em; border-bottom: 1px solid rgba(139, 92, 246, 0.2); padding-bottom: 0.5em; }
        .prose-dark h3 { font-size: 1.25em; }
        .prose-dark h4 { font-size: 1.125em; }
        
        .prose-dark p {
            color: #cbd5e1;
            margin: 1em 0;
            line-height: 1.75;
            font-size: 1.0625rem;
        }
        
        .prose-dark strong, .prose-dark b {
            color: #f1f5f9;
            font-weight: 600;
        }
        
        .prose-dark em, .prose-dark i {
            color: #a5b4fc;
            font-style: italic;
        }
        
        .prose-dark ul, .prose-dark ol {
            color: #cbd5e1;
            margin: 1em 0;
            padding-left: 1.75em;
        }
        
        .prose-dark ul { list-style-type: disc; }
        .prose-dark ol { list-style-type: decimal; }
        
        .prose-dark li {
            margin: 0.5em 0;
            line-height: 1.6;
        }
        
        .prose-dark li::marker {
            color: #8b5cf6;
        }
        
        .prose-dark a {
            color: #a78bfa;
            text-decoration: underline;
            text-underline-offset: 2px;
            transition: color 0.2s;
        }
        
        .prose-dark a:hover {
            color: #c4b5fd;
        }
        
        .prose-dark code {
            background: rgba(139, 92, 246, 0.2) !important;
            color: #e879f9 !important;
            padding: 0.2em 0.4em;
            border-radius: 0.375rem;
            font-size: 0.875em;
            font-family: 'Fira Code', 'Monaco', monospace;
        }
        
        .prose-dark pre {
            background: rgba(15, 23, 42, 0.8) !important;
            border: 1px solid rgba(139, 92, 246, 0.2);
            border-radius: 0.75rem;
            padding: 1.25rem;
            overflow-x: auto;
            margin: 1.5em 0;
        }
        
        .prose-dark pre code {
            background: transparent !important;
            padding: 0;
            color: #e2e8f0 !important;
        }
        
        .prose-dark blockquote {
            border-left: 4px solid #8b5cf6;
            background: rgba(139, 92, 246, 0.1);
            padding: 1rem 1.5rem;
            margin: 1.5em 0;
            border-radius: 0 0.5rem 0.5rem 0;
            color: #cbd5e1;
        }
        
        .prose-dark img {
            border-radius: 0.75rem;
            max-width: 100%;
            height: auto;
        }
        
        .prose-dark hr {
            border: none;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.3), transparent);
            margin: 2em 0;
        }
        
        .prose-dark table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5em 0;
        }
        
        .prose-dark th, .prose-dark td {
            border: 1px solid rgba(139, 92, 246, 0.2);
            padding: 0.75rem 1rem;
            text-align: left;
        }
        
        .prose-dark th {
            background: rgba(139, 92, 246, 0.1);
            color: #f1f5f9;
            font-weight: 600;
        }
        
        .prose-dark td {
            color: #cbd5e1;
        }
        
        .prose-dark span {
            background-color: transparent !important;
        }

        /* Video responsive */
        iframe, video, embed, object {
            max-width: 100% !important;
            width: 100% !important;
            height: auto !important;
            aspect-ratio: 16/9;
            border-radius: 0.5rem;
        }

        .truncate-2-lines {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Mobile sidebar */
        .mobile-sidebar-toggle {
            display: none;
        }

        @media (max-width: 1024px) {
            .mobile-sidebar-toggle {
                display: flex;
            }
            
            .sidebar {
                display: none;
            }
            
            .sidebar.active {
                display: block;
                position: fixed;
                top: 0;
                left: 0;
                width: 85%;
                max-width: 320px;
                height: 100vh;
                z-index: 50;
                overflow-y: auto;
            }
            
            .sidebar-right.active {
                left: auto;
                right: 0;
            }
        }
        
        .sidebar-overlay {
            display: none;
        }
        
        .sidebar-overlay.active {
            display: block;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 40;
        }

        /* Scrollbar styling */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.5);
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(139, 92, 246, 0.3);
            border-radius: 3px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(139, 92, 246, 0.5);
        }
    </style>
</head>
<body class="gradient-bg">
    <x-user-navbar></x-user-navbar> 
    
    <!-- Sidebar Overlay -->
    <div id="sidebar-overlay" class="sidebar-overlay"></div>
    
    <div class="flex min-h-screen w-full max-w-full overflow-x-hidden">
        
        <!-- Mobile Toggle Buttons -->
        <div class="fixed bottom-6 left-4 z-30 flex flex-col gap-3 lg:hidden">
            <button id="mobile-sidebar-toggle" class="mobile-sidebar-toggle w-12 h-12 bg-gradient-to-br from-purple-600 to-blue-600 text-white rounded-xl shadow-lg shadow-purple-500/30 items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <button id="mobile-courses-toggle" class="mobile-sidebar-toggle w-12 h-12 bg-gradient-to-br from-pink-600 to-orange-500 text-white rounded-xl shadow-lg shadow-pink-500/30 items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </button>
        </div>

        <!-- Left Sidebar - Playlist Topics -->
        <aside id="playlist-sidebar" class="sidebar sidebar-gradient w-72 p-5 lg:block custom-scrollbar overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-blue-500 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                    </div>
                    <h2 class="text-white font-semibold text-lg">Playlist</h2>
                </div>
                <button id="close-sidebar" class="lg:hidden text-slate-400 hover:text-white p-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div class="text-xs text-slate-500 uppercase tracking-wider mb-3 px-3">{{ count($relatedTopics) }} Topics</div>
            
            <nav class="space-y-1">
                @foreach($relatedTopics as $index => $topic)
                <a title="{{$topic->title}}" 
                   class="topic-link flex items-start gap-3 px-3 py-3 rounded-r-lg text-sm {{ $topic->id == $currentTopic->id ? 'bg-purple-500/20 border-l-purple-500 text-white' : 'text-slate-400 hover:text-white' }}" 
                   href="/topic/{{$topic->course_id}}/{{$topic->id}}/{{str_replace(' ', '-',$topic->title)}}">
                    <span class="flex-shrink-0 w-6 h-6 bg-slate-700/50 rounded text-xs flex items-center justify-center {{ $topic->id == $currentTopic->id ? 'bg-purple-500 text-white' : 'text-slate-500' }}">
                        {{ $index + 1 }}
                    </span>
                    <span class="truncate-2-lines">{{$topic->title}}</span>
                </a>
                @endforeach
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8 w-full min-w-0">
            <!-- Breadcrumb -->
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-6 flex-wrap">
                <a href="/" class="hover:text-purple-400 transition">Home</a>
                <span>›</span>
                <a href="/courses" class="hover:text-purple-400 transition">Courses</a>
                <span>›</span>
                <span class="text-purple-400 truncate max-w-[200px]">{{$currentTopic->title}}</span>
            </div>
            
            <!-- Topic Title -->
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-6 leading-tight">
                {{$currentTopic->title}}
            </h1>

            <!-- Video Container -->
            <div class="video-container mb-8">
                <div class="p-1">
                    {!!$currentTopic->video_link!!}
                </div>
            </div>
            
            <!-- Navigation -->
            <div class="flex items-center justify-between mb-8">
                @php
                    $currentIndex = $relatedTopics->search(function($item) use ($currentTopic) {
                        return $item->id == $currentTopic->id;
                    });
                    $prevTopic = $currentIndex > 0 ? $relatedTopics[$currentIndex - 1] : null;
                    $nextTopic = $currentIndex < count($relatedTopics) - 1 ? $relatedTopics[$currentIndex + 1] : null;
                @endphp
                
                @if($prevTopic)
                <a href="/topic/{{$prevTopic->course_id}}/{{$prevTopic->id}}/{{str_replace(' ', '-',$prevTopic->title)}}" 
                   class="flex items-center gap-2 px-4 py-2 bg-slate-800/50 hover:bg-slate-700/50 border border-slate-700 rounded-lg text-slate-300 hover:text-white transition text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    <span class="hidden sm:inline">Previous</span>
                </a>
                @else
                <div></div>
                @endif
                
                <div class="flex items-center gap-2 text-slate-500 text-sm">
                    <span class="text-purple-400 font-medium">{{ $currentIndex + 1 }}</span>
                    <span>/</span>
                    <span>{{ count($relatedTopics) }}</span>
                </div>
                
                @if($nextTopic)
                <a href="/topic/{{$nextTopic->course_id}}/{{$nextTopic->id}}/{{str_replace(' ', '-',$nextTopic->title)}}" 
                   class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-500 hover:to-blue-500 rounded-lg text-white transition text-sm">
                    <span class="hidden sm:inline">Next</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                @else
                <div></div>
                @endif
            </div>

            <!-- Content -->
            <div class="content-card rounded-2xl p-6 sm:p-8">
                <div class="prose-dark max-w-none">
                    {!!$currentTopic->description!!}
                </div>
            </div>
            
            <!-- Share Section -->
            <div class="mt-8 flex flex-wrap items-center gap-4">
                <span class="text-slate-500 text-sm">Share this lesson:</span>
                <div class="flex gap-2">
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($currentTopic->title) }}" 
                       target="_blank"
                       class="w-10 h-10 bg-slate-800 hover:bg-[#1DA1F2] rounded-lg flex items-center justify-center text-slate-400 hover:text-white transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" 
                       target="_blank"
                       class="w-10 h-10 bg-slate-800 hover:bg-[#0A66C2] rounded-lg flex items-center justify-center text-slate-400 hover:text-white transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    <button onclick="navigator.clipboard.writeText(window.location.href); this.innerHTML='<svg class=\'w-4 h-4\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M5 13l4 4L19 7\'/></svg>'; setTimeout(() => this.innerHTML='<svg class=\'w-4 h-4\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z\'/></svg>', 2000)"
                            class="w-10 h-10 bg-slate-800 hover:bg-purple-600 rounded-lg flex items-center justify-center text-slate-400 hover:text-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </main>

        <!-- Right Sidebar - Related Courses -->
        <aside id="courses-sidebar" class="sidebar sidebar-right sidebar-gradient-right w-64 p-5 lg:block custom-scrollbar overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-orange-500 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h2 class="text-white font-semibold">Courses</h2>
                </div>
                <button id="close-courses-sidebar" class="lg:hidden text-slate-400 hover:text-white p-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div class="text-xs text-slate-500 uppercase tracking-wider mb-3 px-3">Explore More</div>
            
            <nav class="space-y-2">
                @foreach($courses as $course)
                <a class="course-link block px-3 py-3 rounded-lg text-sm text-slate-300 hover:text-white" 
                   href="/course-details/{{$course->id}}/{{str_replace(' ', '-',$course->title)}}">
                    <div class="truncate-2-lines font-medium">{{$course->title}}</div>
                </a>
                @endforeach
            </nav>
        </aside>

    </div>

    <x-footer-user></x-footer-user>
    
    @if(!session('user') && !session('admin'))
        @include('components.lead-modal')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modal = document.getElementById('leadModal');
                
                setTimeout(function() {
                    if (modal) {
                        modal.classList.remove('hidden');
                        document.getElementById('leadModalClose').classList.add('hidden');
                    }
                }, 5000);
                
                document.getElementById('leadTabSignup').onclick = function() {
                    document.getElementById('leadSignupForm').classList.remove('hidden');
                    document.getElementById('leadLoginForm').classList.add('hidden');
                    this.classList.add('bg-purple-600', 'text-white');
                    this.classList.remove('bg-gray-200', 'text-purple-900');
                    document.getElementById('leadTabLogin').classList.remove('bg-purple-600', 'text-white');
                    document.getElementById('leadTabLogin').classList.add('bg-gray-200', 'text-purple-900');
                };
                document.getElementById('leadTabLogin').onclick = function() {
                    document.getElementById('leadSignupForm').classList.add('hidden');
                    document.getElementById('leadLoginForm').classList.remove('hidden');
                    this.classList.add('bg-purple-600', 'text-white');
                    this.classList.remove('bg-gray-200', 'text-purple-900');
                    document.getElementById('leadTabSignup').classList.remove('bg-purple-600', 'text-white');
                    document.getElementById('leadTabSignup').classList.add('bg-gray-200', 'text-purple-900');
                };
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileToggle = document.getElementById('mobile-sidebar-toggle');
            const mobileCoursesToggle = document.getElementById('mobile-courses-toggle');
            const playlistSidebar = document.getElementById('playlist-sidebar');
            const coursesSidebar = document.getElementById('courses-sidebar');
            const closeSidebar = document.getElementById('close-sidebar');
            const closeCoursesSidebar = document.getElementById('close-courses-sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            function closeAllSidebars() {
                playlistSidebar.classList.remove('active');
                coursesSidebar.classList.remove('active');
                overlay.classList.remove('active');
            }

            mobileToggle.addEventListener('click', function() {
                closeAllSidebars();
                playlistSidebar.classList.add('active');
                overlay.classList.add('active');
            });
            
            mobileCoursesToggle.addEventListener('click', function() {
                closeAllSidebars();
                coursesSidebar.classList.add('active');
                overlay.classList.add('active');
            });

            closeSidebar.addEventListener('click', closeAllSidebars);
            closeCoursesSidebar.addEventListener('click', closeAllSidebars);
            overlay.addEventListener('click', closeAllSidebars);
        });
    </script>
</body>
</html>
