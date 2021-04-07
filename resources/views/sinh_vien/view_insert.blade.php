@extends('layout/layout_gv')
@section('content')
{{--< a href="{{ route('sinh_vien.back') }}">
    <i class="pe-7s-back"></i>
</a> --}}
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="header">
                        <h4 class="title">Insert Profile</h4>
                    </div>
                    <div class="content">
                        <form method="post" action="{{ route('sinh_vien.process_insert')}}" enctype="multipart/form-data">
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
                            @if (Session::has('error'))
                                <p style="color: red">
                                    {{Session::get('error')}}
                                </p>
                            @endif
                            @if (Session::has('success'))
                                <p style="color: red">
                                    {{Session::get('success')}}
                                </p>
                            @endif

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control"  placeholder="Username" name="ten_sv" value="{{old('ten_sv')}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date brith</label>
                                        <input type="date" class="form-control" placeholder="Date brith" name="ngay_sinh" value="{{old('ngay_sinh')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label >Password</label>
                                        <input type="password" class="form-control" placeholder="Password" name="mat_khau" value="{{old('mat_khau')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" placeholder="Number phone" name="SDT" value="{{old('SDT')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender: </label>
                                        <input type="radio"  placeholder="Last Name" name="gioi_tinh" checked="" value="1">Male
                                        <input type="radio" placeholder="Last Name" name="gioi_tinh" value="0">Female
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" placeholder="Home Address" name="dia_chi" value="{{old('dia_chi')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <select id="nganh" name="nganh" class="selectpicker" data-title="Majors" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                            @foreach ($array_nganh as $nganh)
                                                <option value="{{$nganh->ma_nganh}}">{{$nganh->ten_nganh}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="khoa" name="khoa" class="selectpicker" data-title="Khóa" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
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

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" class="form-control" accept="image/png,image/jpeg" name="anh" value="{{old('anh')}}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Sunmit</button>
                            <div class="clearfix"></div>
                        </form>
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
            var errors = $("#error").val();
            if(errors == 1){
                alert("không thành công");
            }
            $("#nganh, #khoa").change(function(){
                // alert($("#nganh").val());alert($("#nganh").val());
                if($("#khoa").val() == '' || $("#nganh").val() == ''){
                    return false;
                }
                getLop();
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
    </script>
@endpush