@extends('layout/layout_gv')
@section('content')
<div class="header">
    <h4 class="title">Students list</h4>
    <p class="category">Students</p>
    <a href="{{ route('sinh_vien.view_insert') }}"><p class="text-left">Insert students</p></a>
</div>

<div class="col-md-6">
    <legend>Select to view</legend>
    <div class="row">
        <div class="col-md-4">
            <select id="nganh" name="nganh" class="selectpicker" data-title="Majors" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                @foreach ($array_nganh as $nganh)
                <option value="{{$nganh->ma_nganh}}">{{$nganh->ten_nganh}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <select id="khoa" name="khoa" class="selectpicker" data-title="Course" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                @foreach ($array_khoa as $khoa)
                <option value="{{$khoa->ma_khoa}}">{{$khoa->ten_khoa}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4" style="display: none;" id="div_lop">
            <select id="lop" name="lop" class="selectpicker" data-title="Class" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
            </select>
        </div>
    </div>
</div>
<div class="content table-responsive table-full-width">
    {{-- <a href="{{ route('khoa.view_insert') }}" class="btn btn-primary">Thêm khóa học</a> --}}
    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Full Name</th>
                <th>Image</th>
                <th>Date birth</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Phone number</th>
                <th>Addess</th>
                <th>Class</th>
                <th class="disabled-sorting">Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection
@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        $("#nganh, #khoa").change(function(){
            if($("#khoa").val() == '' || $("#nganh").val() == ''){
                return false;
            }
            getLop();
        });
        $("#lop").change(function(){
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
                url: '{{ route('ajax.get_sinh_vien_theo_lop') }}',
                data: {
                    ma_lop : $("#lop").val()
                },
                dataSrc: ""
            }
        });
    }
</script>
@endpush