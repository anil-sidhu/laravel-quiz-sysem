<style>
#leadModal {
  position: fixed !important;
  top: 0 !important;
  left: 0 !important;
  width: 100vw !important;
  height: 100vh !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  background: rgba(0,0,0,0.5) !important;
  z-index: 9999 !important;
}
#leadModal.hidden { display: none !important; }
</style>

<div id="leadModal" class="fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-2xl shadow-lg w-full max-w-lg mx-4 relative">
        <button id="leadModalClose" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-2xl font-bold focus:outline-none hidden">&times;</button>
        <div class="p-4 sm:p-6 pt-[6px]">
            <!-- <h2 class="no-margin text-sm sm:text-base font-bold text-center text-green-900 mb-2">Unlock Your Learning Journey!</h2> -->
            <!-- <p class="text-center text-gray-700 mb-4">Sign up or log in to access exclusive content, personalized training, and get a free call from our experts!<br>
                <span class="text-green-700 font-semibold">Select <u>"Interested in training"</u> and <u>"I would like to receive call from training"</u> for a free consultation and special offers!</span> -->
            </p>
            <div class="flex justify-center mb-2">
                <button id="leadTabSignup" class="px-3 sm:px-4 py-2 rounded-l-xl bg-green-900 text-white font-semibold focus:outline-none text-sm sm:text-base">Signup</button>
                <button id="leadTabLogin" class="px-3 sm:px-4 py-2 rounded-r-xl bg-gray-200 text-green-900 font-semibold focus:outline-none text-sm sm:text-base">Login</button>
            </div>
            <div id="leadSignupForm" class="">
                <div id="modalSignupError" class="text-red-600 text-sm mb-2"></div>
                @include('user-signup-modal')
            </div>
            <div id="leadLoginForm" class="hidden">
                <div id="modalLoginError" class="text-red-600 text-sm mb-2"></div>
                @include('user-login-modal')
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var closable = @json($closable ?? true);
        var showDelay = window.location.pathname.startsWith('/topic/') ? 5000 : 15000;
        if (closable && sessionStorage.getItem('leadModalClosed')) return;
        setTimeout(function() {
            var modal = document.getElementById('leadModal');
            var closeBtn = document.getElementById('leadModalClose');
            if (modal) {
                modal.classList.remove('hidden');
                if (closable && closeBtn) closeBtn.classList.remove('hidden');
                if (!closable && closeBtn) closeBtn.classList.add('hidden');
            }
        }, showDelay);
        var closeBtn = document.getElementById('leadModalClose');
        if (closable && closeBtn) {
            closeBtn.onclick = function() {
                document.getElementById('leadModal').classList.add('hidden');
                sessionStorage.setItem('leadModalClosed', '1');
            };
        }
        // Tab switching logic
        var tabSignup = document.getElementById('leadTabSignup');
        var tabLogin = document.getElementById('leadTabLogin');
        if (tabSignup && tabLogin) {
            tabSignup.onclick = function() {
                document.getElementById('leadSignupForm').classList.remove('hidden');
                document.getElementById('leadLoginForm').classList.add('hidden');
                this.classList.add('bg-green-900', 'text-white');
                this.classList.remove('bg-gray-200', 'text-green-900');
                tabLogin.classList.remove('bg-green-900', 'text-white');
                tabLogin.classList.add('bg-gray-200', 'text-green-900');
            };
            tabLogin.onclick = function() {
                document.getElementById('leadSignupForm').classList.add('hidden');
                document.getElementById('leadLoginForm').classList.remove('hidden');
                this.classList.add('bg-green-900', 'text-white');
                this.classList.remove('bg-gray-200', 'text-green-900');
                tabSignup.classList.remove('bg-green-900', 'text-white');
                tabSignup.classList.add('bg-gray-200', 'text-green-900');
            };
        }

        // AJAX logic for signup and login forms
        function getCsrfToken() {
            let token = document.querySelector('meta[name="csrf-token"]');
            if (token) return token.getAttribute('content');
            let input = document.querySelector('input[name="_token"]');
            if (input) return input.value;
            return '';
        }
        // Signup
        var signupForm = document.getElementById('modalSignupForm');
        if (signupForm) {
            // Real-time error clearing
            ['name','email','mobile','password','interested_in_training','leads','passing_year'].forEach(function(field) {
                var el = document.getElementById('modal_' + field);
                if (el) {
                    el.addEventListener('input', function() {
                        var err = document.getElementById('error_' + field);
                        if (err) err.innerHTML = '';
                    });
                    // For select and checkbox
                    el.addEventListener('change', function() {
                        var err = document.getElementById('error_' + field);
                        if (err) err.innerHTML = '';
                    });
                }
            });
            signupForm.onsubmit = function(e) {
                e.preventDefault();
                console.log('Modal signup form submitted'); // Debug log
                document.getElementById('modalSignupBtn').disabled = true;
                document.getElementById('modalSignupSpinner').style.display = 'inline-block';
                document.getElementById('modalSignupError').innerHTML = '';
                // Clear all field errors
                ['name','email','mobile','password','interested_in_training','leads','passing_year'].forEach(function(field) {
                    var err = document.getElementById('error_' + field);
                    if (err) err.innerHTML = '';
                });
                
                // Capture current page URL for redirect after signup
                const currentUrl = window.location.href;
                console.log('Modal signup - capturing redirect URL:', currentUrl); // Debug log
                const formData = new FormData(signupForm);
                formData.append('redirect_url', currentUrl);
                console.log('Modal signup - redirect_url added to formData:', currentUrl); // Debug log
                
                // Debug: Log all form data being sent
                for (let pair of formData.entries()) {
                    console.log('Form data:', pair[0], pair[1]);
                }
                
                fetch('/user-signup', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': getCsrfToken(),
                    },
                    body: formData
                })
                .then(async response => {
                    
                    document.getElementById('modalSignupSpinner').style.display = 'none';
                    if (response.ok) {
                        document.getElementById('modalSignupBtn').disabled = false;
                        let data = await response.json();
                        if (data.redirect) {
                            // OTP verification required - redirect to OTP page
                            document.getElementById('modalSignupError').innerHTML = '<span style="color: #16a34a;">' + data.message + ' Redirecting...</span>';
                            setTimeout(function() {
                                window.location.href = data.redirect;
                            }, 2000);
                        } else {
                            // Normal signup success - redirect to specified URL or reload
                            document.getElementById('modalSignupError').innerHTML = '<span style="color: #16a34a;">Signup successful! Redirecting...</span>';
                            setTimeout(function() {
                                if (data.redirect) {
                                    window.location.href = data.redirect;
                                } else {
                                    location.reload();
                                }
                            }, 2000);
                        }
                    } else {
                        document.getElementById('modalSignupBtn').disabled = false;
                        let data = await response.json();
                        let msg = '';
                        if (data.errors) {
                            for (let key in data.errors) {
                                var err = document.getElementById('error_' + key);
                                if (err) {
                                    err.innerHTML = data.errors[key].join('<br>');
                                } else {
                                    msg += data.errors[key].join('<br>') + '<br>';
                                }
                            }
                        } else if (data.message) {
                            msg = data.message;
                        } else {
                            msg = 'Signup failed. Please try again.';
                        }
                        document.getElementById('modalSignupError').innerHTML = msg;
                    }
                })
                .catch(() => {
                    document.getElementById('modalSignupBtn').disabled = false;
                    document.getElementById('modalSignupSpinner').style.display = 'none';
                    document.getElementById('modalSignupError').innerHTML = 'Signup failed. Please try again.';
                });
            };
        }
        // Login
        var loginForm = document.getElementById('modalLoginForm');
        if (loginForm) {
            loginForm.onsubmit = function(e) {
                e.preventDefault();
                const btn = loginForm.querySelector('button[type="submit"]');
                btn.disabled = true;
                document.getElementById('modalLoginError').innerHTML = '';
                
                // Capture current page URL for redirect after login
                const currentUrl = window.location.href;
                const formData = new FormData(loginForm);
                formData.append('redirect_url', currentUrl);
                fetch('/user-login', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': getCsrfToken(),
                    },
                    body: formData
                })
                .then(async response => {
                    btn.disabled = false;
                    if (response.ok) {
                        let data = await response.json();
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        } else {
                            location.reload();
                        }
                    } else {
                        let data = await response.json();
                        let msg = '';
                        if (data.errors) {
                            for (let key in data.errors) {
                                msg += data.errors[key].join('<br>') + '<br>';
                            }
                        } else if (data.message) {
                            msg = data.message;
                        } else {
                            msg = 'Login failed. Please try again.';
                        }
                        document.getElementById('modalLoginError').innerHTML = msg;
                    }
                })
                .catch(() => {
                    btn.disabled = false;
                    document.getElementById('modalLoginError').innerHTML = 'Login failed. Please try again.';
                });
            };
        }
    });
</script> 