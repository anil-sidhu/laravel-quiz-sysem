<form id="modalSignupForm" action="/user-signup" method="post" class="space-y-4">
    @csrf
    <div class="mb-1">
        <label for="modal_name" class="text-gray-800 mb-1">User Name</label>
        <input type="text" id="modal_name" placeholder="Enter User name" name="name"
        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
        <div id="error_name" class="input-error"></div>
    </div>
    <div class="mb-1">
        <label for="modal_mobile" class="text-gray-800 mb-1">User Mobile</label>
        <input type="text" id="modal_mobile" placeholder="Enter User Mobile" name="mobile"
        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none" maxlength="15">
        <div id="error_mobile" class="input-error"></div>
    </div>
    
    <!-- Country Detection Display -->
    <div class="mb-1" id="modal_countryDetectedDiv">
        <label class="text-gray-800 mb-1">Country (auto-detected)</label>
        <div class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-xl text-gray-700 text-sm">
            <span id="modal_countryLoading">Detecting...</span>
            <span id="modal_countryName" style="display: none;"></span>
            <span id="modal_otpStatus" class="text-xs ml-2" style="display: none;"></span>
        </div>
        <a href="javascript:void(0)" id="modal_changeCountryLink" class="text-xs text-blue-600 hover:underline" style="display: none;" onclick="showModalCountryDropdown()">Change</a>
    </div>
    
    <!-- Country Dropdown (hidden by default) -->
    <div class="mb-1" id="modal_countryDiv" style="display: none;">
        <label for="modal_country" class="text-gray-800 mb-1">Select Country</label>
        <select id="modal_country" name="country" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
            <option value="India" selected>India</option>
            <option value="Pakistan">Pakistan</option>
            <option value="Bangladesh">Bangladesh</option>
            <option value="Nepal">Nepal</option>
            <option value="Other">Other</option>
        </select>
        <div id="modal_countryNote" class="text-xs text-gray-500 mt-1"></div>
        <div id="error_country" class="input-error"></div>
    </div>
    
    <div class="relative mb-1">
        <label for="modal_password" class="text-gray-800 mb-1">Password</label>
        <input type="password" id="modal_password" placeholder="Enter User password" name="password"
        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
        <div id="error_password" class="input-error"></div>
    </div>
    <div class="mb-1">
        <label for="modal_passing_year" class="text-gray-800 mb-1">Passing Year (optional)</label>
        <select id="modal_passing_year" name="passing_year" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
            <option value="">Select year</option>
            @for($y = date('Y')+3; $y >= date('Y')-13; $y--)
                <option value="{{$y}}">{{$y}}</option>
            @endfor
        </select>
        <div id="error_passing_year" class="input-error"></div>
    </div>
    <div class="mb-3">
        <label for="modal_interested_in_training" class=" mb-1 text-gray-800">Interested in live instructor-led training? <span class="text-red-600 text-[11px]">(Recommended)</span></label>
        <select id="modal_interested_in_training" name="interested_in_training" class="w-full py-2 px-[5px] border-1 border-[#d6d6d6] rounded-xl focus:outline-none">
            <option value="">Select</option>
            <option value="yes">Yes, I am interested</option>
            <option value="no">No, not interested</option>
        </select>
        <div id="error_interested_in_training" class="input-error"></div>
    </div>
    <button id="modalSignupBtn" type="submit" class="w-full bg-green-900 rounded-xl px-4 py-2 text-white flex items-center justify-center">
        Signup
        <span id="modalSignupSpinner" class="spinner" style="display:none;"></span>
    </button>
</form>
<style>
.input-error { color: #e3342f; font-size: 0.95rem; margin-top: 0.25rem; }
</style>
<script>
// IP Detection for Modal
let modalDetectedCountry = 'India';

(function detectModalCountryFromIP() {
    // Using ipapi.co which supports HTTPS on free tier
    fetch('https://ipapi.co/json/')
        .then(response => response.json())
        .then(data => {
            modalDetectedCountry = data.country_name || 'India';
            
            // Update UI
            document.getElementById('modal_countryLoading').style.display = 'none';
            document.getElementById('modal_countryName').textContent = modalDetectedCountry;
            document.getElementById('modal_countryName').style.display = 'inline';
            document.getElementById('modal_changeCountryLink').style.display = 'inline';
            
            // Set country value - map to available options
            const countrySelect = document.getElementById('modal_country');
            const validCountries = ['India', 'Pakistan', 'Bangladesh', 'Nepal'];
            if (validCountries.includes(modalDetectedCountry)) {
                countrySelect.value = modalDetectedCountry;
            } else {
                countrySelect.value = 'Other';
            }
            
            // Show OTP status
            const otpStatus = document.getElementById('modal_otpStatus');
            if (modalDetectedCountry === 'India') {
                otpStatus.textContent = '(OTP required)';
                otpStatus.className = 'text-xs ml-2 text-orange-600';
            } else {
                otpStatus.textContent = '(No OTP needed)';
                otpStatus.className = 'text-xs ml-2 text-green-600';
            }
            otpStatus.style.display = 'inline';
        })
        .catch(error => {
            // Show dropdown on failure
            document.getElementById('modal_countryDetectedDiv').style.display = 'none';
            document.getElementById('modal_countryDiv').style.display = 'block';
        });
})();

function showModalCountryDropdown() {
    document.getElementById('modal_countryDetectedDiv').style.display = 'none';
    document.getElementById('modal_countryDiv').style.display = 'block';
    document.getElementById('modal_countryNote').textContent = 'India requires OTP verification';
}

// Country change handler
document.getElementById('modal_country').addEventListener('change', function() {
    const note = document.getElementById('modal_countryNote');
    if (this.value === 'India') {
        note.textContent = 'OTP verification required';
        note.className = 'text-xs text-orange-600 mt-1';
    } else {
        note.textContent = 'OTP verification not required';
        note.className = 'text-xs text-green-600 mt-1';
    }
});
</script>
