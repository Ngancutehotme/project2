@extends('layout/layout_gv')
@section('content')
<div class="header">
    <h4 class="title">Subject Insert</h4>
</div>
<div class="content">
    <form method="post" action="{{ route('mon.process_insert') }}">
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
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Name
                    </label>
                    <input type="text" class="form-control"  placeholder="Môn" name="ten_mon" value="{{old('ten_mon')}}">
                </div>
                <div class="col-md-7">
                    <select id="nganh" name="ma_nganh" class="selectpicker" data-title="Select Industry" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                        @foreach ($arr_nganh as $nganh)
                            <option  value="{{$nganh->ma_nganh}}">{{$nganh->ten_nganh}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-info btn-fill pull-right">Submit</button>
        <div class="clearfix"></div>
    </form>
</div>

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