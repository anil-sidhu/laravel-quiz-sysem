<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
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
    </style>
</head>
<body>
  <x-user-navbar></x-user-navbar> 
  <div class="flex min-h-screen bg-gray-100">
  <!-- Sidebar -->
  <aside class="w-70 bg-white shadow-md p-6">
    <h2 class=" text-green-950 list-heading">Playlist Topics</h2>
    <nav class="space-y-4">

    @foreach($relatedTopics as $topic)
 
      <a title="{{$topic->title}}" class="truncate-2-lines" href="/topic/{{$topic->course_id}}/{{$topic->id}}/{{str_replace(' ', '-',$topic->title)}}" 
      class="block text-gray-700 hover:text-blue-600 font-medium">{{$topic->title}}</a>

    @endforeach

    </nav>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">{{$currentTopic->title}}</h1>

    <div>
    {!!$currentTopic->video_link!!}
    </div>


    <div class="grid">
    {!!$currentTopic->description!!}
    </div>
  </main>

  <aside class="w-60 bg-white shadow-md p-6">
    <h2   class=" text-green-950 list-heading">Related Course </h2>
    <nav class="space-y-4">

    @foreach($courses as $course)

      <a class="truncate-2-lines" href="/course-details/{{$course->id}}/{{str_replace(' ', '-',$course->title)}}" class="text-green-900 font-bold hover:underline text-sm">{{$course->title}}</a>

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
                this.classList.add('bg-blue-500', 'text-white');
                this.classList.remove('bg-gray-200', 'text-blue-700');
                document.getElementById('leadTabLogin').classList.remove('bg-blue-500', 'text-white');
                document.getElementById('leadTabLogin').classList.add('bg-gray-200', 'text-blue-700');
            };
            document.getElementById('leadTabLogin').onclick = function() {
                document.getElementById('leadSignupForm').classList.add('hidden');
                document.getElementById('leadLoginForm').classList.remove('hidden');
                this.classList.add('bg-blue-500', 'text-white');
                this.classList.remove('bg-gray-200', 'text-blue-700');
                document.getElementById('leadTabSignup').classList.remove('bg-blue-500', 'text-white');
                document.getElementById('leadTabSignup').classList.add('bg-gray-200', 'text-blue-700');
            };
        });
    </script>
@endif
</body>