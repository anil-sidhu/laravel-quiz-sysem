<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>The Coding Skills User Signup | Code Step by Step YouTube Channel Official website | theCodingSkills.com</title>
    <meta name="description" content="Signup for coding and programming language MCQs, structured notes from coding code step by step YouTube Channel, Anil Sidhu">
    <meta name="keywords" content="Anil Sidhu, Code step by step youtube channel, Programming language MCQs, technology quizzes for developers,  The Coding Skills">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
  
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
<div class=" bg-gray-100 flex items-center justify-center min-h-screen mobile-full-form">
    
    <div class=" bg-white p-8 rounded-2xl  shadow-lg w-full max-w-sm form-container">
    <h2 class="text-2xl text-center text-gray-800 mb-6 ">User Signup </h2>
    
    <div id="resetNotification" class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg" style="display: none;">
        <p class="text-blue-800 text-sm">
            <strong>Note:</strong> Phone number field has been cleared. You can enter a new number.
        </p>
    </div>
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
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none" 
            value="{{ old('mobile') }}" 
            autocomplete="off" 
            data-lpignore="true">
       @error('mobile')
       <div class="input-error">{{$message}}</div>
       @enderror
        </div>

        <div>
            <label for="passing_year" class="text-gray-600 mb-1">Passing Year (optional)</label>
            <select id="passing_year" name="passing_year" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                <option value="">Select year</option>
                @for($y = date('Y'); $y >= date('Y')-13; $y--)
                    <option value="{{$y}}" {{ old('passing_year') == $y ? 'selected' : '' }}>{{$y}}</option>
                @endfor
            </select>
            @error('passing_year')
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
        
        <div class="text-center mt-4">
            <a href="user-login" class="text-blue-600 text-sm sm:text-base hover:underline">Already have an account? Login</a>
        </div>
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

    // Check if user is coming back from OTP page (browser back button or direct link)
    document.addEventListener('DOMContentLoaded', function() {
        const fromOtpPage = sessionStorage.getItem('fromOtpPage');
        const isResetParam = window.location.search.includes('reset=true');
        
        if (fromOtpPage || isResetParam) {
            // Clear the mobile field immediately
            const mobileField = document.getElementById('mobile');
            if (mobileField) {
                // Multiple methods to clear the field
                mobileField.value = '';
                mobileField.defaultValue = '';
                mobileField.setAttribute('value', '');
                
                // Also clear any browser autofill
                mobileField.setAttribute('autocomplete', 'off');
                mobileField.setAttribute('data-lpignore', 'true');
                
                // Force a re-render
                mobileField.dispatchEvent(new Event('input', { bubbles: true }));
            }
            
            // Show notification
            const notification = document.getElementById('resetNotification');
            if (notification) {
                notification.style.display = 'block';
            }
            
            // Focus on mobile field
            if (mobileField) {
                mobileField.focus();
            }
            
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

    // Additional check on page load to handle browser cache
    window.addEventListener('pageshow', function(event) {
        // Check if page is loaded from cache (back/forward navigation)
        if (event.persisted) {
            const fromOtpPage = sessionStorage.getItem('fromOtpPage');
            if (fromOtpPage) {
                // Clear the mobile field
                const mobileField = document.getElementById('mobile');
                if (mobileField) {
                    // Multiple methods to clear the field
                    mobileField.value = '';
                    mobileField.defaultValue = '';
                    mobileField.setAttribute('value', '');
                    mobileField.setAttribute('autocomplete', 'off');
                    
                    // Force a re-render
                    mobileField.dispatchEvent(new Event('input', { bubbles: true }));
                }
                
                // Show notification
                const notification = document.getElementById('resetNotification');
                if (notification) {
                    notification.style.display = 'block';
                }
                
                // Focus on mobile field
                if (mobileField) {
                    mobileField.focus();
                }
                
                // Clear the session storage flag
                sessionStorage.removeItem('fromOtpPage');
            }
        }
    });
</script>
</body>
</html>