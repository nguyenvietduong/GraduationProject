<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Xử lý yêu cầu và kiểm tra xác thực.
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (!$this->auth->check()) {
            // Kiểm tra xem yêu cầu có phải là JSON hay không
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            // Thêm thông báo với `with` khi chuyển hướng
            return redirect()->route('login')->with('error', __('messages.system.notification.login.errorNotLogin'));
        }

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}
