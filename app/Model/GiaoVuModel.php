<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class GiaoVuModel extends Model
{
    public $ma;
    public $ten;
    public $ngay_sinh;
    public $email;
    public $mat_khau;
    public $sdt;
    public $ten_anh;
    public $gioi_tinh;
    public $dia_chi;
    public function get_one(){
    	$arr = DB::select('SELECT * from giao_vu where email = ?',[
    		$this->email
    	]);
    	// dd($arr);
    	return $arr;
    }
    static function get_user($ma){
        $arr = DB::select('SELECT * from giao_vu where ma_gv = ?',[
            $ma
        ]);
        // dd($arr);
        return $arr;
    }
    static function get_all(){
    	$arr = DB::select('SELECT ma_gv,ten_gv,ROUND(DATEDIFF(CURDATE(), ngay_sinh) / 365, 0) AS tuoi,email,gioi_tinh,SDT,dia_chi from giao_vu');
    	// dd($arr);
    	return $arr;
    }
    public function get_one_gv(){
        $result = DB::select('SELECT * from giao_vu where ma_gv = ?',[
            $this->ma
        ]);
        // dd($arr);
        return $result;
    }
    public function process_edit_profile(){
        DB::update('UPDATE giao_vu 
            set
            ten_gv    = ?,
            ngay_sinh = ?,
            email     = ?,
            gioi_tinh = ?,
            SDT       = ?,
            anh       = ?,
            dia_chi   = ?
            where ma_gv  = ?
            ',[
            $this->ten,
            $this->ngay_sinh,
            $this->email,
            $this->gioi_tinh,
            $this->SDT,
            $this->ten_anh,
            $this->dia_chi,
            $this->ma
        ]);
        // dd($result);
    }
    public function process_update_password(){
        DB::update('UPDATE giao_vu 
            set
            mat_khau    = ?
            where ma_gv  = ?
            ',[
            $this->mat_khau,
            $this->ma
        ]);
        // dd($result);
    }
}