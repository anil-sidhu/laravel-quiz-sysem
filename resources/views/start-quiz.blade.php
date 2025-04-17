<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Categories Page</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-user-navbar ></x-user-navbar>
    @if(session('message'))
<p class="text-green-500">{{'message'}}</p>
@endif
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
    <h1 class="text-4xl text-center text-green-800 mb-6 font-bold ">
        {{$quizName}}
    </h1>
    <h2 class="text-lg text-center text-green-800 mb-6 font-bold ">
        This Quiz container {{$quizCount}} Questions and no limit to attempt this Quiz</h2>
        <h1 class="text-2xl text-center text-green-800 mb-6 font-bold ">
        Good Luck
    </h1>

    @if(session('user'))
        <a type="submit" href="" class=" bg-blue-500 rounded-md px-4 py-2 my-5 text-white" >
        Start Quiz
</a>
@else
<a type="submit" href="/user-signup-quiz" class=" bg-blue-500 rounded-md px-4 py-2 my-5 text-white" >
        Login/SignUp for Start Quiz
</a>
@endif
  

</div>
</body>
</html>