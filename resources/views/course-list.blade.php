<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz System Home Page</title>
    @vite('resources/css/app.css')
</head>
<body>
  <x-user-navbar></x-user-navbar> 
  <div class="flex flex-col min-h-screen items-center bg-gray-100">
   
  <div class="p-8 bg-gray-50 min-h-screen">
  <h1 class="text-3xl font-bold text-gray-800 mb-6">UI Design Courses</h1>
  
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
   
    @foreach($courses as $course)
     <!-- Course Card -->
     <div class="bg-white p-5 rounded-2xl shadow hover:shadow-md transition">
      <h2 class="text-lg font-semibold text-gray-800 mb-2">{{$course->title}}</h2>
      <p class="text-gray-600 text-sm mb-4">{{$course->description}}</p>
      <a href="/course-details/{{$course->id}}/{{str_replace(' ', '-',$course->title)}}" class="text-blue-600 hover:underline text-sm font-medium">View Course</a>
    </div>

    @endforeach
   
   
  </div>
</div>


    </div>
   


   
</div>
<x-footer-user></x-footer-user>
</body>