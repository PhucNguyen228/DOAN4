<?php

use App\Http\Controllers\ChiTietKhuyenMaiController;
use App\Http\Controllers\DanhMucSanPhamController;
use App\Http\Controllers\DoanhThuAdminController;
use App\Http\Controllers\DonHangStoreController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\KhuyenMaiController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\ThongTinController;
use App\Http\Controllers\ThongTinCustomerController;
use App\Http\Controllers\YeuCauDanhMucController;
use App\Http\Controllers\YeuCauDMStoreController;
use App\Models\DanhMucSanPhamControler;
use App\Models\DoanhThuStore;
use App\Models\SanPham;
use Illuminate\Support\Facades\Route;

Route::get('/login', [TaiKhoanController::class, 'indexlogin'])->name('login');
Route::post('/login', [TaiKhoanController::class, 'loginAction']);
Route::get('/register', [TaiKhoanController::class, 'register']);
Route::post('/register', [TaiKhoanController::class, 'registerAction']);
Route::get('/logout', [TaiKhoanController::class, 'Logout']);

Route::get('/admin/login', [TaiKhoanController::class, 'indexAdmin']);
Route::post('/admin/login', [TaiKhoanController::class, 'LoginAdmin']);

Route::group(['prefix' => '/admin', 'middleware' => 'AdminMiddleWare'], function () {
    Route::get('/index', [TaiKhoanController::class, 'index']);
    Route::get('/user/index', [TaiKhoanController::class, 'indexUser']);
    Route::get('/user/data', [TaiKhoanController::class, 'dataTKUser']);
    Route::get('/store/index', [TaiKhoanController::class, 'indexStore']);
    Route::get('/store/data', [TaiKhoanController::class, 'dataTKStore']);
    Route::get('/accout/status/{id}', [TaiKhoanController::class, 'status']);
    Route::get('/delete/accout/{id}', [TaiKhoanController::class, 'destroy']);

    //DANH MUC SẢN PHẨM
    Route::group(['prefix' => '/danh-muc-san-pham'], function () {
        Route::get('/index', [DanhMucSanPhamController::class, 'index']);
        Route::post('/index', [DanhMucSanPhamController::class, 'create']);
        Route::get('/data', [DanhMucSanPhamController::class, 'getData']);
        Route::get('/status/{id}', [DanhMucSanPhamController::class, 'status']);
        Route::get('/delete/{id}', [DanhMucSanPhamController::class, 'delete']);
        Route::get('/edit/{id}', [DanhMucSanPhamController::class, 'edit']);
        Route::post('/update', [DanhMucSanPhamController::class, 'update']);
    });

    //DOANH THU
    Route::group(['prefix' => '/doanh-thu-admin'], function () {
        Route::get('/index', [DoanhThuAdminController::class, 'index']);
        Route::post('/index', [DoanhThuAdminController::class, 'testing'])->name('testing');
        Route::post('/filter', [DoanhThuAdminController::class, 'filter'])->name('admin.doanh_thu.filter');
        Route::post('/dashboard-filter', [DoanhThuAdminController::class, 'dashboard_filter'])->name('dashboard_filter');
    });

    // THONG KE


    Route::group(['prefix' => '/yeu-cau-danh-muc'], function () {
        Route::get('/index', [YeuCauDanhMucController::class, 'index']);
        Route::get('/data', [YeuCauDanhMucController::class, 'view']);
        Route::get('/submit/{id}', [YeuCauDanhMucController::class, 'submit']);
        Route::get('/delete/{id}', [YeuCauDanhMucController::class, 'delete']);
    });
});

