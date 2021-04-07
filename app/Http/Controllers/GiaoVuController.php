<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GiaoVuRequest;
use App\Model\GiaoVuModel;
use Hash;
use Validator;
use Storage;

class GiaoVuController extends Controller
{
    function view_login(){
    	return view('giao_vu/view_login');
    }function welcome1(){
    	return view('welcome1');
    }
    function process_login(Request $rq){
        $giao_vu           = new  GiaoVuModel();
        $giao_vu->email    = $rq->get('email');
        $giao_vu->mat_khau = $rq->get('mat_khau');
        $arr               = $giao_vu->get_one();
        // dd($arr);
        if (count($arr)==1) {
            if(Hash::check($giao_vu->mat_khau,$arr[0]->mat_khau)){
                $rq->session()->put('ma_gv',$arr[0]->ma_gv);
                $rq->session()->put('ten_gv',$arr[0]->ten_gv);
                $rq->session()->put('anh',$arr[0]->anh);
                return redirect()->route('thong_ke.view_thong_ke');
            }
            else{
                return redirect()->route('view_login')->with('error','Nhập không khớp, mời nhập lại');
            }
        } else {
            return redirect()->route('view_login')->with('error','Nhập không khớp, mời nhập lại');
        }
    }
    function view_all(){
    	$arr_gv = GiaoVuModel::get_all();
        // dd($arr_gv);
    	return view('.giao_vu/view_all',compact('arr_gv'));
    }
    function edit_profile(Request $rq){
        $giao_vu     = new GiaoVuModel();
        $giao_vu->ma = $rq->session()->get('ma_gv');
        $result      = $giao_vu->get_one_gv();
        // dd($arr_gv);
        return view('giao_vu/user',compact('result'));
    }
    function process_edit_profile(GiaoVuRequest $rq){
        $ma                 = $rq->session()->get('ma_gv');
        $giao_vu            = new  GiaoVuModel();
        $giao_vu->ma        = $ma;
        $giao_vu->ten       = $rq->get('ten_gv');
        $giao_vu->ngay_sinh = $rq->get('ngay_sinh');
        $giao_vu->email     = $rq->get('email');
        $giao_vu->gioi_tinh = $rq->get('gioi_tinh');
        $giao_vu->SDT       = $rq->get('SDT');
        $giao_vu->dia_chi   = $rq->get('dia_chi');
        // dd($giao_vu);
        $result = GiaoVuModel::get_user($ma);
        $file_anh = $rq->file('anh');
        // dd($file_anh);
        if (!$result[0]->anh) {
            if (!$file_anh) {
                $giao_vu->ten_anh = 'mac_dinh.jpg';
           }else{
                $duoi_file = $file_anh->extension();
                $giao_vu->ten_anh = time().".".$duoi_file;
                // 
                Storage::disk('public')->putFileAs("image", $file_anh, $giao_vu->ten_anh);
           }
        }else{
            if (!$file_anh) {
                $giao_vu->ten_anh = $rq->get('anh_cu');
            }else{
                $duoi_file = $file_anh->extension();
                $giao_vu->ten_anh = time().".".$duoi_file;
                // 
                Storage::disk('public')->putFileAs("image", $file_anh, $giao_vu->ten_anh);
           }
        }
        // dd($giao_vu->ten_anh);
        $rq->session()->put('anh',$giao_vu->ten_anh); 
        $giao_vu->process_edit_profile();
        // dd($giao_vu);
        return redirect()->route('giao_vu.edit_profile')->with('success','Succsessful');
    }
    function user(){
        return view('giao_vu/user');
    }
    function logout(Request $rq){
        $rq->session()->flush();
        return redirect()->route('view_login')->with('success','Đăng xuất thành công!');
    }
    function update_password(){
        return view('giao_vu/update_password');
    }
    function process_update_password(Request $rq){
        $giao_vu        = new GiaoVuModel();
        $giao_vu->ma    = $rq->session()->get('ma_gv');
        $result         = $giao_vu->get_one_gv();
        $mat_khau_cu    = $rq->mat_khau_cu;
        $mat_khau_moi_1 = $rq->mat_khau_moi_1;
        $mat_khau_moi_2 = $rq->mat_khau_moi_2;
        // dd($mat_khau);
        if ((Hash::check($mat_khau_cu,$result[0]->mat_khau)) && ($mat_khau_moi_1 == $mat_khau_moi_2)) {
            $giao_vu->mat_khau = Hash::make($rq->mat_khau_moi_1);
            $giao_vu->process_update_password();
            return redirect()->back()->with('success','Đổi mật khẩu thành công!');
            // echo "thanh cong";
        } else {
            return redirect()->back()->with('error','Mật khẩu không khớp');
            // echo "tb";
        }
    }

}
