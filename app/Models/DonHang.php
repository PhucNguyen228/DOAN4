<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;
    protected $table = 'don_hangs';
    protected $fillable = [
        'ma_don_hang',
        'ho_ten',
        'so_dien_thoai',
        'dia_chi',
        'tong_tien',
        'tien_giam_gia',
        'tien_tra',
        // 'id_san_pham',
        'id_customer',
        'tinh_trang',
        'ngay_hoa_don',
    ];
}
