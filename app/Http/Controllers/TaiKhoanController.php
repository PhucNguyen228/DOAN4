<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan;
use App\Http\Controllers\Controller;
use App\Http\Requests\loginRequest;
use App\Http\Requests\registerRequest;
use App\Models\DanhMucSanPham;
use App\Models\LoaiTaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// Quản lý code đăng kí đăng nhập

class TaiKhoanController extends Controller
{

    public function destroy($id)
    {
        $agent = Auth::guard('TaiKhoan')->user();
        if ($agent) {
            if ($agent->muc == 0) {
                $taiKhoan = TaiKhoan::find($id);
                if ($taiKhoan) {
                    $taiKhoan->delete();
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
                // return view('admin.login');
                return redirect("/admin/login");
            }
        } else {
            // toastr()->error('Bạn chưa đăng nhập');
            // return view('admin.login');
            return redirect("/admin/login");
        }
    }

    public function indexAdmin()
    {
        return view('admin.login');
    }

    public function LoginAdmin(loginRequest $request)
    {
        // $admin = TaiKhoan::query()
        //     ->where('email', $request->get('email'))
        //     ->where('muc', 0)
        //     ->firstOrFail();
        // if (!Hash::check($request->get('password'), $admin->password)) {
        //     // throw new \Exception('Mật khẩu không đúng');
        //     return redirect()->route('admin')->with('error_mk', 'Tài khoản và Mật khẩu không đúng');
        // }

        // return view('admin.page_chinh.index');
        $data  = $request->all();
        $check = Auth::guard('TaiKhoan')->attempt($data);
        if ($check) {
            $agent = Auth::guard('TaiKhoan')->user();
            if ($agent->muc == 0) {
                return response()->json(['status' => 1]);
            } else {
                toastr()->error('Đăng nhập thất bại');
            }
        } else {
            //Login thất bại
            return response()->json(['status' => 0]);
        }
    }
    public function index()
    {
        $agent = Auth::guard('TaiKhoan')->user();
        if ($agent) {
            if ($agent->muc == 0) {
                $oder = DanhMucSanPham::where('yeu_cau', 0)->get();
                // dd($oder->toArray());
                $dem = 0;
                if ($oder) {
                    foreach ($oder as $key => $value) {
                        $dem = $dem + 1;
                    }
                    // dd($dem);
                }
                return view('admin.page_chinh.index', compact('dem'));
            }
        }
    }
    public function Logout()
    {
        $agent = Auth::guard('TaiKhoan')->user();
        if ($agent) {
            if ($agent->muc == 0) {
                Auth::guard('TaiKhoan')->logout();
                return redirect("/admin/login");
            } elseif ($agent->muc == 2) {
                Auth::guard('TaiKhoan')->logout();
                return redirect("/login");
            }
        }
    }
    public function register()
    {
        $list_loai_TK = LoaiTaiKhoan::all();
        return view('tai_khoan.register', compact('list_loai_TK'));
    }
    public function registerAction(registerRequest $request)
    {
        $data = $request->all();
        $data['password']   = bcrypt($request->password);
        TaiKhoan::create($data);
        return response()->json(['status' => true]);
    }

    public function indexlogin()
    {
        return view('tai_khoan.login');
    }

    public function loginAction(loginRequest $request)
    {
        $data = $request->all();
        $check = Auth::guard('TaiKhoan')->attempt($data);
        // dd($check);
        if ($check) {
            $agent = Auth::guard('TaiKhoan')->user();
            if ($agent->trang_thai == 1) {
                if ($agent->muc == 1) {
                    return response()->json(['status' => 2]);
                } else if ($agent->muc == 2) {
                    return response()->json(['status' => 3]);
                } else {
                    return response()->json(['status' => 1]);
                }
            } else {
                toastr()->warning('trang thai da tat');
            }
        } else {
            //Login thất bại
            return response()->json(['status' => false]);
        }
    }
    public function indexUser()
    {
        $agent = Auth::guard('TaiKhoan')->user();
        // dd($agent);
        if ($agent) {
            if ($agent->muc == 0) {
                $oder = DanhMucSanPham::where('yeu_cau', 0)->get();
                // dd($oder->toArray());
                $dem = 0;
                if ($oder) {
                    foreach ($oder as $key => $value) {
                        $dem = $dem + 1;
                    }
                    // dd($dem);
                }
                return view('admin.quan_ly_tai_khoan.index_user',compact('dem'));
            } else {
                // toastr()->error('Bạn Chưa Đăng Nhập');
                // return view('admin.login');
                return redirect("/admin/login");
            }
        } else {
            // toastr()->error('Bạn Chưa Đăng Nhập');
            // return view('admin.login');
            return redirect("/admin/login");
        }
    }
    public function dataTKUser()
    {
        $agent = Auth::guard('TaiKhoan')->user();
        if ($agent) {
            if ($agent->muc == 0) {
                $data = TaiKhoan::where('muc', 1)->get();
                return response()->json([
                    'TK_User' => $data,
                ]);
            } else {
                // toastr()->error('Bạn chưa đăng nhập');
                // return view('admin.login');
                return redirect("/admin/login");
            }
        } else {
            // toastr()->error('Bạn Chưa Đăng Nhập');
            // return view('admin.login');
            return redirect("/admin/login");
        }
    }
    public function status($id)
    {
        $agent = Auth::guard('TaiKhoan')->user();
        if ($agent) {
            if ($agent->muc == 0) {
                $tai_khoan = TaiKhoan::find($id);
                if ($tai_khoan) {
                    $tai_khoan->trang_thai = !$tai_khoan->trang_thai;
                    $tai_khoan->save();
                    return response()->json([
                        'trangThai'         =>  true,
                        'tinhTrangDanhMuc'  =>  $tai_khoan->trang_thai,
                    ]);
                } else {
                    return response()->json([
                        'trangThai'         =>  false,
                    ]);
                }
            } else {
                // toastr()->error('Bạn chưa đăng nhập');
                // return view('admin.login');
                return redirect("/admin/login");
            }
        } else {
            // toastr()->error('Bạn chưa đăng nhập');
            // return view('admin.login');
            return redirect("/admin/login");
        }
    }
    public function indexStore()
    {
        $agent = Auth::guard('TaiKhoan')->user();
        if ($agent) {
            if ($agent->muc == 0) {
                $oder = DanhMucSanPham::where('yeu_cau', 0)->get();
                // dd($oder->toArray());
                $dem = 0;
                if ($oder) {
                    foreach ($oder as $key => $value) {
                        $dem = $dem + 1;
                    }
                    // dd($dem);
                }
                return view('admin.quan_ly_tai_khoan.index_store',compact('dem'));
            } else {
                // toastr()->error('Bạn Chưa Đăng Nhập');
                // return view('admin.login');
                return redirect("/admin/login");
            }
        } else {
            // toastr()->error('Bạn Chưa Đăng Nhập');
            // return view('admin.login');
            return redirect("/admin/login");
        }
    }

    public function dataTKStore()
    {
        $agent = Auth::guard('TaiKhoan')->user();
        if ($agent) {
            if ($agent->muc == 0) {
                $data = TaiKhoan::where('muc', 2)->get();
                return response()->json([
                    'TK_Store' => $data,
                ]);
            } else {
                // toastr()->error('Bạn Chưa Đăng Nhập');
                // return view('admin.login');
                return redirect("/admin/login");
            }
        } else {
            // toastr()->error('Bạn Chưa Đăng Nhập');
            // return view('admin.login');
            return redirect("/admin/login");
        }
    }
}
