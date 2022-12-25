<?php

namespace App\Http\Controllers;

use App\Models\ChiTietKhuyenMai;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChiTietKhuyenMaiRequest;
use App\Http\Requests\UpdateChiTietKhuyenMaiRequest;
use App\Models\KhuyenMai;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChiTietKhuyenMaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTyLe()
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2) {
                $list_KM = KhuyenMai::where('khuyen_mais.trang_thai', 1)
                    ->where('id_tai_khoan', $check->id)
                    ->get();
                $list_SP = SanPham::where('is_open', 1)
                    ->where('id_tai_khoan', $check->id)
                    ->get();
                return view('store_owner.ty_le_KM.index', compact('list_KM', 'list_SP'));
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ChiTietKhuyenMaiRequest $request)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2) {
                $data =  ChiTietKhuyenMai::where('id_tai_khoan', $check->id)
                    ->where([
                        ['id_san_pham', $request->id_san_pham],
                        ['id_khuyen_mai', $request->id_khuyen_mai],
                    ])
                    // ->where('id_khuyen_mai', $request->id_khuyen_mai)
                    ->first();
                if ($data) {
                    return response()->json([
                        'status'         =>  false,
                    ]);
                } else {
                    ChiTietKhuyenMai::create([
                        'id_san_pham'      =>    $request->id_san_pham,
                        'id_khuyen_mai'    => $request->id_khuyen_mai,
                        'ti_le_KM'         => $request->ti_le_KM,
                        'id_tai_khoan'     => $check->id,
                        'trang_thai'       => $request->trang_thai,
                    ]);
                    return response()->json([
                        'status'         =>  true,
                    ]);
                }
            } else {
                return redirect("/login");
            }
        } else {
            return redirect("/login");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChiTietKhuyenMai  $chiTietKhuyenMai
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2) {
                $data = ChiTietKhuyenMai::join('san_phams', 'san_phams.id', 'chi_tiet_khuyen_mais.id_san_pham')
                    ->join('khuyen_mais', 'khuyen_mais.id', 'chi_tiet_khuyen_mais.id_khuyen_mai')
                    ->where('chi_tiet_khuyen_mais.id_tai_khoan', $check->id)
                    ->select('khuyen_mais.ten_dot_KM', 'san_phams.ten_san_pham', 'chi_tiet_khuyen_mais.ti_le_KM', 'chi_tiet_khuyen_mais.trang_thai', 'chi_tiet_khuyen_mais.id')
                    ->get();
                return response()->json([
                    'dataTyLe' => $data,
                ]);
            } else {
                return redirect('/login');
            }
        } else {
            return redirect('/login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChiTietKhuyenMai  $chiTietKhuyenMai
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2) {
                $edit = ChiTietKhuyenMai::find($id);
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
            toastr()->error('Bạn chưa đăng nhập');

            return redirect("/login");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChiTietKhuyenMai  $chiTietKhuyenMai
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChiTietKhuyenMaiRequest $request)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2) {
                $data = ChiTietKhuyenMai::where('id', $request->id)
                    ->where('id_tai_khoan', $check->id)->first();
                if ($data) {
                    $check_km = ChiTietKhuyenMai::where('id_tai_khoan', $check->id)
                    ->where([
                        ['id_khuyen_mai', $request->id_khuyen_mai],
                        ['id_san_pham', $request->id_san_pham],
                    ])
                    ->first();
                    if ($check_km) {
                        if ($check_km->id == $data->id) {
                            $data = $request->all();
                            $khuyenmai = ChiTietKhuyenMai::find($request->id);
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
                        $khuyenmai = ChiTietKhuyenMai::find($request->id);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChiTietKhuyenMai  $chiTietKhuyenMai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2) {
                $delete = ChiTietKhuyenMai::find($id);
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
                $status = ChiTietKhuyenMai::find($id);
                if ($status) {
                    $status->trang_thai = !$status->trang_thai;
                    $status->save();
                    return response()->json([
                        'trangThai'         =>  true,
                        'tinhTrangTyLe'  =>  $status->trang_thai,
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
}
