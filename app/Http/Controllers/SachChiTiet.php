<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SachChiTietRequest;
use App\Http\Requests\SachRequest;
use App\Model\SachModel;
use App\Model\SinhVienModel;
use App\Model\SachChiTietModel;
use App\Model\MonModel;
use App\Model\NganhModel;
use App\Model\KhoaModel;

class SachChiTiet extends Controller
{
	function view_insert(){
		$arr_nganh = NganhModel::get_all();
		$arr_khoa  = KhoaModel::get_all();
		$arr_mon   = MonModel::get_all();
	 	return view('sach_chi_tiet/view_insert',compact('arr_nganh','arr_khoa','arr_mon'));
	}
	// function process_phat_sach(SachChiTietRequest $rq){
	// 	$ma_lop      = $rq->lop;
	// 	$array_sv    = SinhVienModel::get_sinh_vien_theo_lop($ma_lop);
		
	// 	$ma_gv       = $rq->session()->get('ma_gv');
	// 	$ngay_phat   = date('Y-m-d');
	// 	$ma_sach     = $rq->sach;
	// 	$array_check = $rq->array_check;
	// 	// dd($array_check);

	// 	foreach ($array_sv as $sinh_vien) {
	// 		$ma_sv = $sinh_vien->ma_sv;

	// 		$phat            = new SachChiTietModel();
	// 		$phat->ma_gv     = $ma_gv;
	// 		$phat->ma_sach   = $ma_sach;
	// 		// $phat->ngay_phat = $ngay_phat;
	// 		$phat->ma_sv     = $ma_sv;
	// 		$arr = $phat->select();

	// 		dd($arr);
	// 		print_r('------------------');
	// 		print_r('<br>');
	// 		// $sl = $phat->get_sl()[0]->sl;
	// 		// $sl_nhap = $phat->get_sl_nhap()[0]->so_luong;
	// 		// $kq = $sl_nhap - $sl;
	// 		// dd($kq);
	// 		// if ($sl > $sl_nhap) {
	// 		// 	echo "ádss";
	// 		// 	// return redirect()->back()->with('error','Số lượng sách k đủ');
	// 		// }
	// 		// if(isset($array_check[$ma_sv])){
	// 		// 	$phat->insert();
	// 		// }
	// 	}die;
	// 	return redirect()->back();
	// }

	function ajax_process_phat_sach(Request $rq){
		// dd($rq->toArray());
		// dd($rq->session()->get('ma_gv'));
		$phat          = new SachChiTietModel();
		$phat->ma_sv   = $rq->ma_sv;
		$phat->ma_sach = $rq->ma_sach;
		if($rq->check){
			if(!empty($phat->check_da_phat())){
				return 1;
			}
			$sl_con = SachModel::get_so_luong($rq->ma_sach)[0]->sl_con;
			if($sl_con>0){
				$phat->ma_gv     = $rq->session()->get('ma_gv');
				$phat->ngay_phat = date('Y-m-d');
				$phat->insert();
			}
			else{
				throw new \Exception("Hết sách rồi");
			}
		}
		else{
			$phat->delete();
		}
		return 1;
	}

	//lấy sinh viên theo lớp là đầu sách xem đã phát sách hay chưa
    function get_chi_tiet_theo_lop_va_sach(Request $rq){
        $ma_lop  = $rq->ma_lop;
        $ma_sach = $rq->ma_sach;

        // ĐÃ từng phát
        $array_sv = SachChiTietModel::get_sinh_vien_theo_lop_va_sach($ma_lop,$ma_sach);

        $array = [];
        foreach ($array_sv as $index => $each) {
			$ma_sv      = $each->ma_sv;
			$ten_sv     = $each->ten_sv;
			$SDT        = $each->SDT;
			$tinh_trang = $each->tinh_trang;
            if($each->gioi_tinh == 1){
                $gioi_tinh = 'Male';
            }
            else{
                $gioi_tinh = 'Female';
            }
            $dia_chi   = $each->dia_chi;
            $ten_lop   = $each->ten_lop;

            if($tinh_trang==0){
            	$checked = '';
            }
            else{
            	$checked = 'checked';
            }
            $button_update = "<input data-ma_sv='$ma_sv' $checked type='checkbox' class='click_checkbox' id='$index' value='1' name='array_check[$ma_sv]' /><label class='label_checkbox' for='$index'>Toggle</label>";
            $array[$index] = [];
            array_push($array[$index],$ma_sv,$ten_sv,$gioi_tinh,$SDT,$dia_chi,$ten_lop,$button_update);
        }
        return $array;
    }
    function get_so_luong_sach(Request $rq){
    	$ma_sach = $rq->ma_sach;
    	$arr_so_luong = SachModel::get_so_luong($ma_sach);
    	// dd($arr_so_luong);
    	return $arr_so_luong;
    }
}
