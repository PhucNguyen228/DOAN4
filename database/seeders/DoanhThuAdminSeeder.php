<?php

namespace Database\Seeders;

use App\Models\DoanhThuAdmin;
use Illuminate\Database\Seeder;

class DoanhThuAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create date from table doanh_thu_admin
        DoanhThuAdmin::factory(500)->create();
    }
}
