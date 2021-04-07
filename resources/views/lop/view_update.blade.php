@extends('layout/layout_gv')
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card card-wizard" id="wizardCard">
                    <div class="header">
                        <h4 class="title">Edit Class</h4>
                    </div>
                    <div class="content">
                        <form method="post" action="{{ route('lop.process_update',['ma'=>$result[0]->ma_lop]) }}">
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
                            @if (Session::has('success'))
                                <p style="color: red">
                                    {{Session::get('success')}}
                                </p>
                            @endif
                        	@foreach ($result as $each)
                        	<input type="hidden" value="{{$each->ma_lop}}" name="ma_lop">
                        		{{-- expr --}}
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control"  placeholder="Major" name="ten_lop" value="{{$each->ten_lop}}">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="row">
                                <div class="col-md-6">
                                    <select id="nganh" name="ma_nganh" class="selectpicker" data-title=" Select Major" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                        @foreach ($arr_nganh as $nganh)
                                            @if ($nganh->ma_nganh == $result[0]->ma_nganh)
                                                <option value="{{$nganh->ma_nganh}}" selected="">{{$nganh->ten_nganh}}</option>
                                            @else
                                                <option value="{{$nganh->ma_nganh}}">{{$nganh->ten_nganh}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select id="khoa" name="ma_khoa" class="selectpicker" data-title="Course Select" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                        @foreach ($arr_khoa as $khoa)
                                            @if ($khoa->ma_khoa == $result[0]->ma_khoa)
                                                <option value="{{$khoa->ma_khoa}}" selected="">{{$khoa->ten_khoa}}</option>
                                            @else
                                                <option value="{{$khoa->ma_khoa}}">{{$khoa->ten_khoa}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Submit</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-4">
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

        </div>
    </div>
</div>
@endsection