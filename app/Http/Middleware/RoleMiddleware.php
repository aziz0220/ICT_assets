<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next): Response
    {
        if ( Auth::user() &&  Auth::user()->getRoleNames()->first() === null) {
            Log::debug('User without role attempted access.', ['user_id' => Auth::user()->id]);
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is is not registered. Please contact administrator.');
        }
        return $next($request);
    }
}
