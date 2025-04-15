<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Categories Page</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-user-navbar ></x-user-navbar>
 
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
    <h2 class="text-2xl text-center text-green-800 mb-6 font-bold ">Category Name : {{$category}}
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
                    <a href="" class="text-green-500 font-bold">
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