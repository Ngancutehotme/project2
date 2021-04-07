@extends('layout/layout_gv')
@push('css')
<style>
input[type=checkbox]{
    height: 0;
    width: 0;
    visibility: hidden;
}

.label_checkbox {
    cursor: pointer;
    text-indent: -9999px;
    width: 50px;
    height: 25px;
    background: grey;
    display: block;
    border-radius: 100px;
    position: relative;
}

.label_checkbox:after {
    content: '';
    position: absolute;
    top: 5px;
    left: 5px;
    width: 20px;
    height: 15px;
    background: #fff;
    border-radius: 90px;
    transition: 0.3s;
}

input:checked + .label_checkbox {
    background: #bada55;
}

input:checked + .label_checkbox:after {
    left: calc(100% - 5px);
    transform: translateX(-100%);
}

.label_checkbox:active:after {
    width: 50px;
}
</style>
@endpush
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Book distribution manager</h4>
                        <p style="display: none; color: #0773C6" id="sl_sach">Quantity: <span id="so_luong">
                            
                        </span></p>
                    </div>
                    <div class="content">
                        {{-- <form method="post" action="{{ route('sach_ct.process_phat_sach')}}" > --}}
                            {{csrf_field()}}

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-4">
                                    <select id="nganh" name="nganh" class="selectpicker" data-title="Majors" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                        @foreach ($arr_nganh as $nganh)
                                            <option value="{{$nganh->ma_nganh}}">{{$nganh->ten_nganh}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select id="khoa" name="khoa" class="selectpicker" data-title="Course" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                        @foreach ($arr_khoa as $khoa)
                                            <option value="{{$khoa->ma_khoa}}">{{$khoa->ten_khoa}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4" style="display: none;" id="div_lop">
                                    <select id="lop" name="lop" class="selectpicker" data-title="Class" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                    </select>
                                </div>
                                <div class="col-md-4" style="display: none;" id="div_mon">
                                    <select id="mon" name="mon" class="selectpicker" data-title="Subject" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-4" style="display: none;" id="div_sach">
                                        <select id="sach" name="sach" class="selectpicker" data-title="Books" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p></p>
                                </div>
                            </div>

                            <div class="col-md-6">
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>PN</th>
                                            <th>Address</th>
                                            <th>Class</th>
                                            <th>
                                                <input $checked type='checkbox' id='checkbox' value='1' name='array_check[$ma_sv]' /><label class='label_checkbox' for='checkbox'>Toggle</label>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            {{-- <button type="submit" class="btn btn-info btn-fill pull-right">Update</button> --}}
                            <div class="clearfix"></div>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#checkbox").click(function(){
                if($(this).is(":checked")){
                    $(".click_checkbox").prop("checked",true).change();
                }
                else{
                    $(".click_checkbox").prop("checked",false).change();
                }
            });

            var errors = $("#error").val();
            if(errors == 1){
                alert("không thành công");
            }
            $("#nganh, #khoa").change(function(){
                // alert($("#nganh").val());alert($("#nganh").val());
                if($("#khoa").val() == '' || $("#nganh").val() == ''){
                    return;
                }else if($("#nganh").val() != ''){
                    getMon();
                }
                getLop();
            });
            $("#sach").change(function(){
                getTable();
                getSoLuong();
            });
            $("#mon").change(function(){
                getSach();
            });
            $("#lop").change(function(){
                if($("#mon").val() == '' || $("#sach").val() == ''){
                    return;
                }
                getTable();
            });
        });
        function getLop() {
            $.ajax({
                url: '{{ route('ajax.get_array_lop_theo_nganh_khoa') }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    ma_nganh: $("#nganh").val(),
                    ma_khoa: $("#khoa").val(),
                },
            })
            .done(function(response) {
                $("#div_lop").show();
                $("#lop").html('');
                $(response).each(function() {
                    $("#lop").append(`
                        <option value='${this.ma_lop}'>
                            ${this.ten_lop}
                        </option>
                    `);
                });
                $('#lop').selectpicker('refresh');
            });
        };
        function getMon() {
            $.ajax({
                url: '{{ route('ajax.get_array_mon_theo_nganh') }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    ma_nganh: $("#nganh").val()
                },
            })
            .done(function(response) {
                $("#div_mon").show();
                $("#mon").html('');
                $(response).each(function() {
                    $("#mon").append(`
                        <option value='${this.ma_mon}'>
                            ${this.ten_mon}
                        </option>
                    `);
                });
                $('#mon').selectpicker('refresh');
            });
        }
        function getSach() {
            $.ajax({
                url: '{{ route('ajax.get_sach_theo_mon_ct') }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    ma_mon: $("#mon").val()
                },
            })
            .done(function(response) {
                $("#div_sach").show();
                $("#sach").html('');
                $(response).each(function() {
                    $("#sach").append(`
                        <option value='${this.ma_sach}'>
                            ${this.ten_sach}
                        </option>
                    `);
                });
                $('#sach').selectpicker('refresh');

            });

        }
        function getSoLuong() {
            $.ajax({
                url: '{{ route('ajax.get_so_luong_sach') }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    ma_sach: $("#sach").val()
                },
            })
            .done(function(response) {
                $("#sl_sach").show();
                $("#so_luong").html('');
                $(response).each(function() {
                    $("#so_luong").append(`
                        ${this.sl_con}/${this.sl_tong}
                    `);
                });
                // $('#sach').selectpicker('refresh');
            });
        }
        function getTable() {
            $('#datatables').dataTable().fnDestroy();
            $('#datatables').DataTable({
                pagingType: "full_numbers",
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                },
                searching:false,
                sort:false,
                paging:false,
                serverSide: true,
                ajax: {
                    url: '{{ route('ajax.get_chi_tiet_theo_lop_va_sach') }}',
                    data: {
                        ma_lop : $("#lop").val(),
                        ma_sach : $("#sach").val(),
                    },
                    dataSrc: ""
                },
                "initComplete": function(settings, json) {
                    checkRadio();
                    $(".click_checkbox").change(function(){
                        checkRadio();
                        process_phat_sach($(this));
                         getSoLuong();
                    });
                }
            });

        }
        function checkRadio(){
            var check = 1;
            $(".click_checkbox").each(function(){
                if(!$(this).is(':checked')){
                    check = 0;
                    return;
                }
            });
            if(check==1){
                $("#checkbox").prop('checked',true);
            }
            else{
                $("#checkbox").prop('checked',false);
            }
        }
        function process_phat_sach(checkbox){
            $.ajax({
                url: '{{ route('ajax.process_phat_sach') }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    ma_sv: checkbox.data('ma_sv'),
                    ma_sach: $("#sach").val(),
                    check: checkbox.is(':checked') ? 1 : 0,
                },
            })
            .done(function() {
                action = checkbox.is(':checked') ? 'Give' : 'Take';
                text = action + ' book successfully';
                $.notify({
                    message: text 
                },{
                    // settings
                    type: 'success'
                });
            })
            .fail(function(response) {
                checkbox.prop('checked',false);
                $("#checkbox").prop('checked',false);
                swal({
                  type: 'error',
                  title: 'Oops...',
                  text: 'Out of books',
                })
            });
            
        }
    </script>
@endpush