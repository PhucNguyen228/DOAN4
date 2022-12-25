<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'user';
    protected $fillable = [
        'ten_tai_khoan',
        'muc',
        'email',
        'mat_khau',
        'sdt',
        'dia_chi',
        'trang_thai',
    ];
}
