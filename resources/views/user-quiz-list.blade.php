<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{str_replace('-',' ', $category)}} MCQ Quiz | Code Step by Step YouTube Channel website | theCodingSkills.com | Anil Sidhu</title>
    <meta name="description" content="{{str_replace('-',' ', $category)}} Quiz , {{str_replace('-',' ', $category)}} objective Questions,   ,structured notes from coding YouTube Channel, and practical code examples to level up your skills in various programming languages and related technologies">
  <meta name="keywords" content="{{str_replace('-',' ', $category)}} Quiz , {{str_replace('-',' ', $category)}} Interview Questions, {{str_replace('-',' ', $category)}} Latest Questions, programming language MCQs, programming notes pdf, Anil Sidhu, the coding skills">
    @vite('resources/css/app.css')
    <style>
        body {
            overflow-x: hidden;
            max-width: 100vw;
        }
    </style>
</head>
<body>
    <x-user-navbar ></x-user-navbar>
 
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5 w-full max-w-full overflow-x-hidden px-4">
    <h2 class="text-xl sm:text-2xl text-center text-green-800 mb-6 font-bold px-4">Category Name : {{str_replace('-',' ', $category)}}
         </h2>
    
    <!-- Desktop Table View -->
    <div class="hidden md:block w-full max-w-4xl">
        <ul class="border border-gray-200 bg-white rounded-lg overflow-hidden">
        <li class="p-3 font-bold bg-green-50">
                <ul class="flex justify-between">
                    <li class="w-20 text-sm">Quiz Id</li>
                    <li class="flex-1 text-sm px-4">Name</li>
                    <li class="w-24 text-sm">Mcq Count</li>
                    <li class="w-28 text-sm">Action</li>
                </ul>
            </li>

            @foreach($quizData as $item)
            <li class="even:bg-gray-50 p-3 border-t border-gray-100">
                <ul class="flex justify-between items-center">
                    <li class="w-20 text-sm">{{$item->id}}</li>
                    <li class="flex-1 text-sm px-4 break-words">{{$item->name}}</li>
                    <li class="w-24 text-sm">{{$item->mcq_count}}</li>
                    <li class="w-28 text-sm">
                    <a href="/start-quiz/{{$item->id}}/{{str_replace(' ','-', $item->name)}}" class="text-green-900 font-bold hover:text-green-700 text-sm">
                        Attempt Quiz
                        </a>
                    </li>
                </ul>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Mobile Card View -->
    <div class="md:hidden w-full max-w-md">
        @foreach($quizData as $item)
        <div class="bg-white border border-gray-200 rounded-lg p-4 mb-4 shadow-sm">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm text-gray-600">Quiz ID: {{$item->id}}</span>
                <span class="text-sm text-gray-600">MCQs: {{$item->mcq_count}}</span>
            </div>
            <h3 class="font-semibold text-green-800 mb-3 break-words">{{$item->name}}</h3>
            <a href="/start-quiz/{{$item->id}}/{{str_replace(' ','-', $item->name)}}" class="inline-block bg-green-500 text-white px-4 py-2 rounded-lg font-bold hover:bg-green-600 transition duration-200 text-center w-full">
                Attempt Quiz
            </a>
        </div>
        @endforeach
    </div>
</div>
@if(!session('user'))
    @include('components.lead-modal', ['closable' => true])
@endif
</body>
</html>