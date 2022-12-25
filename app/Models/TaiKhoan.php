<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class TaiKhoan extends Authenticatable
{
    use HasFactory;
    protected $table = 'tai_khoans';
    protected $fillable = [
        'ten_tai_khoan',
        'muc',
        'email',
        'password',
        'sdt',
        'dia_chi',
        'trang_thai',
    ];
}
