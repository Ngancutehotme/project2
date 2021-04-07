<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GiaoVu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giao_vu', function(Blueprint $table){
            $table->increments('ma_gv');
            $table->string('ten_gv',100);
            $table->date('ngay_sinh');
            $table->boolean('gioi_tinh');
            $table->string('email',100)->unique();
            $table->string('mat_khau',200);
            $table->string('SDT',10);
            $table->string('anh',200);
            $table->text('dia_chi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("giao_vu");
    }
}
