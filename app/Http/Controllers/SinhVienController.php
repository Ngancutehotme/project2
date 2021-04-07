<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SinhVienRequest;
use App\Http\Requests\SinhVienRequestUser;
use App\Model\KhoaModel;
use App\Model\NganhModel;
use App\Model\LopModel;
use App\Model\MonModel;
use App\Model\SachModel;
use App\Model\SachChiTietModel;
use App\Model\SinhVienModel;
use Hash;
use Storage;
// use Exception;
use Maatwebsite\Excel\Facades\Excel;

class SinhVienController extends Controller
{
    function view_all(){
      $array_nganh = NganhModel::get_all();
      $array_khoa  = KhoaModel::get_all();
      return view('sinh_vien/view_all',compact('array_nganh','array_khoa'));
  }
  function get_sinh_vien_theo_lop(Request $rq){
    $ma_lop   = $rq->ma_lop;
        // dd($ma_lop);
    $array_sv = SinhVienModel::get_sinh_vien_theo_lop($ma_lop);
    $array = [];
    foreach ($array_sv as $index => $each) {
        $link_update   = route('sinh_vien.view_update',['ma'=>$each->ma_sv]);
        $name_img = $each->anh;
            // dd($name_img);
        $link_img   = asset("uploads/image/".$name_img);
        $ma_sv     = $each->ma_sv;
        $ten_sv    = $each->ten_sv;
        $img       = "<img class='avatar border-gray' src='$link_img'/>";
        $ngay_sinh = $each->ngay_sinh;
        if($each->gioi_tinh == 1){
            $gioi_tinh = 'Male';
        }
        else{
            $gioi_tinh = 'Female';
        }
        $email     = $each->email;
        $SDT       = $each->SDT;
        $dia_chi   = $each->dia_chi;
        $ten_lop   = $each->ten_lop;
        $button_update = "<a href='$link_update' class='btn btn-simple btn-warning btn-icon edit'><i class='fa fa-edit'></i></a>";
        $array[$index] = [];
        array_push($array[$index],$ma_sv,$ten_sv,$img,$ngay_sinh,$gioi_tinh,$email,$SDT,$dia_chi,$ten_lop,$button_update);
    }
        // dd($array);
    return $array;
}
function view_insert(){
    $array_nganh = NganhModel::get_all();
    $array_khoa  = KhoaModel::get_all();
        // dd($array_khoa);
    return view('sinh_vien/view_insert',compact('array_nganh','array_khoa'));
}
function process_insert(SinhVienRequest $rq){
    $sinh_vien            = new  SinhVienModel();
    $sinh_vien->ten       = $rq->get('ten_sv');
    $sinh_vien->ngay_sinh = $rq->get('ngay_sinh');
    $sinh_vien->email     = $rq->get('email');
    $sinh_vien->mat_khau  = Hash::make($rq->get('mat_khau'));
    $sinh_vien->gioi_tinh = $rq->get('gioi_tinh');
    $sinh_vien->SDT       = $rq->get('SDT');
    $sinh_vien->dia_chi   = $rq->get('dia_chi');
    $sinh_vien->ma_lop   = $rq->get('lop');
        // dd($sinh_vien);
    $file_anh           = $rq->file('anh');
        // dd($file_anh);
    $duoi_file          = $file_anh->extension();
    $sinh_vien->anh = time().".".$duoi_file;
        // 
    Storage::disk('public')->putFileAs("sinh_vien", $file_anh, $sinh_vien->anh);

        // dd($sinh_vien->ten_anh);
    $sinh_vien->process_insert();
        // dd($sinh_vien);
    return redirect()->route('sinh_vien.view_all');
}
function view_update($ma){
    $arr_nganh               = NganhModel::get_all();
    $arr_khoa                = KhoaModel::get_all();
    $sinh_vien               = new SinhVienModel();
    $sinh_vien->ma_sinh_vien = $ma;
    $result                  = $sinh_vien->get_one_sv();
        // dd($result);
    $ma_lop                  = $result[0]->ma_lop;
    $get_nganh_khoa_theo_lop = SinhVienModel::get_nganh_khoa_theo_lop($ma_lop);
        // dd($get_nganh_khoa_theo_lop);
    return view('sinh_vien/view_update',compact('result','arr_nganh','arr_khoa','get_nganh_khoa_theo_lop'));
}
function process_update(SinhVienRequest $rq){
    $sinh_vien               = new  SinhVienModel();
    $sinh_vien->ma_sinh_vien = $rq->get('ma_sv');
    $sinh_vien->ten          = $rq->get('ten_sv');
    $sinh_vien->ngay_sinh    = $rq->get('ngay_sinh');
    $sinh_vien->email        = $rq->get('email');
    $sinh_vien->gioi_tinh    = $rq->get('gioi_tinh');
    $sinh_vien->SDT          = $rq->get('SDT');
    $sinh_vien->dia_chi      = $rq->get('dia_chi');
    $ma_nganh                = $rq->get('ma_nganh');
    $ma_khoa                 = $rq->get('ma_khoa');
    $sinh_vien->ma_lop       = $rq->get('lop');
        // dd($sinh_vien);
    $result = $sinh_vien->get_user();
    $file_anh = $rq->file('anh');
        // dd($result);
    if (!$result[0]->anh) {
        if (!$file_anh) {
            $sinh_vien->ten_anh = 'mac_dinh.jpg';
        }else{
            $duoi_file = $file_anh->extension();
            $sinh_vien->ten_anh = time().".".$duoi_file;
                // 
            Storage::disk('public')->putFileAs("image", $file_anh, $sinh_vien->ten_anh);
        }
    }else{
        if (!$file_anh) {
            $sinh_vien->ten_anh = $rq->get('anh_cu');
        }else{
            $duoi_file = $file_anh->extension();
            $sinh_vien->ten_anh = time().".".$duoi_file;
                // 
            Storage::disk('public')->putFileAs("image", $file_anh, $sinh_vien->ten_anh);
        }
    }
        // dd($sinh_vien->ten_anh);
        // $rq->session()->put('anh',$sinh_vien->ten_anh);
    try {
        $sinh_vien->process_update_sv();
        return redirect()->route('sinh_vien.view_update',['ma'=>$result[0]->ma_sv])->with('success','Successful');
    } catch (Exception $e) {
        return redirect()->route('sinh_vien.view_update',['ma'=>$result[0]->ma_sv])->with('error','Error');
    } 
        // dd($sinh_vien);
}
function create_file_excel(Request $rq){
    try {
        $excel = Excel::create('ListStudents', function($excel) use ($rq) {
            $excel->sheet('Sheet1', function($sheet) use ($rq) {
                $sheet->row(1, $rq->cot_excel);
            });
        })->store('xls', storage_path('app/public/excel/exports'));
        return $excel->download();

    } catch (\Exception $e) {
        dd($e);
    }
    return view('sinh_vien.excel');
}
public function download_file_excel_mau()
{
    return Storage::disk('public_1')->download('excel/exports/Default.xls');
}
function view_insert_excel(){
    return view('sinh_vien.excel');
}
public function insert_excel(Request $rq)
{
    // dd($rq->all());
    try {
        $file = $rq->ds_sinh_vien;
        Excel::load($file, function($reader) {
            $results = $reader->get()->toArray();
            foreach ($results as $each) {
                if(empty(array_filter($each))){
                    continue;
                }

                // dd($each['ten_lop'],$each['ten_khoa']);
                $sinh_vien               = new SinhVienModel();
                $sinh_vien->ma_sinh_vien = $each['ma_sinh_vien'];
                $check                   = $sinh_vien->get_user();
                // dd($sinh_vien);
                $sinh_vien->ten          = $each['ten_sinh_vien'];
                $sinh_vien->ngay_sinh    = date_format(date_create($each['ngay_sinh']),'Y-m-d');
                $sinh_vien->gioi_tinh    = ($each['gioi_tinh']=='Nam') ? 1 : 0;
                $sinh_vien->email        = $each['email'];
                $sinh_vien->SDT          = $each['so_dien_thoai'];
                $sinh_vien->dia_chi      = $each['dia_chi'];
                $sinh_vien->mat_khau     = Hash::make('123456');;
                
                $ma_khoa = KhoaModel::get_ma_theo_ten($each['ten_khoa']);
                
                // dd($ma_khoa);
                $sinh_vien->ma_lop       = LopModel::get_ma_theo_ten_lop_ten_khoa($each['ten_lop'],$ma_khoa);
                // dd($sinh_vien);
                if(empty($check)){
                    $sinh_vien->process_insert();
                }
                else{
                    $sinh_vien->process_update_sv();                
                }
            }
        });
        return redirect()->route('sinh_vien.view_insert_excel')->with('success','Successful');
    } catch (Exception $e) {
        return redirect()->route('sinh_vien.view_insert_excel')->with('error','Error');
    }
}

