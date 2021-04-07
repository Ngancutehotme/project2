<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SachRequest;
use App\Model\SachModel;
use App\Model\MonModel;
use App\Model\NganhModel;

class SachController extends Controller
{
    function view_all(){
		$arr_nganh = NganhModel::get_all();
		return view('sach/view_all',compact('arr_nganh'));
	}
	function get_sach_theo_mon(Request $rq){
		$ma_mon           = $rq->ma_mon;

		$array_sach = SachModel::get_sach_theo_mon($ma_mon);

		$array = [];
		foreach ($array_sach as $index => $each) {
			$link_update   = route('sach.view_update',['ma'=>$each->ma_sach]);
			$ma_sach       = $each->ma_sach;
			$ten_sach      = $each->ten_sach;
			$so_luong      = $each->so_luong;
			$ten_mon       = $each->ten_mon;
			$button_update = "<a href='$link_update' class='btn btn-simple btn-warning btn-icon edit'><i class='fa fa-edit'></i></a>";

			$array[$index] = [];
			array_push($array[$index],$ma_sach,$ten_sach,$so_luong,$ten_mon,$button_update);
		}
		return $array;
	}
    function get_sach_theo_mon_ct(Request $rq){
        $ma_mon           = $rq->ma_mon;

        $array_sach = SachModel::get_sach_theo_mon($ma_mon);
        // dd($array_sach);
        return $array_sach;
    }
    function view_insert(){
		$arr_nganh = NganhModel::get_all();
		return view('sach/view_insert',compact('arr_nganh'));
    }
    function process_insert(SachRequest $rq){
        $sach           = new SachModel();
        $sach->ten      = $rq->get('ten_sach');
        $sach->so_luong = $rq->get('so_luong');
        $sach->ma_mon   = $rq->get('ma_mon');
        // dd($sach);
        $sach->insert();
        return redirect()->route('sach.view_insert')->with('success','Successful');
    }
    function view_update($ma){
		$arr_nganh     	= NganhModel::get_all();
		$sach          	= new SachModel();
		$sach->ma_sach 	= $ma;
		$result        	= $sach->get_one();
		$ma_mon        	= $result[0]->ma_mon;
		$nganh_theo_mon = MonModel::get_nganh_theo_mon($ma_mon);
    	// dd($nganh_theo_mon);
    	return view('sach/view_update',compact('result','arr_nganh','nganh_theo_mon'));
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
    	return redirect()->route('lop.view_update',['ma'=>$lop->ma_lop]);
    }
    function process_update_sach(SachRequest $rq){
    	// dd('abc');
    	$sach           = new SachModel();
    	$sach->ma_sach  = $rq->get('ma_sach');
    	$sach->ma_mon   = $rq->get('ma_mon');
    	$sach->ten      = $rq->get('ten_sach');
    	$sach->so_luong = $rq->get('so_luong');
    	// dd($sach);
    	$sach->update_sach();
    	return redirect()->route('sach.view_update',['ma'=>$sach->ma_sach]);
    }

}