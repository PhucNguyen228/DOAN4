<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietKhuyenMai extends Model
{
    use HasFactory;
    protected $table = 'chi_tiet_khuyen_mais';
    protected $fillable = [
        'id_san_pham',
        'id_khuyen_mai',
        'ti_le_KM',
        'id_tai_khoan',
    ];
}
