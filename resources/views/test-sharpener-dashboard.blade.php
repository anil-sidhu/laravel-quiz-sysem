<!DOCTYPE html>
<html lang="en">
<head>
    <x-common></x-common>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Test Sharpener Dashboard | The Coding Skills</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-user-navbar></x-user-navbar>
    
    <div class="flex flex-col min-h-screen items-center bg-gray-100 w-full max-w-full overflow-x-hidden">
        <div class="w-full max-w-4xl mx-auto p-8">
            <h1 class="text-3xl font-bold text-green-900 mb-8 text-center">Test Sharpener Dashboard</h1>
            
            @if(session('user'))
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4">User Information</h2>
                    <p><strong>Name:</strong> {{ session('user')->name }}</p>
                    <p><strong>Mobile:</strong> {{ session('user')->mobile }}</p>
                    
                    <div class="mt-6">
                        <button id="test-dashboard-btn" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-md transition-colors">
                            Test Sharpener Dashboard Access
                        </button>
                    </div>
                    
                    <div id="result" class="mt-4 p-4 rounded-md hidden"></div>
                </div>
            @else
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg">
                    <p>Please <a href="/user-login" class="underline">login</a> first to test the Sharpener Dashboard functionality.</p>
                </div>
            @endif
        </div>
    </div>
    
    <x-footer-user></x-footer-user>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const testBtn = document.getElementById('test-dashboard-btn');
            const resultDiv = document.getElementById('result');
            
            if (testBtn) {
                testBtn.addEventListener('click', function() {
                    const originalText = testBtn.textContent;
                    testBtn.textContent = 'Testing...';
                    testBtn.disabled = true;
                    
                    fetch('/open-sharpener-dashboard', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        resultDiv.className = `mt-4 p-4 rounded-md ${data.success ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700'}`;
                        resultDiv.innerHTML = `
                            <h3 class="font-semibold">${data.success ? 'Success!' : 'Error'}</h3>
                            <p>${data.message}</p>
                            ${data.redirect_url ? `<p><strong>Redirect URL:</strong> ${data.redirect_url}</p>` : ''}
                        `;
                        resultDiv.classList.remove('hidden');
                        
                        if (data.success) {
                            setTimeout(() => {
                                window.location.href = data.redirect_url;
                            }, 2000);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        resultDiv.className = 'mt-4 p-4 rounded-md bg-red-100 border border-red-400 text-red-700';
                        resultDiv.innerHTML = `
                            <h3 class="font-semibold">Error</h3>
                            <p>Failed to test dashboard access. Please try again.</p>
                        `;
                        resultDiv.classList.remove('hidden');
                    })
                    .finally(() => {
                        testBtn.textContent = originalText;
                        testBtn.disabled = false;
                    });
                });
            }
        });
    </script>
</body>
</html>
