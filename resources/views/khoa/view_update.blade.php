@extends('layout/layout_gv')
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div><h4 class="title"><a href="{{ route('khoa.view_all') }}">View all</a></h4></div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Edit Course</h4>
                    </div>
                    <div class="content">
                        <form method="post" action="{{ route('khoa.process_update',['ma'=>$result[0]->ma_khoa]) }}">
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
                        	@foreach ($result as $each)
                        	<input type="hidden" value="{{$each->ma_khoa}}" name="ma_khoa">
                        		{{-- expr --}}
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control"  placeholder="Course" name="ten_khoa" value="{{$each->ten_khoa}}">
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