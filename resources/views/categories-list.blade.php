<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <title>The Coding Skills</title>
    @vite('resources/css/app.css')
</head>
<body>
  <x-user-navbar></x-user-navbar> 
  <div class="flex flex-col min-h-screen items-center bg-gray-100">
    @if(session('message-success'))
    <div>
        <p class=" text-green-500 font-bold">{{session('message-success')}}</p>
    </div>
    @endif
   
    <h1 class="text-4xl font-bold text-green-900 p-5" >MCQs Categories</h1>

    <div class="grid sm:grid-cols-3 md:grid-cols-4 gap-4 p-8 font-extralight text-2xl">
    @foreach($categories as $key=>$category)
    <div class="p-6 text-center border md:w-40 lg:w-60 rounded-lg transition duration-300 hover:bg-green-900 hover:text-white cursor-pointer">
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