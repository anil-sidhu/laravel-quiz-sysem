<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Categories Page</title>
    @vite('resources/css/app.css')
</head>
<body>
<x-common></x-common>
    <x-navbar  name={{$name}} ></x-navbar>
    @if(session('category'))
    <div class=" bg-green-800 text-white pl-5">{{session('category')}}</div>
    @endif
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
    <div class=" bg-white p-8 rounded-2xl  shadow-lg w-full max-w-sm">
    <h2 class="text-2xl text-center text-gray-800 mb-6 ">Add Category </h2>
    <form action="/add-category" method="post" class="space-y-4">
        @csrf
        <div>
            <input type="text"placeholder="Enter category name" name="category"
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
        @error('category')
    <div class="text-red-500" >{{$message}}</div>
    @enderror
        </div>
        <button type="submit" class="w-full bg-green-900 rounded-xl px-4 py-2 text-white" >Add</button>
    </form>
    </div>
    <div class="w-200">
        <h1 class="text-2xl text-blue-500">Category List</h1>
        <ul class="border border-gray-200">
        <li class="p-2 font-bold bg-gray-300">
                <ul class="flex justify-between items-center">
                    <li class="w-16">ID</li>
                    <li class="w-40">Name</li>
                    <li class="w-30">Creator</li>
                    <li class="w-60 text-center">Actions</li>
                </ul>
            </li>

            @foreach($categories as $category)
            <li class="even:bg-gray-200 p-2 hover:bg-blue-50">
                <ul class="flex justify-between items-center">
                    <li class="w-16">{{$category->id}}</li>
                    <li class="w-40 font-medium">{{$category->name}}</li>
                    <li class="w-30">{{$category->creator}}</li>
                    <li class="w-60 flex justify-center gap-2">
                        <!-- View Quizzes Button -->
                        <a href="quiz-list/{{$category->id}}/{{$category->name}}" class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-1 rounded flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="currentColor"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
                            View Quizzes
                        </a>
                        <!-- Delete Category Button -->
                        <a href="category/delete/{{$category->id}}" class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded flex items-center gap-1" onclick="return confirm('Are you sure you want to delete this category?')">
                            <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="currentColor"><path d="M312-144q-29.7 0-50.85-21.15Q240-186.3 240-216v-480h-48v-72h192v-48h192v48h192v72h-48v479.57Q720-186 698.85-165T648-144H312Zm336-552H312v480h336v-480ZM384-288h72v-336h-72v336Zm120 0h72v-336h-72v336ZM312-696v480-480Z"/></svg>
                            Delete
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