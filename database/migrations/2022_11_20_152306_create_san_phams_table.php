<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSanPhamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id();
            $table->string('ten_san_pham');
            $table->string('slug_san_pham');
            $table->integer('gia_ban');
            $table->string('don_vi');
            $table->string('anh_dai_dien');
            $table->integer('id_danh_muc');
            $table->string('mo_ta_ngan');
            $table->string('mo_ta_dai');
            $table->boolean('is_open')->default(1);
            $table->integer('id_tai_khoan');
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
        Schema::dropIfExists('san_phams');
    }
}
