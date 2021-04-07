@extends('layout/layout_gv')
@section('content')
<div class="header">
    <h4 class="title">Class Insert</h4>
</div>
<div class="content">
    <form method="post" action="{{ route('lop.process_insert_nhanh') }}">
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

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Number class
                    </label>
                    <input type="text" class="form-control"  placeholder="Quantity Class" name="so_lop" value="{{old('so_lop')}}">
                </div>
                <div class="form-group">
                    <label>Name
                    </label>
                    <input type="text" class="form-control"  placeholder="vd: BKD" name="ten_lop" value="{{old('ten_lop')}}">
                </div>
                <div class="col-md-6">
                    <select id="nganh" name="ma_nganh" class="selectpicker" data-title="Select Major" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                        @foreach ($arr_nganh as $nganh)
                            <option  value="{{$nganh->ma_nganh}}">{{$nganh->ten_nganh}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <select id="khoa" name="ma_khoa" class="selectpicker" data-title="Select Course" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                        @foreach ($arr_khoa as $khoa)
                            <option  value="{{$khoa->ma_khoa}}">{{$khoa->ten_khoa}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-info btn-fill pull-right">Submit</button>
        <div class="clearfix"></div>
    </form>
</div><div class="header">
    <h4 class="title">Insert Class</h4>
</div>
<div class="content">
    <form method="post" action="{{ route('lop.process_insert') }}">
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
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Name
                    </label>
                    <input type="text" class="form-control"  placeholder="Vd: BIT01" name="ten_lop" value="{{old('ten_lop')}}">
                </div>
                <div class="col-md-6">
                    <select id="nganh" name="ma_nganh" class="selectpicker" data-title="Select Major" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                        @foreach ($arr_nganh as $nganh)
                            <option  value="{{$nganh->ma_nganh}}">{{$nganh->ten_nganh}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <select id="khoa" name="ma_khoa" class="selectpicker" data-title="Select Course" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                        @foreach ($arr_khoa as $khoa)
                            <option  value="{{$khoa->ma_khoa}}">{{$khoa->ten_khoa}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-info btn-fill pull-right">Insert Profile</button>
        <div class="clearfix"></div>
    </form>
</div>

{{--<div class="col-md-4">
<div class="card card-user">
<div class="image">
    <img src="../../assets/img/full-screen-image-3.jpg" alt="..."/>
</div>
<div class="content">
    <div class="author">
         <a href="#">
        <img class="avatar border-gray" src="../../assets/img/default-avatar.png" alt="..."/>

          <h4 class="title">Tania Andrew<br />
             <small>michael24</small>
          </h4>
        </a>
    </div>
    <p class="description text-center"> "Lamborghini Mercy <br>
                        Your chick she so thirsty <br>
                        I'm in that two seat Lambo"
    </p>
</div>
<hr>
<div class="text-center">
    <button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
    <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
    <button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>

</div>
</div>
</div> --}}

@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            var errors = $("#error").val();
            if(errors == 1){
                alert("không thành công");
            }
        });
    </script>
@endpush