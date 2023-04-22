<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tai_khoans')->delete();

        DB::table('tai_khoans')->truncate();

        DB::table('tai_khoans')->insert([
            [
                'ten_tai_khoan'     => 'Trần Kim Thật',
                'muc'               => 0,
                'email'             => 'thattran2603@gmail.com',
                'password'          => bcrypt('123456789'),
                'sdt'               => 917513293,
                'dia_chi'           => 'đà nẵng',
                'ten_cua_hang'      => '',
                'is_email'          => 1,
                'hash'              => '',
                'trang_thai'        => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'ten_tai_khoan'     => 'Nguyễn Phúc',
                'muc'               => 0,
                'email'             => 'phuc@gmail.com',
                'password'          => bcrypt('123456789'),
                'sdt'               => 917513293,
                'dia_chi'           => 'đà nẵng',
                'ten_cua_hang'      => '',
                'is_email'          => 1,
                'hash'              => '',
                'trang_thai'        => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ]);
    }
}
