<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginCustomerMiddleWare
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
        $store = Auth::guard('TaiKhoan')->check();
        if ($store) {
            $check = Auth::guard('TaiKhoan')->user();
            if ($check->muc == 1 && $check->trang_thai == 1 ) {
                return $next($request);
            } else {
                // toastr()->error('Bạn cần phải đăng nhập');
                Auth::guard('TaiKhoan')->logout();
                return redirect('/login');

            }
        } else {
            // toastr()->error('Bạn cần phải đăng nhập');
            // return view('tai_khoan.login');
            return redirect("/login");
        }
    }
}
