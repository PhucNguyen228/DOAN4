<?php

namespace Database\Seeders;

use App\Models\DoanhThuStore;
use Illuminate\Database\Seeder;

class DoanhThuStoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DoanhThuStore::factory(1000)->create();
    }
}
