<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestYeuCauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('danh_muc_san_phams')->delete();

        DB::table('danh_muc_san_phams')->truncate();

        DB::table('danh_muc_san_phams')->insert([
            [
                'ten_danh_muc'     => 'cá',
                'slug_danh_muc'    => 'ca',
                'trang_thai'       => 1,
                'id_tai_khoan'     => 1,
                'yeu_cau'          => 0,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'ten_danh_muc'     => 'thịt',
                'slug_danh_muc'    => 'thit',
                'trang_thai'       => 1,
                'id_tai_khoan'     => 1,
                'yeu_cau'          => 0,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ]);
    }
}
