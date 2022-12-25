<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoaiTaiKhoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('loai_tai_khoans')->delete();

        DB::table('loai_tai_khoans')->truncate();

        DB::table('loai_tai_khoans')->insert([
            [
                'ma_loai'      => '1',
                'ten_loai'     => 'khach hang',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],

            [
                'ma_loai'      => '2',
                'ten_loai'     => 'chu cua hang',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ]);
    }
}
