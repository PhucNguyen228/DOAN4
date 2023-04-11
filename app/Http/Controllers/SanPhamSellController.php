<?php

namespace App\Http\Controllers;

use App\Models\DanhMucSanPham;
use App\Models\SanPham;
use Illuminate\Http\Request;

class SanPhamSellController extends Controller
{
    public function dataSell()
    {
        $dataSell = SanPham::where('san_phams.gia_khuyen_mai', '>', 0)->get();
        $danhMuc = DanhMucSanPham::where('yeu_cau', 1)->get();
        return view('customer.san_pham_sell.index', compact('danhMuc', 'dataSell'));
    }
}
