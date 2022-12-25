<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DanhMucSanPhamRequest;
use App\Models\DanhMucSanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class YeuCauDMStoreController extends Controller
{
    public function index()
    {
        return view('store_owner.yeu_cau_dm.index');
    }

    public function create(DanhMucSanPhamRequest $request)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            DanhMucSanPham::create([
                'ten_danh_muc'      =>  $request->ten_danh_muc,
                'slug_danh_muc'     =>  $request->slug_danh_muc,
                'id_tai_khoan'      =>  $check->id,
                'yeu_cau'            => 0,
            ]);

            return response()->json([
                'trangThai'         =>  true,
            ]);
        }
    }
    public function data(){
        $data = DanhMucSanPham::where('yeu_cau', 0)->get();
        return response()->json([
            'data'  => $data,
        ]);
    }
}
