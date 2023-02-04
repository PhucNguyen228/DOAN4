<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuanLyThueRequest;
use App\Models\DanhMucSanPham;
use App\Models\QuanLyThueAdmin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuanLyThueAdminController extends Controller
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
        return view('admin.thue.index', compact('dem'));
    }

    public function create(Request $request)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 0) {
                $validatedData = $request->validate([
                    'ten_thue' => 'required|max:255',
                    'muc_thue' => 'required|numeric|min:0',
                ]);

                QuanLyThueAdmin::create([
                    'Ten_thue'      => $validatedData['ten_thue'],
                    'Muc_thue'      => $validatedData['muc_thue'],
                    'Trang_thai'    => $request->is_open,
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
                $data = QuanLyThueAdmin::all();
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
                $status = QuanLyThueAdmin::find($id);
                if ($status) {
                    $status->Trang_thai = !$status->Trang_thai;
                    $status->save();
                    return response()->json([
                        'trangThai'         =>  true,
                        'tinhTrangThue'  =>  $status->Trang_thai,
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
                $delete = QuanLyThueAdmin::find($id);
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
                $edit = QuanLyThueAdmin::find($id);
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

    public function update(QuanLyThueRequest $request)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 0) {
                $danhmuc = QuanLyThueAdmin::find($request->id);
                $danhmuc->update([
                    'Ten_thue'      => $request->Ten_thue,
                    'Muc_thue'      => $request->Muc_thue,
                    'Trang_thai'    => $request->Trang_thai,
                    'updated_at'    => Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString(),
                ]);
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
