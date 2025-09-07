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

/* Banner Slider Styles */
.banner-slide {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
  transition: opacity 0.5s ease-in-out;
}
.banner-slide.active {
  opacity: 1;
}

/* Alumni Carousel Animations */
.alumni-row-1 {
  animation: scrollLeft 20s linear infinite;
}
.alumni-row-2 {
  animation: scrollRight 20s linear infinite;
}

@keyframes scrollLeft {
  0% { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}

@keyframes scrollRight {
  0% { transform: translateX(-50%); }
  100% { transform: translateX(0); }
}

/* Company Logos Carousel Animations */
.company-column-1 {
  animation: scrollUp 15s linear infinite;
}
.company-column-2 {
  animation: scrollDown 15s linear infinite;
}

@keyframes scrollUp {
  0% { transform: translateY(0); }
  100% { transform: translateY(-50%); }
}

@keyframes scrollDown {
  0% { transform: translateY(-50%); }
  100% { transform: translateY(0); }
}

/* Banner Navigation */
.banner-dot.active {
  background-color: white !important;
  opacity: 1 !important;
}
</style>

<div id="leadModal" class="fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50 hidden">
    <div style="background-color:#0a2647; background-image: radial-gradient(circle at center, rgba(59,130,246,0.2) 0%, transparent 70%);" class="rounded-2xl shadow-lg w-[calc(100%-100px)] h-[calc(100%-100px)] mx-4 relative">
        <button id="leadModalClose" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-2xl font-bold focus:outline-none hidden">&times;</button>
        <div class="flex h-[100%]">
            <div class="flex-1 relative overflow-hidden">
                <!-- Banner content will be added here -->
                <div id="bannerSlider" class="h-full relative">
                    <!-- Slide 1: Alumni Testimonials -->
                    <div class="banner-slide active h-full flex flex-col justify-center items-center text-white p-8">
                        <div class="text-center mb-8">
                            <h2 class="text-3xl font-bold mb-2">Sharpener Strong Alumni Base</h2>
                            <p class="text-lg opacity-90">450+ Top companies where our students work</p>
                        </div>
                        
                        <!-- Stats Cards -->
                        <div class="grid grid-cols-2 gap-4 mb-8 w-full max-w-md">
                            <div class="bg-white bg-opacity-10 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold">4.9G</div>
                                <div class="text-sm opacity-80">Google Rating from 700+ reviews</div>
                            </div>
                            <div class="bg-white bg-opacity-10 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold">95%</div>
                                <div class="text-sm opacity-80">Average salary hike</div>
                            </div>
                            <div class="bg-white bg-opacity-10 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold">2500+</div>
                                <div class="text-sm opacity-80">Sharpenerians Placed</div>
                            </div>
                            <div class="bg-white bg-opacity-10 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold">100%</div>
                                <div class="text-sm opacity-80">Job assurance</div>
                            </div>
                        </div>

                        <!-- Alumni Carousel -->
                        <div class="w-full max-w-2xl">
                            <div class="alumni-carousel-container overflow-hidden h-32">
                                <!-- Row 1: Moving Left to Right -->
                                <div class="alumni-row-1 flex">
                                    <div class="alumni-item flex-shrink-0 w-48 mx-2 bg-white bg-opacity-10 rounded-lg p-3 flex items-center">
                                        <div class="w-8 h-8 bg-blue-500 rounded-full mr-3"></div>
                                        <div>
                                            <div class="font-semibold">Akansha</div>
                                            <div class="text-sm opacity-80">Got Placed at Math Company</div>
                                        </div>
                                    </div>
                                    <div class="alumni-item flex-shrink-0 w-48 mx-2 bg-white bg-opacity-10 rounded-lg p-3 flex items-center">
                                        <div class="w-8 h-8 bg-green-500 rounded-full mr-3"></div>
                                        <div>
                                            <div class="font-semibold">Shafeeq Ali</div>
                                            <div class="text-sm opacity-80">Got Placed at Freecharge</div>
                                        </div>
                                    </div>
                                    <div class="alumni-item flex-shrink-0 w-48 mx-2 bg-white bg-opacity-10 rounded-lg p-3 flex items-center">
                                        <div class="w-8 h-8 bg-purple-500 rounded-full mr-3"></div>
                                        <div>
                                            <div class="font-semibold">Tushar Singh</div>
                                            <div class="text-sm opacity-80">Got Placed at Miles Education</div>
                                        </div>
                                    </div>
                                    <div class="alumni-item flex-shrink-0 w-48 mx-2 bg-white bg-opacity-10 rounded-lg p-3 flex items-center">
                                        <div class="w-8 h-8 bg-red-500 rounded-full mr-3"></div>
                                        <div>
                                            <div class="font-semibold">Shanmuganathan</div>
                                            <div class="text-sm opacity-80">Got Placed at Bijak</div>
                                        </div>
                                    </div>
                                    <div class="alumni-item flex-shrink-0 w-48 mx-2 bg-white bg-opacity-10 rounded-lg p-3 flex items-center">
                                        <div class="w-8 h-8 bg-yellow-500 rounded-full mr-3"></div>
                                        <div>
                                            <div class="font-semibold">Ritik</div>
                                            <div class="text-sm opacity-80">Got Placed at Oracle</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Row 2: Moving Right to Left -->
                                <div class="alumni-row-2 flex mt-4">
                                    <div class="alumni-item flex-shrink-0 w-48 mx-2 bg-white bg-opacity-10 rounded-lg p-3 flex items-center">
                                        <div class="w-8 h-8 bg-indigo-500 rounded-full mr-3"></div>
                                        <div>
                                            <div class="font-semibold">Arun</div>
                                            <div class="text-sm opacity-80">Got Placed at TechPearl</div>
                                        </div>
                                    </div>
                                    <div class="alumni-item flex-shrink-0 w-48 mx-2 bg-white bg-opacity-10 rounded-lg p-3 flex items-center">
                                        <div class="w-8 h-8 bg-pink-500 rounded-full mr-3"></div>
                                        <div>
                                            <div class="font-semibold">Pushkar</div>
                                            <div class="text-sm opacity-80">Got Placed at Dvnj Health Tech</div>
                                        </div>
                                    </div>
                                    <div class="alumni-item flex-shrink-0 w-48 mx-2 bg-white bg-opacity-10 rounded-lg p-3 flex items-center">
                                        <div class="w-8 h-8 bg-teal-500 rounded-full mr-3"></div>
                                        <div>
                                            <div class="font-semibold">Aditya</div>
                                            <div class="text-sm opacity-80">Got Placed at Appscript</div>
                                        </div>
                                    </div>
                                    <div class="alumni-item flex-shrink-0 w-48 mx-2 bg-white bg-opacity-10 rounded-lg p-3 flex items-center">
                                        <div class="w-8 h-8 bg-orange-500 rounded-full mr-3"></div>
                                        <div>
                                            <div class="font-semibold">Priya</div>
                                            <div class="text-sm opacity-80">Got Placed at Microsoft</div>
                                        </div>
                                    </div>
                                    <div class="alumni-item flex-shrink-0 w-48 mx-2 bg-white bg-opacity-10 rounded-lg p-3 flex items-center">
                                        <div class="w-8 h-8 bg-cyan-500 rounded-full mr-3"></div>
                                        <div>
                                            <div class="font-semibold">Rahul</div>
                                            <div class="text-sm opacity-80">Got Placed at Amazon</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2: Simple Content -->
                    <div class="banner-slide h-full flex flex-col justify-center items-center text-white p-8">
                        <div class="text-center">
                            <h2 class="text-4xl font-bold mb-4">Game Based Learning</h2>
                            <p class="text-lg opacity-90 mb-8">A free strategy game, exclusively for Sharpenerians which uses the points you earn in studies.</p>
                            
                            <!-- Game Elements -->
                            <div class="relative w-80 h-60 mx-auto">
                                <!-- Building -->
                                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-40 bg-amber-600 rounded-t-lg">
                                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-8 h-8 bg-red-600 rounded-full"></div>
                                    <div class="absolute top-2 left-1/2 transform -translate-x-1/2 w-2 h-2 bg-white rounded-full animate-pulse"></div>
                                </div>
                                
                                <!-- Trees -->
                                <div class="absolute bottom-0 left-8 w-6 h-16 bg-green-600 rounded-t-full"></div>
                                <div class="absolute bottom-0 right-8 w-6 h-16 bg-green-600 rounded-t-full"></div>
                                <div class="absolute bottom-0 left-16 w-4 h-12 bg-green-500 rounded-t-full"></div>
                                <div class="absolute bottom-0 right-16 w-4 h-12 bg-green-500 rounded-t-full"></div>
                                
                                <!-- Cannons -->
                                <div class="absolute bottom-0 left-4 w-8 h-6 bg-gray-600 rounded"></div>
                                <div class="absolute bottom-0 right-4 w-8 h-6 bg-gray-600 rounded"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3: Company Logos -->
                    <div class="banner-slide h-full flex flex-col justify-center items-center text-white p-8">
                        <div class="text-center mb-8">
                            <h2 class="text-3xl font-bold mb-2">Sharpener has 1500+ companies tie-ups!</h2>
                            <p class="text-lg opacity-90 mb-4">Your dream, our destination</p>
                            
                            <!-- Features -->
                            <div class="flex flex-col items-center space-y-2 mb-8">
                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-blue-500 rounded-full mr-3"></div>
                                    <span>PAN India tie-ups for all locations</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-green-500 rounded-full mr-3"></div>
                                    <span>Students are free to choose a company of their choice</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-purple-500 rounded-full mr-3"></div>
                                    <span>Alumni program for experienced folks for job switches</span>
                                </div>
                            </div>
                        </div>

                        <!-- Company Logos Carousel -->
                        <div class="w-full max-w-2xl">
                            <div class="company-carousel-container overflow-hidden h-64 relative">
                                <!-- Column 1: Moving Bottom to Top -->
                                <div class="company-column-1 absolute left-0 w-1/2 h-full">
                                    <div class="company-item bg-white bg-opacity-10 rounded-lg p-3 m-2 text-center">
                                        <div class="font-bold">Fynd</div>
                                    </div>
                                    <div class="company-item bg-white bg-opacity-10 rounded-lg p-3 m-2 text-center">
                                        <div class="font-bold">Propelld</div>
                                    </div>
                                    <div class="company-item bg-white bg-opacity-10 rounded-lg p-3 m-2 text-center">
                                        <div class="font-bold">Athenahealth</div>
                                    </div>
                                    <div class="company-item bg-white bg-opacity-10 rounded-lg p-3 m-2 text-center">
                                        <div class="font-bold">Publicis Sapient</div>
                                    </div>
                                    <div class="company-item bg-white bg-opacity-10 rounded-lg p-3 m-2 text-center">
                                        <div class="font-bold">Radiansys</div>
                                    </div>
                                    <div class="company-item bg-white bg-opacity-10 rounded-lg p-3 m-2 text-center">
                                        <div class="font-bold">Rakuten</div>
                                    </div>
                                    <div class="company-item bg-white bg-opacity-10 rounded-lg p-3 m-2 text-center">
                                        <div class="font-bold">OYO</div>
                                    </div>
                                    <div class="company-item bg-white bg-opacity-10 rounded-lg p-3 m-2 text-center">
                                        <div class="font-bold">IDFC First</div>
                                    </div>
                                </div>
                                
                                <!-- Column 2: Moving Top to Bottom -->
                                <div class="company-column-2 absolute right-0 w-1/2 h-full">
                                    <div class="company-item bg-white bg-opacity-10 rounded-lg p-3 m-2 text-center">
                                        <div class="font-bold">Upstox</div>
                                    </div>
                                    <div class="company-item bg-white bg-opacity-10 rounded-lg p-3 m-2 text-center">
                                        <div class="font-bold">Netcore</div>
                                    </div>
                                    <div class="company-item bg-white bg-opacity-10 rounded-lg p-3 m-2 text-center">
                                        <div class="font-bold">Zolo</div>
                                    </div>
                                    <div class="company-item bg-white bg-opacity-10 rounded-lg p-3 m-2 text-center">
                                        <div class="font-bold">Scalex</div>
                                    </div>
                                    <div class="company-item bg-white bg-opacity-10 rounded-lg p-3 m-2 text-center">
                                        <div class="font-bold">Shiprocket</div>
                                    </div>
                                    <div class="company-item bg-white bg-opacity-10 rounded-lg p-3 m-2 text-center">
                                        <div class="font-bold">SkillGigs</div>
                                    </div>
                                    <div class="company-item bg-white bg-opacity-10 rounded-lg p-3 m-2 text-center">
                                        <div class="font-bold">Societe Generale</div>
                                    </div>
                                    <div class="company-item bg-white bg-opacity-10 rounded-lg p-3 m-2 text-center">
                                        <div class="font-bold">Telstra</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Banner Navigation Dots -->
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                    <button class="banner-dot w-3 h-3 rounded-full bg-white bg-opacity-50 active" data-slide="0"></button>
                    <button class="banner-dot w-3 h-3 rounded-full bg-white bg-opacity-50" data-slide="1"></button>
                    <button class="banner-dot w-3 h-3 rounded-full bg-white bg-opacity-50" data-slide="2"></button>
                </div>
            </div>
        <div class="p-[20px] flex-1"><div class="bg-white h-[100%] rounded-2xl p-4 sm:p-6 pt-[6px]">
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
    </div>
</div>

<script>
    console.log('Lead modal script loaded'); // Debug log
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
                
                // Initialize form JavaScript AFTER modal is visible
                console.log('Modal is now visible, initializing form JavaScript'); // Debug log
                initializeModalForms();
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
        
        function initializeModalForms() {
            console.log('initializeModalForms function called'); // Debug log
            // Signup
            var signupForm = document.getElementById('modalSignupForm');
            console.log('Modal signup form found:', signupForm); // Debug log
            console.log('About to attach onsubmit event to modal form'); // Debug log
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
                console.log('Modal signup form onsubmit event attached'); // Debug log
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
                
                console.log('About to send fetch request to /user-signup'); // Debug log
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
        } // Close initializeModalForms function

        // Banner Slider Functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.banner-slide');
        const dots = document.querySelectorAll('.banner-dot');
        const totalSlides = slides.length;

        function showSlide(index) {
            // Hide all slides
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            
            // Show current slide
            slides[index].classList.add('active');
            dots[index].classList.add('active');
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        // Auto-advance slides every 5 seconds
        setInterval(nextSlide, 5000);

        // Dot navigation
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);
            });
        });

        // Initialize first slide
        showSlide(0);
    });
</script> 