<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoanhThuAdmin extends Model
{
    use HasFactory;
    protected $table = 'doanh_thu_admin';
    protected $fillable = [
        'id_tai_khoan',
        'tong_doanh_thu',
        'Thang_thu_nhap',
    ];
}
