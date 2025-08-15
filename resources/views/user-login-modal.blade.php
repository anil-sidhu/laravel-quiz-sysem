<form id="modalLoginForm" action="/user-login" method="post" class="space-y-4">
    @csrf
    <div>
        <label for="modal_login_mobile" class="text-gray-600 mb-1">User Mobile</label>
        <input type="text" id="modal_login_mobile" placeholder="Enter User mobile" name="mobile"
        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
    </div>
    <div>
        <label for="modal_login_password" class="text-gray-600 mb-1">Password</label>
        <input type="password" id="modal_login_password" placeholder="Enter User password" name="password"
        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
    </div>
    <button type="submit" class="w-full bg-green-900 rounded-xl px-4 py-2 text-white">Login</button>
    <a href="user-forgot-password" class="text-green-900">Forgot Password?</a>
</form> 