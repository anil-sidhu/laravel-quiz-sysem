<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
<title>The Coding Skills User Forget Password | Code Step by Step YouTube Channel Official website | theCodingSkills.com</title>
    <meta name="description" content="Forget password page theCodingSkills.com structured notes from coding code step by step YouTube Channel, Anil Sidhu">
  <meta name="keywords" content="Anil Sidhu, Code step by step youtube channel, Programming language MCQs, Forget password page theCodingSkills.com, The Coding Skills">
  
    @vite('resources/css/app.css')
</head>
<body>
<x-user-navbar></x-user-navbar> 
<div class=" bg-gray-100 flex items-center justify-center min-h-screen">
    
    <div class=" bg-white p-8 rounded-2xl  shadow-lg w-full max-w-sm">
    <h2 class="text-2xl text-center text-gray-800 mb-6 ">Forgot Password  </h2>
    @error('user')
       <div class="text-red-500">{{$message}}</div>
       @enderror
    <form action="/user-forgot-password" method="post" class="space-y-4">
        @csrf

        <div>
            <input type="text"placeholder="Enter User email" name="email"
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
       @error('email')
       <div class="text-red-500">{{$message}}</div>
       @enderror
        </div>
        <button type="submit" class="w-full bg-green-900 rounded-xl px-4 py-2 text-white" >Submit</button>
  
    </form>
    </div>
</div>
</body>
</html>