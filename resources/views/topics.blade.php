<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-navbar name={{$name}} ></x-navbar>
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
    <div class="w-200">
        <h1 class="text-2xl text-blue-500">Users List</h1>
        <ul class="border border-gray-200">
        <li class="p-2 font-bold">
                <ul class="flex justify-between">
                    <li class="w-30">S. No</li>
                    <li class="w-70">Title</li>
                    <li class="w-70">Action</li>
                </ul>
            </li>

            @foreach($topics as $key=>$topics)
            <li class="even:bg-gray-200 p-2">
                <ul class="flex justify-between">
                    <li class="w-30">{{$key+1}}</li>
                    <li class="w-70">{{$topics->title}}</li>
                    <li class="w-70">
                        <a href="/edit-topic/{{$topics->id}}">Edit</a>
                        <a href="/delete-topic/{{$topics->id}}">Delete</a>
                    </li>
                   
                </ul>
            </li>
            @endforeach
        </ul>
    </div>
    <div>
    
    </div>
</div>
</body>
</html> 