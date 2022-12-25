<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SanPhamRequest;
use App\Http\Requests\UpdateSanPhamRequest;
use App\Models\DanhMucSanPham;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SanPhamController extends Controller
{
    public function index()
    {
        // $check = Auth::guard('TaiKhoan')->user();
        // if ($check) {
        //     if ($check->muc == 2 && $check->trang_thai == 1) {
                return view('store_owner.page_chinh.index');
        //     } else {
        //         // toastr()->error('Bạn cần phải đăng nhập');
        //         return redirect("/login");
        //         // return view('tai_khoan.login');

        //     }
        // } else {
        //     // toastr()->error('Bạn cần phải đăng nhập');
        //     // return view('tai_khoan.login');
        //     return redirect("/login");
        // }
    }
    public function indexSanPham()
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2) {
                $list_danh_muc = DanhMucSanPham::where('trang_thai', 1)
                    ->where('yeu_cau', 1)
                    ->get();
                return view('store_owner.san_pham.index', compact('list_danh_muc'));
            } else {
                // toastr()->error('Bạn chưa đăng nhập');
                return redirect("/login");

            }
        } else {
            // toastr()->error('Bạn chưa đăng nhập');
            return redirect("/login");
        }
    }
    public function createSP(SanPhamRequest $request)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2) {
                $data = SanPham::where('id_tai_khoan', $check->id)
                    ->where('ten_san_pham', $request->ten_san_pham)->first();
                if ($data) {
                    return response()->json([
                        'status'         =>  false,
                    ]);
                } else {
                    // $data = $request->all();
                    SanPham::create([
                        'ten_san_pham'  => $request->ten_san_pham,
                        'slug_san_pham' => $request->slug_san_pham,
                        'gia_ban'       => $request->gia_ban,
                        'don_vi'        => $request->don_vi,
                        'anh_dai_dien'  => $request->anh_dai_dien,
                        'id_danh_muc'   => $request->id_danh_muc,
                        'mo_ta_ngan'    => $request->mo_ta_ngan,
                        'mo_ta_dai'     => $request->mo_ta_dai,
                        'is_open'       => $request->is_open,
                        'id_tai_khoan'  => $check->id,
                    ]);
                    return response()->json([
                        'status' => true,
                    ]);
                }
            } else {
                // toastr()->error('Bạn chưa đăng nhập');
                return redirect("/login");

            }
        } else {
            // toastr()->error('Bạn chưa đăng nhập');
            return redirect("/login");

        }
    }
    public function dataSP()
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2) {
                $data = SanPham::join('danh_muc_san_phams', 'san_phams.id_danh_muc', 'danh_muc_san_phams.id')
                    ->where('san_phams.id_tai_khoan', $check->id)
                    ->select('san_phams.id', 'san_phams.ten_san_pham', 'san_phams.slug_san_pham', 'san_phams.gia_ban', 'san_phams.is_open', 'danh_muc_san_phams.ten_danh_muc')
                    ->get();
                return response()->json([
                    'dataSP'    => $data,
                ]);
            } else {
                // toastr()->error('Bạn chưa đăng nhập');
                return redirect("/login");

            }
        } else {
            // toastr()->error('Bạn chưa đăng nhập');
            return redirect("/login");

        }
    }
    public function status($id)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2) {
                $san_pham = SanPham::find($id);
                if ($san_pham) {
                    $tinh_trang_moi = $san_pham->is_open == true ? false : true;
                    $san_pham->is_open = $tinh_trang_moi;
                    $san_pham->save();
                    return response()->json(['status' => true]);
                }
            } else {
                // toastr()->error('Bạn chưa đăng nhập');
                return redirect("/login");

            }
        } else {
            // toastr()->error('Bạn chưa đăng nhập');
            return redirect("/login");

        }
    }
    public function delete($id)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2) {
                $delete = SanPham::find($id);
                if ($delete) {
                    $delete->delete();
                    return response()->json([
                        'status'    => true,
                    ]);
                } else {
                    return response()->json([
                        'status'  =>  false,
                    ]);
                }
            } else {
                // toastr()->error('Bạn chưa đăng nhập');
                return redirect("/login");

            }
        } else {
            // toastr()->error('Bạn chưa đăng nhập');
            return redirect("/login");

        }
    }
    public function edit($id)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2) {
                $edit = SanPham::find($id);
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
                // toastr()->error('Bạn chưa đăng nhập');
                return redirect("/login");

            }
        } else {
            // toastr()->error('Bạn chưa đăng nhập');
            return redirect("/login");

        }
    }
    public function update(UpdateSanPhamRequest $request)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2) {
                $data = SanPham::where('id' ,$request->id)
                                ->where('id_tai_khoan', $check->id)->first();
                if($data) {
                    $check_sp = SanPham::where('id_tai_khoan', $check->id)
                                    ->where('ten_san_pham', $request->ten_san_pham)->first();
                    if($check_sp) {
                        if($check_sp->id == $data->id) {
                            $data = $request->all();
                            $sanPham = SanPham::find($request->id);
                            $sanPham->update($data);
                            return response()->json([
                                'status' => true,
                            ]);
                        } else {
                            return response()->json([
                                'status' => false,
                            ]);
                        }
                    } else {
                        $data = $request->all();
                        $sanPham = SanPham::find($request->id);
                        $sanPham->update($data);
                        return response()->json([
                            'status' => true,
                        ]);
                    }
                } else {
                    return response()->json([
                        'status'  => false
                    ]);
                }

            } else {
                // toastr()->error('Bạn chưa đăng nhập');
                return redirect("/login");

            }
        } else {
            // toastr()->error('Bạn chưa đăng nhập');
            return redirect("/login");

        }
    }
}
