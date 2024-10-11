<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckUserSession
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Nếu người dùng đã đăng nhập và có session khác với session hiện tại
        if ($user && $user->session_id && $user->session_id !== Session::getId()) {
            Auth::logout(); // Đăng xuất người dùng
            return redirect()->route('login')->withErrors('Your account is logged in from another device.');
        }

        return $next($request);
    }
}
