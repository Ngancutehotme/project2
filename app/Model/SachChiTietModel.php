<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class SachChiTietModel extends Model
{
    public $ma_sach;
    public $ma_gv;
    public $ma_sv;
    public $ngay_phat;
    function insert(){
    	$arr = DB::insert("INSERT INTO chi_tiet VALUES (?,?,?,?)",[
    		$this->ma_sv,
    		$this->ma_gv,
    		$this->ma_sach,
    		$this->ngay_phat
    	]);
        return $arr; 
    }
    function check_da_phat(){
        $array = DB::select("SELECT * from chi_tiet where ma_sv = ? and ma_sach = ?",[
            $this->ma_sv,
            $this->ma_sach,
        ]);
        return $array;
    }
    function delete(){
        DB::delete("DELETE from chi_tiet where ma_sv = ? and ma_sach = ?",[
            $this->ma_sv,
            $this->ma_sach,
        ]);
    
    }
    function get_sl(){
        $result = DB::select("SELECT COUNT(ma_sach) as sl FROM `chi_tiet` WHERE ma_sach = ?",[
            $this->ma_sach,
        ]);
        return $result;
    }
    function get_sl_nhap(){
        $result = DB::select("SELECT so_luong FROM `sach` WHERE ma_sach = ?",[
            $this->ma_sach,
        ]);
        return $result;
    }
    static function get_all($ma_sach){
        $result = DB::select("SELECT * from chi_tiet where ma_sach = ?",[
            $ma_sach,
        ]);
        return $result;
    }
    static function get_sinh_vien_theo_lop($ma_lop,$ma_sach){
        $result = DB::select("SELECT 
            sinh_vien.*,
            lop_hoc.ten_lop,
            ifnull(chi_tiet.ma_sach=?,0) as tinh_trang
            from sinh_vien 
            inner join lop_hoc on sinh_vien.ma_lop = lop_hoc.ma_lop 
            left join chi_tiet on sinh_vien.ma_sv = chi_tiet.ma_sv 
            where 
            sinh_vien.ma_lop = ?
            ",[
            $ma_sach,
            $ma_lop,
        ]);
        // dd($result);
        return $result;
    }
    static function get_sinh_vien_theo_lop_va_sach($ma_lop,$ma_sach){
        $result = DB::select("SELECT 
            sinh_vien.*,
            lop_hoc.ten_lop,
            ifnull((select 1 from chi_tiet 
            where chi_tiet.ma_sv = sinh_vien.ma_sv and chi_tiet.ma_sach = ?),0) as tinh_trang
            from sinh_vien 
            inner join lop_hoc on sinh_vien.ma_lop = lop_hoc.ma_lop 
            where 
            sinh_vien.ma_lop = ?
            ",[
            $ma_sach,
            $ma_lop,
        ]);
        // dd($result);
        return $result;
    }
    static function get_sach_chi_tiet_theo_sinh_vien($ma_sv,$ma_sach){
        $result = DB::select("SELECT chi_tiet.ngay_phat, giao_vu.ten_gv, sach.ten_sach, mon_hoc.ten_mon,
            if(chi_tiet.ma_sach = sach.ma_sach,1,0) as tinh_trang
            from chi_tiet
            inner join giao_vu on chi_tiet.ma_gv = giao_vu.ma_gv
            inner join sach on chi_tiet.ma_sach = sach.ma_sach
            inner join mon_hoc on sach.ma_mon = mon_hoc.ma_mon
            where
            chi_tiet.ma_sv = ?
            and sach.ma_sach = ?",[
                $ma_sv,
                $ma_sach
            ]);
        // dd($result);
        return $result;
    }
}
