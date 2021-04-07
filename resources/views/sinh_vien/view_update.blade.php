@extends('layout/layout_gv')
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Update Profile Student</h4>
                    </div>
                    <div class="content">
                        <form method="post" action="{{ route('sinh_vien.process_update',['ma'=>$result[0]->ma_sv])}}" enctype="multipart/form-data">
                        	{{csrf_field()}}
                        	{{ method_field("PUT") }}

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
                            {{-- dd($result); --}}
                            @foreach ($result as $each)
                            <input type="hidden" value="{{$each->ma_sv}}" name="ma_sv">
                            {{-- expr --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control"  placeholder="Username" name="ten_sv" value="{{$each->ten_sv}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date brith</label>
                                        <input type="date" class="form-control" placeholder="Date brith" name="ngay_sinh" value="{{$each->ngay_sinh}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{$each->email}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" placeholder="Phone Number" name="SDT" value="{{$each->SDT}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender: </label>
                                        <input type="radio"  placeholder="Gender" name="gioi_tinh" value="1" 
                                        @if ($each->gioi_tinh==1)
                                        {{"checked"}}
                                        @endif>Male
                                        <input type="radio" placeholder="Gender" name="gioi_tinh" value="0" 
                                        @if ($each->gioi_tinh==0)
                                        {{"checked"}}
                                        @endif>Female
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" placeholder="Home Address" name="dia_chi" value="{{$each->dia_chi}}">
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-4">
                                        <select id="nganh" name="nganh" class="selectpicker" data-title="Major" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                            @foreach ($arr_nganh as $nganh)
                                            <option value="{{$nganh->ma_nganh}}" 
                                                @if ($get_nganh_khoa_theo_lop[0]->ma_nganh == $nganh->ma_nganh)
                                                {{"selected"}}
                                                @endif>{{$nganh->ten_nganh}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select id="khoa" name="khoa" class="selectpicker" data-title="Course" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                @foreach ($arr_khoa as $khoa)
                                                <option value="{{$khoa->ma_khoa}}"
                                                    @if ($get_nganh_khoa_theo_lop[0]->ma_khoa == $khoa->ma_khoa)
                                                    {{"selected"}}
                                                    @endif>{{$khoa->ten_khoa}}</option>
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
                                                <input type="hidden" name="anh_cu" value="{{$each->anh}}">
                                                <input type="file" class="form-control" accept="image/png,image/jpeg" name="anh">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Submit</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="image">
                                <img src="{{asset('img/full-screen-image-3.jpg')}}" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                    <a href="#">
                                        <img class="avatar border-gray" src="{{asset("uploads/image/$each->anh")}}" alt="..."/>

                                        <h4 class="title">{{$each->ten_sv}}<br />
                                         {{-- <small>michael24</small> --}}
                                     </h4>
                                 </a>
                             </div>
                       {{--  <p class="description text-center"> "Lamborghini Mercy <br>
                                            Your chick she so thirsty <br>
                                            I'm in that two seat Lambo"
                                        </p> --}}
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
                                        <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
                                        <button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @endsection
                @push('js')
                <script type="text/javascript">
                    $.ajax({
                        url: '{{ route('ajax.get_array_lop_theo_nganh_khoa') }}',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            ma_nganh: $("#nganh").val(),
                            ma_khoa: $("#khoa").val()
                        },
                    })
                    .done(function(response) {
                        $("#div_lop").show();
                        $("#lop").html('');
                        var ma_lop = $("#ma_lop").val();
            // alert(ma_mon)
            
            $(response).each(function() {
                var selected = '';
                if (this.ma_lop == '{{$result[0]->ma_lop}}') {
                    selected = 'selected';
                }
                $("#lop").append(`
                    <option value='${this.ma_lop}' ${selected}>
                    ${this.ten_lop}
                    </option>
                    `);
            });
            $('#lop').selectpicker('refresh');
        });
                    $(document).ready(function() {
                        var errors = $("#error").val();
                        if(errors == 1){
                            alert("không thành công");
                        };
            // alert($("#mon").val());
            $("#nganh, #khoa").change(function(){
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
                                ma_khoa: $("#khoa").val()
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