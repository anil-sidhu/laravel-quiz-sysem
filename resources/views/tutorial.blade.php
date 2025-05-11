<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <title>Quiz System Home Page</title>
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
    </style>
</head>
<body>
  <x-user-navbar></x-user-navbar> 
  <div class="flex min-h-screen bg-gray-100">
  <!-- Sidebar -->
  <aside class="w-64 bg-white shadow-md p-6">
    <h2 class="text-2xl font-bold mb-6 text-blue-600">Playlist Topics</h2>
    <nav class="space-y-4">

    @foreach($relatedTopics as $topic)
 
      <a href="/topic/{{$topic->course_id}}/{{$topic->id}}/{{str_replace(' ', '-',$topic->title)}}" 
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
</div>

<x-footer-user></x-footer-user>
</body>