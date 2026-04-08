<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <title>Show Quiz Page</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-navbar  name={{$name}} ></x-navbar>
 
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
    
    @if(session('message-success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 w-200">
            {{ session('message-success') }}
        </div>
    @endif
    @if(session('message-error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 w-200">
            {{ session('message-error') }}
        </div>
    @endif
    
    <h2 class="text-2xl text-center text-gray-800 mb-6">Quiz: {{$quizName}}
         <a class="text-yellow-500 text-sm" href="/add-quiz">Back</a>
         </h2>
    
    <div class="mb-4 text-gray-600">
        Total Questions: <span class="font-bold text-blue-600">{{ count($mcqs) }}</span>
    </div>
    
    <div class="w-200">
        <ul class="border border-gray-200 rounded-lg overflow-hidden">
        <li class="p-3 font-bold bg-gray-300">
                <ul class="flex justify-between items-center">
                    <li class="w-16">ID</li>
                    <li class="flex-1">Question</li>
                    <li class="w-24 text-center">Answer</li>
                    <li class="w-20 text-center">Action</li>
                </ul>
            </li>

            @forelse($mcqs as $mcq)
            <li class="even:bg-gray-200 p-3 hover:bg-blue-50">
                <ul class="flex justify-between items-center">
                    <li class="w-16">{{$mcq->id}}</li>
                    <li class="flex-1 pr-4">{{$mcq->question}}</li>
                    <li class="w-24 text-center">
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded font-bold">{{$mcq->correct_ans}}</span>
                    </li>
                    <li class="w-20 text-center">
                        <a href="/delete-mcq/{{$mcq->id}}" class="text-red-600 hover:text-red-800" title="Delete Question" onclick="return confirm('Are you sure you want to delete this question?')">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="currentColor" class="inline"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                        </a>
                    </li>
                </ul>
            </li>
            @empty
            <li class="p-4 text-center text-gray-500">No questions in this quiz yet.</li>
            @endforelse
        </ul>
    </div>
</div>
</body>
</html>
