<?php
Route::get('test','Controller@test');

Route::get('form','Controller@form');
Route::post('upload','Controller@upload')->name('upload');

//Người dùng là  Giáo Vụ
Route::get('','GiaoVuController@view_login')->name('view_login');
Route::post('process_login','GiaoVuController@process_login')->name('process_login');
Route::group(['middleware' => 'CheckLoginGV'], function(){
    Route::group(['prefix'=>'giao_vu', 'as'=>'giao_vu.'], function(){
    	Route::get('welcome1','GiaoVuController@welcome1')->name('welcome1');
    	Route::get('view_all','GiaoVuController@view_all')->name('view_all');
    	Route::get('EP','GiaoVuController@edit_profile')->name('edit_profile');
    	Route::put('EP','GiaoVuController@process_edit_profile')->name('process_edit_profile');
    	Route::get('user','GiaoVuController@user')->name('user');
    	Route::get('view_insert','GiaoVuController@view_insert')->name('view_insert');
        Route::get('UP','GiaoVuController@update_password')->name('update_password');
        Route::post('UP','GiaoVuController@process_update_password')->name('process_update_password');
    });
    Route::group(['prefix'=>'khoa', 'as'=>'khoa.'], function(){
        Route::get('view_all','KhoaController@view_all')->name('view_all');
        Route::get('view_update/{ma}','KhoaController@view_update')->name('view_update');
        Route::put('view_update/{ma}','KhoaController@process_update')->name('process_update');
        Route::get('view_insert','KhoaController@view_insert')->name('view_insert');
        Route::post('view_insert','KhoaController@process_insert')->name('process_insert');
    });
    Route::group(['prefix'=>'nganh', 'as'=>'nganh.'], function(){
        Route::get('view_all','NganhController@view_all')->name('view_all');
        Route::get('view_update/{ma}','NganhController@view_update')->name('view_update');
        Route::put('view_update/{ma}','NganhController@process_update')->name('process_update');
        Route::get('view_insert','NganhController@view_insert')->name('view_insert');
        Route::post('view_insert','NganhController@process_insert')->name('process_insert');
    });
    Route::group(['prefix'=>'lop', 'as'=>'lop.'], function(){
        Route::get('view_all','LopController@view_all')->name('view_all');
        Route::get('view_update/{ma}','LopController@view_update')->name('view_update');
        Route::put('view_update/{ma}','LopController@process_update')->name('process_update');
        Route::get('view_insert','LopController@view_insert')->name('view_insert');
        Route::put('view_insert','LopController@process_insert_nhanh')->name('process_insert_nhanh');
        Route::post('view_insert','LopController@process_insert')->name('process_insert');
        Route::get('tim_kiem','LopController@tim_kiem')->name('tim_kiem');
    });
    Route::group(['prefix'=>'sinh_vien', 'as'=>'sinh_vien.'], function(){
        Route::get('welcome1','SinhVienController@welcome1')->name('welcome1');
        Route::get('view_all','SinhVienController@view_all')->name('view_all');
        Route::get('view_update/{ma}','SinhVienController@view_update')->name('view_update');
        Route::put('view_update/{ma}','SinhVienController@process_update')->name('process_update');
        Route::get('view_insert','SinhVienController@view_insert')->name('view_insert');
        Route::post('view_insert','SinhVienController@process_insert')->name('process_insert');
        Route::get('insert_excel','SinhVienController@view_insert_excel')->name('view_insert_excel');
        Route::post('insert_excel','SinhVienController@insert_excel')->name('insert_excel');
        Route::put('create_file_excel','SinhVienController@create_file_excel')->name('create_file_excel');
        Route::get('download_file_excel_mau','SinhVienController@download_file_excel_mau')->name('download_file_excel_mau');
        // Route::post('back','SinhVienController@back')->name('back');
    });
    Route::group(['prefix'=>'mon', 'as'=>'mon.'], function(){
        Route::get('view_all','MonController@view_all')->name('view_all');
        Route::get('view_insert','MonController@view_insert')->name('view_insert');
        Route::post('view_insert','MonController@process_insert')->name('process_insert');
        Route::get('view_update/{ma}','MonController@view_update')->name('view_update');
        Route::put('view_update/{ma}','MonController@process_update')->name('process_update');
    });
    Route::group(['prefix'=>'sach', 'as'=>'sach.'], function(){
        Route::get('view_all','SachController@view_all')->name('view_all');
        Route::get('view_insert','SachController@view_insert')->name('view_insert');
        Route::post('view_insert','SachController@process_insert')->name('process_insert');
        Route::get('view_update/{ma}','SachController@view_update')->name('view_update');
        Route::post('view_update/{ma}','SachController@process_update_sach')->name('process_update');
    });
    Route::group(['prefix'=>'sach_ct', 'as'=>'sach_ct.'], function(){
        Route::get('view_insert','SachChiTiet@view_insert')->name('view_insert');
        Route::post('view_insert','SachChiTiet@process_phat_sach')->name('process_phat_sach');
    });
    Route::group(['prefix'=>'thong_ke', 'as'=>'thong_ke.'], function(){
        Route::get('view_thong_ke','ThongKeController@view_thong_ke')->name('view_thong_ke');
    });
    Route::group(['prefix'=>'ajax', 'as'=>'ajax.'], function(){
        Route::get('get_table_lop_theo_nganh_khoa','LopController@get_table_lop_theo_nganh_khoa')->name('get_table_lop_theo_nganh_khoa');
        // lấy danh sách lớp theo ngành khóa
        Route::get('get_array_lop_theo_nganh_khoa','LopController@get_array_lop_theo_nganh_khoa')->name('get_array_lop_theo_nganh_khoa');
        Route::get('get_table_mon_theo_nganh','MonController@get_table_mon_theo_nganh')->name('get_table_mon_theo_nganh');
        Route::get('get_sinh_vien_theo_lop','SinhVienController@get_sinh_vien_theo_lop')->name('get_sinh_vien_theo_lop');

        // lấy bảng sinh viên kèm thông tin sách chi tiết datatable qua ajax theo mã lớp và mã sách
        Route::get('get_chi_tiet_theo_lop_va_sach','SachChiTiet@get_chi_tiet_theo_lop_va_sach')->name('get_chi_tiet_theo_lop_va_sach');

        Route::get('get_array_mon_theo_nganh','MonController@get_array_mon_theo_nganh')->name('get_array_mon_theo_nganh');
        Route::get('get_sach_theo_mon','SachController@get_sach_theo_mon')->name('get_sach_theo_mon');
        Route::get('get_array_sach_theo_mon','ThongKeController@get_array_sach_theo_mon')->name('get_array_sach_theo_mon');
        Route::get('get_sach_theo_mon_ct','SachController@get_sach_theo_mon_ct')->name('get_sach_theo_mon_ct');
        Route::get('get_so_luong','ThongKeController@get_so_luong')->name('get_so_luong');
        Route::get('get_so_luong_sach','SachChiTiet@get_so_luong_sach')->name('get_so_luong_sach');


        Route::get('ajax_process_phat_sach','SachChiTiet@ajax_process_phat_sach')->name('process_phat_sach');
        Route::get('tim_kiem','LopController@tim_kiem')->name('tim_kiem');
    });
});
Route::get('logout','GiaoVuController@logout')->name('logout');

//Người dùng là  Sinh viên
Route::get('sinh_vien','SinhVienController@sinh_vien_view_login')->name('sinh_vien_view_login');
Route::post('sinh_vien_process_login','SinhVienController@sinh_vien_process_login')->name('sinh_vien_process_login');
Route::group(['middleware' => 'CheckLoginSV'], function(){
    Route::group(['prefix'=>'quan_ly_sinh_vien', 'as'=>'quan_ly_sinh_vien.'], function(){
        Route::get('welcome1','SinhVienController@welcome1')->name('welcome1');
        Route::get('EP','SinhVienController@edit_profile')->name('edit_profile');
        Route::put('EP','SinhVienController@process_edit_profile')->name('process_edit_profile');
        Route::get('UP','SinhVienController@update_password')->name('update_password');
        Route::post('UP','SinhVienController@process_update_password')->name('process_update_password');
        Route::get('sinh_vien_xem_tinh_trang_nhan_sach_cua_mk','SinhVienController@sinh_vien_xem_tinh_trang_nhan_sach_cua_mk')->name('sinh_vien_xem_tinh_trang_nhan_sach_cua_mk');
    });
});
Route::get('logout_sv','SinhVienController@logout_sv')->name('logout_sv');