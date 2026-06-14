<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  ...$roles
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }

        $user = Auth::user();

        // Kiểm tra xem role của user có nằm trong danh sách các role được phép không
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Nếu không có quyền, chuyển hướng về trang chủ hoặc trang thông báo lỗi
        return redirect('/')->with('error', 'Bạn không có quyền truy cập vào khu vực này.');
    }
}
