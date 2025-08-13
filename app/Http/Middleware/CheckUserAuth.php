<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class CheckUserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is already logged in via session
        if(session('user')){
            return $next($request);
        }
        
        // Check for remember token cookie
        $rememberToken = $request->cookie('remember_token');
        if($rememberToken) {
            $user = User::where('remember_token', $rememberToken)->first();
            if($user) {
                // Log user in automatically
                Session::put('user', $user);
                return $next($request);
            }
        }
        
        return redirect('user-login');
    }
}
