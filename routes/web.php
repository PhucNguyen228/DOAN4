<?php

use App\Http\Controllers\BinhLuanVaDanhGiaController;
use App\Http\Controllers\ChiTietDonHangController;
use App\Http\Controllers\ChiTietKhuyenMaiController;
use App\Http\Controllers\ChiTietSanPhamController;
use App\Http\Controllers\DanhMucSanPhamController;
use App\Http\Controllers\DoanhThuAdminController;
use App\Http\Controllers\DoanhThuStoreController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\DonHangStoreController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\KhuyenMaiController;
use App\Http\Controllers\QuanLyThueAdminController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\SanPhamSellController;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\ThongKeAdminController;
use App\Http\Controllers\ThongTinController;
use App\Http\Controllers\ThongTinCustomerController;
use App\Http\Controllers\YeuCauDanhMucController;
use App\Http\Controllers\YeuCauDMStoreController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [TaiKhoanController::class, 'indexlogin'])->name('login');
Route::post('/login', [TaiKhoanController::class, 'loginAction']);
Route::get('/register', [TaiKhoanController::class, 'register']);
Route::post('/register', [TaiKhoanController::class, 'registerAction']);
Route::get('/logout', [TaiKhoanController::class, 'Logout']);

Route::get('/forgot', [TaiKhoanController::class, 'forgot']);
Route::post('/forgot-password', [TaiKhoanController::class, 'forgotPassword']);
Route::get('/reset-password/{hash}', [TaiKhoanController::class, 'resetPassword']);
Route::post('/update-password', [TaiKhoanController::class, 'updatePassword']);


Route::get('/admin/login', [TaiKhoanController::class, 'indexAdmin']);
Route::post('/admin/login', [TaiKhoanController::class, 'LoginAdmin']);

Route::get('/login-google', [GoogleController::class, 'login_google']);
Route::get('/google/callback', [GoogleController::class, 'callback_google']);


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

    // THUE
    Route::group(['prefix' => '/thue'], function () {
        Route::get('/index', [QuanLyThueAdminController::class, 'index']);
        Route::post('/index', [QuanLyThueAdminController::class, 'create'])->name('admin.thue.create');
        Route::get('/data', [QuanLyThueAdminController::class, 'getData'])->name('admin.thue.data');
        Route::get('/status/{id}', [QuanLyThueAdminController::class, 'status']);
        Route::get('/delete/{id}', [QuanLyThueAdminController::class, 'delete']);
        Route::get('/edit/{id}', [QuanLyThueAdminController::class, 'edit']);
        Route::post('/update', [QuanLyThueAdminController::class, 'update']);
    });

    //DOANH THU
    Route::group(['prefix' => '/doanh-thu-admin'], function () {
        Route::get('/index', [DoanhThuAdminController::class, 'index']);
        Route::post('/index', [DoanhThuAdminController::class, 'testing'])->name('testing');
        Route::post('/filter', [DoanhThuAdminController::class, 'filter'])->name('admin.doanh_thu.filter');
        Route::post('/dashboard-filter', [DoanhThuAdminController::class, 'dashboard_filter'])->name('dashboard_filter');
    });

    // THONG KE
    Route::group(['prefix' => '/thong-ke-admin'], function () {
        Route::get('/index', [ThongKeAdminController::class, 'index']);
        Route::post('/filter', [ThongKeAdminController::class, 'filter'])->name('admin.thong_ke.filter');
        // Route::post('/dashboard-filter', [DoanhThuAdminController::class, 'dashboard_filter'])->name('dashboard__filter');
    });

    Route::group(['prefix' => '/yeu-cau-danh-muc'], function () {
        Route::get('/index', [YeuCauDanhMucController::class, 'index']);
        Route::get('/data', [YeuCauDanhMucController::class, 'view']);
        Route::get('/submit/{id}', [YeuCauDanhMucController::class, 'submit']);
        Route::get('/delete/{id}', [YeuCauDanhMucController::class, 'delete']);
    });
});

