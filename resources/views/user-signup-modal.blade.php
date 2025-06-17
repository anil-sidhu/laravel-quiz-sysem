<form id="modalSignupForm" action="/user-signup" method="post" class="space-y-4">
    @csrf
    <div>
        <label for="modal_name" class="text-gray-600 mb-1">User Name</label>
        <input type="text" id="modal_name" placeholder="Enter User name" name="name"
        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
        <div id="error_name" class="input-error"></div>
    </div>
    <div>
        <label for="modal_email" class="text-gray-600 mb-1">User Email</label>
        <input type="text" id="modal_email" placeholder="Enter User email" name="email"
        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
        <div id="error_email" class="input-error"></div>
    </div>
    <div>
        <label for="modal_mobile" class="text-gray-600 mb-1">User Mobile</label>
        <input type="text" id="modal_mobile" placeholder="Enter User Mobile" name="mobile"
        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
        <div id="error_mobile" class="input-error"></div>
    </div>
    <div class="relative">
        <label for="modal_password" class="text-gray-600 mb-1">Password</label>
        <input type="password" id="modal_password" placeholder="Enter User password" name="password"
        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
        <div id="error_password" class="input-error"></div>
    </div>
    <div class="relative">
        <label for="modal_password_confirmation" class="text-gray-600 mb-1">Confirm Password</label>
        <input type="password" id="modal_password_confirmation" placeholder="Confirm User password" name="password_confirmation"
        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
        <div id="error_password_confirmation" class="input-error"></div>
    </div>
    <div>
        <label for="modal_interested_in_training" class="text-gray-600 mb-1 font-bold text-blue-700">Interested in Training <span class="text-green-600">(Highly Recommended)</span></label>
        <select id="modal_interested_in_training" name="interested_in_training" class="w-full px-4 py-2 border-2 border-green-500 rounded-xl focus:outline-none bg-green-50">
            <option value="">Select an option</option>
            <option value="yes">Yes, I am interested in training</option>
            <option value="no">No, not interested</option>
        </select>
        <div id="error_interested_in_training" class="input-error"></div>
    </div>
    <div class="flex items-center bg-green-100 p-2 rounded-xl border-2 border-green-500">
        <input type="checkbox" id="modal_leads" name="leads" value="1" class="mr-2">
        <label for="modal_leads" class="text-gray-700 font-bold">I would like to receive call from training <span class="text-green-600">(Get a free consultation!)</span></label>
        <div id="error_leads" class="input-error"></div>
    </div>
    <button id="modalSignupBtn" type="submit" class="w-full bg-blue-500 rounded-xl px-4 py-2 text-white flex items-center justify-center">
        Signup
        <span id="modalSignupSpinner" class="spinner" style="display:none;"></span>
    </button>
</form>
<style>
.input-error { color: #e3342f; font-size: 0.95rem; margin-top: 0.25rem; }
</style> 