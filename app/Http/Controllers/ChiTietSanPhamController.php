<?php

namespace App\Http\Controllers;

use App\Models\BinhLuanVaDanhGia;
use App\Models\DanhMucSanPham;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChiTietSanPhamController extends Controller
{
    public function ChiTietSP($id)
    {
        // 2 where check id_sp and muc_do_hai_long
        $danh_gia_hai_long = BinhLuanVaDanhGia::where('id_sp', $id)->where('muc_do_hai_long', 1)->count();
        $danh_gia_khong_hai_long = BinhLuanVaDanhGia::where('id_sp', $id)->where('muc_do_hai_long', 0)->count();
        // take id_sp, id_khach_hang
        $user = Auth::guard('TaiKhoan')->user();
        // $data = SanPham::where('san_phams.id', $id)->first();
        $data = SanPham::join('tai_khoans', 'san_phams.id_tai_khoan', 'tai_khoans.id')
            ->where('san_phams.id', $id)
            ->select('san_phams.*', 'tai_khoans.ten_cua_hang')
            ->first();
        $danhMuc = DanhMucSanPham::where('yeu_cau', 1)->get();
        // join table binh_luan_va_danh_gias and tai_khoans to get name of user
        $data_danhGia_binhLuan_user = BinhLuanVaDanhGia::join('tai_khoans', 'tai_khoans.id', '=', 'binh_luan_va_danh_gias.id_khach_hang')
            ->where('id_sp', $id)
            ->select('binh_luan_va_danh_gias.*', 'tai_khoans.ten_tai_khoan')
            ->get();
        // dd($data_danhGia_binhLuan_user);
        // $data_danhGia_binhLuan_user = BinhLuanVaDanhGia::where('id_sp', $id);
        // lấy tất cả bảng bình luận và đánh giá
        // $data_danhGia_binhLuan = BinhLuanVaDanhGia::where('id_sp', $id)->get();
        // dd($data_danhGia_binhLuan);
        $dataSP = SanPham::all();
        if ($data)
            return view('customer.chi_tiet_sp.index', compact('data', 'data_danhGia_binhLuan_user', 'danhMuc', 'dataSP', 'user', 'danh_gia_hai_long', 'danh_gia_khong_hai_long'));
        else {
            toastr()->error('sản phẩm không tồn tại');
            return redirect('/');
        }
    }
}
