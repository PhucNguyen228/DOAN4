<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaiKhoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tai_khoans', function (Blueprint $table) {
            $table->id();
            $table->string('ten_tai_khoan');
            $table->integer('muc');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('sdt');
            $table->string('dia_chi');
            $table->string('ten_cua_hang')->nullable();
            $table->integer('is_email')->default(0);
            $table->boolean('trang_thai')->default(1);
            $table->string('hash');
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
        Schema::dropIfExists('tai_khoans');
    }
}
