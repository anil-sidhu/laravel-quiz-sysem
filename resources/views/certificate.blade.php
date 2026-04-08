<!DOCTYPE html>
<html lang="en">
<head>
<x-common></x-common>
    <meta charset="UTF-8">
    <title>Certificate - {{ $certificate->student_name }} | The Coding Skills</title>
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            min-height: 100vh;
        }
        
        .certificate-wrapper {
            background: white;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }
        
        .certificate-svg {
            width: 100%;
            height: auto;
            display: block;
        }
        
        .certificate-svg svg {
            width: 100%;
            height: auto;
        }
        
        .action-btn {
            transition: all 0.3s ease;
        }
        
        .action-btn:hover {
            transform: translateY(-2px);
        }
        
        .certificate-id-display {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            font-family: 'Courier New', monospace;
        }
        
        @media print {
            .no-print {
                display: none !important;
            }
            .certificate-wrapper {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <x-user-navbar></x-user-navbar>
    
    <div class="min-h-screen py-8 px-4">
        <div class="max-w-5xl mx-auto">
            
            <!-- Header Section -->
            <div class="no-print mb-6">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <a href="/" class="inline-flex items-center gap-2 text-white/80 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span>Back to Home</span>
                    </a>
                    
                    <div class="flex items-center gap-3">
                        <a href="/download-certificate" class="action-btn inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            <span>Download PDF</span>
                        </a>
                        <button onclick="window.print()" class="action-btn inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-xl font-semibold border border-white/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                            </svg>
                            <span>Print</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Certificate ID Badge -->
            <div class="no-print mb-6 text-center">
                <div class="inline-block certificate-id-display text-white px-6 py-3 rounded-xl shadow-lg">
                    <p class="text-sm text-white/80 mb-1">Certificate ID</p>
                    <p class="text-xl font-bold tracking-wider">{{ $certificate->certificate_id }}</p>
                </div>
            </div>
            
            <!-- Certificate Display -->
            <div class="certificate-wrapper">
                <div class="certificate-svg">
                    {!! $svgContent !!}
                </div>
            </div>
            
            <!-- Certificate Details -->
            <div class="no-print mt-8 bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                <h3 class="text-white font-bold text-lg mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Certificate Details
                </h3>
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white/5 rounded-xl p-4">
                        <p class="text-white/60 text-sm mb-1">Recipient</p>
                        <p class="text-white font-semibold">{{ $certificate->student_name }}</p>
                    </div>
                    <div class="bg-white/5 rounded-xl p-4">
                        <p class="text-white/60 text-sm mb-1">Quiz Completed</p>
                        <p class="text-white font-semibold">{{ $certificate->quiz_name }}</p>
                    </div>
                    <div class="bg-white/5 rounded-xl p-4">
                        <p class="text-white/60 text-sm mb-1">Score</p>
                        <p class="text-white font-semibold">{{ $certificate->score }}%</p>
                    </div>
                    <div class="bg-white/5 rounded-xl p-4">
                        <p class="text-white/60 text-sm mb-1">Issued On</p>
                        <p class="text-white font-semibold">{{ $certificate->issued_at->format('F d, Y') }}</p>
                    </div>
                </div>
                
                <!-- Verification Link -->
                <div class="mt-6 pt-6 border-t border-white/10 text-center">
                    <p class="text-white/60 text-sm mb-2">Verify this certificate at:</p>
                    <a href="/verify?id={{ $certificate->certificate_id }}" class="text-green-400 hover:text-green-300 font-mono text-sm">
                        {{ url('/verify') }}?id={{ $certificate->certificate_id }}
                    </a>
                </div>
            </div>
            
            <!-- Share Section -->
            <div class="no-print mt-6 text-center">
                <p class="text-white/60 text-sm mb-3">Share your achievement</p>
                <div class="flex justify-center gap-3">
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url('/verify?id=' . $certificate->certificate_id)) }}" 
                       target="_blank"
                       class="action-btn inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                        </svg>
                        LinkedIn
                    </a>
                    <a href="https://twitter.com/intent/tweet?text=I just earned a certificate in {{ urlencode($certificate->quiz_name) }} from The Coding Skills!&url={{ urlencode(url('/verify?id=' . $certificate->certificate_id)) }}" 
                       target="_blank"
                       class="action-btn inline-flex items-center gap-2 bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                        X (Twitter)
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
