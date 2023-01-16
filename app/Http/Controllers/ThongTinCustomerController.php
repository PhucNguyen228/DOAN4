<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThongTinCustomerController extends Controller
{
    public function index(){
        $check = Auth::guard('TaiKhoan')->user();
        if($check){
            $dataTK = TaiKhoan::where('id', $check->id)
                    ->select('tai_khoans.ten_tai_khoan','tai_khoans.email','tai_khoans.sdt','tai_khoans.dia_chi','tai_khoans.id')
                    ->first();
        return view('customer.thong_tin.index',compact('dataTK'));
        }
    }
}
