<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class KhoaModel extends Model
{
    public $ma;
    public $ten;
    static function get_all(){
    	$arr = DB::select('SELECT * from khoa_hoc');
    	// dd($arr);
    	return $arr;
    }
    public function get_one(){
    	$result = DB::select('SELECT * from khoa_hoc where ma_khoa = ?',[$this->ma]);
    	// dd($arr);
    	return $result;
    }
    public function insert(){
        DB::insert("INSERT into khoa_hoc(ten_khoa) values (?)",
            [$this->ten]);
        // dd($result);
    }
    public function update_khoa(){
        DB::update("UPDATE khoa_hoc SET ten_khoa= ? WHERE ma_khoa = ?",[$this->ten, $this->ma]);
    	// dd($sql);
    }
    public function get_khoa_theo_ten(){
        $result = DB::select("SELECT * from khoa_hoc where ten_khoa = ?",[
            $this->ten
        ]);
        return $result;
    }
    static function get_ma_theo_ten($ten_khoa){
        $result = DB::select("SELECT ma_khoa from khoa_hoc where ten_khoa = ?",[
            $ten_khoa
        ]);
        return $result[0]->ma_khoa;
    }
}