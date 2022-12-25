<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DanhMucSanPham;
use Illuminate\Http\Request;

class YeuCauDanhMucController extends Controller
{
    public function index()
    {
        $oder = DanhMucSanPham::where('yeu_cau', 0)->get();
        // dd($oder->toArray());
        $dem = 0;
        if ($oder) {
            foreach ($oder as $key => $value) {
                $dem = $dem + 1;
            }
            // dd($dem);
        }
        return view('admin.danh_muc.index_oder', compact('dem'));
    }
    public function view()
    {
        $data = DanhMucSanPham::where('yeu_cau', 0)->get();
        return response()->json([
            'data' => $data,
        ]);
    }
    public function submit($id)
    {
        $tmp  = DanhMucSanPham::find($id);
        $tmp->yeu_cau = 1;
        $tmp->save();
        // dd($tmp);
        return response()->json([
            'status' => true,
        ]);
    }
    public function delete($id){
        $delete = DanhMucSanPham::find($id);
        if ($delete) {
            $delete->delete();
            return response()->json([
                'status'  =>  true,
            ]);
        } else {
            return response()->json([
                'status'  =>  false,
            ]);
        }
    }
}
