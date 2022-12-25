<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAdminMiddleWare
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
        $user = Auth::guard('TaiKhoan')->check();
        if($user) {
            $check = Auth::guard('TaiKhoan')->user();
            if($check->muc == 0) {
                return $next($request);
            } else {
                // toastr()->error("Tài khoản này không đủ điểu kiện đăng nhập!!");
                Auth::guard('TaiKhoan')->logout();
                return redirect('/admin/login');
            }
        } else {
            // toastr()->error("Vui lòng đăng nhập!!");
            return redirect('/admin/login');
        }

    }
}
