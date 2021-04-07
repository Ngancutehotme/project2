@extends('layout/layout_gv')
@section('content')
<div class="header">
    <h4 class="title">Book Insert</h4>
</div>
<div class="content">
    <form method="post" action="{{ route('sach.process_insert') }}">
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
                    <input type="text" class="form-control"  placeholder="Book" name="ten_sach" value="{{old('ten_sach')}}">
                </div>
                <div class="form-group">
                    <label>Quantity
                    </label>
                    <input type="number" class="form-control"  placeholder="Quantity" name="so_luong" value="{{old('so_luong')}}">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="col-md-6">
                    <select id="nganh" name="ma_nganh" class="selectpicker" data-title="Select Major" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                        @foreach ($arr_nganh as $nganh)
                            <option  value="{{$nganh->ma_nganh}}">{{$nganh->ten_nganh}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6" style="display: none;" id="div_mon">
                    <select id="mon" name="ma_mon" class="selectpicker" data-title="Subject" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
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
            };
            $("#nganh").change(function(){
                if($("#nganh").val() == ''){
                    return false;
                }
                getMon();
            });
        });
        function getMon() {
            $.ajax({
                url: '{{ route('ajax.get_array_mon_theo_nganh') }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    ma_nganh: $("#nganh").val()
                },
            })
            .done(function(response) {
                $("#div_mon").show();
                $("#mon").html('');
                $(response).each(function() {
                    $("#mon").append(`
                        <option value='${this.ma_mon}'>
                            ${this.ten_mon}
                        </option>
                    `);
                });
                $('#mon').selectpicker('refresh');
            });
            
        }
    </script>
@endpush