Route::group(['prefix' => '/store', 'middleware' => 'StoreMiddleware'], function () {

    Route::get('/index', [SanPhamController::class, 'index']);

    Route::group(['prefix' => '/thong-tin'], function () {
        Route::get('/index', [ThongTinController::class, 'index']);
        Route::get('/data',[ThongTinController::class,'data']);
        Route::post('/update', [ThongTinController::class, 'update']);
    });
    Route::group(['prefix' => '/san-pham'], function () {
        Route::get('/index', [SanPhamController::class, 'indexSanPham']);
        Route::post('/index', [SanPhamController::class, 'createSP']);
        Route::get('/dataSP', [SanPhamController::class, 'dataSP']);
        Route::get('/status/{id}', [SanPhamController::class, 'status']);
        Route::get('/delete/{id}', [SanPhamController::class, 'delete']);
        Route::get('/edit/{id}', [SanPhamController::class, 'edit']);
        Route::post('/update', [SanPhamController::class, 'update']);
    });

    Route::group(['prefix' => '/khuyen-mai'], function () {
        Route::get('/index', [KhuyenMaiController::class, 'indexKM']);
        Route::post('/index', [KhuyenMaiController::class, 'createKM']);
        Route::get('/dataKM', [KhuyenMaiController::class, 'dataKM']);
        Route::get('/status/{id}', [KhuyenMaiController::class, 'status']);
        Route::get('/delete/{id}', [KhuyenMaiController::class, 'delete']);
        Route::get('/edit/{id}', [KhuyenMaiController::class, 'edit']);
        Route::post('/update', [KhuyenMaiController::class, 'update']);
    });

    Route::group(['prefix' => '/ty-le'], function () {
        Route::get('/index', [ChiTietKhuyenMaiController::class, 'indexTyLe']);
        Route::post('/index', [ChiTietKhuyenMaiController::class, 'create']);
        Route::get('/dataTyLe', [ChiTietKhuyenMaiController::class, 'show']);
        Route::get('/delete/{id}', [ChiTietKhuyenMaiController::class, 'destroy']);
        Route::get('/edit/{id}', [ChiTietKhuyenMaiController::class, 'edit']);
        Route::get('/status/{id}', [ChiTietKhuyenMaiController::class, 'status']);
        Route::post('/update', [ChiTietKhuyenMaiController::class, 'update']);
    });

    //DOANH THU
    Route::group(['prefix' => '/doanh-thu-store'], function () {
        Route::get('/index', [DoanhThuStore::class, 'index']);
        Route::post('/index', [DoanhThuStore::class, 'testing'])->name('testing');
        Route::post('/filter', [DoanhThuStore::class, 'filter'])->name('store.doanh_thu.filter');
        Route::post('/dashboard-filter', [DoanhThuStore::class, 'dashboard_filter'])->name('dashboard_filter');
    });

    Route::group(['prefix' => '/yeu-cau'], function () {
        Route::get('/index', [YeuCauDMStoreController::class, 'index']);
        Route::post('/index', [YeuCauDMStoreController::class, 'create']);
        Route::get('/data', [YeuCauDMStoreController::class, 'data']);
    });
    Route::group(['prefix' => '/don-hang'], function () {
        Route::get('/cho-xac-nhan', [DonHangStoreController::class, 'indexXacNhan']);
        Route::get('/da-xac-nhan', [DonHangStoreController::class, 'indexDaXacNhan']);
        Route::get('/dang-chuyen', [DonHangStoreController::class, 'indexDangChuyen']);
        Route::get('/da-giao', [DonHangStoreController::class, 'indexDaGiao']);
    });
});
Route::get('/', [HomePageController::class, 'index']);
Route::get('/detail', [HomePageController::class, 'detail']);
Route::group(['prefix' => '/customer', 'middleware' => 'CustomerMiddleWare'], function () {
    Route::get('/don-hang', [HomePageController::class, 'indexDonHang']);
    Route::group(['prefix' => '/cart'], function () {
        Route::get('/index', [HomePageController::class, 'indexCart']);
    });
    Route::group(['prefix' => '/thong-tin'], function () {
        Route::get('/index', [ThongTinCustomerController::class, 'index']);
    });
});

// Route::get('/', function () {
//     return view('customer.page.index');
// });
// Route::get('/index', function () {
//     return view('customer.cart.index');
// });

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
