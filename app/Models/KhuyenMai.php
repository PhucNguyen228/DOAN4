<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhuyenMai extends Model
{
    use HasFactory;
    protected $table = 'khuyen_mais';
    protected $fillable = [
        'ten_dot_KM',
        'ngay_bd',
        'ngay_kt',
        'trang_thai',
        'id_tai_khoan',
    ];
}
