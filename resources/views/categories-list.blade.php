<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>The Coding Skills</title>
    @vite('resources/css/app.css')
    <style>
        body {
            overflow-x: hidden;
            max-width: 100vw;
        }
        .grid {
            max-width: 100%;
        }
    </style>
</head>
<body>
  <x-user-navbar></x-user-navbar> 
  <div class="flex flex-col min-h-screen items-center bg-gray-100 w-full max-w-full overflow-x-hidden">
    @if(session('message-success'))
    <div>
        <p class=" text-green-500 font-bold">{{session('message-success')}}</p>
    </div>
    @endif
   
    <h1 class="text-4xl font-bold text-green-900 p-5" >MCQs Categories</h1>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 p-8 font-extralight text-2xl w-full max-w-full">
    @foreach($categories as $key=>$category)
    <div class="p-6 text-center border w-full rounded-lg transition duration-300 hover:bg-green-900 hover:text-white cursor-pointer break-words text-lg sm:text-2xl">
    {{$category->name}}
    </div>
    @endforeach

    </div>
 

    <div class="mb-10 mt-5">
        {{$categories->links()}}
       </div>

</div>
<x-footer-user></x-footer-user>
@if(!session('user'))
    @include('components.lead-modal', ['closable' => true])
@endif
</body>