<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SanPhamRequest;
use App\Http\Requests\UpdateSanPhamRequest;
use App\Models\DanhMucSanPham;
use App\Models\DoanhThuAdmin;
use App\Models\QuanLyThueAdmin;
use App\Models\SanPham;
use App\Models\TaiKhoan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SanPhamController extends Controller
{
    public function index()
    {
        $han_can_thanh_toan = TaiKhoan::where('id', Auth::guard('TaiKhoan')->user()->id)->first();
        $han_can_thanh_toan = $han_can_thanh_toan->updated_at;
        // truy xuất dữ liệu từ bảng quan_ly_thue_admins và lấy Muc_thue
        $muc_thue = QuanLyThueAdmin::where('Trang_thai', 1)->first();
        $muc_thue = $muc_thue->Muc_thue;
        $symbol = 'đ';
        $symbol_thousand = '.';
        $decimal_place = 0;
        $price = number_format($muc_thue, $decimal_place, '', $symbol_thousand);
        $price = $price . $symbol;
        return view('store_owner.page_chinh.index', ['muc_thue' => $muc_thue, 'price' => $price, 'han_can_thanh_toan' => $han_can_thanh_toan]);
    }

    public function create(Request $request)
    {
        // dd($request->all());
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2 && $check->trang_thai == 1) {
                $userId = Auth::guard('TaiKhoan')->user()->id;
                $thue = $request->thue;

                // lấy updated_at từ bảng tai_khoans và format date giờ phút giây theo định dạng Y-m-d-h:i:s dùng carbon Asia/Ho_Chi_Minh
                $updated_at = TaiKhoan::where('id', $userId)->first();
                $updated_at = $updated_at->updated_at;
                $updated_at = Carbon::parse($updated_at)->timezone('Asia/Ho_Chi_Minh')->format('Y-m-d-h:i:s');
                $the_next_6months = Carbon::parse($updated_at)->addMonths(6)->format('Y-m-d-h:i:s');
                // dd($userId, $thue, $updated_at, $the_next_6months);
                // return view('store_owner.page_chinh.index');

                DoanhThuAdmin::create([
                    'id_tai_khoan'   => $userId,
                    'tong_doanh_thu' => $thue,
                    'Thang_thu_nhap' => Carbon::now()->format('Y-m-d'),
                    'updated_at'     => $the_next_6months,
                ]);

                TaiKhoan::where('id', $userId)->update([
                    'updated_at' => $the_next_6months,
                ]);

                return response()->json([
                    'trangThai' => true,
                ]);
            } else {
                // toastr()->error('Bạn cần phải đăng nhập');
                return redirect("/login");
                // return view('tai_khoan.login');

            }
        } else {
            // toastr()->error('Bạn cần phải đăng nhập');
            // return view('tai_khoan.login');
            return redirect("/login");
        }
    }

    public function vnpay_payment(Request $request)
    {
        $muc_thue = QuanLyThueAdmin::where('Trang_thai', 1)->first();
        $muc_thue = $muc_thue->Muc_thue;
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $code_random = rand(00, 9999);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
        $vnp_TmnCode = "Y6ZPILY2"; //Mã website tại VNPAY
        $vnp_HashSecret = "XKVNOCARVHQSWARGKNBIIVEUNUAPJHYB"; //Chuỗi bí mật

        $vnp_TxnRef = $code_random; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán thuế';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $muc_thue * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
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
                        'gia_khuyen_mai' => $request->gia_khuyen_mai,
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
                    ->select('san_phams.id', 'san_phams.ten_san_pham', 'san_phams.slug_san_pham', 'san_phams.gia_ban','san_phams.gia_khuyen_mai', 'san_phams.is_open', 'danh_muc_san_phams.ten_danh_muc')
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
                $data = SanPham::where('id', $request->id)
                    ->where('id_tai_khoan', $check->id)->first();
                if ($data) {
                    $check_sp = SanPham::where('id_tai_khoan', $check->id)
                        ->where('ten_san_pham', $request->ten_san_pham)->first();
                    if ($check_sp) {
                        if ($check_sp->id == $data->id) {
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
