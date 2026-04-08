<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <title>All Quizzes - Admin</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-navbar name={{$name}}></x-navbar>
 
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
    
    @if(session('message-success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 w-full max-w-4xl">
            {{ session('message-success') }}
        </div>
    @endif
    @if(session('message-error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 w-full max-w-4xl">
            {{ session('message-error') }}
        </div>
    @endif
    
    <div class="flex justify-between items-center w-full max-w-4xl mb-4">
        <h2 class="text-2xl text-gray-800 font-bold">All Quizzes</h2>
        <a href="/add-quiz" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="currentColor"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
            Add New Quiz
        </a>
    </div>
    
    <div class="mb-4 text-gray-600">
        Total Quizzes: <span class="font-bold text-blue-600">{{ count($quizzes) }}</span>
    </div>
    
    <div class="w-full max-w-4xl">
        <ul class="border border-gray-200 rounded-lg overflow-hidden bg-white shadow">
            <li class="p-3 font-bold bg-gray-300">
                <ul class="flex justify-between items-center">
                    <li class="w-16">ID</li>
                    <li class="flex-1">Quiz Name</li>
                    <li class="w-32">Category</li>
                    <li class="w-20 text-center">MCQs</li>
                    <li class="w-48 text-center">Actions</li>
                </ul>
            </li>

            @forelse($quizzes as $quiz)
            <li class="even:bg-gray-100 p-3 hover:bg-blue-50 border-b border-gray-200">
                <ul class="flex justify-between items-center">
                    <li class="w-16 text-gray-600">{{$quiz->id}}</li>
                    <li class="flex-1 font-medium">{{$quiz->name}}</li>
                    <li class="w-32">
                        <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded">
                            {{$quiz->category ? $quiz->category->name : 'No Category'}}
                        </span>
                    </li>
                    <li class="w-20 text-center">
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded font-bold">{{$quiz->mcq_count ?? 0}}</span>
                    </li>
                    <li class="w-48 flex justify-center gap-2">
                        <!-- View Questions -->
                        <a href="/show-quiz/{{$quiz->id}}/{{$quiz->name}}" class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-1 rounded flex items-center gap-1" title="View Questions">
                            <svg xmlns="http://www.w3.org/2000/svg" height="14px" viewBox="0 -960 960 960" width="14px" fill="currentColor"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
                            View
                        </a>
                        <!-- Delete Quiz -->
                        <a href="/delete-quiz/{{$quiz->id}}" class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded flex items-center gap-1" title="Delete Quiz" onclick="return confirm('Are you sure you want to delete this quiz and all its questions?')">
                            <svg xmlns="http://www.w3.org/2000/svg" height="14px" viewBox="0 -960 960 960" width="14px" fill="currentColor"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                            Delete
                        </a>
                    </li>
                </ul>
            </li>
            @empty
            <li class="p-8 text-center text-gray-500">
                <p class="text-lg mb-4">No quizzes found</p>
                <a href="/add-quiz" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="currentColor"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                    Create Your First Quiz
                </a>
            </li>
            @endforelse
        </ul>
    </div>
</div>
</body>
</html>
