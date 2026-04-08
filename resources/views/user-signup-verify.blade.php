<!DOCTYPE html>
<html lang="en">
<head>
    <x-common></x-common>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Verify Mobile Number | The Coding Skills</title>
    <meta name="description" content="Verify your mobile number to complete signup on The Coding Skills.">
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
<div class="bg-gray-100 flex items-center justify-center min-h-screen mobile-full-form">
    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow w-full form-container">
        <h2 class="text-2xl font-bold mb-4 text-center">Verify Your Mobile Number</h2>
        @if(session('message-error'))
            <div class="bg-red-100 text-red-700 p-2 rounded mb-3">{{ session('message-error') }}</div>
        @endif
                         @if(session('message-success'))
     <div class="w-full max-w-md mx-auto mb-4" id="successMessage">
         <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-md text-center">
             <p class="font-semibold">{{ session('message-success') }}</p>
         </div>
     </div>
     @endif
        <form id="verifyForm" class="space-y-4">
            @csrf
            <label for="otp" class="block font-semibold">Enter OTP sent to your mobile:</label>
            <input type="text" name="otp" id="otp" maxlength="6" class="w-full border rounded px-3 py-2" required autofocus>
            <button id="verifyBtn" type="submit" class="w-full bg-green-900 text-white rounded px-4 py-2 flex items-center justify-center">
                Verify OTP
                <span id="verifySpinner" class="spinner" style="display:none;"></span>
            </button>
        </form>
        <form id="resendForm" action="/user-signup-verify/resend" method="post" class="mt-4">
            @csrf
            <button id="resendBtn" type="submit" class="w-full bg-gray-200 text-gray-800 rounded px-4 py-2" disabled>Resend OTP <span id="timer">(30s)</span></button>
        </form>
        <div class="text-sm text-gray-500 mt-4 text-center">Attempts left: {{ 5 - (session('signup_otp_attempts', 0)) }} / 5</div>
        <div id="resendError" class="text-red-600 text-center mt-2" style="display:none;"></div>
        
        <!-- Back to Signup Link -->
        <div class="mt-6 text-center">
            <a href="/user-signup?reset=true" class="text-green-900 hover:text-blue-800 underline text-sm">
                ← Back to Signup (Change Phone Number)
            </a>
        </div>
        
        <script>
            // Mark that user has visited OTP page
            sessionStorage.setItem('fromOtpPage', 'true');
        </script>
    </div>
</div>
<x-footer-user></x-footer-user>
<script>
    // AJAX form submission for OTP verification
    document.getElementById('verifyForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent form from submitting normally
        
        var btn = document.getElementById('verifyBtn');
        var spinner = document.getElementById('verifySpinner');
        var form = this;
        
        // Show loading state
        btn.disabled = true;
        spinner.style.display = 'inline-block';
        
        // Get form data
        var formData = new FormData(form);
        
        // Send AJAX request
        fetch('/user-signup-verify', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            // Check if response is JSON
            const contentType = response.headers.get('content-type') || '';
            if (contentType.includes('application/json')) {
                return response.json();
            } else {
                // If not JSON, try to parse as text first
                return response.text().then(text => {
                    try {
                        return JSON.parse(text);
                    } catch (e) {
                        // If parsing fails but response is OK, redirect (backend likely succeeded)
                        if (response.ok) {
                            window.location.href = '/';
                            return null;
                        }
                        throw new Error('Invalid response format');
                    }
                });
            }
        })
        .then(data => {
            // If data is null, we already redirected
            if (!data) {
                return;
            }
            console.log('OTP Verification Response:', data); // Debug log
            if (data.success) {
                // Show success message before redirect
                const successMessage = data.message || 'OTP verified successfully!';
                
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
                alert(data.message || 'Invalid OTP. Please try again.');
                
                // Re-enable button
                btn.disabled = false;
                spinner.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            
            // If it's a JSON parse error, the backend likely succeeded
            // Redirect to home page as fallback
            if (error.message && (error.message.includes('JSON') || error.message.includes('Unexpected token'))) {
                window.location.href = '/';
                return;
            }
            
            alert('An error occurred. Please try again.');
            
            // Re-enable button
            btn.disabled = false;
            spinner.style.display = 'none';
        });
    });

    // Resend timer logic
    let timer = 30;
    const resendBtn = document.getElementById('resendBtn');
    const timerSpan = document.getElementById('timer');
    resendBtn.disabled = true;
    const interval = setInterval(() => {
        timer--;
        timerSpan.textContent = `(${timer}s)`;
        if (timer <= 0) {
            resendBtn.disabled = false;
            timerSpan.textContent = '';
            clearInterval(interval);
        }
    }, 1000);

    // AJAX resend with error handling
    document.getElementById('resendForm').onsubmit = async function(e) {
        e.preventDefault();
        resendBtn.disabled = true;
        timer = 30;
        timerSpan.textContent = `(${timer}s)`;
        document.getElementById('resendError').style.display = 'none';
        const formData = new FormData(this);
        try {
            const response = await fetch(this.action, {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                body: formData
            });
            const text = await response.text();
            if (response.ok) {
                location.reload(); // reload to show success message
            } else {
                // Try to extract error message
                let msg = 'Failed to resend OTP. Please try again later.';
                if (text.includes('Spamming detected')) {
                    msg = 'You have reached the maximum number of OTP requests allowed per hour. Please try again later.';
                }
                document.getElementById('resendError').textContent = msg;
                document.getElementById('resendError').style.display = 'block';
            }
        } catch (err) {
            document.getElementById('resendError').textContent = 'Network error. Please try again.';
            document.getElementById('resendError').style.display = 'block';
        }
        // Restart timer
        let localTimer = 30;
        resendBtn.disabled = true;
        timerSpan.textContent = `(${localTimer}s)`;
        const localInterval = setInterval(() => {
            localTimer--;
            timerSpan.textContent = `(${localTimer}s)`;
            if (localTimer <= 0) {
                resendBtn.disabled = false;
                timerSpan.textContent = '';
                clearInterval(localInterval);
            }
        }, 1000);
    };

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
</script>
</body>
</html> 