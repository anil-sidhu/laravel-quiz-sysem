<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <title>The Coding Skills User Signup | Code Step by Step YouTube Channel Official website | theCodingSkills.com</title>
    <meta name="description" content="Signup for coding and programming language MCQs, structured notes from coding code step by step YouTube Channel, Anil Sidhu">
  <meta name="keywords" content="Anil Sidhu, Code step by step youtube channel, Programming language MCQs, technology quizzes for developers,  The Coding Skills">
  
    @vite('resources/css/app.css')
</head>
<body>
<x-user-navbar></x-user-navbar> 
<div class=" bg-gray-100 flex items-center justify-center min-h-screen">
    
    <div class=" bg-white p-8 rounded-2xl  shadow-lg w-full max-w-sm">
    <h2 class="text-2xl text-center text-gray-800 mb-6 ">User Signup </h2>
    @error('user')
       <div class="text-red-500">{{$message}}</div>
       @enderror
    <form action="/user-signup" method="post" class="space-y-4">
        @csrf
        <div>
            <label for="" class="text-gray-600 mb-1">User Name</label>
            <input type="text"placeholder="Enter User name" name="name"
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
       @error('name')
       <div class="text-red-500">{{$message}}</div>
       @enderror
        </div>

        <div>
            <label for="" class="text-gray-600 mb-1">User Email</label>
            <input type="text"placeholder="Enter User email" name="email"
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
       @error('email')
       <div class="text-red-500">{{$message}}</div>
       @enderror
        </div>

        <div>
            <label for="" class="text-gray-600 mb-1">User Mobile</label>
            <input type="text"placeholder="Enter User Mobile" name="mobile"
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
       @error('mobile')
       <div class="text-red-500">{{$message}}</div>
       @enderror
        </div>

        <div>
            <label for="" class="text-gray-600 mb-1">Password</label>
            <input type="password"placeholder="Enter User password" name="password"
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
            @error('password')
       <div class="text-red-500">{{$message}}</div>
       @enderror
        </div>


        <div>
            <label for="" class="text-gray-600 mb-1">Confirm Password</label>
            <input type="password"placeholder="Confirm User password" name="password_confirmation"
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
          
        </div>

        <button type="submit" class="w-full bg-blue-500 rounded-xl px-4 py-2 text-white" >Signup</button>
    </form>
    </div>
</div>
<x-footer-user></x-footer-user>
</body>
</html>