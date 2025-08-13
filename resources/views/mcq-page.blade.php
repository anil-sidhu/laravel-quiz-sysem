<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <title> {{ str_replace('-',' ',$quizName) }} | {{$mcqData->question}} | The Coding Skills </title>
    <meta name="description" content="{{ str_replace('-',' ',$quizName) }} | {{$mcqData->question}} theCodingSkills.com structured notes from coding code step by step YouTube channel">
  <meta name="keywords" content="{{ str_replace('-',' ',$quizName) }}, {{$mcqData->question}}, Programming language MCQs, Anil sidhu, The Coding Skills">
  
    @vite('resources/css/app.css')
</head>
<body>
    <x-user-navbar ></x-user-navbar>
    @if(session('message'))
<p class="text-green-500">{{'message'}}</p>
@endif
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5 px-4">
    <h1 class="text-lg sm:text-xl md:text-2xl text-center text-green-800 mb-4 sm:mb-6 font-bold">
        {{$quizName}}
    </h1>
    <h2 class="text-base sm:text-lg md:text-xl text-center text-green-800 mb-2 sm:mb-4 font-bold">
       Question No. {{session('currentQuiz')['currentMcq']}}
    </h2>

    <h2 class="text-sm sm:text-base md:text-lg text-center text-green-800 mb-4 sm:mb-6 font-bold">
    {{session('currentQuiz')['currentMcq']}}  of {{session('currentQuiz')['totalMcq']}}
    </h2>

  <div class="mt-2 p-4 sm:p-6 bg-white shadow-2xl rounded-xl w-full max-w-4xl">
    <h3 class="text-green-900 font-bold text-lg sm:text-xl mb-4" >{{$mcqData->question}}</h3>
    <form action="/submit-next/{{$mcqData->id}}" class="space-y-3 sm:space-y-4" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$mcqData->id}}">
    <label for="option_1" class="flex border p-3 sm:p-4 mt-2 rounded-2xl shadow-2xl cursor-pointer hover:bg-blue-50 transition duration-200">
        <input id="option_1" class="form-radio text-blue-500 mt-1 flex-shrink-0" type="radio" value="a" name="option">
        <span class="text-green-900 pl-3 text-sm sm:text-base leading-relaxed" >{{$mcqData->a}}</span>
    </label>
    <label for="option_2" class="flex border p-3 sm:p-4 mt-2 rounded-2xl shadow-2xl cursor-pointer hover:bg-blue-50 transition duration-200">
        <input id="option_2" class="form-radio text-blue-500 mt-1 flex-shrink-0" type="radio" value="b" name="option">
        <span class="text-green-900 pl-3 text-sm sm:text-base leading-relaxed" >{{$mcqData->b}}</span>
    </label>
    <label for="option_3"  class="flex border p-3 mt-2 rounded-2xl shadow-2xl">
        <input id="option_3" class="form-radio text-blue-500" type="radio" value="c" name="option">
        <span class="text-green-900 pl-2" >{{$mcqData->c}}</span>
    </label>
    <label for="option_4"  class="flex border p-3 mt-2 rounded-2xl shadow-2xl">
        <input id="option_4" class="form-radio text-blue-500" type="radio" value="d" name="option">
        <span class="text-green-900 pl-2" >{{$mcqData->d}} </span>
    </label>
    <button type="submit" class="w-full bg-blue-500 rounded-xl px-4 py-2 text-white" >
    Submit Answer and Next
    </button>


    </form>
  </div>

</div>
<x-footer-user></x-footer-user>
</body>
</html>