<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        if (App::getLocale() === 'vi') {
            $messages = "Bạn đã đăng nhập trước đó rồi!";
        } else if (App::getLocale() === 'en') {
            $messages = "You have already logged in!";
        }

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect()->intended()->with('error', $messages);
            }
        }

        return $next($request);
    }
}
