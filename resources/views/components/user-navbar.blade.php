<nav class="sticky top-0 z-50 bg-slate-900/80 backdrop-blur-xl border-b border-white/10 px-4 py-3 w-full">
    <style>
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #7c3aed, #2563eb);
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .btn-gradient {
            background: linear-gradient(135deg, #7c3aed 0%, #2563eb 100%);
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px -10px rgba(124, 58, 237, 0.5);
        }
        .btn-ghost {
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }
        .btn-ghost:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(124, 58, 237, 0.5);
        }
        .search-glow:focus {
            box-shadow: 0 0 20px rgba(124, 58, 237, 0.3);
            border-color: rgba(124, 58, 237, 0.5);
        }
        .logo-glow:hover {
            filter: drop-shadow(0 0 10px rgba(124, 58, 237, 0.5));
        }
        .contact-pill {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transition: all 0.3s ease;
        }
        .contact-pill:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px -10px rgba(5, 150, 105, 0.45);
        }
        .mobile-menu {
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
    
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <div class="flex-shrink-0">
            <a href="/" class="logo-glow transition-all duration-300">
                <img class="h-15 sm:h-15" src="{{ asset('img/the_coding_skills.png') }}" alt="The Coding Skills">
            </a>
        </div>

        <!-- Desktop Search -->
        <div class="hidden md:block flex-1 max-w-md mx-8">
            <form action="search-quiz" method="get" class="relative">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input class="w-full pl-12 pr-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white placeholder-slate-400 text-sm focus:outline-none search-glow transition-all" 
                       type="text" name="search" placeholder="Search quizzes, courses..." />
            </form>
        </div>

        <!-- Desktop Navigation -->
        <div class="hidden lg:flex items-center gap-1">
            <a class="nav-link text-slate-300 hover:text-white px-4 py-2 text-sm font-medium" href="/">Home</a>
            <a class="nav-link text-slate-300 hover:text-white px-4 py-2 text-sm font-medium" href="/categories-list">Categories</a>
            <a class="nav-link text-slate-300 hover:text-white px-4 py-2 text-sm font-medium" href="/courses">Courses</a>
            <a class="nav-link text-slate-300 hover:text-white px-4 py-2 text-sm font-medium" href="/anil-sidhu">About</a>
            
            <div class="w-px h-6 bg-white/10 mx-2"></div>

            <a href="tel:+919958194988" class="hidden xl:inline-flex items-center gap-1.5 text-slate-300 hover:text-white px-3 py-2 text-sm font-medium" title="Call us">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                <span class="hidden 2xl:inline">+91 99581 94988</span>
            </a>
            <a href="https://wa.me/919958194988" target="_blank" rel="noopener noreferrer" class="contact-pill px-3 py-2 rounded-lg text-white text-sm font-semibold hidden sm:inline-flex items-center gap-1.5" title="WhatsApp">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.435 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                WhatsApp
            </a>
            
            @if(session('user'))
                <a class="text-slate-300 hover:text-white px-3 py-2 text-sm font-medium flex items-center gap-2" href="/user-details">
                    <div class="w-7 h-7 bg-gradient-to-br from-purple-500 to-blue-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                        {{ strtoupper(substr(session('user')->name, 0, 1)) }}
                    </div>
                    <span class="hidden xl:inline">{{ session('user')->name }}</span>
                </a>
                <a class="btn-ghost text-slate-300 hover:text-white px-4 py-2 rounded-lg text-sm font-medium" href="/user-logout">Logout</a>
            @else
                <a class="btn-ghost text-slate-300 hover:text-white px-4 py-2 rounded-lg text-sm font-medium" href="/user-login">Login</a>
                <a class="btn-gradient text-white px-5 py-2 rounded-lg text-sm font-semibold" href="/user-signup">Sign Up</a>
            @endif
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-toggle" class="lg:hidden p-2 text-slate-300 hover:text-white transition-colors">
            <svg class="w-6 h-6" id="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg class="w-6 h-6 hidden" id="close-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="lg:hidden hidden mobile-menu mt-4 -mx-4 px-4 py-6">
        <!-- Mobile Search -->
        <div class="md:hidden mb-6">
            <form action="search-quiz" method="get" class="relative">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input class="w-full pl-12 pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-slate-400 text-sm focus:outline-none search-glow transition-all" 
                       type="text" name="search" placeholder="Search quizzes, courses..." />
            </form>
        </div>

        <!-- Mobile Navigation Links -->
        <div class="space-y-1">
            <a class="flex items-center gap-3 text-slate-300 hover:text-white hover:bg-white/5 px-4 py-3 rounded-xl transition-colors" href="/">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Home
            </a>
            <a class="flex items-center gap-3 text-slate-300 hover:text-white hover:bg-white/5 px-4 py-3 rounded-xl transition-colors" href="/categories-list">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                Categories
            </a>
            <a class="flex items-center gap-3 text-slate-300 hover:text-white hover:bg-white/5 px-4 py-3 rounded-xl transition-colors" href="/courses">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Courses
            </a>
            <a class="flex items-center gap-3 text-slate-300 hover:text-white hover:bg-white/5 px-4 py-3 rounded-xl transition-colors" href="/anil-sidhu">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                About
            </a>
        </div>
        
        <div class="h-px bg-white/10 my-4"></div>
        
        @if(session('user'))
            <div class="space-y-1">
                <a class="flex items-center gap-3 text-slate-300 hover:text-white hover:bg-white/5 px-4 py-3 rounded-xl transition-colors" href="/user-details">
                    <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-blue-500 rounded-full flex items-center justify-center text-white text-sm font-bold">
                        {{ strtoupper(substr(session('user')->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="font-medium">{{ session('user')->name }}</div>
                        <div class="text-xs text-slate-500">View Profile</div>
                    </div>
                </a>
                <a href="tel:+919958194988" class="w-full contact-pill flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-white font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    Call +91 99581 94988
                </a>
                <a href="https://wa.me/919958194988" target="_blank" rel="noopener noreferrer" class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl font-semibold border border-emerald-500/40 text-emerald-300 hover:bg-emerald-500/10 transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.435 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    WhatsApp
                </a>
                <a class="flex items-center justify-center gap-2 text-slate-400 hover:text-white px-4 py-3 rounded-xl transition-colors" href="/user-logout">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </a>
            </div>
        @else
            <div class="space-y-3 pt-2">
                <a href="tel:+919958194988" class="block w-full contact-pill text-center text-white px-4 py-3 rounded-xl font-semibold">Call +91 99581 94988</a>
                <a href="https://wa.me/919958194988" target="_blank" rel="noopener noreferrer" class="block w-full text-center border border-emerald-500/40 text-emerald-300 px-4 py-3 rounded-xl font-semibold hover:bg-emerald-500/10">WhatsApp</a>
                <a class="block w-full btn-ghost text-center text-slate-300 hover:text-white px-4 py-3 rounded-xl font-medium" href="/user-login">Login</a>
                <a class="block w-full btn-gradient text-center text-white px-4 py-3 rounded-xl font-semibold" href="/user-signup">Sign Up Free</a>
            </div>
        @endif
    </div>
</nav>

<script>
    document.getElementById('mobile-menu-toggle').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');
        
        mobileMenu.classList.toggle('hidden');
        menuIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    });
</script>
