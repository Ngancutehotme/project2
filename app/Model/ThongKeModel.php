<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class ThongKeModel extends Model
{
	static function get_sach_chua_nhan($ma_nganh,$ma_khoa){
		$result = DB::select("
		SELECT
            `lop_hoc`.`ma_lop`
            , `sach`.`ma_sach`
            , `lop_hoc`.`ten_lop`
            , `sach`.`ten_sach`
            ,(
            SELECT COUNT(*) FROM sinh_vien
            WHERE sinh_vien.`ma_lop` = lop_hoc.`ma_lop`
            AND sinh_vien.`ma_sv` NOT IN (SELECT ma_sv FROM chi_tiet WHERE chi_tiet.`ma_sach` = sach.`ma_sach`)
            ) AS so_luong_chua_nhan
        FROM
            `doan2`.`lop_hoc`
            JOIN `doan2`.`nganh_chi_tiet` 
                ON (`lop_hoc`.`ma_nganh` = `nganh_chi_tiet`.`ma_nganh`)
            JOIN `doan2`.`sach` 
                ON (`nganh_chi_tiet`.`ma_mon` = `sach`.`ma_mon`)
            WHERE 
            lop_hoc.ma_nganh = ?
            AND lop_hoc.`ma_khoa` = ?
        GROUP BY `lop_hoc`.`ma_lop`, `sach`.`ma_sach`
        ORDER BY `lop_hoc`.`ma_lop`, `sach`.`ma_sach`",[
				$ma_nganh,
				$ma_khoa,
		]);
        // dd($result);
		return $result;
	}	
}
