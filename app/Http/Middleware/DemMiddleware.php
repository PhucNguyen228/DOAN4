<?php

namespace App\Http\Middleware;

use App\Models\DanhMucSanPham;
use Closure;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isReadable;

class DemMiddleware
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
        $oder = DanhMucSanPham::where('yeu_cau',0)->get();
        // dd($oder->toArray());
        $dem = 0;
        if($oder){
            foreach($oder as $key => $value) {
                $dem = $dem + 1;
            }
            // return $next($request);
        }
    }
}
