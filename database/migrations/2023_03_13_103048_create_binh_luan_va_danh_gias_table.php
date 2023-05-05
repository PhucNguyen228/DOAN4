<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBinhLuanVaDanhGiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binh_luan_va_danh_gias', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_sp')->unsigned();
            $table->bigInteger('id_khach_hang');
            $table->text('noi_dung')->nullable();
            $table->integer('muc_do_hai_long')->nullable();
            $table->timestamps();
            // lập khoá chính và khoá ngoại
            $table->foreign('id_sp')->references('id')->on('san_phams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('binh_luan_va_danh_gias');
    }
}
