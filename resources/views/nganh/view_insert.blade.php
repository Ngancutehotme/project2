@extends('layout/layout_gv')
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Insert Major</h4>
                    </div>
                    <div class="content">
                        <form method="post" action="{{ route('nganh.process_insert') }}">
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
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control"  placeholder="Name..." name="ten_nganh" value="{{old('ten_nganh')}}">
                                    </div>
                                </div>
                            </div>
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