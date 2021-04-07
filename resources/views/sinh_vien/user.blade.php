@extends('layout/layout_sv')
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Edit Profile</h4>
                    </div>
                    <div class="content">
                        <form method="post" action="{{ route('quan_ly_sinh_vien.process_edit_profile')}}" enctype="multipart/form-data">
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

                            @foreach ($result as $each)
                            <input type="hidden" value="{{$each->ma_sv}}" name="ma_sv">
                            {{-- expr --}}
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control"  placeholder="Username" name="ten_sv" value="{{$each->ten_sv}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
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
                                        <input type="radio"  placeholder="Last Name" name="gioi_tinh" value="1" 
                                        @if ($each->gioi_tinh==1)
                                        {{"checked"}}
                                        @endif>Male
                                        <input type="radio" placeholder="Last Name" name="gioi_tinh" value="0" 
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
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <a href="http://www.facebook.com/" target="_blank" class="btn btn-simple"><i class="fa fa-facebook-square"></i></a>
                                        <a href="http://twitter.com/" target="_blank" class="btn btn-simple"><i class="fa fa-twitter"></i></a>
                                        <a href="http://google.com/" target="_blank" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></a>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @endsection