<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{$currentTopic->title}} | programming  courses | The Coding Skills | Anil Sidhu</title>
    <meta name="description" content="{{$currentTopic->title}}, {{$currentTopic->keywords}}  notes from coding code step by step YouTube Channel">
  <meta name="keywords" content="{{$currentTopic->title}}, {{$currentTopic->keywords}}, Anil Sidhu">
    @vite('resources/css/app.css')

    <style>
        /* Typography Reset and Base Styling */
h1, h2, h3, h4, h5, h6 {
  margin: 1em 0 0.5em;
  font-weight: bold;
  line-height: 1.25;
}

h1 { font-size: 2em; }
h2 { font-size: 1.75em; }
h3 { font-size: 1.5em; }
h4 { font-size: 1.25em; }
h5 { font-size: 1em; }
h6 { font-size: 0.875em; }

p {
  margin: 0.75em 0;
  line-height: 1.6;
  font-size: 1em;
}

b, strong {
  font-weight: bold;
}

i, em {
  font-style: italic;
}

/* List Reset and Base Styling */
ul {
  margin: 0.75em 0;
  padding-left: 1.5em;
  list-style-type: disc;
}

li {
  margin: 0.25em 0;
  line-height: 1.5;
}
span,code{
    background-color:transparent !important
}

.truncate-2-lines {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
  font-size: 14px;
}

h2.list-heading{
  font-size:24px; font-weight:200
}

/* Mobile responsive styles */
body {
    overflow-x: hidden;
    max-width: 100vw;
}

/* Code block responsive */
pre, code {
    overflow-x: auto;
    white-space: pre-wrap;
    word-wrap: break-word;
    max-width: 100%;
}

/* Video player responsive */
iframe, video, embed, object {
    max-width: 100% !important;
    width: 100% !important;
    height: auto !important;
    aspect-ratio: 16/9;
}

/* YouTube embed specific */
.youtube-embed, .youtube-embed iframe {
    max-width: 100% !important;
    width: 100% !important;
    height: auto !important;
    aspect-ratio: 16/9;
}

/* Mobile sidebar toggle */
.mobile-sidebar-toggle {
    display: none;
}

.no-margin{
  margin:0
}

@media (max-width: 768px) {
    .mobile-sidebar-toggle {
        display: block;
    }
    
    .sidebar {
        display: none;
    }
    
    .sidebar.active {
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background: white;
        z-index: 50;
        overflow-y: auto;
        padding: 1rem;
    }
}

    </style>
</head>
<body>
  <x-user-navbar></x-user-navbar> 
  <div class="flex min-h-screen bg-gray-100 w-full max-w-full overflow-x-hidden">
  
  <!-- Mobile Sidebar Toggle Button -->
  <button id="mobile-sidebar-toggle" class="mobile-sidebar-toggle fixed top-20 left-4 z-40 bg-green-900 text-white p-2 rounded-lg shadow-lg">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
  </button>

  <!-- Left Sidebar - Playlist Topics -->
  <aside id="playlist-sidebar" class="sidebar w-70 bg-white shadow-md p-6 lg:block">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-green-950 list-heading">Playlist Topics</h2>
      <button id="close-sidebar" class="lg:hidden text-gray-500 hover:text-gray-700">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
    <nav class="space-y-4">
    @foreach($relatedTopics as $topic)
      <a title="{{$topic->title}}" class="truncate-2-lines block text-gray-700 hover:text-green-900 font-medium" href="/topic/{{$topic->course_id}}/{{$topic->id}}/{{str_replace(' ', '-',$topic->title)}}">
        {{$topic->title}}
      </a>
    @endforeach
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-4 sm:p-8 w-full">
    <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800 mb-6">{{$currentTopic->title}}</h1>

    <div class="mb-6 w-full overflow-hidden">
      {!!$currentTopic->video_link!!}
    </div>

    <div class="prose max-w-none">
      {!!$currentTopic->description!!}
    </div>
  </main>

  <!-- Right Sidebar - Related Courses -->
  <aside id="courses-sidebar" class="sidebar w-60 bg-white shadow-md p-6 lg:block">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-green-950 list-heading">Related Courses</h2>
      <button id="close-courses-sidebar" class="lg:hidden text-gray-500 hover:text-gray-700">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
    <nav class="space-y-4">
    @foreach($courses as $course)
      <a class="truncate-2-lines block text-green-900 font-bold hover:underline text-sm" href="/course-details/{{$course->id}}/{{str_replace(' ', '-',$course->title)}}">
        {{$course->title}}
      </a>
    @endforeach
    </nav>
  </aside>

</div>

<x-footer-user></x-footer-user>
@if(!session('user'))
    @include('components.lead-modal')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.getElementById('leadModal').classList.remove('hidden');
                document.getElementById('leadModalClose').classList.add('hidden'); // Hide close button
            }, 5000);
            // Tab switching logic
            document.getElementById('leadTabSignup').onclick = function() {
                document.getElementById('leadSignupForm').classList.remove('hidden');
                document.getElementById('leadLoginForm').classList.add('hidden');
                this.classList.add('bg-green-900', 'text-white');
                this.classList.remove('bg-gray-200', 'text-green-900');
                document.getElementById('leadTabLogin').classList.remove('bg-green-900', 'text-white');
                document.getElementById('leadTabLogin').classList.add('bg-gray-200', 'text-green-900');
            };
            document.getElementById('leadTabLogin').onclick = function() {
                document.getElementById('leadSignupForm').classList.add('hidden');
                document.getElementById('leadLoginForm').classList.remove('hidden');
                this.classList.add('bg-green-900', 'text-white');
                this.classList.remove('bg-gray-200', 'text-green-900');
                document.getElementById('leadTabSignup').classList.remove('bg-green-900', 'text-white');
                document.getElementById('leadTabSignup').classList.add('bg-gray-200', 'text-green-900');
            };
        });
    </script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileToggle = document.getElementById('mobile-sidebar-toggle');
        const playlistSidebar = document.getElementById('playlist-sidebar');
        const coursesSidebar = document.getElementById('courses-sidebar');
        const closeSidebar = document.getElementById('close-sidebar');
        const closeCoursesSidebar = document.getElementById('close-courses-sidebar');

        // Toggle playlist sidebar
        mobileToggle.addEventListener('click', function() {
            playlistSidebar.classList.toggle('active');
        });

        // Close playlist sidebar
        closeSidebar.addEventListener('click', function() {
            playlistSidebar.classList.remove('active');
        });

        // Close courses sidebar
        closeCoursesSidebar.addEventListener('click', function() {
            coursesSidebar.classList.remove('active');
        });

        // Close sidebar when clicking outside
        document.addEventListener('click', function(e) {
            if (!playlistSidebar.contains(e.target) && !mobileToggle.contains(e.target)) {
                playlistSidebar.classList.remove('active');
            }
        });
    });
</script>
</body>