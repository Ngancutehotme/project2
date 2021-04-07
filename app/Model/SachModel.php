<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class SachModel extends Model
{
    public $ma_sach;
    public $ma_nganh;
    public $ma_mon;
    public $ten;
    public $so_luong;
    static function get_sach_theo_mon($ma_mon){
        $result = DB::select("SELECT sach.*,mon_hoc.ten_mon from sach 
            inner join mon_hoc on sach.ma_mon = mon_hoc.ma_mon
            where sach.ma_mon = ?",[
            $ma_mon
        ]);
        // dd($result);
        return $result;
    }
    public function insert(){
        DB::insert("INSERT into sach(ten_sach,so_luong,ma_mon) values (?,?,?)",[
        	$this->ten,
            $this->so_luong,
            $this->ma_mon
        ]);
        // dd($result);
    }
    public function get_one(){
        $result = DB::select("SELECT sach.*,mon_hoc.ten_mon from sach inner join mon_hoc on sach.ma_mon = mon_hoc.ma_mon where ma_sach = ?",[
            $this->ma_sach
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
    public function update_sach(){
        DB::update('UPDATE sach set ten_sach = ?, ma_mon = ?, so_luong = ? where ma_sach = ?',[
            $this->ten,
            $this->ma_mon,
            $this->so_luong,
            $this->ma_sach
        ]);
    }
    static function get_so_luong($ma_sach){
        $result = DB::select("SELECT sach.so_luong as sl_tong, COUNT(chi_tiet.ma_sach) as sl_da_phat, (sach.so_luong-COUNT(chi_tiet.ma_sach)) as sl_con  FROM `chi_tiet`
            RIGHT JOIN sach on chi_tiet.ma_sach = sach.ma_sach
            WHERE sach.ma_sach = ?",[
            $ma_sach
        ]);
        // dd($result);
        return $result;
    }
}