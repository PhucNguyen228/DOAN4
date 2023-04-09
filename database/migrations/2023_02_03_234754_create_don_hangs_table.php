<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonHangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('don_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('ho_ten');
            $table->integer('so_dien_thoai');
            $table->string('dia_chi');
            $table->string('ma_don_hang');
            $table->double('tong_tien', 18, 0);
            $table->double('tien_giam_gia', 18, 0);
            $table->double('tien_tra', 18, 0);
            // $table->integer('id_san_pham');
            $table->integer('id_customer');
            $table->integer('tinh_trang')->default(0);
            $table->date('ngay_hoa_don');
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
        Schema::dropIfExists('don_hangs');
    }
}
