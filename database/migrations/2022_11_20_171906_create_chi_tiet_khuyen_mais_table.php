<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChiTietKhuyenMaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi_tiet_khuyen_mais', function (Blueprint $table) {
            $table->id();
            $table->integer('id_san_pham');
            $table->integer('id_khuyen_mai');
            $table->integer('ti_le_KM');
            $table->integer('id_tai_khoan');
            $table->boolean('trang_thai')->default(1);
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
        Schema::dropIfExists('chi_tiet_khuyen_mais');
    }
}
