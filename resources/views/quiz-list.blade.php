<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <title>Admin Categories Page</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-navbar  name={{$name}} ></x-navbar>
 
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
    
    @if(session('message-success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 w-200">
            {{ session('message-success') }}
        </div>
    @endif
    @if(session('message-error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 w-200">
            {{ session('message-error') }}
        </div>
    @endif
    
    <h2 class="text-2xl text-center text-gray-800 mb-6 ">Category: {{$category}}
         <a class="text-yellow-500 text-sm" href="/add-quiz" >Back</a>
         </h2>
    <div class="w-200">
        <ul class="border border-gray-200">
        <li class="p-2 font-bold bg-gray-300">
                <ul class="flex justify-between items-center">
                    <li class="w-20">Quiz Id</li>
                    <li class="w-100 flex-1">Name</li>
                    <li class="w-20 text-center">MCQs</li>
                    <li class="w-40 text-center">Actions</li>
                </ul>
            </li>

            @foreach($quizData as $item)
            <li class="even:bg-gray-200 p-2 hover:bg-blue-50">
                <ul class="flex justify-between items-center">
                    <li class="w-20">{{$item->id}}</li>
                    <li class="w-100 flex-1">{{$item->name}}</li>
                    <li class="w-20 text-center">
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{$item->mcq_count ?? 0}}</span>
                    </li>
                    <li class="w-40 flex justify-center gap-3">
                        <!-- View Quiz -->
                        <a href="/show-quiz/{{$item->id}}/{{$item->name}}" class="text-blue-600 hover:text-blue-800" title="View Questions">
                            <svg xmlns="http://www.w3.org/2000/svg" height="22px" viewBox="0 -960 960 960" width="22px" fill="currentColor"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
                        </a>
                        <!-- Delete Quiz -->
                        <a href="/delete-quiz/{{$item->id}}" class="text-red-600 hover:text-red-800" title="Delete Quiz" onclick="return confirm('Are you sure you want to delete this quiz? This will also delete all its questions.')">
                            <svg xmlns="http://www.w3.org/2000/svg" height="22px" viewBox="0 -960 960 960" width="22px" fill="currentColor"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
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