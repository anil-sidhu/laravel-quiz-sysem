<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <title>{{str_replace('-',' ', $category)}} MCQ Quiz | Code Step by Step YouTube Channel website | theCodingSkills.com | Anil Sidhu</title>
    <meta name="description" content="{{str_replace('-',' ', $category)}} Quiz , {{str_replace('-',' ', $category)}} objective Questions,   ,structured notes from coding YouTube Channel, and practical code examples to level up your skills in various programming languages and related technologies">
  <meta name="keywords" content="{{str_replace('-',' ', $category)}} Quiz , {{str_replace('-',' ', $category)}} Interview Questions, {{str_replace('-',' ', $category)}} Latest Questions, programming language MCQs, programming notes pdf, Anil Sidhu, the coding skills">
    @vite('resources/css/app.css')
</head>
<body>
    <x-user-navbar ></x-user-navbar>
 
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
    <h2 class="text-2xl text-center text-green-800 mb-6 font-bold ">Category Name : {{str_replace('-',' ', $category)}}
         </h2>
    <div class="w-200">
        <ul class="border border-gray-200">
        <li class="p-2 font-bold">
                <ul class="flex justify-between">
                    <li class="w-30">Quiz Id</li>
                    <li class="w-110">Name</li>
                    <li class="w-300">Mcq Count</li>
                    <li class="w-30">Action</li>
                </ul>
            </li>

            @foreach($quizData as $item)
            <li class="even:bg-gray-200 p-2">
                <ul class="flex justify-between">
                    <li class="w-30">{{$item->id}}</li>
                    <li class="w-110">{{$item->name}}</li>
                    <li class="w-30">{{$item->mcq_count}}</li>
                    <li class="w-30">
                    <a href="/start-quiz/{{$item->id}}/{{str_replace(' ','-', $item->name)}}" class="text-green-500 font-bold">
                        Attempt Quiz
                        </a>
                    </li>
                </ul>
            </li>
            @endforeach
        </ul>
    </div>
</div>
</body>
</html>