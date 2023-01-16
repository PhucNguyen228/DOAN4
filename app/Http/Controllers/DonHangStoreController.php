<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonHangStoreController extends Controller
{
    public function indexXacNhan(){
        return view('store_owner.don_hang.cho_xac_nhan.index');
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
