<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz System Home Page</title>
    @vite('resources/css/app.css')
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