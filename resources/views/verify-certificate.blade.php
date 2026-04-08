<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <title>Verify Certificate | The Coding Skills</title>
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            min-height: 100vh;
        }
        
        .verify-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .input-field {
            font-family: 'JetBrains Mono', monospace;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .input-field:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
        }
        
        .verify-btn {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            transition: all 0.3s ease;
        }
        
        .verify-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px -10px rgba(34, 197, 94, 0.5);
        }
        
        .result-card {
            animation: slideUp 0.5s ease;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .verified-badge {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4); }
            50% { box-shadow: 0 0 0 15px rgba(34, 197, 94, 0); }
        }
        
        .shield-icon {
            filter: drop-shadow(0 4px 8px rgba(34, 197, 94, 0.3));
        }
    </style>
</head>
<body>
    <x-user-navbar></x-user-navbar>
    
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-2xl mx-auto">
            
            <!-- Header -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-green-500/20 rounded-full mb-6 shield-icon">
                    <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold text-white mb-3">Certificate Verification</h1>
                <p class="text-white/60 text-lg">Enter the certificate ID to verify its authenticity</p>
            </div>
            
            <!-- Verification Form -->
            <div class="verify-card rounded-2xl p-8">
                <form action="/verify" method="POST" id="verifyForm">
                    @csrf
                    <div class="mb-6">
                        <label for="certificate_id" class="block text-white/80 font-medium mb-3">
                            Certificate ID
                        </label>
                        <input 
                            type="text" 
                            id="certificate_id" 
                            name="certificate_id" 
                            placeholder="SHP-2026-XXXXXX"
                            value="{{ request('id') ?? ($searchedId ?? '') }}"
                            class="input-field w-full px-5 py-4 rounded-xl text-white text-lg tracking-widest text-center uppercase placeholder:text-white/30 outline-none"
                            required
                            maxlength="20"
                        >
                        @error('certificate_id')
                            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" class="verify-btn w-full py-4 rounded-xl text-white font-bold text-lg">
                        Verify Certificate
                    </button>
                </form>
            </div>
            
            @if(isset($searched) && $searched)
                @if(isset($certificate) && $certificate)
                    <!-- Valid Certificate Result -->
                    <div class="result-card mt-8 bg-green-500/10 border border-green-500/30 rounded-2xl p-8">
                        <div class="text-center mb-6">
                            <div class="verified-badge inline-flex items-center justify-center w-16 h-16 rounded-full mb-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-green-400">Certificate Verified!</h2>
                            <p class="text-white/60 mt-2">This certificate is authentic and valid</p>
                        </div>
                        
                        <div class="bg-white/5 rounded-xl p-6 space-y-4">
                            <div class="flex justify-between items-center py-3 border-b border-white/10">
                                <span class="text-white/60">Certificate ID</span>
                                <span class="text-white font-mono font-bold">{{ $certificate->certificate_id }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-white/10">
                                <span class="text-white/60">Recipient Name</span>
                                <span class="text-white font-semibold">{{ $certificate->student_name }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-white/10">
                                <span class="text-white/60">Quiz/Course</span>
                                <span class="text-white font-semibold">{{ $certificate->quiz_name }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-white/10">
                                <span class="text-white/60">Score Achieved</span>
                                <span class="text-green-400 font-bold">{{ $certificate->score }}%</span>
                            </div>
                            <div class="flex justify-between items-center py-3">
                                <span class="text-white/60">Issue Date</span>
                                <span class="text-white font-semibold">{{ $certificate->issued_at->format('F d, Y') }}</span>
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-white/10 text-center">
                            <p class="text-white/40 text-sm">
                                Issued by <span class="text-white/60 font-medium">The Coding Skills</span>
                            </p>
                        </div>
                    </div>
                @else
                    <!-- Invalid Certificate Result -->
                    <div class="result-card mt-8 bg-red-500/10 border border-red-500/30 rounded-2xl p-8">
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-red-500/20 rounded-full mb-4">
                                <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-red-400">Certificate Not Found</h2>
                            <p class="text-white/60 mt-2">
                                No certificate found with ID: <span class="font-mono text-white">{{ $searchedId }}</span>
                            </p>
                            <p class="text-white/40 text-sm mt-4">
                                Please check the certificate ID and try again. If you believe this is an error, 
                                please contact support.
                            </p>
                        </div>
                    </div>
                @endif
            @endif
            
            <!-- Instructions -->
            <div class="mt-10 text-center">
                <h3 class="text-white/80 font-semibold mb-4">Where to find the Certificate ID?</h3>
                <div class="verify-card rounded-xl p-6 inline-block">
                    <p class="text-white/60 text-sm">
                        The Certificate ID is printed on the certificate in the format:<br>
                        <span class="font-mono text-green-400 text-lg mt-2 block">SHP-2026-XXXXXX</span>
                    </p>
                </div>
            </div>
            
            <!-- Back to Home -->
            <div class="mt-8 text-center">
                <a href="/" class="inline-flex items-center gap-2 text-white/60 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Back to Home</span>
                </a>
            </div>
        </div>
    </div>
    
    <script>
        // Auto-uppercase input
        document.getElementById('certificate_id').addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });
        
        // Auto-submit if ID is passed via URL
        @if(request('id') && !isset($searched))
            document.getElementById('verifyForm').submit();
        @endif
    </script>
</body>
</html>
