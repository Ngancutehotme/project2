<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class NganhModel extends Model
{
    public $ma;
    public $ten;
    static function get_all(){
    	$arr = DB::select('SELECT * from nganh_hoc');
    	// dd($arr);
    	return $arr;
    }
    public function get_one(){
    	$result = DB::select('SELECT * from nganh_hoc where ma_nganh = ?',[$this->ma]);
    	// dd($arr);
    	return $result;
    }
    public function get_nganh_theo_ten(){
        $result = DB::select("SELECT * from nganh_hoc where ten_nganh = ?",
            [$this->ten]);
        return $result;
    }
    public function insert(){
         DB::insert("INSERT into nganh_hoc(ten_nganh) values (?)",
            [$this->ten]);
        // dd($result);
    }
    public function update_nganh(){
        DB::update("UPDATE nganh_hoc SET ten_nganh= ? WHERE ma_nganh = ?",[$this->ten, $this->ma]);
    	// dd($sql);
    }
}