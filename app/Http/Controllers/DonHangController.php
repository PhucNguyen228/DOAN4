<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonHangRequest;
use App\Models\ChiTietDonHang;
use App\Models\DonHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\str;

class DonHangController extends Controller
{
    public function store(DonHangRequest $request)
    {
        // dd($request);
        $agent = Auth::guard('TaiKhoan')->user();
        if ($agent) {
            $giohang = ChiTietDonHang::join('san_phams','chi_tiet_don_hangs.san_pham_id','san_phams.id')
                ->where('is_cart', 1)
                ->where('agent_id', $agent->id)
                ->select('chi_tiet_don_hangs.*','san_phams.gia_ban')
                ->get();
                // dd($giohang->toArray());
            // foreach ($giohang as $key => $value) {
                if (count($giohang) > 0) {
                    // $donHang = DonHang::create([
                    //     'ma_don_hang'   => Str::uuid(),
                    //     'ho_ten'        => $request->ho_ten,
                    //     'so_dien_thoai' => $request->so_dien_thoai,
                    //     'dia_chi'       => $request->dia_chi,
                    //     'tong_tien'     => 0,
                    //     'tien_giam_gia' => 0,
                    //     'tien_tra'      => 0,
                    //     'id_customer'   => $agent->id,
                    //     'tinh_trang'    => 1,
                    //     'ngay_hoa_don'  => date('Y-m-d'),

                    // ]);
                    // $tien_tra = 0;
                    // $tong_tien = 0;
                    foreach ($giohang as $key => $value) {
                        $sanPham = SanPham::find($value->san_pham_id);
                        // dd($sanPham);
                        if ($sanPham) {
                            $donHang = DonHang::create([
                                'ma_don_hang'   => Str::uuid(),
                                'ho_ten'        => $request->ho_ten,
                                'so_dien_thoai' => $request->so_dien_thoai,
                                'dia_chi'       => $request->dia_chi,
                                'tong_tien'     => $value->so_luong * $value->gia_ban,
                                'tien_giam_gia' => ($value->so_luong * $value->gia_ban) - ($value->so_luong * $value->don_gia),
                                'tien_tra'      => $value->so_luong * $value->don_gia,
                                'id_customer'   => $agent->id,
                                'tinh_trang'    => 1,
                                'ngay_hoa_don'  => date('Y-m-d'),

                            ]);
                            $value->is_cart  = 0;
                            $value->hoa_don_id  = $donHang->id;
                            $value->save();

                        } else {
                            $value->delete();
                        }
                    }
                    $donHang->save();
                    return response()->json(['status' => true]);
                } else {
                    return response()->json(['status' => 2]);
                }
        }
    }
}
