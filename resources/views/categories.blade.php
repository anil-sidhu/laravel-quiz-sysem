<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Categories Page</title>
    @vite('resources/css/app.css')
</head>
<body>
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
        </div>
        <button type="submit" class="w-full bg-blue-500 rounded-xl px-4 py-2 text-white" >Add</button>
    </form>
    </div>
    <div class="w-200">
        <h1 class="text-2xl text-blue-500">Category List</h1>
        <ul class="border border-gray-200">
        <li class="p-2 font-bold">
                <ul class="flex justify-between">
                    <li class="w-30">S. No</li>
                    <li class="w-70">Name</li>
                    <li class="w-70">Creator</li>
                    <li class="w-30">Action</li>

                </ul>
            </li>

            @foreach($categories as $category)
            <li class="even:bg-gray-200 p-2">
                <ul class="flex justify-between">
                    <li class="w-30">{{$category->id}}</li>
                    <li class="w-70">{{$category->name}}</li>
                    <li class="w-70">{{$category->creator}}</li>
                    <li class="w-30">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#000000"><path d="M312-144q-29.7 0-50.85-21.15Q240-186.3 240-216v-480h-48v-72h192v-48h192v48h192v72h-48v479.57Q720-186 698.85-165T648-144H312Zm336-552H312v480h336v-480ZM384-288h72v-336h-72v336Zm120 0h72v-336h-72v336ZM312-696v480-480Z"/></svg>
                    </li>

                </ul>
            </li>
            @endforeach
        </ul>
    </div>
</div>
</body>
</html>