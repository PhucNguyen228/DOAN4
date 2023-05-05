<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonHangStoreController extends Controller
{
    public function indexXacNhan(){
        return view('store_owner.don_hang.cho_xac_nhan.index');
    }
    public function dataXacNhan(){
        $user = Auth::guard('TaiKhoan')->user();
        $data = DonHang::join('chi_tiet_don_hangs','chi_tiet_don_hangs.hoa_don_id','don_hangs.id')
                        ->join('san_phams','san_phams.id','chi_tiet_don_hangs.san_pham_id')
                        ->join('tai_khoans','tai_khoans.id','san_phams.id_tai_khoan')
                        ->where('san_phams.id_tai_khoan',$user->id)
                        ->where('don_hangs.tinh_trang',1)
                        ->select('don_hangs.*','chi_tiet_don_hangs.ten_san_pham','chi_tiet_don_hangs.so_luong')
                        ->get();
        // dd($data->toArray());
        return response()->json([
            'data'  => $data,
        ]);
    }
    public function tinhTrang($id){
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2) {
                $don_hang = DonHang::find($id);
                // dd($don_hang);
                if ($don_hang) {
                    $don_hang->tinh_trang = 2;
                    $don_hang->save();
                    return response()->json(['status' => true]);
                }
            } else {
                // toastr()->error('Bạn chưa đăng nhập');
                return redirect("/login");
            }
        } else {
            // toastr()->error('Bạn chưa đăng nhập');
            return redirect("/login");
        }
    }
    public function indexDaXacNhan(){
        return view('store_owner.don_hang.da_xac_nhan.index');
    }
    public function indexDangChuyen(){
        return view('store_owner.don_hang.dang_van_chuyen.index');
    }
    public function indexDaGiao(){
        return view('store_owner.don_hang.da_giao.index');
    }
}
