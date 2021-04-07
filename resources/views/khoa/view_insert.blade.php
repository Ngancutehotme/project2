@extends('layout/layout_gv')
@section('content')
<div class="header">
    <h4 class="title">Insert Course</h4>
</div>
<div class="content">
    <form method="post" action="{{ route('khoa.process_insert') }}">
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
        {{-- @if (Session::has('error'))
        @php
        $error = Session::get('error');
        @endphp
        @endif
        @if (Session::has('success')) 
        @php
        $success = Session::get('success');
        @endphp
        @endif --}}

        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label>Name
                    </label>
                    <input type="text" class="form-control" id="course" placeholder="Course" name="ten_khoa" value="{{old('ten_khoa')}}">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-info btn-fill pull-left" onclick="thong_bao()">Submit</button>
        <div class="clearfix"></div>
    </form>
</div>
@endsection
@push('js')
<script type="text/javascript">
    $(document).ready(function() {

        // alert($("#error").val());
        // var success = $("#success").val();
        // if(typeof error !== 'undefined'){
        //     alert("Data already exists");
        // }else if(typeof success !== 'undefined'){
        //     swal({
        //         title: "Successful",
        //         text: "You clicked the button!",
        //         buttonsStyling: false,
        //         confirmButtonClass: "btn btn-success btn-fill",
        //         type: "success"
        //     }).catch(swal.noop)
        // }
    });
    function thong_bao(){
        sessionStorage.clear();
        var error = '<?php 
        if (isset($error)) {
            echo $error;
        }
        ?>';
        var success = '<?php 
        if (isset($success)) {
            echo $success;
        }
        ?>';
        if(error) {
            alert(error);
        }else if(success){
            swal({
                title: success,
                text: "You clicked the button!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success btn-fill",
                type: "success"
            }).catch(swal.noop)
        }
    }
</script>
@endpush