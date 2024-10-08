<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (!Auth::user()->can($permission)) {
            // Nếu không có quyền, chuyển hướng hoặc trả về thông báo lỗi
            return redirect()->back()->with('error', 'Bạn không có quyền thực hiện hành động này.');
        }

        return $next($request);
    }
}
