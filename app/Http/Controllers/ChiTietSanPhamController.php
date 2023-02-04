<?php

namespace App\Http\Controllers;

use App\Models\DanhMucSanPham;
use App\Models\SanPham;
use Illuminate\Http\Request;

class ChiTietSanPhamController extends Controller
{
    public function ChiTietSP($id){
        $data = SanPham::where('san_phams.id', $id)->first();
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
