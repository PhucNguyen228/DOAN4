<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinhLuanVaDanhGia extends Model
{
    use HasFactory;
    protected $table = 'binh_luan_va_danh_gias';

    protected $fillable = [
        'id_sp',
        'id_khach_hang',
        'noi_dung',
        'muc_do_hai_long',
    ];
}
