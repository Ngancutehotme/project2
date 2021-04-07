<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class SinhVienModel extends Model
{
    public $ma_lop;
    public $ma_sinh_vien;
    public $ten;
    public $ngay_sinh;
    public $gioi_tinh;
    public $email;
    public $mat_khau;
    public $SDT;
    public $ten_anh;
    public $dia_chi;
    public function get_one(){
        $arr = DB::select('SELECT * from sinh_vien where email = ?',[
            $this->email
        ]);
        // dd($arr);
        return $arr;
    }
    public function get_user(){
        $arr = DB::select('SELECT * from sinh_vien where ma_sv = ?',[
            $this->ma_sinh_vien
        ]);
        // dd($arr);
        return $arr;
    }
	static function get_sinh_vien_theo_lop($ma_lop){
		$result = DB::select("SELECT sinh_vien.*,lop_hoc.ten_lop from sinh_vien inner join lop_hoc on sinh_vien.ma_lop = lop_hoc.ma_lop where sinh_vien.ma_lop = ?",[
			$ma_lop
		]);
		// dd("SELECT sinh_vien.*,lop_hoc.ten_lop from sinh_vien inner join lop_hoc on sinh_vien.ma_lop = lop_hoc.ma_lop where sinh_vien.ma_lop = $ma_lop");
		return $result;
	}
    public function process_insert(){
        DB::insert("INSERT into sinh_vien(ten_sv,ngay_sinh,gioi_tinh,email,mat_khau,SDT,anh,dia_chi,ma_lop) values (?,?,?,?,?,?,?,?,?)",[
        	$this->ten,
            $this->ngay_sinh,
            $this->gioi_tinh,
            $this->email,
            $this->mat_khau,
            $this->SDT,
            $this->anh,
            $this->dia_chi,
            $this->ma_lop
        ]);
        // dd($result);
    }
    public function get_one_sv(){
        $result = DB::select('SELECT * from sinh_vien where ma_sv = ?',[
            $this->ma_sinh_vien
        ]);
        // dd($arr);
        return $result;
    }
    static function get_nganh_khoa_theo_lop($ma_lop){
        $result = DB::select('SELECT * from lop_hoc where ma_lop = ?',[
            $ma_lop
        ]);
        // dd($arr);
        return $result;
    }
    static function get_so_luong_theo_lop($ma_lop){
        $result = DB::select('SELECT count(*) as so_luong from sinh_vien where ma_lop = ?',[
            $ma_lop
        ]);
        // dd($arr);
        return $result;
    }
    static function get_lop_theo_sinh_vien($ma_sv){
        $result = DB::select('SELECT sinh_vien.ma_lop,lop_hoc.ten_lop from sinh_vien
        inner join lop_hoc on sinh_vien.ma_lop = lop_hoc.ma_lop where ma_sv = ?',[
            $ma_sv
        ]);
        // dd($result);
        return $result;
    }
    public function process_edit_profile(){
        DB::update('UPDATE sinh_vien 
            set
            ten_sv    = ?,
            ngay_sinh = ?,
            email     = ?,
            gioi_tinh = ?,
            SDT       = ?,
            anh       = ?,
            dia_chi   = ?
            where ma_sv  = ?
            ',[
            $this->ten,
            $this->ngay_sinh,
            $this->email,
            $this->gioi_tinh,
            $this->SDT,
            $this->ten_anh,
            $this->dia_chi,
            $this->ma_sinh_vien
        ]);
        // dd($result);
    }
    public function process_update_sv(){
        DB::update('UPDATE sinh_vien 
            set
            ten_sv    = ?,
            ngay_sinh = ?,
            email     = ?,
            gioi_tinh = ?,
            SDT       = ?,
            anh       = ?,
            dia_chi   = ?,
            ma_lop    = ?
            where ma_sv  = ?
            ',[
            $this->ten,
            $this->ngay_sinh,
            $this->email,
            $this->gioi_tinh,
            $this->SDT,
            $this->ten_anh,
            $this->dia_chi,
            $this->ma_lop,
            $this->ma_sinh_vien
        ]);
        // dd($result);
    }
    static function tinh_trang_phat_sach_sinh_vien(){
        $result = DB::select('SELECT chi_tiet.*,sinh_vien.ten_sv,lop_hoc.ten_lop from chi_tiet where ma_lop = ?',[
            $ma_lop
        ]);
        // dd($arr);
        return $result;
    }
    public function process_update_password(){
       $result = DB::update('UPDATE sinh_vien 
            set
            mat_khau    = ?
            where ma_sv  = ?
            ',[
            $this->mat_khau,
            $this->ma_sinh_vien
        ]);
       // dd($result);
    }
}