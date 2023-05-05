<?php

namespace App\Http\Controllers;

use App\Models\DoanhThuStore;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;

class DoanhThuStoreController extends Controller
{
    public function index()
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2) {
                return view('store_owner.doanh_thu.index');
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
            if ($check->muc == 2) {
                $data = $request->all();
                $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

                if ($data['dashboard_value'] == '365ngay') {
                    $get = DoanhThuStore::whereBetween('ngay_hoa_don', [$sub365days, $now])->orderBy('ngay_hoa_don', 'ASC')->get()->groupBy(function ($date) {
                        return Carbon::parse($date->ngay_hoa_don)->format('m/Y'); // grouping by months
                    });
                }

                foreach ($get as $month => $values) {
                    $tong_tien = array_sum(array_column($values->toArray(), 'tien_tra'));
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
            if ($check->muc == 2) {
                $data = $request->all();
                $id_store = $check->id;
                $from_date = $data['from_date'];
                $to_date = $data['to_date'];
                // dd(gettype($from_date), gettype($to_date));
                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                $change_First_Date = new Carbon('first day of January' . $from_date);
                $change_Last_Date = new Carbon('last day of December' . $to_date);
                // dd($change_First_Date, $change_Last_Date);

                if (gettype($from_date) != 'NULL' && gettype($to_date) != 'NULL') {
                    $get = DoanhThuStore::where('id_store', $id_store)->whereBetween('ngay_hoa_don', [$change_First_Date, $change_Last_Date])->orderBy('ngay_hoa_don', 'ASC')->get()->groupBy(function ($date) {
                        return Carbon::parse($date->ngay_hoa_don)->format('Y'); // grouping by months
                    });
                    // dd($get);
                    foreach ($get as $month => $values) {
                        $tong_tien = array_sum(array_column($values->toArray(), 'tien_tra'));
                        // dd(array_column($values->toArray(), 'tien_tra'));
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
                if (gettype($from_date) != 'NULL' && gettype($to_date) == 'NULL' || gettype($from_date) == 'NULL' && gettype($to_date) != 'NULL') {
                    $entered_date = '';
                    if (gettype($from_date) != 'NULL' && gettype($to_date) == 'NULL') {
                        $entered_date = $from_date;
                    } else {
                        $entered_date = $to_date;
                    }
                    // dd($entered_date);
                    // $get = DoanhThuStore::where('ngay_hoa_don', 'LIKE', '%' . $entered_date . '%')->orderBy('ngay_hoa_don', 'ASC')->get()->groupBy(function ($date) {
                    //     return Carbon::parse($date->ngay_hoa_don)->format('m/y');
                    // });
                    $get = DoanhThuStore::where('id_store', $id_store)->where('ngay_hoa_don', 'LIKE', '%' . $entered_date . '%')->orderBy('ngay_hoa_don', 'ASC')->get()->groupBy(function ($date) {
                        return Carbon::parse($date->ngay_hoa_don)->format('m/y');
                    });
                    if ($get->isEmpty()) {
                        // back()->with('error', 'Không có dữ liệu');
                        // return view('admin.doanh_thu.index', compact('dem'))->with('error', 'Không có dữ liệu');
                        return redirect()->back()->with('error', 'Không có dữ liệu');
                    } else {
                        foreach ($get as $month => $values) {
                            $tong_tien = array_sum(array_column($values->toArray(), 'tien_tra'));
                            // dd(array_column($values->toArray(), 'tien_tra'));
                            $chart_data[] = array(
                                'Thang_thu_nhap' => $month,
                                'Tong_tien'      => $tong_tien,
                            );
                        }
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

    public function dashboard_filter(Request $request)
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            if ($check->muc == 2) {
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
                // dd($subdays, $now, $data['dashboard_value']);

                if ($data['dashboard_value'] == '7ngay') {
                    $get = DoanhThuStore::whereBetween('ngay_hoa_don', [$sub7days, $now])->orderBy('ngay_hoa_don', 'ASC')->get()->groupBy(function ($date) {
                        return Carbon::parse($date->ngay_hoa_don)->format('d/m');
                    });
                } elseif ($data['dashboard_value'] == 'thangtruoc') {
                    $get = DoanhThuStore::whereBetween('ngay_hoa_don', [$dau_ThangTruoc, $cuoi_ThangTruoc])->orderBy('ngay_hoa_don', 'ASC')->get()->groupBy(function ($date) {
                        return Carbon::parse($date->ngay_hoa_don)->format('d/m/Y'); // grouping by months
                    });
                } elseif ($data['dashboard_value'] == 'thangnay') {
                    $get = DoanhThuStore::whereBetween('ngay_hoa_don', [$dau_ThangNay, $now])->orderBy('ngay_hoa_don', 'ASC')->get()->groupBy(function ($date) {
                        return Carbon::parse($date->ngay_hoa_don)->format('d/m/Y'); // grouping by months
                    });
                } else {
                    $get = DoanhThuStore::whereBetween('ngay_hoa_don', [$subdays, $now])->orderBy('ngay_hoa_don', 'ASC')->get()->groupBy(function ($date) {
                        return Carbon::parse($date->ngay_hoa_don)->format('m/Y'); // grouping by months
                    });
                }

                foreach ($get as $month => $values) {
                    $tong_tien = array_sum(array_column($values->toArray(), 'tien_tra'));
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
