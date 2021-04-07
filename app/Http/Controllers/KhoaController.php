<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\KhoaModel;
use App\Http\Requests\KhoaRequest;
use Exception;
class KhoaController extends Controller
{
    function view_all(){
    	$arr_khoa = KhoaModel::get_all();
        // dd($arr_gv);
    	return view('khoa/view_all',compact('arr_khoa'));
    }
    function view_insert(){
    	return view('khoa/view_insert');
    }
    function process_insert(KhoaRequest $rq){
        $khoa      = new KhoaModel();
        $khoa->ten = $rq->get('ten_khoa');
        //lay nganh theo tên kiểm tra xem có trugf hay k
        $check = $khoa->get_khoa_theo_ten();
        // dd($check);
        if (count($check) >= 1) {
            return redirect()->route('khoa.view_insert')->with('error','Data already exists');
        }else {
            $khoa->insert();
            return redirect()->route('khoa.view_insert')->with('success','Successful');
        }
    }
    function view_update($ma){
        $khoa     = new KhoaModel();
        $khoa->ma = $ma;
        $result   = $khoa->get_one();
        // dd($arr_gv);
        return view('.khoa/view_update',compact('result'));
    }
    function process_update(KhoaRequest $rq){
        // dd($rq->all());
        $khoa      = new KhoaModel();
        $ma        = $rq->get('ma_khoa');
        $khoa->ma  = $ma;
        $khoa->ten = $rq->get('ten_khoa');
        // $result    = $khoa->get_one();
        // dd($result[0]->ten_khoa);
        try {
            $khoa->update_khoa();
            // dd($ma);
            return redirect()->route('khoa.view_update',['ma'=>$ma])->with('success','Successful');
            
        } catch (Exception $e) {
            return redirect()->route('khoa.view_update',['ma'=>$ma])->with('error','Data already exists');
        }
    }
}
