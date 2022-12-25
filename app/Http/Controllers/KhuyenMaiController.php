<?php

namespace App\Http\Controllers;

use App\Models\KhuyenMai;
use App\Http\Controllers\Controller;
use App\Http\Requests\KhuyenMainRequest;
use App\Http\Requests\UpdateKhuyenMaiRequest;
use App\Models\ChiTietKhuyenMai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KhuyenMaiController extends Controller
{

    public function indexKM()
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2) {
                return view('store_owner.Khuyen_mai.indexKM');
            } else {
                // toastr()->error('Bạn chưa đăng nhập');
                // return view('tai_khoan.login');
                return redirect("/login");
            }
        } else {
            // toastr()->error('Bạn chưa đăng nhập');
            // return view('tai_khoan.login');
            return redirect("/login");
        }
    }
    public function createKM(KhuyenMainRequest $request)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2) {
                $ngay_ht = Carbon::now();
                $data = KhuyenMai::where('id_tai_khoan', $check->id)
                    ->where('ten_dot_KM', $request->ten_dot_KM)
                    // ->orWhereDate($request->ngay_bd,'>',$ngay_ht)
                    ->first();

                // dd($ngay_ht);
                // $check_km = KhuyenMai::where('ngay_bd','>',$request->ngay_bd)
                //                        -> where('ngay_kt','>', $request->ngay_bd)->get();
                // if(count($check_km) > 0) {
                    if ($data) {
                        return response()->json([
                            'status'         =>  false,
                        ]);
                    } else {
                            KhuyenMai::create([
                                'ten_dot_KM' => $request->ten_dot_KM,
                                'ngay_bd'    => $request->ngay_bd,
                                'ngay_kt'    => $request->ngay_kt,
                                'trang_thai' => $request->trang_thai,
                                'id_tai_khoan' => $check->id,
                            ]);
                            return response()->json([
                                'status'         =>  true,
                            ]);
                    }
                // } else {
                //     return response()->json([
                //         'status'         =>  false,
                //     ]);
                // }

            } else {
                // toastr()->error('Bạn chưa đăng nhập');

                return redirect("/login");
            }
        } else {
            // toastr()->error('Bạn chưa đăng nhập');

            return redirect("/login");
        }
    }
    public function dataKM()
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2) {
                $data = KhuyenMai::where('id_tai_khoan', $check->id)
                    ->select('khuyen_mais.*')
                    ->get();

                return response()->json([
                    'dataKM' => $data,
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
                $status = KhuyenMai::find($id);
                if ($status) {
                    $status->trang_thai = !$status->trang_thai;
                    $status->save();
                    return response()->json([
                        'trangThai'         =>  true,
                        'tinhTrangKM'  =>  $status->trang_thai,
                    ]);
                } else {
                    return response()->json([
                        'trangThai'         =>  false,
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
    public function delete($id)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2) {
                $delete = KhuyenMai::find($id);
                // $chitiet =  ChiTietKhuyenMai::where('id_khuyen_mai',$id)->first();
                if ($delete) {
                    $delete->delete();
                    // $chitiet->delete();
                    return response()->json([
                        'status'  =>  true,
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
                $edit = KhuyenMai::find($id);
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
    public function update(UpdateKhuyenMaiRequest $request)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2) {
                $data = KhuyenMai::where('id', $request->id)
                    ->where('id_tai_khoan', $check->id)->first();
                if ($data) {
                    $check_km = KhuyenMai::where('id_tai_khoan', $check->id)
                        ->where('ten_dot_KM', $request->ten_dot_KM)->first();
                    if ($check_km) {
                        if ($check_km->id == $data->id) {
                            $data = $request->all();
                            $khuyenmai = KhuyenMai::find($request->id);
                            $khuyenmai->update($data);
                            return response()->json([
                                'status' => true,
                            ]);
                        } else {
                            return response()->json([
                                'trangThai'         =>  false,
                            ]);
                        }
                    } else {
                        $data = $request->all();
                        $khuyenmai = KhuyenMai::find($request->id);
                        $khuyenmai->update($data);
                        return response()->json([
                            'status' => true,
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => false,
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
