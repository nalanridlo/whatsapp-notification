<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated
        if (Auth::check()) {
            // Get last activity timestamp
            $lastActivity = session('last_activity_time');

            // Define timeout duration in minutes (e.g., 60 minutes)
            $timeout = 60;

            if ($lastActivity && now()->diffInMinutes($lastActivity) > $timeout) {
                // Logout user if session has expired
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')->with('message', 'Your session has expired. Please log in again.');
            }

            // Update last activity timestamp
            session(['last_activity_time' => now()]);
        }
        return $next($request);
    }
}