Route::group(['prefix' => '/store', 'middleware' => 'StoreMiddleware'], function () {

    // testing ............. nop_thue
    Route::get('/index', [SanPhamController::class, 'index']);
    Route::post('/index', [SanPhamController::class, 'create'])->name('nop_tien');
    Route::post('/vnpay_payment', [SanPhamController::class, 'vnpay_payment']);

    Route::group(['prefix' => '/thong-tin'], function () {
        Route::get('/index', [ThongTinController::class, 'index']);
        // Route::get('/data',[ThongTinController::class,'data']);
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
        Route::get('/index', [DoanhThuStoreController::class, 'index']);
        Route::post('/index', [DoanhThuStoreController::class, 'testing'])->name('testing1');
        Route::post('/filter', [DoanhThuStoreController::class, 'filter'])->name('store.doanh_thu.filter');
        Route::post('/dashboard-filter', [DoanhThuStoreController::class, 'dashboard_filter'])->name('dashboard_filter_store');
    });

    // THONG KE
    // Route::group(['prefix' => '/thong-ke-admin'], function () {
    //     Route::get('/index', [::class, 'index']);
    //     Route::post('/filter', [::class, 'filter'])->name('store.thong_ke.filter');
    //     // Route::post('/dashboard-filter', [DoanhThuAdminController::class, 'dashboard_filter'])->name('dashboard__filter');
    // });

    Route::group(['prefix' => '/yeu-cau'], function () {
        Route::get('/index', [YeuCauDMStoreController::class, 'index']);
        Route::post('/index', [YeuCauDMStoreController::class, 'create']);
        Route::get('/data', [YeuCauDMStoreController::class, 'data']);
    });
    Route::group(['prefix' => '/don-hang'], function () {
        Route::get('/cho-xac-nhan', [DonHangStoreController::class, 'indexXacNhan']);
        Route::get('/cho-xac-nhan/data', [DonHangStoreController::class, 'dataXacNhan']);
        Route::get('/tinh-trang/{id}', [DonHangStoreController::class, 'tinhTrang']);
        Route::get('/da-xac-nhan', [DonHangStoreController::class, 'indexDaXacNhan']);
        Route::get('/dang-chuyen', [DonHangStoreController::class, 'indexDangChuyen']);
        Route::get('/da-giao', [DonHangStoreController::class, 'indexDaGiao']);
    });
});
Route::get('/', [HomePageController::class, 'index']);
// Route::get('/data', [HomePageController::class, 'data']);
Route::get('/chi-tiet/{id}', [ChiTietSanPhamController::class, 'ChiTietSP']);
Route::get('/san-pham-sell', [SanPhamSellController::class, 'dataSell']);
Route::get('/san-pham/{id}', [HomePageController::class, 'dataSP']);
Route::post('/tim-kiem', [HomePageController::class, 'search']);
Route::get('/active/{hash}', [TaiKhoanController::class, 'active']);
// phần đánh giá bình luận sản phẩm của khách hàng
Route::post('/danh-gia', [BinhLuanVaDanhGiaController::class, 'create'])->name('tao_danh_gia');
Route::post('/binh-luan', [BinhLuanVaDanhGiaController::class, 'update'])->name('tao_binh_luan');
Route::get('/delete', [BinhLuanVaDanhGiaController::class, 'delete'])->name('xoa_binh_luan');
Route::get('/edit', [BinhLuanVaDanhGiaController::class, 'edit'])->name('sua_binh_luan');



Route::group(['prefix' => '/customer', 'middleware' => 'CustomerMiddleWare'], function () {
    Route::get('/don-hang', [HomePageController::class, 'indexDonHang']);
    Route::get('/don-hang/data', [HomePageController::class, 'dataDonHang']);
    Route::post('/add-to-cart', [HomePageController::class, 'addToCart']);
    Route::post('/create-don-hang', [DonHangController::class, 'store']);
    Route::group(['prefix' => '/cart'], function () {
        Route::get('/index', [ChiTietDonHangController::class, 'indexCart']);
        Route::get('/data', [ChiTietDonHangController::class, 'dataCart']);
        Route::post('/updateqty', [ChiTietDonHangController::class, 'updateqty']);
        Route::get('/remove/{id}', [ChiTietDonHangController::class, 'removeCart']);
    });
    Route::group(['prefix' => '/thong-tin'], function () {
        Route::get('/index', [ThongTinCustomerController::class, 'index']);
        // Route::get('/data',[ThongTinCustomerController::class,'data']);
        Route::post('/update', [ThongTinCustomerController::class, 'update']);
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
