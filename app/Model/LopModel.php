<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class LopModel extends Model
{
    public $ma_lop;
    public $ma_nganh;
    public $ma_khoa;
    public $ten;
	static function get_lop_theo_nganh_khoa($ma_nganh,$ma_khoa){
		$result = DB::select("SELECT lop_hoc.*,nganh_hoc.ten_nganh,khoa_hoc.ten_khoa from lop_hoc inner join nganh_hoc on lop_hoc.ma_nganh = nganh_hoc.ma_nganh inner join khoa_hoc on lop_hoc.ma_khoa = khoa_hoc.ma_khoa where lop_hoc.ma_nganh = ? and lop_hoc.ma_khoa = ?",[
			$ma_nganh,
			$ma_khoa
		]);
		// dd($result);
		return $result;
	}
    static function get_lop_theo_khoa($ma_khoa){
        $result = DB::select("SELECT lop_hoc.*,khoa_hoc.ten_khoa from lop_hoc inner join khoa_hoc on lop_hoc.ma_khoa = khoa_hoc.ma_khoa where lop_hoc.ma_khoa = ?",[
            $ma_khoa
        ]);
        // dd($result);
        return $result;
    }
    static function get_ma_theo_ten_lop_ten_khoa($ten_lop,$ma_khoa){
        $result = DB::select("SELECT ma_lop from lop_hoc where ten_lop = ? and ma_khoa = ?",[
            $ten_lop,
            $ma_khoa
        ]);
        return $result[0]->ma_lop;
    }
    static function get_lop_theo_nganh($ma_nganh){
        $result = DB::select("SELECT lop_hoc.*,nganh_hoc.ten_nganh from lop_hoc 
            inner join nganh_hoc on lop_hoc.ma_nganh = nganh_hoc.ma_nganh
            where lop_hoc.ma_nganh = ?",[
            $ma_nganh
        ]);
        // dd($result);
        return $result;
    }
    static function get_nganh_theo_lop($ma_lop){
        $result = DB::select('SELECT nganh_hoc.ten_nganh,nganh_hoc.ma_nganh from lop_hoc inner join nganh_hoc on lop_hoc.ma_nganh = nganh_hoc.ma_nganh where ma_lop = ?',[
            $ma_lop
        ]);
        // dd($result);
        return $result;
    }
    public function insert(){
        DB::insert("INSERT into lop_hoc(ten_lop,ma_khoa,ma_nganh) values (?,?,?)",[
        	$this->ten,
            $this->ma_khoa,
            $this->ma_nganh
        ]);
        // dd($result);
    }
    public function get_one(){
        $result = DB::select("SELECT lop_hoc.*,nganh_hoc.ten_nganh,khoa_hoc.ten_khoa from lop_hoc inner join nganh_hoc on lop_hoc.ma_nganh = nganh_hoc.ma_nganh inner join khoa_hoc on lop_hoc.ma_khoa = khoa_hoc.ma_khoa where ma_lop = ?",[
            $this->ma_lop
        ]);
        // dd($result);
        return $result;
    }
    public function get_all(){
        $result = DB::select("SELECT * FROM lop_hoc where ten_lop = ? and ma_nganh = ? and ma_khoa = ?",[
            $this->ten,
            $this->ma_nganh,
            $this->ma_khoa
        ]);
        // dd($result);
        return $result;
    }
    public function update_lop(){
        DB::update('UPDATE lop_hoc set ten_lop = ?, ma_nganh = ?, ma_khoa = ? where ma_lop = ?',[
            $this->ten,
            $this->ma_nganh,
            $this->ma_khoa,
            $this->ma_lop
        ]);
    }
    static function tim_kiem($tim_kiem){
        $arr_lop = DB::select("SELECT lop_hoc.*, nganh_hoc.ten_nganh, khoa_hoc.ten_khoa from lop_hoc
        join nganh_hoc on nganh_hoc.ma_nganh = lop_hoc.ma_nganh
        join khoa_hoc on khoa_hoc.ma_khoa = lop_hoc.ma_khoa
        where ten_lop like '%$tim_kiem%'");
        dd($arr_lop);
        return $arr_lop;
    }
}