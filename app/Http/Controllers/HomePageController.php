<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCartRequest;
use App\Models\ChiTietDonHang;
use App\Models\DanhMucSanPham;
use App\Models\SanPham;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    public function index()
    {
        $sanPham = SanPham::all();
        $danhMuc = DanhMucSanPham::where('yeu_cau', 1)->get();
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            $oder = ChiTietDonHang::where('is_cart', 1)
                ->where('chi_tiet_don_hangs.id')
                ->get();
            // dd($oder->toArray());
            $dem = 0;
            if ($oder) {
                foreach ($oder as $key => $value) {
                    $dem = $dem + 1;
                }
                // dd($dem);
            }
        }
        return view('customer.home_page.index', compact('sanPham', 'danhMuc'));
    }

    // public function ChiTietSP($id){
    //     $data = SanPham::where('san_phams.id', $id)->first();
    //     return view('customer.chi_tiet_sp.index', compact('data'));
    // }

    // public function index(){
    //     return view('customer.home_page.index');
    // }
    // public function data(){
    //     $sanPham = SanPham::all();
    //     return response()->json([
    //         'data' => $sanPham,
    //     ]);
    // }

    public function search(Request $request)
    {
        $dataTimKiem = SanPham::where('ten_san_pham', 'like', '%' . $request->ten_san_pham . '%')
            ->get();
        // dd(($data));
        $danhMuc = DanhMucSanPham::all();
        return view('customer.tim_kiem.index', compact('danhMuc', 'dataTimKiem'));
    }



    public function detail()
    {
        return view('customer.chi_tiet_sp.index');
    }

    public function indexDonHang()
    {
        return view('customer.don_hang.index');
    }

    // add sản phẩm
    public function addToCart(AddCartRequest $request)
    {
        $agent = Auth::guard('TaiKhoan')->user();
        if ($agent) {
            $sanPham = SanPham::find($request->san_pham_id);
            // $ban = Ban::all();
            $chiTietDonHang = ChiTietDonHang::where('san_pham_id', $request->san_pham_id)
                ->where('is_cart', 1)
                ->where('agent_id', $agent->id)
                ->first();

            if ($chiTietDonHang) {
                $chiTietDonHang->so_luong += $request->so_luong;
                $chiTietDonHang->save();
            } else {
                ChiTietDonHang::create([
                    'san_pham_id'       => $sanPham->id,
                    'ten_san_pham'      => $sanPham->ten_san_pham,
                    'don_gia'           => $sanPham->gia_khuyen_mai ? $sanPham->gia_khuyen_mai : $sanPham->gia_ban,
                    'so_luong'          => $request->so_luong,
                    'is_cart'           => 1,
                    'agent_id'          => $agent->id,
                ]);
            }
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function dataSP(Request $request)
    {
        $sanPham = SanPham::join('danh_muc_san_phams', 'danh_muc_san_phams.id', 'san_phams.id_danh_muc')
            ->where('danh_muc_san_phams.id', $request->id)
            ->select('san_phams.*')
            ->get();
        $danhMuc = DanhMucSanPham::all();
        return view('customer.san_pham_danh_muc.index', compact('sanPham', 'danhMuc'));
    }
}
