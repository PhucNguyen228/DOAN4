<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoanhThuAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doanh_thu_admins', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tai_khoan');
            $table->integer('tong_doanh_thu');
            $table->date('Thang_thu_nhap');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doanh_thu_admins');
    }
}
