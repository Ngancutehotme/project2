<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChiTiet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi_tiet',function (Blueprint $table){
            $table->integer('ma_sv')->unsigned();
            $table->integer('ma_gv')->unsigned();
            $table->integer('ma_sach')->unsigned();
            $table->date('ngay_phat');
            $table->primary(['ma_sv','ma_sach']);
            $table->foreign('ma_sv')->references('ma_sv')
            ->on('sinh_vien');
            $table->foreign('ma_sach')->references('ma_sach')
            ->on('sach');
            $table->foreign('ma_gv')->references('ma_gv')
            ->on('giao_vu');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists("chi_tiet");
    }
}