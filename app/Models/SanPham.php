<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;
    protected $table = 'san_phams';
    protected $fillable = [
            'ten_san_pham',
            'slug_san_pham',
            'gia_ban',
            'don_vi',
            'id_chi_tiet_KM',
            'anh_dai_dien',
            'id_danh_muc',
            'mo_ta_ngan',
            'mo_ta_dai',
            'is_open',
            'id_tai_khoan',
    ];
}
