<?php

namespace App\Http\Controllers;

use App\Models\BinhLuanVaDanhGia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BinhLuanVaDanhGiaController extends Controller
{
    public function create(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'id_sp'           => 'required',
            'muc_do_hai_long' => 'required',
        ]);
        $data = $request->all();
        $data['id_khach_hang'] = Auth::guard('TaiKhoan')->user()->id;
        // dd($data);
        // BinhLuanVaDanhGia::create($data);
        // toastr()->success('Đánh giá thành công');
        // return redirect()->back();
        if (BinhLuanVaDanhGia::where('id_sp', $data['id_sp'])->where('id_khach_hang', $data['id_khach_hang'])->exists()) {
            //update database
            BinhLuanVaDanhGia::where('id_sp', $data['id_sp'])->where('id_khach_hang', $data['id_khach_hang'])->update([
                'muc_do_hai_long' => $data['muc_do_hai_long'],
            ]);
            toastr()->success('Đánh giá thành công');
            return redirect()->back();
        } else {
            BinhLuanVaDanhGia::create($data);
            toastr()->success('Đánh giá thành công');
            return redirect()->back();
        }
    }

    // delete comment
    public function delete(Request $request)
    {
        $data = BinhLuanVaDanhGia::find($request->id);
        $data->delete([
            'noi_dung' => $data['noi_dung'],
        ]);
        // toastr()->success('Xóa bình luận thành công');
        // return redirect("/");
        return response()->json([
            'status' => true,
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        // dd($data);
        if (BinhLuanVaDanhGia::where('id_sp', $data['id_sp'])->where('id_khach_hang', $data['id_khach_hang'])->exists()) {
            //update database
            BinhLuanVaDanhGia::where('id_sp', $data['id_sp'])->where('id_khach_hang', $data['id_khach_hang'])->update([
                'noi_dung' => $data['noi_dung'],
            ]);
            toastr()->success('Đánh giá thành công');
            return redirect()->back();
        } else {
            BinhLuanVaDanhGia::create($data);
            toastr()->success('Đánh giá thành công');
            return redirect()->back();
        }
    }
}
