<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sach extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sach',function (Blueprint $table){
            $table->increments('ma_sach');
            $table->string('ten_sach',100);
            $table->integer('so_luong');
            $table->integer('ma_mon')->unsigned();
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
        Schema::dropIfExists("sach");
    }
}