<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use App\Models\DoanhThuAdmin;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoanhThuAdminController extends Controller
{
    public function index()
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 0) {
                return view('admin.doanh_thu.index');
            } else {
                toastr()->error('Bạn chưa đăng nhập');
                return view('admin.login');
            }
        } else {
            toastr()->error('Bạn chưa đăng nhập');
            return view('admin.login');
        }
    }

    public function testing(Request $request)
    {
        // dd($request->all());
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 0) {
                $data = $request->all();
                $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

                if ($data['dashboard_value'] == '365ngay') {
                    $get = DoanhThuAdmin::whereBetween('Thang_thu_nhap', [$sub365days, $now])->orderBy('Thang_thu_nhap', 'ASC')->get()->groupBy(function ($date) {
                        return Carbon::parse($date->Thang_thu_nhap)->format('m/Y'); // grouping by months
                    });
                }

                foreach ($get as $month => $values) {
                    $tong_tien = array_sum(array_column($values->toArray(), 'tong_doanh_thu'));
                    $chart_data[] = array(
                        'Thang_thu_nhap' => $month,
                        'Tong_tien'      => $tong_tien,
                    );
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

    public function filter(Request $request)
    {
        // dd($request->all());
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 0) {
                $data = $request->all();
                $from_date = $data['from_date'];
                $to_date = $data['to_date'];
                // dd(gettype($from_date), gettype($to_date));
                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                $change_First_Date = new Carbon('first day of January' . $from_date);
                $change_Last_Date = new Carbon('last day of December' . $to_date);
                // dd($change_First_Date, $change_Last_Date);

                if (gettype($from_date) != 'NULL' && gettype($to_date) != 'NULL') {
                    // 82-88 code so sánh 2 năm khác nhau
                    // $get = DoanhThuAdmin::where('Thang_thu_nhap', 'LIKE', '%' . $from_date . '%')
                    //     ->orWhere('Thang_thu_nhap', 'LIKE', '%' . $to_date . '%')
                    //     ->orderBy('Thang_thu_nhap', 'ASC')
                    //     ->get()
                    //     ->groupBy(function ($date) {
                    //         return Carbon::parse($date->Thang_thu_nhap)->format('y');
                    //     });

                    // 89 - 95 code hiện thị theo năm được chọn
                    $get = DoanhThuAdmin::whereBetween('Thang_thu_nhap', [$change_First_Date, $change_Last_Date])->orderBy('Thang_thu_nhap', 'ASC')->get()->groupBy(function ($date) {
                        return Carbon::parse($date->Thang_thu_nhap)->format('Y'); // grouping by months
                    });
                    // dd($get);
                    foreach ($get as $month => $values) {
                        $tong_tien = array_sum(array_column($values->toArray(), 'tong_doanh_thu'));
                        // dd(array_column($values->toArray(), 'tong_doanh_thu'));
                        $chart_data[] = array(
                            'Thang_thu_nhap' => $month,
                            'Tong_tien'      => $tong_tien,
                        );
                    }
                }
                if (gettype($from_date) == 'NULL' && gettype($to_date) == 'NULL') {
                    // create error message HASH
                    toastr()->error('Bạn chưa chọn ngày');
                    return view('admin.doanh_thu.index');
                }
                if (gettype($from_date) != 'NULL' && gettype($to_date) == 'NULL' || gettype($from_date) != 'NULL' && gettype($to_date) == 'NULL') {
                    $get = DoanhThuAdmin::where('Thang_thu_nhap', 'LIKE', '%' . $from_date . '%')->orderBy('Thang_thu_nhap', 'ASC')->get()->groupBy(function ($date) {
                        return Carbon::parse($date->Thang_thu_nhap)->format('m/y');
                    });
                    // dd($get);
                    foreach ($get as $month => $values) {
                        $tong_tien = array_sum(array_column($values->toArray(), 'tong_doanh_thu'));
                        // dd(array_column($values->toArray(), 'tong_doanh_thu'));
                        $chart_data[] = array(
                            'Thang_thu_nhap' => $month,
                            'Tong_tien'      => $tong_tien,
                        );
                    }
                }
                // $get = DoanhThuAdmin::whereBetween('Thang_thu_nhap', 'LIKE', ['%' . $from_date . '%', '%' . $to_date . '%'])->orderBy('Thang_thu_nhap', 'ASC')->get()->groupBy(function ($date) {
                //     return Carbon::parse($date->Thang_thu_nhap)->format('y');
                // });

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

    public function dashboard_filter(Request $request)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 0) {
                $data = $request->all();
                // $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
                $dau_ThangNay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
                $dau_ThangTruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
                $cuoi_ThangTruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
                $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();

                $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                $year = new Carbon('first day of January');
                $days_left = Carbon::parse($now)->diffInDays($year);
                $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays($days_left)->toDateString();
                // dd($sub365days, $year);

                if ($data['dashboard_value'] == '7ngay') {
                    $get = DoanhThuAdmin::whereBetween('Thang_thu_nhap', [$sub7days, $now])->orderBy('Thang_thu_nhap', 'ASC')->get()->groupBy(function ($date) {
                        return Carbon::parse($date->Thang_thu_nhap)->format('d/m');
                    });
                } elseif ($data['dashboard_value'] == 'thangtruoc') {
                    $get = DoanhThuAdmin::whereBetween('Thang_thu_nhap', [$dau_ThangTruoc, $cuoi_ThangTruoc])->orderBy('Thang_thu_nhap', 'ASC')->get()->groupBy(function ($date) {
                        return Carbon::parse($date->Thang_thu_nhap)->format('d/m/Y'); // grouping by months
                    });
                } elseif ($data['dashboard_value'] == 'thangnay') {
                    $get = DoanhThuAdmin::whereBetween('Thang_thu_nhap', [$dau_ThangNay, $now])->orderBy('Thang_thu_nhap', 'ASC')->get()->groupBy(function ($date) {
                        return Carbon::parse($date->Thang_thu_nhap)->format('d/m/Y'); // grouping by months
                    });
                } else {
                    $get = DoanhThuAdmin::whereBetween('Thang_thu_nhap', [$subdays, $now])->orderBy('Thang_thu_nhap', 'ASC')->get()->groupBy(function ($date) {
                        return Carbon::parse($date->Thang_thu_nhap)->format('m/Y'); // grouping by months
                    });
                }

                foreach ($get as $month => $values) {
                    $tong_tien = array_sum(array_column($values->toArray(), 'tong_doanh_thu'));
                    $chart_data[] = array(
                        'Thang_thu_nhap' => $month,
                        'Tong_tien'      => $tong_tien,
                    );
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
