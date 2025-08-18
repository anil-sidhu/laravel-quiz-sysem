<!DOCTYPE html>
<html lang="en">
<head>
    <x-common></x-common>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Verify Mobile Number | The Coding Skills</title>
    <meta name="description" content="Verify your mobile number to complete login on The Coding Skills.">
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
<div class="bg-gray-100 flex items-center justify-center min-h-screen mobile-full-form">
    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow w-full form-container">
        <h2 class="text-2xl font-bold mb-4 text-center">Verify Your Mobile Number</h2>
        @if(session('message-error'))
            <div class="bg-red-100 text-red-700 p-2 rounded mb-3">{{ session('message-error') }}</div>
        @endif
        @if(session('message-success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-3">{{ session('message-success') }}</div>
        @endif
        @if(session('message-info'))
            <div class="bg-blue-100 text-green-900 p-2 rounded mb-3">{{ session('message-info') }}</div>
        @endif
        <form action="/user-login-verify" method="post" class="space-y-4">
            @csrf
            <label for="otp" class="block font-semibold">Enter OTP sent to your mobile:</label>
            <input type="text" name="otp" id="otp" maxlength="6" class="w-full border rounded px-3 py-2" required autofocus pattern="[0-9]{6}">
            <button type="submit" class="w-full bg-green-900 text-white rounded px-4 py-2">Verify OTP</button>
        </form>
        <form id="resendForm" action="/user-login-verify/resend" method="post" class="mt-4">
            @csrf
            <button id="resendBtn" type="submit" class="w-full bg-gray-200 text-gray-800 rounded px-4 py-2" disabled>Resend OTP <span id="timer">(30s)</span></button>
        </form>
        <div class="text-sm text-gray-500 mt-4 text-center">Attempts left: {{ 5 - (session('login_otp_attempts', 0)) }} / 5</div>
        <div id="resendError" class="text-red-600 text-center mt-2" style="display:none;"></div>
        
        <!-- Back to Login Link -->
        <div class="mt-6 text-center">
            <a href="/user-login?reset=true" class="text-green-900 hover:text-blue-800 underline text-sm">
                ← Back to Login (Try Different Email)
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
</script>
</body>
</html> 