<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(){
        $sanPham = SanPham::all();
        return view('customer.home_page.index', compact('sanPham'));
    }



    public function detail(){
        return view('customer.chi_tiet_sp.index');
    }

    public function indexCart(){
        return view('customer.cart.index');
    }

    public function indexDonHang(){
        return view('customer.don_hang.index');
    }
}
