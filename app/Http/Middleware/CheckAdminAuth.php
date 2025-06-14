<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!session('admin')){
            return redirect('admin-login');
        }
        $admin = session('admin');
        if ($admin && isset($admin->name) && $admin->name === 'leadsview') {
            $allowedRoutes = [
                'dashboard',
                'admin-logout',
            ];
            $currentRoute = $request->route()->getName();
            // If route name is not set, fallback to path check
            $currentPath = $request->path();
            $allowedPaths = [
                'dashboard',
                'admin-logout',
            ];
            if (!in_array($currentRoute, $allowedRoutes) && !in_array($currentPath, $allowedPaths)) {
                abort(403, 'Access Restricted');
            }
        }
        return $next($request);
    }
}
