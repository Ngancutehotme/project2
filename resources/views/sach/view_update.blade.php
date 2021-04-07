@extends('layout/layout_gv')
@section('content')
<div class="header">
    <h4 class="title">Books Update</h4>
</div>
<div class="content">
    <form method="post" action="{{ route('sach.process_update',['ma'=>$result[0]->ma_sach]) }}">
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
                    <input type="hidden" name="ma_sach" value="{{$result[0]->ma_sach}}">
                    <input type="text" class="form-control"  placeholder="Sách" name="ten_sach" value="{{$result[0]->ten_sach}}">
                </div>
                <div class="form-group">
                    <label>Quabtity
                    </label>
                    <input type="number" class="form-control"  placeholder="Quabtity" name="so_luong" value="{{$result[0]->so_luong}}">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="col-md-6">
                    <select id="nganh" name="ma_nganh" class="selectpicker" data-title="Select Major" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                        @foreach ($arr_nganh as $nganh)
                            <option  value="{{$nganh->ma_nganh}}"
                                <?php if ($nganh->ma_nganh==$nganh_theo_mon[0]->ma_nganh): ?>
                                    {{"selected"}}
                                <?php endif ?>>{{$nganh->ten_nganh}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6" id="div_mon">
                    <select id="mon" name="ma_mon" class="selectpicker" data-title="Subject" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                        <option></option>
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
                var ma_mon = $("#ma_mon").val();
                // alert(ma_mon)
                
                $(response).each(function() {
                    var selected = '';
                    if (this.ma_mon == '{{$result[0]->ma_mon}}') {
                        selected = 'selected';
                    }
                    $("#mon").append(`
                        <option value='${this.ma_mon}' ${selected}>
                            ${this.ten_mon}
                        </option>
                    `);
                });
                $('#mon').selectpicker('refresh');
            });
        $(document).ready(function() {
            var errors = $("#error").val();
            if(errors == 1){
                alert("không thành công");
            };
            // alert($("#mon").val());
            $("#nganh").change(function(){
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