<nav class=" bg-white shadow-md px-4 py-3 font-extralight border-b-green-900 border  ">
      <div class="flex justify-between item-center">
      <div class="text-2xl text-green-900 hover:text-blue-500 cursor-pointer">
           <a href="/">
            <img class="h-10" src="{{ asset('img/the_coding_skills.png') }}" alt="Logo">
           </a>
        </div>

        <div class="w-130">
      <div class="relative">
       <form action="search-quiz" method="get">
       <input class="w-full px-2 py-2 text-green-900 border border-green-900
        rounded-sm shadow" type="text" name="search"  placeholder="Search quiz..." />
        <button class="absolute right-3 top-[5px]">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#0d542b"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
        </button>
       </form>
      </div>
    </div>

        <div class=" space-x-4 flex items-center">
        <a class="text-green-900 hover:text-blue-500" href="/">Home</a>
            <a class="text-green-900 hover:text-blue-500" href="/categories-list">Categories</a>
            <a class="text-green-900 hover:text-blue-500" href="/about-me">About Me</a>
            @if(session('user'))
            <a class="text-green-900 hover:text-blue-500" href="/user-details">Welcome ,{{session('user')->name}}</a>
            <a class="text-green-900 hover:text-blue-500" href="/user-logout">Logout</a>
            @else
            <a class="text-green-900 hover:text-blue-500" href="/user-login">Login</a>
            <a class="text-green-900 hover:text-blue-500" href="/user-signup">Signup</a>
  @endif
            <!-- <a class="text-green-900 hover:text-blue-500" href="/admin-logout">Blog</a> -->
            <a class="text-green-900 hover:text-blue-500" href="/courses">Course</a>

        </div>
      </div>
    </nav>