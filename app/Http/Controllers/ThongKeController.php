<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ThongKeModel;
use App\Model\NganhModel;
use App\Model\KhoaModel;
use App\Model\SachModel;
use App\Model\SinhVienModel;

class ThongKeController extends Controller
{
	function view_thong_ke(){
		// $arr_thang =[
		// 	"1" => "January",
		// 	"2" => "February",
		// 	"3" => "March",
		// 	"4" => "April",
		// 	"5" => "May",
		// 	"6" => "June",
		// 	"7" => "July",
		// 	"8" => "August",
		// 	"9" => "September",
		// 	"10" => "October",
		// 	"11" => "November",
		// 	"12" => "December",
		// ];
		$array_nganh = NganhModel::get_all();
		$array_khoa = KhoaModel::get_all();
		return view('thong_ke/view_thong_ke',compact('array_khoa','array_nganh'));
	}
	function get_array_sach_theo_mon(Request $rq){
		$ma_mon           = $rq->ma_mon;

		$array_sach = SachModel::get_sach_theo_mon($ma_mon);
		// dd($array_sach);
		return $array_sach;
	}
	function get_so_luong(Request $rq){
		$ma_nganh = $rq->ma_nganh;
		$ma_khoa  = $rq->ma_khoa;
		$result   = ThongKeModel::get_sach_chua_nhan($ma_nganh,$ma_khoa);

		$array = [];
		foreach ($result as $each) {
			$ma_lop = $each->ma_lop;
			if(empty($array[$ma_lop])){
				$array[$ma_lop]['ten_lop'] = $each->ten_lop;

				$array[$ma_lop]['tong_so_chua_nhan'] = 0;
			}
			$ma_sach = $each->ma_sach;
			$array[$ma_lop]['tung_sach'][$ma_sach]['ten_sach']           = $each->ten_sach . "(". $ma_sach . ")";
			$array[$ma_lop]['tung_sach'][$ma_sach]['so_luong_chua_nhan']   = $each->so_luong_chua_nhan;

			$array[$ma_lop]['tong_so_chua_nhan'] += $each->so_luong_chua_nhan;
		}
		$array_ten_lop = array_pluck($array,'ten_lop');
		return $array;
	}
}
