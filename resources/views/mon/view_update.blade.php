@extends('layout/layout_gv')
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card card-wizard" id="wizardCard">
                    <div class="header">
                        <h4 class="title">Edit Subject</h4>
                    </div>
                    <div class="content">
                        <form method="post" action="{{ route('mon.process_update',['ma'=>$result[0]->ma_mon]) }}">
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
                        	@foreach ($result as $each)
                        	<input type="hidden" value="{{$each->ma_mon}}" name="ma_mon">
                        		{{-- expr --}}
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="ten_mon" value="{{$each->ten_mon}}">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="row">
                                <div class="col-md-6">
                                    <select id="nganh" name="ma_nganh" class="selectpicker" data-title="Select Industry" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                        @foreach ($arr_nganh as $nganh)
                                            @if ($nganh->ma_nganh == $result[0]->ma_nganh)
                                                <option value="{{$nganh->ma_nganh}}" selected="">{{$nganh->ten_nganh}}</option>
                                            @else
                                                <option value="{{$nganh->ma_nganh}}">{{$nganh->ten_nganh}}</option>
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
        </div>
    </div>
</div>
@endsection