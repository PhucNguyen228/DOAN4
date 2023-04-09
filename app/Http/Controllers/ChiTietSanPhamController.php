<?php

namespace App\Http\Controllers;

use App\Models\DanhMucSanPham;
use App\Models\SanPham;
use Illuminate\Http\Request;

class ChiTietSanPhamController extends Controller
{
    public function ChiTietSP($id){
        $data = SanPham::join('tai_khoans','san_phams.id_tai_khoan','tai_khoans.id')
                            ->where('san_phams.id', $id)
                            ->select('san_phams.*','tai_khoans.ten_cua_hang')
                            ->first();
        $danhMuc = DanhMucSanPham::all();
        $dataSP = SanPham::all();
        if($data)
        return view('customer.chi_tiet_sp.index', compact('data','danhMuc','dataSP'));
        else{
            toastr()->error('sản phẩm không tồn tại');
            return redirect('/');
        }
    }
}
