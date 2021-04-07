<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class MonModel extends Model
{
    public $ma_mon;
    public $ma_nganh;
    public $ten;
    static function get_mon_theo_nganh($ma_nganh){
        // DB::connection()->enableQueryLog();
        // dd($ma_nganh);
        $result = DB::select("SELECT mon_hoc.*,nganh_hoc.ten_nganh, sach.ten_sach, sach.ma_sach from mon_hoc left join nganh_chi_tiet on mon_hoc.ma_mon = nganh_chi_tiet.ma_mon inner join nganh_hoc on nganh_chi_tiet.ma_nganh = nganh_hoc.ma_nganh left join sach on mon_hoc.ma_mon = sach.ma_mon where nganh_hoc.ma_nganh = ?
            GROUP BY (mon_hoc.ma_mon)",[
            $ma_nganh
        ]);
        // dd(DB::getQueryLog());
        // dd($result);
        return $result;
    }
    static function get_nganh_theo_mon($ma_mon){
        $result = DB::select("SELECT nganh_chi_tiet.ma_nganh from nganh_chi_tiet
            where ma_mon = ?",[
            $ma_mon
        ]);
        // dd($result);
        return $result;
    }
    public function insert_mon(){
        DB::insert("INSERT into mon_hoc(ten_mon) values (?)",[
        	$this->ten
        ]);
        // dd($result);
    }
    public function select_ma_mon(){
        $result = DB::select("SELECT MAX(ma_mon) AS ma_mon FROM mon_hoc");
        return $result;
    }
    static function insert_mon_nganh_chi_tiet($ma_nganh,$ma_mon){
        DB::insert("INSERT into nganh_chi_tiet(ma_nganh,ma_mon) values (?,?)",[
            $ma_nganh,
            $ma_mon
        ]);
        // dd($result);
    }
    public function get_one(){
        $result = DB::select("SELECT mon_hoc.*,nganh_chi_tiet.ma_nganh from mon_hoc inner join nganh_chi_tiet on mon_hoc.ma_mon = nganh_chi_tiet.ma_mon where mon_hoc.ma_mon = ?",[
            $this->ma_mon
        ]);
        // dd($result);
        return $result;
    }
    public function update_mon(){
        DB::update('UPDATE mon_hoc set ten_mon = ? where ma_mon = ?',[
            $this->ten,
            $this->ma_mon
        ]);
    }
    public function update_mon_nganh_chi_tiet(){
        DB::update('UPDATE nganh_chi_tiet set ma_nganh = ? where ma_mon = ?',[
            $this->ma_nganh,
            $this->ma_mon
        ]);
    }
    static function get_all(){
        $result = DB::select("SELECT * from mon_hoc");
        return $result;
    }
}