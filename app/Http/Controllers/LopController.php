<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LopRequest;
use App\Model\KhoaModel;
use App\Model\NganhModel;
use App\Model\LopModel;

class LopController extends Controller
{
	function view_all(){
		$arr_nganh = NganhModel::get_all();
		$arr_khoa  = KhoaModel::get_all();
		// dd($array_lop);
		return view('lop/view_all',compact('arr_nganh','arr_khoa'));
	}
	function get_table_lop_theo_nganh_khoa(Request $rq){
		$ma_nganh            = $rq->ma_nganh;
		$ma_khoa             = $rq->ma_khoa;

		if (!$ma_nganh) {
			$array_lop = LopModel::get_lop_theo_khoa($ma_khoa);
		}elseif (!$ma_khoa) {
			$array_lop = LopModel::get_lop_theo_nganh($ma_nganh);
		}elseif ($ma_khoa && $ma_nganh) {
			$array_lop = LopModel::get_lop_theo_nganh_khoa($ma_nganh,$ma_khoa);
		}

		$array = [];
		foreach ($array_lop as $index => $each) {
			$link_update   = route('lop.view_update',['ma'=>$each->ma_lop]);
			$ma_lop        = $each->ma_lop;
			$ten_lop       = isset($each->ten_khoa) ? $each->ten_lop.$each->ten_khoa : $each->ten_lop;
			$ten_nganh     = isset($each->ten_nganh) ? $each->ten_nganh : '';
			$button_update = "<a href='$link_update' class='btn btn-simple btn-warning btn-icon edit'><i class='fa fa-edit'></i></a>";

			$array[$index] = [];
			array_push($array[$index],$ma_lop,$ten_lop,$ten_nganh,$button_update);
		}
		return $array;
	}
	function tim_kiem(Request $rq){
		// dd($rq->all());
		$tim_kiem = $rq->tim_kiem;
		$arr_lop = LopModel::tim_kiem($tim_kiem);
		$array_lop = [];
		foreach ($arr_lop as $index => $each) {
			$link_update   = route('lop.view_update',['ma'=>$each->ma_lop]);
			$ma_lop        = $each->ma_lop;
			$ten_lop       = $each->ten_lop.$each->ten_khoa;
			$ten_nganh     = $each->ten_nganh;
			$button_update = "<a href='$link_update' class='btn btn-simple btn-warning btn-icon edit'><i class='fa fa-edit'></i></a>";

			$array_lop[$index] = [];
			array_push($array_lop[$index],$ma_lop,$ten_lop,$ten_nganh,$button_update);
		}
		// dd($array_lop);
		return redirect()->route('lop.view_all',['array_lop' => $array_lop]);
	}
	function get_array_lop_theo_nganh_khoa(Request $rq){
		$ma_nganh            = $rq->ma_nganh;
		$ma_khoa             = $rq->ma_khoa;

		$array_lop = LopModel::get_lop_theo_nganh_khoa($ma_nganh,$ma_khoa);
		return $array_lop;
	}
	function get_lop_theo_nganh_khoa_sv(Request $rq){
		$ma_nganh            = $rq->ma_nganh;
		$ma_khoa             = $rq->ma_khoa;

		$lop_theo_nganh_khoa = LopModel::get_lop_theo_nganh_khoa($ma_nganh,$ma_khoa);
		foreach ($lop_theo_nganh_khoa as $each) {
			$link_update = route('lop.view_update',['ma'=>$each->ma_lop]);
			// dd($lop_theo_nganh_khoa);
			echo "
			<select id='lop' name= 'lop'>
			<option value='$each->ma_lop'>$each->ten_lop</option>
			</select>
			";
		}
	}
	function view_insert(){
		$arr_nganh = NganhModel::get_all();
		$arr_khoa  = KhoaModel::get_all();
		return view('lop/view_insert',compact('arr_nganh','arr_khoa'));
	}
	function process_insert_nhanh(LopRequest $rq){
		$lop           = new LopModel();
		$so_luong      = $rq->get('so_lop');
		$lop->ten      = $rq->get('ten_lop');
        // dd($lop);
		try {
			for ($i=1; $i <= $so_luong; $i++) { 
				$lop->ten      = $rq->get('ten_lop').$i;
				if ($i<10) {
					$lop->ten      = $rq->get('ten_lop').'0'.$i;
				}
				$lop->ma_khoa  = $rq->get('ma_khoa');
				$lop->ma_nganh = $rq->get('ma_nganh');
	        // dd($lop);
				$lop->insert();
			}
		} catch (Exception $e) {
			return redirect()->route('lop.view_insert')->with('error','Insert false');
		}

		return redirect()->route('lop.view_insert')->with('success','Successful');
        // dd($arr);
	}
	function process_insert(LopRequest $rq){
		$lop           = new LopModel();
		$lop->ten      = $rq->get('ten_lop');
		$lop->ma_khoa  = $rq->get('ma_khoa');
		$lop->ma_nganh = $rq->get('ma_nganh');

		$arr = $lop->get_all();
        // dd($arr);
		if (count($arr)==1) {
			return redirect()->route('lop.view_insert')->with('error','Insert false');
		}else{
			$lop->insert();
			return redirect()->route('lop.view_all');
		};
        // dd($arr);
	}
	function view_update($ma){
		$arr_nganh   = NganhModel::get_all();
		$arr_khoa    = KhoaModel::get_all();
		$lop         = new LopModel();
		$lop->ma_lop = $ma;
		$result      = $lop->get_one();
    	// dd($arr);
		return view('.lop/view_update',compact('result','arr_nganh','arr_khoa'));
	}
	function process_update(LopRequest $rq){
    	// dd('abc');
		$lop           = new LopModel();
		$lop->ma_lop   = $rq->get('ma_lop');
		$lop->ten      = $rq->get('ten_lop');
		$lop->ma_nganh = $rq->get('ma_nganh');
		$lop->ma_khoa  = $rq->get('ma_khoa');
    	// // dd($lop);
		$lop->update_lop();
		return redirect()->route('lop.view_update',['ma'=>$lop->ma_lop])->with('success','Successful');
	}
}