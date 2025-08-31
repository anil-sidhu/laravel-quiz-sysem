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
    
    <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg w-full max-w-md form-container">

    @if(session('message-error'))
    <div>
        <p class=" text-red-500 font-bold">{{session('message-error')}}</p>
    </div>
    @endif

    @if(session('message-success'))
    <div>
        <p class=" text-green-900 font-bold">{{session('message-success')}}</p>
    </div>
    @endif

    <h2 class="text-xl sm:text-2xl text-center text-gray-800 mb-4 sm:mb-6">User Login</h2>
    

    @error('user')
       <div class="text-red-500">{{$message}}</div>
       @enderror
    <form id="loginForm" class="space-y-4">
        @csrf
    

        <div>
            <label for="mobile" class="text-gray-600 mb-1 text-sm sm:text-base">User Mobile Number</label>
            <input type="text" id="mobile" placeholder="Enter 10-digit mobile number" name="mobile"
            class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-xl focus:outline-none text-sm sm:text-base"
            maxlength="10"
            pattern="[6-9][0-9]{9}"
            title="Please enter a valid 10-digit Indian mobile number starting with 6, 7, 8, or 9">
            <div id="mobileError" class="text-red-500" style="display: none;"></div>
       @error('mobile')
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

        <button id="loginBtn" type="submit" class="w-full bg-green-900 rounded-xl px-4 py-2 sm:py-3 text-white font-medium flex items-center justify-center">
            Login
            <span id="loginSpinner" class="spinner" style="display:none;"></span>
        </button>
        
        <div class="flex flex-col sm:flex-row items-center justify-between gap-2 mt-4">
            <a href="user-forgot-password" class="text-green-900 text-sm sm:text-base hover:underline">Forgot Password?</a>
            <a href="user-signup" class="text-green-900 text-sm sm:text-base hover:underline">Don't have an account? Sign up</a>
        </div>
    </form>
    </div>
</div>
<x-footer-user></x-footer-user>

<script>
    // Indian mobile number validation
    function validateIndianMobile(mobile) {
        const mobileRegex = /^[6-9]\d{9}$/;
        return mobileRegex.test(mobile);
    }

    // Mobile field validation
    document.getElementById('mobile').addEventListener('input', function() {
        const mobile = this.value;
        const errorDiv = document.getElementById('mobileError');
        
        if (mobile.length > 0) {
            if (!validateIndianMobile(mobile)) {
                errorDiv.textContent = 'Please enter a valid Indian mobile number (should start with 6, 7, 8, or 9)';
                errorDiv.style.display = 'block';
                this.style.borderColor = '#e3342f';
            } else {
                errorDiv.style.display = 'none';
                this.style.borderColor = '#d1d5db';
            }
        } else {
            errorDiv.style.display = 'none';
            this.style.borderColor = '#d1d5db';
        }
    });

    // AJAX form submission for login
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent form from submitting normally
        
        var btn = document.getElementById('loginBtn');
        var spinner = document.getElementById('loginSpinner');
        var form = this;
        
        // Validate mobile number before submission
        const mobile = document.getElementById('mobile').value;
        if (!validateIndianMobile(mobile)) {
            alert('Please enter a valid Indian mobile number (should start with 6, 7, 8, or 9)');
            return;
        }
        
        // Show loading state
        btn.disabled = true;
        spinner.style.display = 'inline-block';
        
        // Get form data
        var formData = new FormData(form);
        
        // Send AJAX request
        fetch('/user-login', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message before redirect
                const successMessage = data.message || 'Login successful!';
                
                // Create and show success message
                const messageDiv = document.createElement('div');
                messageDiv.className = 'fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg shadow-lg z-50';
                messageDiv.innerHTML = `<p class="font-semibold">${successMessage}</p>`;
                messageDiv.style.zIndex = '9999'; // Ensure it's on top
                messageDiv.style.position = 'fixed';
                messageDiv.style.top = '20px';
                messageDiv.style.left = '50%';
                messageDiv.style.transform = 'translateX(-50%)';
                messageDiv.style.backgroundColor = '#dcfce7';
                messageDiv.style.border = '2px solid #22c55e';
                messageDiv.style.color = '#15803d';
                messageDiv.style.padding = '16px 24px';
                messageDiv.style.borderRadius = '8px';
                messageDiv.style.boxShadow = '0 10px 25px rgba(0,0,0,0.2)';
                document.body.appendChild(messageDiv);
                
                // Auto-hide after 3 seconds and redirect
                setTimeout(() => {
                    messageDiv.style.transition = 'opacity 0.5s ease-out';
                    messageDiv.style.opacity = '0';
                    setTimeout(() => {
                        document.body.removeChild(messageDiv);
                        // Redirect if specified
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        } else {
                            window.location.href = '/';
                        }
                    }, 500);
                }, 3000);
            } else {
                // Show error message
                alert(data.message || 'Login failed. Please check your credentials.');
                
                // Re-enable button
                btn.disabled = false;
                spinner.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
            
            // Re-enable button
            btn.disabled = false;
            spinner.style.display = 'none';
        });
    });

    // Check if user is coming back from OTP page (browser back button or direct link)
    document.addEventListener('DOMContentLoaded', function() {
        const fromOtpPage = sessionStorage.getItem('fromOtpPage');
        const isResetParam = window.location.search.includes('reset=true');
        
        if (fromOtpPage || isResetParam) {
            // Clear the mobile field
            document.getElementById('mobile').value = '';
            

            
            // Focus on mobile field
            document.getElementById('mobile').focus();
            
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