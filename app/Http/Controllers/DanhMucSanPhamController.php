<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DanhMucSanPhamRequest;
use App\Http\Requests\UpdateDanhMucSpRequest;
use App\Models\DanhMucSanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DanhMucSanPhamController extends Controller
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
        return view('admin.danh_muc.index',compact('dem'));
    }
    public function create(DanhMucSanPhamRequest $request)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 0) {
                DanhMucSanPham::create([
                    'ten_danh_muc'      =>  $request->ten_danh_muc,
                    'slug_danh_muc'     =>  $request->slug_danh_muc,
                    'id_tai_khoan'      =>  $check->id,
                    'trang_thai'        =>  $request->trang_thai,
                ]);

                return response()->json([
                    'trangThai'         =>  true,
                ]);
            } else {
                // toastr()->error('Bạn chưa đăng nhập');
                return view('admin.login');
            }
        } else {
            // toastr()->error('Bạn chưa đăng nhập');
            return view('admin.login');
        }
    }
    public function getData()
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 0) {
                $data = DanhMucSanPham::where('yeu_cau', 1)->get();
                return response()->json([
                    'data' => $data,
                ]);
            } else {
                // toastr()->error('Bạn chưa đăng nhập');
                return view('admin.login');
            }
        } else {
            // toastr()->error('Bạn chưa đăng nhập');
            return view('admin.login');
        }
    }
    public function status($id)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 0) {
                $status = DanhMucSanPham::find($id);
                if ($status) {
                    $status->trang_thai = !$status->trang_thai;
                    $status->save();
                    return response()->json([
                        'trangThai'         =>  true,
                        'tinhTrangDanhMuc'  =>  $status->trang_thai,
                    ]);
                } else {
                    return response()->json([
                        'trangThai'         =>  false,
                    ]);
                }
            } else {
                // toastr()->error('Bạn chưa đăng nhập');
                return view('admin.login');
            }
        } else {
            // toastr()->error('Bạn chưa đăng nhập');
            return view('admin.login');
        }
    }
    public function delete($id)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 0) {
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
            } else {
                return view('admin.login');
            }
        } else {
            return view('admin.login');
        }
    }
    public function edit($id)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 0) {
                $edit = DanhMucSanPham::find($id);
                if ($edit) {
                    return response()->json([
                        'status'  =>  true,
                        'data'    =>  $edit,
                    ]);
                } else {
                    return response()->json([
                        'status'  =>  false,
                    ]);
                }
            } else {
                return view('admin.login');
            }
        } else {
            return view('admin.login');
        }
    }
    public function update(UpdateDanhMucSpRequest $request)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 0) {
                $data = $request->all();
                $danhmuc = DanhMucSanPham::find($request->id);
                $danhmuc->update($data);
                return response()->json([
                    'status' => true,
                ]);
            } else {
                return view('admin.login');
            }
        } else {
            return view('admin.login');
        }
    }
}
