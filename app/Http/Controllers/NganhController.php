<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\NganhModel;
use Validator;
use App\Http\Requests\NganhRequest;
use Exception;

class NganhController extends Controller
{
    function view_all(){
    	$arr_nganh = NganhModel::get_all();
        // dd($arr_nganh);
    	return view('.nganh/view_all',compact('arr_nganh'));
    }
    function view_insert(){
    	return view('.nganh/view_insert');
    }
    function process_insert(NganhRequest $rq){
        $nganh      = new NganhModel();
        $nganh->ten = $rq->get('ten_nganh');
        //lay nganh theo tên kiểm tra xem có trugf hay k
        $check = $nganh->get_nganh_theo_ten();
        // dd($check);
        //   try {
        // Validate the value...
        //} catch (Exception $e) {
        if (count($check) >= 1) {
            return redirect()->route('nganh.view_insert')->with('error','Data already exists');
        }else {
            $nganh->insert();
            return redirect()->route('nganh.view_insert')->with('success','Successful');
        }
        
    }
    function view_update($ma){
        $nganh     = new NganhModel();
        $nganh->ma = $ma;
        $result   = $nganh->get_one();
        // dd($arr_gv);
        return view('.nganh/view_update',compact('result'));
    }
    function process_update(NganhRequest $rq){
        $nganh      = new NganhModel();
        $ma         = $rq->get('ma_nganh');
        $nganh->ma  = $ma;
        $nganh->ten = $rq->get('ten_nganh');
        try {
            $nganh->update_nganh();
            // dd("abc");
            return redirect()->route('nganh.view_update',['ma'=>$ma])->with('success','Successful');
        } catch (Exception $e) {
            // dd($e);
            return redirect()->route('nganh.view_update',['ma'=>$ma])->with('error','Data already exists');
        }
    }
}
