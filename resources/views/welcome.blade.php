<!DOCTYPE html>
<html lang="en">
<head>
    <x-common></x-common>
    <meta charset="UTF-8">
    <title>Programming Interview Questions, Code & Notes of Step by Step YouTube Channel, Anil Sidhu</title>
    <meta name="description" content="Find coding & programming MCQs, Interview questions, notes and code for  code step by step YouTube Channel in various programming languages>
  <meta name="keywords" content="Anil Sidhu, Interview Questions, programming language mcqs, technology quizzes for developers, coding video summaries, programming notes pdf, code snippets library, software development practice, web development mcqs, data science mcqs, the coding skills">
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
    <h1 class="border-b border-solid text-2xl sm:text-3xl md:text-4xl text-green-900 p-4 sm:p-5 pb-2 mb-4 mt-6 sm:mt-10 font-extralight text-center px-4" >Test Skills with MCQs</h1>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-4 sm:p-8 font-extralight text-lg sm:text-xl md:text-2xl">
    @foreach($categories as $key=>$category)
    <a class="p-4 sm:p-6 text-center border w-full min-h-[80px] sm:min-h-[100px] flex items-center justify-center rounded-lg transition duration-300 hover:bg-green-900 hover:text-white cursor-pointer" href="user-quiz-list/{{$category->id}}/{{str_replace(' ','-',$category->name)}}">
    {{$category->name}}
    </a>
    @endforeach

    </div>

    <h3 class="border-b border-solid text-2xl sm:text-3xl md:text-4xl text-green-900 p-4 sm:p-5 pb-2 mb-4 mt-6 sm:mt-10 font-extralight text-center px-4" >Top Coding Quiz</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-4 sm:p-8 font-extralight">
    @foreach($quizData as $item)
    <a href="/start-quiz/{{$item->id}}/{{str_replace(' ','-',$item->name)}}" class="p-4 sm:p-6 text-center w-full min-h-[80px] sm:min-h-[100px] flex items-center justify-center border rounded-lg transition duration-300 bg-green-900 text-white hover:bg-gray-100 hover:text-green-900 cursor-pointer">
    {{$item->name}}
    </a>
    @endforeach
    </div>

    <h2 class="border-b border-solid text-2xl sm:text-3xl md:text-4xl text-green-900 p-4 sm:p-5 pb-2 mb-4 mt-6 sm:mt-10 font-extralight text-center px-4" >Top Programming Language Courses</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-4 sm:p-8 font-extralight">
@foreach($courses as $course)
<a href="/course-details/{{$course->id}}/{{str_replace(' ', '-',$course->title)}}" class="p-4 sm:p-6 text-center w-full min-h-[80px] sm:min-h-[100px] flex items-center justify-center border rounded-lg transition duration-300 bg-green-900 text-white hover:bg-gray-100 hover:text-green-900 cursor-pointer">
    {{$course->title}}
</a>
@endforeach
 
  </div>
</div>
<x-footer-user></x-footer-user>
@if(!session('user'))
    @include('components.lead-modal', ['closable' => true])
@endif
</body>