<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>All Courses Listing, React, Angular, Laravel etc | The Coding Skills</title>
    <meta name="description" content="Code step by step youtube channel courses notes and code, Explore our complete catalog of courses covering various programming languages, frameworks, and development technologies. anil sidhu official website">
  <meta name="keywords" content="
  @foreach($courses as $course) 
  {{$course->title}} ,
     @endforeach">
    @vite('resources/css/app.css')
    <style>
        body {
            overflow-x: hidden;
            max-width: 100vw;
        }
        .grid {
            max-width: 100%;
        }
    </style>
</head>
<body>
  <x-user-navbar></x-user-navbar> 
  <div class="flex flex-col min-h-screen items-center bg-gray-100 w-full max-w-full overflow-x-hidden">
   
  <div class="p-8 bg-gray-50 min-h-screen">
  <h1 class="text-3xl text-center font-extralight text-gray-800 mb-6">All Courses Listing</h1>
  
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 w-full max-w-full">
   
    @foreach($courses as $course)
     <div class="bg-white p-5 rounded-2xl shadow hover:shadow-md transition w-full">
      <h2 class="font-extralight text-lg sm:text-2xl text-gray-800 mb-2 break-words">{{$course->title}}</h2>
      <p class="text-gray-600 font-extralight text-sm mb-4 break-words">{{$course->description}}</p>
      <a href="/course-details/{{$course->id}}/{{str_replace(' ', '-',$course->title)}}" class="text-green-900 font-bold hover:underline text-sm">View Course</a>
    </div>

    @endforeach
   
   
  </div>
</div>


    </div>
   


   
</div>
<x-footer-user></x-footer-user>
</body>