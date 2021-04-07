<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LopHoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lop_hoc',function (Blueprint $table){
            $table->increments('ma_lop');
            $table->string('ten_lop',100);
            $table->integer('ma_khoa')->unsigned();
            $table->integer('ma_nganh')->unsigned();
            $table->foreign('ma_khoa')->references('ma_khoa')
            ->on('khoa_hoc');
            $table->foreign('ma_nganh')->references('ma_nganh')
            ->on('nganh_hoc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("lop_hoc");
    }
}