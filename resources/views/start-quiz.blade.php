<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <title>{{ str_replace('-',' ', $quizName)}} The Coding Skills | Code Step by Step YouTube Channel Official website | Anil Sidhu</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-user-navbar ></x-user-navbar>
    @if(session('message-success'))
    <div>
        <p class=" text-green-900 font-bold">{{session('message-success')}}</p>
    </div>
    @endif
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
    <h1 class="text-4xl text-center text-green-800 mb-6 font-bold ">
    {{ str_replace('-',' ', $quizName)}}
    </h1>


    @if(isset($noQuestions) && $noQuestions)
        <div class="text-red-500 font-bold">No questions are available for this quiz yet. Please try again later.</div>
    @else
    <h2 class="text-lg text-center text-green-800 mb-6 font-bold ">
        This Quiz contains {{$quizCount}} Questions and no limit to attempt this Quiz</h2>
        <h1 class="text-2xl text-center text-green-800 mb-6 font-bold ">
        Good Luck
    </h1>
        @if(session('user'))
            <a type="submit" href="/mcq/{{session('firstMCQ')->id.'/'.$quizName}}" class=" bg-green-900 rounded-md px-4 py-2 my-5 text-white" >
            Start Quiz
            </a>
        @else
            <a type="submit" href="/user-signup-quiz" class=" bg-green-900 rounded-md px-4 py-2 my-5 text-white" >
                    SignUp for Start Quiz
            </a>
            <a type="submit" href="/user-login-quiz" class=" bg-green-900 rounded-md px-4 py-2 my-5 text-white" >
                    Login for Start Quiz
            </a>
        @endif
    @endif
  

</div>
@if(!session('user') && !session('admin'))
    @include('components.lead-modal', ['closable' => true])
@endif
</body>
</html>