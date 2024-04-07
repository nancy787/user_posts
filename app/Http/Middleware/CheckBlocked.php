<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Check if the authenticated user is blocked
            if (Auth::user()->isBlocked()) {
                // Log out the blocked user
                Auth::logout();

                // Redirect to the login page with an error message
                return redirect()->route('login')->with('error', 'Your account has been blocked. Please contact the administrator.');
            }
        }
        return $next($request);
    }
}
