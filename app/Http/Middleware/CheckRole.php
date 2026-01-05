<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Check if user has the required role
        $user = Auth::user();
        
        if (!$user->hasRole($role)) {
            // If user doesn't have the role, redirect to home or show error
            return redirect('/home')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}