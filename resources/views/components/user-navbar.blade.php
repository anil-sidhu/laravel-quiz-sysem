<nav class="bg-white shadow-md px-4 py-3 font-extralight border-b-green-900 border w-full max-w-full overflow-x-hidden">
      <div class="flex justify-between items-center">
        <!-- Logo -->
        <div class="text-2xl text-green-900 hover:text-blue-500 cursor-pointer">
           <a href="/">
            <img class="h-8 sm:h-10" src="{{ asset('img/the_coding_skills.png') }}" alt="Logo">
           </a>
        </div>

        <!-- Desktop Search -->
        <div class="hidden md:block flex-1 max-w-md mx-8">
          <div class="relative">
           <form action="search-quiz" method="get">
           <input class="w-full px-3 py-2 text-green-900 border border-green-900 rounded-sm shadow text-sm" type="text" name="search" placeholder="Search quiz..." />
            <button class="absolute right-3 top-[6px]">
            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#0d542b"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
            </button>
           </form>
          </div>
        </div>

        <!-- Desktop Navigation -->
        <div class="hidden lg:flex space-x-4 items-center">
          <a class="text-green-900 hover:text-blue-500 text-sm whitespace-nowrap" href="/">Home</a>
          <a class="text-green-900 hover:text-blue-500 text-sm whitespace-nowrap" href="/categories-list">Categories</a>
          <a class="text-green-900 hover:text-blue-500 text-sm whitespace-nowrap" href="/anil-sidhu">About Me</a>
          @if(session('user'))
          <a class="text-green-900 hover:text-blue-500 text-sm whitespace-nowrap" href="/user-details">Welcome, {{session('user')->name}}</a>
          <button id="sharpener-dashboard-btn" class="text-green-900 hover:text-blue-500 text-sm whitespace-nowrap bg-blue-100 hover:bg-blue-200 px-3 py-1 rounded-md transition-colors">Sharpener Dashboard</button>
          <a class="text-green-900 hover:text-blue-500 text-sm whitespace-nowrap" href="/user-logout">Logout</a>
          @else
          <a class="text-green-900 hover:text-blue-500 text-sm whitespace-nowrap" href="/user-login">Login</a>
          <a class="text-green-900 hover:text-blue-500 text-sm whitespace-nowrap" href="/user-signup">Signup</a>
          @endif
          <a class="text-green-900 hover:text-blue-500 text-sm whitespace-nowrap" href="/courses">Course</a>
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-toggle" class="lg:hidden p-2">
          <svg class="w-6 h-6 text-green-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>

      <!-- Mobile Menu -->
      <div id="mobile-menu" class="lg:hidden hidden mt-4 pb-4">
        <!-- Mobile Search -->
        <div class="md:hidden mb-4">
          <div class="relative">
           <form action="search-quiz" method="get">
           <input class="w-full px-3 py-2 text-green-900 border border-green-900 rounded-sm shadow text-sm" type="text" name="search" placeholder="Search quiz..." />
            <button class="absolute right-3 top-[6px]">
            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#0d542b"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
            </button>
           </form>
          </div>
        </div>

        <!-- Mobile Navigation Links -->
        <div class="space-y-3">
          <a class="block text-green-900 hover:text-blue-500 py-2 border-b border-gray-200" href="/">Home</a>
          <a class="block text-green-900 hover:text-blue-500 py-2 border-b border-gray-200" href="/categories-list">Categories</a>
          <a class="block text-green-900 hover:text-blue-500 py-2 border-b border-gray-200" href="/about-me">About Me</a>
          @if(session('user'))
          <a class="block text-green-900 hover:text-blue-500 py-2 border-b border-gray-200" href="/user-details">Welcome, {{session('user')->name}}</a>
          <button id="sharpener-dashboard-btn-mobile" class="block text-green-900 hover:text-blue-500 py-2 border-b border-gray-200 bg-blue-100 hover:bg-blue-200 px-3 rounded-md transition-colors w-full text-left">Sharpener Dashboard</button>
          <a class="block text-green-900 hover:text-blue-500 py-2 border-b border-gray-200" href="/user-logout">Logout</a>
          @else
          <a class="block text-green-900 hover:text-blue-500 py-2 border-b border-gray-200" href="/user-login">Login</a>
          <a class="block text-green-900 hover:text-blue-500 py-2 border-b border-gray-200" href="/user-signup">Signup</a>
          @endif
          <a class="block text-green-900 hover:text-blue-500 py-2" href="/courses">Course</a>
        </div>
      </div>
    </nav>

    <script>
      document.getElementById('mobile-menu-toggle').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
      });

      // Sharpener Dashboard functionality
      function openSharpenerDashboard() {
        const button = event.target;
        const originalText = button.textContent;
        
        // Show loading state
        button.textContent = 'Loading...';
        button.disabled = true;
        
        fetch('/open-sharpener-dashboard', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Show success message
            showMessage(data.message, 'success');
            
            // Redirect to Sharpener dashboard
            setTimeout(() => {
              window.location.href = data.redirect_url;
            }, 1000);
          } else {
            showMessage(data.message, 'error');
            button.textContent = originalText;
            button.disabled = false;
          }
        })
        .catch(error => {
          console.error('Error:', error);
          showMessage('Failed to access dashboard. Please try again.', 'error');
          button.textContent = originalText;
          button.disabled = false;
        });
      }

      // Show message function
      function showMessage(message, type) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-md shadow-lg ${
          type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
        }`;
        messageDiv.textContent = message;
        
        document.body.appendChild(messageDiv);
        
        setTimeout(() => {
          messageDiv.remove();
        }, 3000);
      }

      // Add event listeners
      document.addEventListener('DOMContentLoaded', function() {
        const desktopBtn = document.getElementById('sharpener-dashboard-btn');
        const mobileBtn = document.getElementById('sharpener-dashboard-btn-mobile');
        
        if (desktopBtn) {
          desktopBtn.addEventListener('click', openSharpenerDashboard);
        }
        
        if (mobileBtn) {
          mobileBtn.addEventListener('click', openSharpenerDashboard);
        }
      });
    </script>