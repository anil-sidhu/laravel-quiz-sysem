<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <title>{{$course->title}} | Free coding course | Free tutorial, notes and code</title>
    <meta name="description" content="{{$course->title}} | {{$course->description}}">
    <meta name="keywords" content="{{$course->title}}, free {{$course->title}}, {{$course->title}} notes, {{$course->title}} code, Free tutorial ">
    @vite('resources/css/app.css')
</head>
<body>
  <x-user-navbar></x-user-navbar> 
  
   
  <div class="p-8 bg-gray-50 min-h-screen">
  <h1 class="text-3xl text-green-900 mb-6 font-extralight text-center">{{$course->title}}</h1>
  
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-6">
    @foreach($topics as $topic)
     <div class="bg-white p-5 rounded-2xl shadow hover:shadow-md transition">
      <h2 class="font-extralight text-2xl  text-gray-800 mb-2">{{$topic->title}}</h2>
      <a href="/topic/{{$topic->course_id}}/{{$topic->id}}/{{str_replace(' ', '-',$topic->title)}}" class="text-green-900 hover:underline text-sm font-medium">Read More</a>
    </div>
    @endforeach
   
</div>


    </div>
   


   
</div>
<x-footer-user></x-footer-user>
</body>