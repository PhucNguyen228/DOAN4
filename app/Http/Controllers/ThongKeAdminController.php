<?php

namespace App\Http\Controllers;

use App\Models\DanhMucSanPham;
use App\Models\ThongKeAdmin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThongKeAdminController extends Controller
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
        return view('admin.thong_ke.index', compact('dem'));

        // $check = Auth::guard('TaiKhoan')->user();
        // if ($check) {
        //     if ($check->muc == 0) {
        //         return view('admin.doanh_thu.index');
        //     } else {
        //         toastr()->error('Bạn chưa đăng nhập');
        //         return view('admin.login');
        //     }
        // } else {
        //     toastr()->error('Bạn chưa đăng nhập');
        //     return view('admin.login');
        // }
    }

    public function filter(Request $request)
    {
        // dd($request->all());
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 0) {
                $data = $request->all();
                $from_date = $data['from_date'];
                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                // $change_First_Date = new Carbon('first day of January' . $from_date);
                // dd($change_First_Date, $change_Last_Date);

                // dd($entered_date);
                $get = ThongKeAdmin::where('Thang_thu_nhap', 'LIKE', '%' . $from_date . '%')->orderBy('Thang_thu_nhap', 'ASC')->get()->groupBy(function ($date) {
                    return Carbon::parse($date->Thang_thu_nhap)->format('m/y');
                });
                // dd(gettype($get));
                if ($get->isEmpty()) {
                    // back()->with('error', 'Không có dữ liệu');
                    $oder = DanhMucSanPham::where('yeu_cau', 0)->get();
                    // dd($oder->toArray());
                    $dem = 0;
                    if ($oder) {
                        foreach ($oder as $key => $value) {
                            $dem = $dem + 1;
                        }
                        // dd($dem);
                    }
                    // return view('admin.doanh_thu.index', compact('dem'))->with('error', 'Không có dữ liệu');
                    return redirect()->back()->with('error', 'Không có dữ liệu');
                } else {
                    foreach ($get as $month => $values) {
                        $tong_tien = array_sum(array_column($values->toArray(), 'tong_doanh_thu'));
                        // dd(array_column($values->toArray(), 'tong_doanh_thu'));
                        $chart_data[] = array(
                            'Thang_thu_nhap' => $month,
                            'Tong_tien'      => $tong_tien,
                        );
                    }
                }

                echo $data = json_encode($chart_data);
            } else {
                toastr()->error('Bạn chưa đăng nhập');
                return view('admin.login');
            }
        } else {
            toastr()->error('Bạn chưa đăng nhập');
            return view('admin.login');
        }
    }
}
