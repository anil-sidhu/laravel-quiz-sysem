<!DOCTYPE html>
<html lang="en">
<head>
    <x-common></x-common>
    <meta charset="UTF-8">
    <title> | Programming MCQs | Code Step by Step YouTube Channel Video Notes & Code for Developers | Anil Sidhu</title>
    <meta name="description" content="Find coding and programming language MCQs, structured notes from coding YouTube Channel, and practical code examples to level up your skills in various programming languages and related technologies">
  <meta name="keywords" content="Anil Sidhu, programming language mcqs, technology quizzes for developers, coding video summaries, programming notes pdf, code snippets library, software development practice, web development mcqs, data science mcqs, the coding skills">
    @vite('resources/css/app.css')
</head>
<body>
  <x-user-navbar></x-user-navbar> 
  <div class="flex flex-col min-h-screen items-center bg-gray-100">
    @if(session('message-success'))
    <div>
        <p class=" text-green-500 font-bold">{{session('message-success')}}</p>
    </div>
    @endif
    <h1 class="border-b border-solid text-4xl text-green-900  p-5 pb-2 mb-4 mt-10 font-extralight" >Test Skills with MCQs</h1>
    
    <div class="grid sm:grid-cols-3 md:grid-cols-4 gap-4 p-8 font-extralight text-2xl">
    @foreach($categories as $key=>$category)
    <a class="p-6 text-center border md:w-40 lg:w-60 rounded-lg transition duration-300 hover:bg-green-900 hover:text-white cursor-pointer"href="user-quiz-list/{{$category->id}}/{{str_replace(' ','-',$category->name)}}">
    
    {{$category->name}}
</a>
    @endforeach

    </div>

    <h1 class="border-b border-solid text-4xl text-green-900  p-5 pb-2 mb-4 mt-10 font-extralight" >Top Coding Quiz</h1>

    <div class="grid sm:grid-cols-3 md:grid-cols-3 gap-4 p-8 font-extralight">
    @foreach($quizData as $item)

    <a href="/start-quiz/{{$item->id}}/{{str_replace(' ','-',$item->name)}}" class="p-6 text-center  md:w-60 lg:w-80  border rounded-lg transition duration-300 bg-green-900 text-white hover:bg-gray-100 hover:text-green-900 cursor-pointer">
    {{$item->name}}
                        </a>
    @endforeach
    </div>

    <h1 class="border-b border-solid text-4xl text-green-900  p-5 pb-2 mb-4 mt-10 font-extralight" >Top Programming Language Courses</h1>

<div class="grid sm:grid-cols-3 md:grid-cols-3 gap-4 p-8 font-extralight">
@foreach($courses as $course)

<a href="/course-details/{{$course->id}}/{{str_replace(' ', '-',$course->title)}}" class="p-6 text-center  md:w-60 lg:w-80  border rounded-lg transition duration-300 bg-green-900 text-white hover:bg-gray-100 hover:text-green-900 cursor-pointer">
    {{$course->title}}
</a>
@endforeach
 
  </div>
</div>
<x-footer-user></x-footer-user>
</body>