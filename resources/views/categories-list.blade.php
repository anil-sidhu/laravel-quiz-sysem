<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>All Categories | The Coding Skills</title>
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
        
        .category-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #7c3aed, #2563eb, #06b6d4);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .category-card:hover::before {
            opacity: 1;
        }
        
        .category-card:hover {
            border-color: rgba(124, 58, 237, 0.5);
            box-shadow: 0 0 40px rgba(124, 58, 237, 0.2);
            transform: translateY(-8px);
        }
        
        .icon-box {
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.2) 0%, rgba(37, 99, 235, 0.2) 100%);
        }
        
        .search-glow:focus {
            box-shadow: 0 0 30px rgba(124, 58, 237, 0.3);
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="bg-slate-950 min-h-screen">
    <x-user-navbar></x-user-navbar> 
    
    @if(session('message-success'))
    <div class="fixed top-24 left-1/2 transform -translate-x-1/2 z-50">
        <div class="bg-emerald-500/20 border border-emerald-500/50 text-emerald-300 px-6 py-4 rounded-xl backdrop-blur-sm">
            <p class="font-semibold">{{session('message-success')}}</p>
        </div>
    </div>
    @endif
    
    <!-- Hero Section -->
    <section class="hero-gradient py-16 sm:py-24 relative overflow-hidden">
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
                    <span class="text-purple-400">Categories</span>
                </div>
                
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white mb-6">
                    All <span class="gradient-text">Categories</span>
                </h1>
                <p class="text-slate-400 text-lg max-w-2xl mx-auto mb-10">
                    Explore our comprehensive collection of programming topics. From web development to data science, we've got you covered.
                </p>
                
                <!-- Search Bar -->
                <div class="max-w-xl mx-auto">
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" id="categorySearch" placeholder="Search categories..." 
                               class="w-full pl-12 pr-4 py-4 bg-white/5 border border-white/10 rounded-2xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 search-glow transition-all"
                               onkeyup="filterCategories()">
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Categories Grid -->
    <section class="py-16 bg-slate-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats Bar -->
            <div class="flex flex-wrap items-center justify-between gap-4 mb-10 p-4 bg-white/5 rounded-2xl border border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-white font-bold text-xl" id="categoryCount">{{ count($categories) }}</div>
                        <div class="text-slate-400 text-sm">Total Categories</div>
                    </div>
                </div>
                <div class="text-slate-400 text-sm">
                    Showing <span class="text-white font-semibold" id="visibleCount">{{ count($categories) }}</span> categories
                </div>
            </div>
            
            <!-- Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="categoriesGrid">
                @php
                    $categoryIcons = [
                        'JavaScript' => '⚡', 'Node' => '🟢', 'Angular' => '🅰️', 'PHP' => '🐘',
                        'JAVA' => '☕', 'TypeScript' => '📘', 'Vue' => '💚', 'Next' => '▲',
                        'React' => '⚛️', 'Python' => '🐍', 'CSS' => '🎨', 'HTML' => '🌐',
                        'Laravel' => '🔴', 'MongoDB' => '🍃', 'SQL' => '🗃️', 'Git' => '📦',
                        'Express' => '🚀', 'Docker' => '🐳', 'AWS' => '☁️', 'API' => '🔌'
                    ];
                    
                    $gradients = [
                        'from-purple-500/20 to-blue-500/20',
                        'from-pink-500/20 to-orange-500/20',
                        'from-cyan-500/20 to-emerald-500/20',
                        'from-yellow-500/20 to-red-500/20',
                        'from-indigo-500/20 to-purple-500/20',
                        'from-emerald-500/20 to-cyan-500/20',
                    ];
                @endphp
                
                @foreach($categories as $key => $category)
                <a href="user-quiz-list/{{$category->id}}/{{str_replace(' ','-',$category->name)}}" 
                   class="category-card rounded-2xl p-6 group cursor-pointer category-item"
                   data-name="{{ strtolower($category->name) }}">
                    <div class="flex items-start justify-between mb-4">
                        <div class="icon-box w-14 h-14 rounded-xl flex items-center justify-center text-3xl">
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
                        <div class="flex items-center gap-1 text-purple-400 opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-sm">Explore</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </div>
                    </div>
                    
                    <h3 class="text-xl font-bold text-white mb-3 group-hover:text-purple-300 transition-colors">
                        {{ $category->name }}
                    </h3>
                    
                    <div class="flex items-center gap-2">
                        <span class="bg-purple-500/20 text-purple-300 text-xs px-3 py-1.5 rounded-full font-medium">
                            {{ $category->quizzes_count ?? 0 }} Quizzes
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
            
            <!-- Empty State (hidden by default) -->
            <div id="emptyState" class="hidden text-center py-16">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-2xl font-bold text-white mb-2">No categories found</h3>
                <p class="text-slate-400">Try adjusting your search term</p>
            </div>
            
            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                <div class="bg-white/5 rounded-2xl p-2 border border-white/10">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </section>
    
    <x-footer-user></x-footer-user>
    
    @if(!session('user') && !session('admin'))
        @include('components.lead-modal', ['closable' => true])
    @endif
    
    <script>
        function filterCategories() {
            const searchTerm = document.getElementById('categorySearch').value.toLowerCase();
            const cards = document.querySelectorAll('.category-item');
            const emptyState = document.getElementById('emptyState');
            let visibleCount = 0;
            
            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                if (name.includes(searchTerm)) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            document.getElementById('visibleCount').textContent = visibleCount;
            
            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
