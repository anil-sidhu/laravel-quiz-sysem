<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Categories Page</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-navbar  name={{$name}} ></x-navbar>
 
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
    <h2 class="text-2xl text-center text-gray-800 mb-6 ">category Name : {{$category}}
         <a class="text-yellow-500 text-sm" href="/add-quiz" >Back</a>
         </h2>
    <div class="w-200">
        <ul class="border border-gray-200">
        <li class="p-2 font-bold">
                <ul class="flex justify-between">
                    <li class="w-30">Quiz Id</li>
                    <li class="w-140">Name</li>
                    <li class="w-30">Action</li>
                </ul>
            </li>

            @foreach($quizData as $item)
            <li class="even:bg-gray-200 p-2">
                <ul class="flex justify-between">
                    <li class="w-30">{{$item->id}}</li>
                    <li class="w-140">{{$item->name}}</li>
                    <li class="w-30">
                    <a href="/show-quiz/{{$item->id}}/{{$item->name}}">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
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