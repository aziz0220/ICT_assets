<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckStaffBlockStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if($user && auth()->user()->hasRole('Staff')){
            if ( $user->staff->is_blocked) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account is blocked. Please contact administrator.');
            }
    }
        return $next($request);
    }
}
