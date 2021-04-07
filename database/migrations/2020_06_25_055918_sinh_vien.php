<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SinhVien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinh_vien',function (Blueprint $table){
            $table->increments('ma_sv');
            $table->string('ten_sv',100);
            $table->date('ngay_sinh');
            $table->boolean('gioi_tinh');
            $table->string('email',100)->unique();
            $table->string('mat_khau',200);
            $table->string('SDT',10);
            $table->string('anh',200);
            $table->text('dia_chi');
            $table->integer('ma_lop')->unsigned();
            $table->foreign('ma_lop')->references('ma_lop')
            ->on('lop_hoc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("sinh_vien");
    }
}
