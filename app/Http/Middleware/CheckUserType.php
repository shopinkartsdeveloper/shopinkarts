<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$types
     */
    public function handle(Request $request, Closure $next, ...$types): Response
    {
        $user = $request->user();
        
        // Check if user is authenticated
        if (!$user) {
            return redirect()->route('admin.login');
        }
        
        // Check if user has one of the allowed types
        if (!in_array($user->type, $types)) {
            abort(403, 'Unauthorized access for this user type.');
        }
        
        return $next($request);
    }
}