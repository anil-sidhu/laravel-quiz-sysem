<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <title>The Coding Skills User Signup | Code Step by Step YouTube Channel Official website | theCodingSkills.com</title>
    <meta name="description" content="Signup for coding and programming language MCQs, structured notes from coding code step by step YouTube Channel, Anil Sidhu">
  <meta name="keywords" content="Anil Sidhu, Code step by step youtube channel, Programming language MCQs, technology quizzes for developers,  The Coding Skills">
  
    @vite('resources/css/app.css')
    <style>
        .input-error {
            color: #e3342f;
            font-size: 0.95rem;
            margin-top: 0.25rem;
        }
        .spinner {
            border: 2px solid #f3f3f3;
            border-top: 2px solid #3498db;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            animation: spin 1s linear infinite;
            display: inline-block;
            vertical-align: middle;
            margin-left: 8px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .password-toggle {
            position: absolute;
            right: 12px;
            top: 70%;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .relative { position: relative; }
    </style>
</head>
<body>
<x-user-navbar></x-user-navbar> 
<div class=" bg-gray-100 flex items-center justify-center min-h-screen">
    
    <div class=" bg-white p-8 rounded-2xl  shadow-lg w-full max-w-sm">
    <h2 class="text-2xl text-center text-gray-800 mb-6 ">User Signup </h2>
    <!-- @if ($errors->any())
        <div class="mb-4 input-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif -->
    <form id="signupForm" action="/user-signup" method="post" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="text-gray-600 mb-1">User Name</label>
            <input type="text" id="name" placeholder="Enter User name" name="name"
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none" value="{{ old('name') }}">
       @error('name')
       <div class="input-error">{{$message}}</div>
       @enderror
        </div>

        <div>
            <label for="email" class="text-gray-600 mb-1">User Email</label>
            <input type="text" id="email" placeholder="Enter User email" name="email"
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none" value="{{ old('email') }}">
       @error('email')
       <div class="input-error">{{$message}}</div>
       @enderror
        </div>

        <div>
            <label for="mobile" class="text-gray-600 mb-1">User Mobile</label>
            <input type="text" id="mobile" placeholder="Enter User Mobile" name="mobile"
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none" value="{{ old('mobile') }}">
       @error('mobile')
       <div class="input-error">{{$message}}</div>
       @enderror
        </div>

        <div class="relative">
            <label for="password" class="text-gray-600 mb-1">Password</label>
            <input type="password" id="password" placeholder="Enter User password" name="password"
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
            <span class="password-toggle" onclick="togglePassword('password', this)">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-.274.832-.64 1.624-1.09 2.354M15.54 15.54A8.963 8.963 0 0112 17c-4.478 0-8.268-2.943-9.542-7a9.014 9.014 0 012.042-3.362M9.88 9.88a3 3 0 014.24 4.24"/></svg>
            </span>
            @error('password')
            <div class="input-error">{{$message}}</div>
            @enderror
        </div>

        <div class="relative">
            <label for="password_confirmation" class="text-gray-600 mb-1">Confirm Password</label>
            <input type="password" id="password_confirmation" placeholder="Confirm User password" name="password_confirmation"
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
            <span class="password-toggle" onclick="togglePassword('password_confirmation', this)">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-.274.832-.64 1.624-1.09 2.354M15.54 15.54A8.963 8.963 0 0112 17c-4.478 0-8.268-2.943-9.542-7a9.014 9.014 0 012.042-3.362M9.88 9.88a3 3 0 014.24 4.24"/></svg>
            </span>
        </div>

        <div>
            <label for="interested_in_training" class="text-gray-600 mb-1">Interested in Training</label>
            <select id="interested_in_training" name="interested_in_training" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                <option value="">Select an option</option>
                <option value="yes" {{ old('interested_in_training') == 'yes' ? 'selected' : '' }}>Yes, I am interested in training</option>
                <option value="no" {{ old('interested_in_training') == 'no' ? 'selected' : '' }}>No, not interested</option>
            </select>
            @error('interested_in_training')
            <div class="input-error">{{$message}}</div>
            @enderror
        </div>

        <div class="flex items-center">
            <input type="checkbox" id="leads" name="leads" value="1" class="mr-2" {{ old('leads') ? 'checked' : '' }}>
            <label for="leads" class="text-gray-600 mb-1">I would like to receive call from training</label>
        </div>

        <button id="signupBtn" type="submit" class="w-full bg-blue-500 rounded-xl px-4 py-2 text-white flex items-center justify-center">
            Signup
            <span id="signupSpinner" class="spinner" style="display:none;"></span>
        </button>
    </form>
    </div>
</div>
<x-footer-user></x-footer-user>
<script>
    // Password visibility toggle
    function togglePassword(fieldId, el) {
        const input = document.getElementById(fieldId);
        if (input.type === 'password') {
            input.type = 'text';
            el.classList.add('text-blue-500');
        } else {
            input.type = 'password';
            el.classList.remove('text-blue-500');
        }
    }

    // Loading indicator on submit
    document.getElementById('signupForm').addEventListener('submit', function(e) {
        var btn = document.getElementById('signupBtn');
        var spinner = document.getElementById('signupSpinner');
        btn.disabled = true;
        spinner.style.display = 'inline-block';
    });
</script>
</body>
</html>