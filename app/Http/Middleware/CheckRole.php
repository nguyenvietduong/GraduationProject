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
        // Kiểm tra xem user có role_id nào trong danh sách các roles không
        if (Auth::check() && in_array(Auth::user()->role_id, $roles)) {
            return $next($request);
        }

        return redirect('/');
    }
}
