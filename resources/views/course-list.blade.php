<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <title>All Courses Listing, React, Angular, Laravel etc | The Coding Skills</title>
    <meta name="description" content="Explore our complete catalog of courses covering various programming languages, frameworks, and development technologies. Find the perfect course to achieve your coding goals">
  <meta name="keywords" content="programming course catalog, software development courses, web development courses, data science courses, full stack development courses, learn React programming language, the coding skills courses">
  
    @vite('resources/css/app.css')
</head>
<body>
  <x-user-navbar></x-user-navbar> 
  <div class="flex flex-col min-h-screen items-center bg-gray-100">
   
  <div class="p-8 bg-gray-50 min-h-screen">
  <h1 class="text-3xl font-bold text-gray-800 mb-6">All Courses Listing</h1>
  
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
   
    @foreach($courses as $course)
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