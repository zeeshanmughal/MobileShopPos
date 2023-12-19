<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsVerifyEmail
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
        $user = Auth::user();

        if ($user && $user->status == 'active' && $user->is_email_verified == 1) {
            return $next($request);
        } else {
            Auth::logout();

            if ($user && $user->status != 'active' ) {
                return redirect()->route('login')->with('error', 'You account is not approved by Admin. Contact to Support or Wait for Approval');
            } elseif ($user && $user->is_email_verified != 1) {
                return redirect()->route('login')->with('error', 'Your email is not verified. Please check your email for verification instructions.');
            } else {
                return redirect()->route('login');
            }
        }
    }
}