    //Nguoi dung sinh vien
    //.
    //.
    //.
    //.
    //.

function sinh_vien_view_login(){
    return view('sinh_vien/view_login');
}
function welcome1(){
    return view('sinh_vien/welcome1');
}
function sinh_vien_process_login(Request $rq){
    $sinh_vien           = new  SinhVienModel();
    $sinh_vien->email    = $rq->get('email');
    $sinh_vien->mat_khau = $rq->get('mat_khau');
    $arr                 = $sinh_vien->get_one();
        // dd($arr);
    if (count($arr)==1) {
        if(Hash::check($sinh_vien->mat_khau,$arr[0]->mat_khau)){
            $rq->session()->put('ma_sv',$arr[0]->ma_sv);
            $rq->session()->put('ten_sv',$arr[0]->ten_sv);
            $rq->session()->put('anh',$arr[0]->anh);
            return redirect()->route('quan_ly_sinh_vien.sinh_vien_xem_tinh_trang_nhan_sach_cua_mk');
        }
        else{
            return redirect()->route('sinh_vien_view_login')->with('error','Nhập không khớp, mời nhập lại');
        }
    } 
    else {
        return redirect()->route('sinh_vien_view_login')->with('error','Nhập không khớp, mời nhập lại');
    }
}
function logout_sv(Request $rq){
    $rq->session()->flush();
    return redirect()->route('sinh_vien_view_login')->with('success','Đăng xuất thành công!');
}
function update_password(){
    return view('sinh_vien/update_password');
}
function process_update_password(Request $rq){
    $sinh_vien               = new SinhVienModel();
    $sinh_vien->ma_sinh_vien = $rq->session()->get('ma_sv');
    $result                  = $sinh_vien->get_one_sv();
        // dd($result);
    $mat_khau_cu    = $rq->mat_khau_cu;
    $mat_khau_moi_1 = $rq->mat_khau_moi_1;
    $mat_khau_moi_2 = $rq->mat_khau_moi_2;
        // dd($mat_khau);
    if ((Hash::check($mat_khau_cu,$result[0]->mat_khau)) && ($mat_khau_moi_1 == $mat_khau_moi_2)) {
        $sinh_vien->mat_khau = Hash::make($rq->mat_khau_moi_1);
            // dd($sinh_vien);
        $sinh_vien->process_update_password();
        return redirect()->back()->with('success','Đổi mật khẩu thành công!');
            // echo "thanh cong";
    } else {
        return redirect()->back()->with('error','Mật khẩu không khớp');
            // echo "tb";
    }
}
function edit_profile(Request $rq){
    $sinh_vien               = new SinhVienModel();
    $sinh_vien->ma_sinh_vien = $rq->session()->get('ma_sv');
    $result                  = $sinh_vien->get_one_sv();
        // dd($arr_sv);
    return view('sinh_vien/user',compact('result'));
}
function process_edit_profile(SinhVienRequestUser $rq){
    $sinh_vien               = new  SinhVienModel();
    $sinh_vien->ma_sinh_vien = $rq->session()->get('ma_sv');
    $sinh_vien->ten          = $rq->get('ten_sv');
    $sinh_vien->ngay_sinh    = $rq->get('ngay_sinh');
    $sinh_vien->email        = $rq->get('email');
    $sinh_vien->gioi_tinh    = $rq->get('gioi_tinh');
    $sinh_vien->SDT          = $rq->get('SDT');
    $sinh_vien->dia_chi      = $rq->get('dia_chi');
        // dd($sinh_vien);
    $result = $sinh_vien->get_user();
    $file_anh = $rq->file('anh');
        // dd($result);
    if (!$result[0]->anh) {
        if (!$file_anh) {
            $sinh_vien->ten_anh = 'mac_dinh.jpg';
        }else{
            $duoi_file = $file_anh->extension();
            $sinh_vien->ten_anh = time().".".$duoi_file;
                // 
            Storage::disk('public')->putFileAs("image", $file_anh, $sinh_vien->ten_anh);
        }
    }else{
        if (!$file_anh) {
            $sinh_vien->ten_anh = $rq->get('anh_cu');
        }else{
            $duoi_file = $file_anh->extension();
            $sinh_vien->ten_anh = time().".".$duoi_file;
                // 
            Storage::disk('public')->putFileAs("image", $file_anh, $sinh_vien->ten_anh);
        }
    }
        // dd($sinh_vien->ten_anh);
    $rq->session()->put('anh',$sinh_vien->ten_anh); 
    $sinh_vien->process_edit_profile();
        // dd($sinh_vien);
    return redirect()->route('quan_ly_sinh_vien.edit_profile');
}
function sinh_vien_xem_tinh_trang_nhan_sach_cua_mk(Request $rq){
    $ma_sv               = $rq->session()->get('ma_sv');
    $arr_lop             = SinhVienModel::get_lop_theo_sinh_vien($ma_sv);
    $arr_nganh           = LopModel::get_nganh_theo_lop($arr_lop[0]->ma_lop);
    $arr_mon_sach        = MonModel::get_mon_theo_nganh($arr_nganh[0]->ma_nganh);
        // $arr_tinh_trang_sach = SachChiTietModel::get_sach_chi_tiet_theo_sinh_vien($ma_sv);
    $array = [];
        // dd($arr_mon_sach);
    foreach ($arr_mon_sach as $each) {
        $ma_sach = $each->ma_sach;
        $sach_da_phat = SachChiTietModel::get_sach_chi_tiet_theo_sinh_vien($ma_sv,$ma_sach);
        if (empty($sach_da_phat)) {
            $arr_sach = $each;
        }else{
            $arr_sach = $sach_da_phat[0];
        }
        array_push($array, $arr_sach);
    }
        // dd($array);
    return view('sinh_vien.sinh_vien_xem_sach',compact('arr_nganh','arr_lop','array'));
}
}