<?php

namespace App\Http\Controllers;

use App\Models\ChiTietDonHang;
use App\Models\DanhMucSanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChiTietDonHangController extends Controller
{
    public function indexCart()
    {
        $danhMuc = DanhMucSanPham::where('yeu_cau', 1)->get();
        return view('customer.cart.index', compact('danhMuc'));
    }
    public function dataCart()
    {

        $agent = Auth::guard('TaiKhoan')->user();
        if ($agent) {
            $data = ChiTietDonHang::join('san_phams', 'chi_tiet_don_hangs.san_pham_id', 'san_phams.id')
                ->where('agent_id', $agent->id)
                ->where('is_cart', 1)
                ->select('chi_tiet_don_hangs.*', 'san_phams.anh_dai_dien', 'san_phams.gia_ban')
                ->get();
            return response()->json(['data' => $data]);
        }
    }
    public function updateqty(Request $request)
    {
        $mon = ChiTietDonHang::where('id', $request->id)->where('is_cart', 1)->whereNull('hoa_don_id')->first();
        if ($mon) {
            $mon->so_luong = $request->so_luong;
            if ($mon->so_luong > 0) {
                $mon->save();
                return response()->json(['status' => true]);
            } else {
                return response()->json(['status' => false]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
    public function removeCart($id)
    {
        $agent = Auth::guard('TaiKhoan')->user();
        $chiTietDonHang = ChiTietDonHang::where('is_cart', 1)
            ->where('agent_id', $agent->id)
            ->where('id',  $id)
            ->whereNull("hoa_don_id")
            ->first();
        if ($chiTietDonHang) {
            $chiTietDonHang->delete();
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}
