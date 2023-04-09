<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuanLyThueAdmin extends Model
{
    protected $table = 'quan_ly_thue_admins';
    protected $fillable = [
        'Ten_thue',
        'Muc_thue',
        'Trang_thai',
        'created_at',
        'updated_at',
    ];
}
