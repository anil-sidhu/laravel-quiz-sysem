<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz System Home Page</title>
    @vite('resources/css/app.css')
</head>
<body>
  <x-user-navbar></x-user-navbar> 
  
   
  <div class="p-8 bg-gray-50 min-h-screen">
  <h1 class="text-3xl font-bold text-gray-800 mb-6">UI Design Courses</h1>
  
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-6">
    @foreach($topics as $topic)
     <div class="bg-white p-5 rounded-2xl shadow hover:shadow-md transition">
      <h2 class="text-lg font-semibold text-gray-800 mb-2">{{$topic->title}}</h2>
      <a href="/topic/{{$topic->course_id}}/{{$topic->id}}/{{str_replace(' ', '-',$topic->title)}}" class="text-blue-600 hover:underline text-sm font-medium">Read More</a>
    </div>
    @endforeach
   
</div>


    </div>
   


   
</div>
<x-footer-user></x-footer-user>
</body>