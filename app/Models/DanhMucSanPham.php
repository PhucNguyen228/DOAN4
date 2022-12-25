<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMucSanPham extends Model
{
    use HasFactory;
    protected $table = 'danh_muc_san_phams';
    protected $fillable = [
        'ten_danh_muc',
        'slug_danh_muc',
        'trang_thai',
        'id_tai_khoan',
        'yeu_cau',
    ];
}
