<!DOCTYPE html>
<html lang="en">
<head>
    <x-common></x-common>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>The Coding skills | Code & Notes of Step by Step YouTube Channel | Anil Sidhu</title>
    <meta name="description" content="Find coding & programming MCQs, Interview questions, notes and code for  code step by step YouTube Channel in various programming languages | Anil Sidhu" />
  <meta name="keywords" content="Anil Sidhu, Interview Questions, programming language mcqs, technology quizzes for developers, coding video summaries, programming notes pdf, code snippets library, software development practice, web development mcqs, data science mcqs, the coding skills, Anil sidhu" />
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
    <div class="w-full max-w-4xl mx-auto p-4" id="successMessage">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-md text-center">
            <p class="font-semibold text-lg">{{session('message-success')}}</p>
        </div>
    </div>
    @endif
    <h1 class="border-b border-solid text-2xl sm:text-3xl md:text-4xl text-green-900 p-4 sm:p-5 pb-2 mb-4 mt-6 sm:mt-10 font-extralight text-center px-4" >Test Skills with MCQs</h1>
    
    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-4 sm:p-8 font-extralight text-lg sm:text-xl md:text-2xl w-full max-w-full">
    @foreach($categories as $key=>$category)
    <a class="p-4 sm:p-6 text-center border w-full min-h-[80px] sm:min-h-[100px] flex items-center justify-center rounded-lg transition duration-300 hover:bg-green-900 hover:text-white cursor-pointer break-words" href="user-quiz-list/{{$category->id}}/{{str_replace(' ','-',$category->name)}}">
    {{$category->name}}
    </a>
    @endforeach

    </div>

    <!-- Sharpener Promotional Box -->
    <div class="w-full max-w-4xl mx-auto p-4 sm:p-8 mt-6 sm:mt-10">
        <div class="bg-white rounded-lg shadow-lg p-6 sm:p-8 relative">
            <!-- Sharpener Logo and Text - Top Right -->
            <div class="absolute top-4 right-4 flex items-center">
                <svg class="w-8 h-8 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" fill="url(#sharpenerGradient)" stroke="url(#sharpenerGradient)" stroke-width="0.5"/>
                    <defs>
                        <linearGradient id="sharpenerGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#b00;stop-opacity:1" />
                            <stop offset="105.83%" style="stop-color:#000;stop-opacity:1" />
                        </linearGradient>
                    </defs>
                </svg>
                <span class="text-lg font-bold" style="background: linear-gradient(90deg, #b00, #000 105.83%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Sharpener</span>
            </div>

            <!-- Pay After Placement Badge -->
            <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mb-4" style="background-color: #FEE2E2; color: #B91C1C;">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                Pay After Placement Program
            </div>

            <!-- Main Heading -->
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-2">Join India's Rank 1 training Institute</h2>

            <!-- Rating and Trust Indicators -->
            <div class="flex flex-wrap items-center gap-4 mb-6">
                <div class="flex items-center">
                    <div class="flex text-yellow-400">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <span class="ml-2 text-gray-600 text-sm">4.93 star rated on google</span>
                </div>
                <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">Trusted by 100k+ learners</div>
                <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">4000+ placements</div>
            </div>

            <!-- Learn More Button -->
            @if(session('user'))
                <button onclick="openSharpenerDashboard()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-flex items-center transition duration-300">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    Learn more
                </button>
            @else
                <a href="/user-signup" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-flex items-center transition duration-300">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    Learn more
                </a>
            @endif
        </div>
    </div>

    <h3 class="border-b border-solid text-2xl sm:text-3xl md:text-4xl text-green-900 p-4 sm:p-5 pb-2 mb-4 mt-6 sm:mt-10 font-extralight text-center px-4" >Top Coding Quiz</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-4 sm:p-8 font-extralight w-full max-w-full">
    @foreach($quizData as $item)
    <a href="/start-quiz/{{$item->id}}/{{str_replace(' ','-',$item->name)}}" class="p-4 sm:p-6 text-center w-full min-h-[80px] sm:min-h-[100px] flex items-center justify-center border rounded-lg transition duration-300 bg-green-900 text-white hover:bg-gray-100 hover:text-green-900 cursor-pointer break-words text-sm sm:text-base">
    {{$item->name}}
    </a>
    @endforeach
    </div>

    <h2 class="border-b border-solid text-2xl sm:text-3xl md:text-4xl text-green-900 p-4 sm:p-5 pb-2 mb-4 mt-6 sm:mt-10 font-extralight text-center px-4" >Top Programming Language Courses</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-4 sm:p-8 font-extralight w-full max-w-full">
@foreach($courses as $course)
<a href="/course-details/{{$course->id}}/{{str_replace(' ', '-',$course->title)}}" class="p-4 sm:p-6 text-center w-full min-h-[80px] sm:min-h-[100px] flex items-center justify-center border rounded-lg transition duration-300 bg-green-900 text-white hover:bg-gray-100 hover:text-green-900 cursor-pointer break-words text-sm sm:text-base">
    {{$course->title}}
</a>
@endforeach
 
  </div>
</div>
<x-footer-user></x-footer-user>
@if(!session('user'))
    @include('components.lead-modal', ['closable' => true])
@endif

<script>
    // Auto-hide success messages after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = document.getElementById('successMessage');
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.transition = 'opacity 0.5s ease-out';
                successMessage.style.opacity = '0';
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 500);
            }, 5000);
        }
    });

    // Sharpener Dashboard functionality
    function openSharpenerDashboard() {
        fetch('/open-sharpener-dashboard', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Redirect to Sharpener dashboard with JWT token
                window.location.href = data.redirect_url;
            } else {
                alert(data.message || 'Something went wrong. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Something went wrong. Please try again.');
        });
    }
</script>
</body>