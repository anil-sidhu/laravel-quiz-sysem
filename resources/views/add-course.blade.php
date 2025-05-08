<div>
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Course Page</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-navbar  name={{$name}} ></x-navbar>
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
    <div class=" bg-white p-8 rounded-2xl  shadow-lg w-full max-w-sm">
    <h2 class="text-2xl text-center text-gray-800 mb-6 ">Add Course </h2>
    @error('user')
       <div class="text-red-500">{{$message}}</div>
       @enderror
    <form action="/add-course" method="post" class="space-y-4">
        @csrf
        <div>
            <label for="" class="text-gray-600 mb-1">Course Title</label>
            <input type="text"placeholder="Enter Course name" name="title"
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
       @error('title')
       <div class="text-red-500">{{$message}}</div>
       @enderror
        </div>
        <div>
            <label for="" class="text-gray-600 mb-1">Course Description</label>
            <textarea placeholder="Enter Course Description" name="description"
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none" >
</textarea>
            @error('description')
       <div class="text-red-500">{{$message}}</div>
       @enderror
        </div>
        <button type="submit" class="w-full bg-blue-500 rounded-xl px-4 py-2 text-white" >Add Course</button>
    </form>
    </div>
</body>