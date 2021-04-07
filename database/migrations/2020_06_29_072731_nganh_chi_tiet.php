<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NganhChiTiet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nganh_chi_tiet',function (Blueprint $table){
            $table->integer('ma_nganh')->unsigned();
            $table->integer('ma_mon')->unsigned();
            $table->primary(['ma_nganh','ma_mon']);
            $table->foreign('ma_nganh')->references('ma_nganh')
            ->on('nganh_hoc');
            $table->foreign('ma_mon')->references('ma_mon')
            ->on('mon_hoc');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists("nganh_chi_tiet");
    }
}