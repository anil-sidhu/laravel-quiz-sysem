<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>The Coding Skills User Login | Code Step by Step YouTube Channel Official website | theCodingSkills.com/</title>
    <meta name="description" content="Login for coding and programming language MCQs, structured notes from coding code step by step YouTube Channel, Anil Sidhu">
  <meta name="keywords" content="Anil Sidhu, Code step by step youtube channel, Programming language MCQs, technology quizzes for developers, The Coding Skills">
  
    @vite('resources/css/app.css')
    <style>
        body {
            overflow-x: hidden;
            max-width: 100vw;
        }
        @media (max-width: 768px) {
            .mobile-full-form {
                min-height: auto;
                padding: 0;
                background: white;
                align-items: flex-start;
                justify-content: flex-start;
            }
            .mobile-full-form .form-container {
                max-width: 100%;
                width: 100%;
                box-shadow: none;
                border-radius: 0;
                padding: 2rem 1rem;
                margin-top: 0;
                margin-bottom: 0;
            }
        }
    </style>
</head>
<body>
<x-user-navbar></x-user-navbar> 
<div class="bg-gray-100 flex items-center justify-center min-h-screen px-4 mobile-full-form">
    
    <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg w-full max-w-sm form-container">

    @if(session('message-error'))
    <div>
        <p class=" text-red-500 font-bold">{{session('message-error')}}</p>
    </div>
    @endif

    @if(session('message-success'))
    <div>
        <p class=" text-green-500 font-bold">{{session('message-success')}}</p>
    </div>
    @endif

    <h2 class="text-xl sm:text-2xl text-center text-gray-800 mb-4 sm:mb-6">User Login</h2>
    
    <div id="resetNotification" class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg" style="display: none;">
        <p class="text-blue-800 text-sm">
            <strong>Note:</strong> You can try logging in with a different email address.
        </p>
    </div>
    @error('user')
       <div class="text-red-500">{{$message}}</div>
       @enderror
    <form action="/user-login" method="post" class="space-y-4">
        @csrf
    

        <div>
            <label for="email" class="text-gray-600 mb-1 text-sm sm:text-base">User Email</label>
            <input type="text" id="email" placeholder="Enter User email" name="email"
            class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-xl focus:outline-none text-sm sm:text-base">
       @error('email')
       <div class="text-red-500">{{$message}}</div>
       @enderror
        </div>

        <div>
            <label for="" class="text-gray-600 mb-1 text-sm sm:text-base">Password</label>
            <input type="password" placeholder="Enter User password" name="password"
            class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-xl focus:outline-none text-sm sm:text-base">
            @error('password')
       <div class="text-red-500">{{$message}}</div>
       @enderror
        </div>

        <button type="submit" class="w-full bg-blue-500 rounded-xl px-4 py-2 sm:py-3 text-white font-medium">Login</button>
        
        <div class="flex flex-col sm:flex-row items-center justify-between gap-2 mt-4">
            <a href="user-forgot-password" class="text-green-500 text-sm sm:text-base hover:underline">Forgot Password?</a>
            <a href="user-signup" class="text-blue-600 text-sm sm:text-base hover:underline">Don't have an account? Sign up</a>
        </div>
    </form>
    </div>
</div>
<x-footer-user></x-footer-user>

<script>
    // Check if user is coming back from OTP page (browser back button or direct link)
    document.addEventListener('DOMContentLoaded', function() {
        const fromOtpPage = sessionStorage.getItem('fromOtpPage');
        const isResetParam = window.location.search.includes('reset=true');
        
        if (fromOtpPage || isResetParam) {
            // Clear the email field
            document.getElementById('email').value = '';
            
            // Show notification
            document.getElementById('resetNotification').style.display = 'block';
            
            // Focus on email field
            document.getElementById('email').focus();
            
            // Clear the session storage flag
            sessionStorage.removeItem('fromOtpPage');
            
            // Update URL to remove reset parameter
            if (isResetParam) {
                const url = new URL(window.location);
                url.searchParams.delete('reset');
                window.history.replaceState({}, '', url);
            }
        }
    });
</script>
</body>
</html>