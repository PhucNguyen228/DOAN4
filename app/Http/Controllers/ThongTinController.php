<?php

namespace App\Http\Controllers;

use App\Http\Requests\CapNhatThongTinRequest;
use App\Models\LoaiTaiKhoan;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThongTinController extends Controller
{
    public function index(){
        $check = Auth::guard('TaiKhoan')->user();
        if($check){
            $dataTKStore = TaiKhoan::where('id', $check->id)
                    ->select('tai_khoans.*')
                    ->first();
            // dd($dataTKStore->toArray());
        return view('store_owner.Thong_tin.index',compact('dataTKStore'));
        }
    }

   public function update(CapNhatThongTinRequest $request){
        $data     = $request->all();
        $tai_khoan = TaiKhoan::find($request->id);
        $tai_khoan->update($data);
        toastr()->success('Đã cập nhật danh mục thành công!');
        return redirect('/store/thong-tin/index');
   }
}
