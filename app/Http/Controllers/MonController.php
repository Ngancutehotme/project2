<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MonRequest;
use App\Model\NganhModel;
use App\Model\MonModel;

class MonController extends Controller
{
    function view_all(){
		$arr_nganh = NganhModel::get_all();
		return view('mon/view_all',compact('arr_nganh'));
	}
	function get_table_mon_theo_nganh(Request $rq){
		$ma_nganh            = $rq->ma_nganh;
        // dd($ma_nganh);
		$array_mon = MonModel::get_mon_theo_nganh($ma_nganh);
		$array = [];
        // dd($array_mon);
		foreach ($array_mon as $index => $each) {
			$link_update   = route('mon.view_update',['ma'=>$each->ma_mon]);
			$ma_mon        = $each->ma_mon;
			$ten_mon       = $each->ten_mon;
			$ten_nganh     = $each->ten_nganh;
			$button_update = "<a href='$link_update' class='btn btn-simple btn-warning btn-icon edit'><i class='fa fa-edit'></i></a>";

			$array[$index] = [];
			array_push($array[$index],$ma_mon,$ten_mon,$ten_nganh,$button_update);
		}
		return $array;
	}
    function view_insert(){
		$arr_nganh = NganhModel::get_all();
    	return view('mon/view_insert',compact('arr_nganh'));
    }
    function process_insert(MonRequest $rq){
        $mon      = new MonModel();
        $mon->ten = $rq->get('ten_mon');
        
        // dd($mon);
        $mon->insert_mon();
        $array    = $mon->select_ma_mon();
        $ma_mon   = $array[0]->ma_mon;
        $ma_nganh = $rq->get('ma_nganh');
        // dd($ma_mon); 
        MonModel::insert_mon_nganh_chi_tiet($ma_nganh,$ma_mon);
        return redirect()->route('mon.view_insert')->with('success','Successful');
    }
    function view_update($ma){
		$arr_nganh   = NganhModel::get_all();
		$mon         = new MonModel();
		$mon->ma_mon = $ma;
		$result      = $mon->get_one();
    	// dd($result);
    	return view('mon/view_update',compact('result','arr_nganh'));
    }
    function process_update(MonRequest $rq){
    	// dd('abc');
    	$mon           = new MonModel();
    	$mon->ma_mon   = $rq->get('ma_mon');
    	$mon->ten      = $rq->get('ten_mon');
    	$mon->ma_nganh = $rq->get('ma_nganh');
    	// // dd($mon);
    	$mon->update_mon_nganh_chi_tiet();
        $mon->update_mon();
    	return redirect()->route('mon.view_update',['ma'=>$mon->ma_mon]);
    }
    function get_array_mon_theo_nganh(Request $rq){
        $ma_nganh  = $rq->ma_nganh;
        $array_mon = MonModel::get_mon_theo_nganh($ma_nganh);
        return $array_mon;
    }

}
