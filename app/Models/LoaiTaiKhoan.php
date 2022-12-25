<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiTaiKhoan extends Model
{
    use HasFactory;
    protected $table = 'loai_tai_khoans';
    protected $fillable = [
        'ten_loai',
        'trang_thai',
    ];
}
