<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class CheckRememberToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only check if user is not already logged in
        if(!session('user')){
            // Check for remember token cookie
            $rememberToken = $request->cookie('remember_token');
            if($rememberToken) {
                $user = User::where('remember_token', $rememberToken)->first();
                if($user) {
                    // Log user in automatically
                    Session::put('user', $user);
                }
            }
        }
        
        return $next($request);
    }
}
