<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // Check if the user is authenticated and has any of the provided roles
        if (Auth::check() && Auth::user()->roles->pluck('name')->intersect($roles)->isNotEmpty()) {
            return $next($request);
        }

        // Redirect to home if the user doesn't have the required role
        return redirect('/');
    }
}
