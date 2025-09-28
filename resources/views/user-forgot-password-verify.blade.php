<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
<title>Verify OTP - Password Reset | The Coding Skills</title>
<meta name="description" content="Verify OTP for password reset - The Coding Skills">
<meta name="keywords" content="password reset, OTP verification, The Coding Skills">
@vite('resources/css/app.css')
</head>
<body>
<x-user-navbar></x-user-navbar> 
<div class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
        <h2 class="text-2xl text-center text-gray-800 mb-6">Verify OTP</h2>
        
        @if(session('message-success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('message-success') }}
            </div>
        @endif

        @if(session('message-error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('message-error') }}
            </div>
        @endif

        <form action="/user-forgot-password-verify" method="post" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Enter OTP</label>
                <input type="text" placeholder="Enter 6-digit OTP" name="otp" maxlength="6"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('otp')
                    <div class="text-red-500 text-sm mt-1">{{$message}}</div>
                @enderror
            </div>
            
            <button type="submit" class="w-full bg-green-900 rounded-xl px-4 py-2 text-white hover:bg-green-800 transition duration-200">
                Verify OTP
            </button>
        </form>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">Didn't receive OTP?</p>
            <form action="/user-forgot-password-resend" method="post" class="mt-2">
                @csrf
                <button type="submit" class="text-green-600 hover:text-green-800 text-sm underline">
                    Resend OTP
                </button>
            </form>
        </div>

        <div class="mt-4 text-center">
            <a href="/user-forgot-password" class="text-gray-600 hover:text-gray-800 text-sm">
                ← Back to Forgot Password
            </a>
        </div>
    </div>
</div>
</body>
</html>
