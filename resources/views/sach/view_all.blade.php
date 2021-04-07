@extends('layout/layout_gv')
@section('content')
<div class="header">
    <h4 class="title">Book list</h4>
    <p class="category">Books</p>
    <a href="{{ route('sach.view_insert') }}"><p class="text-left">Insert book for subject</p></a>
</div>

<div class="col-md-6">
    <legend>Select to view</legend>
        <div class="row">
            <div class="col-md-6">
                <select id="nganh" name="cities" class="selectpicker" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                    <option value="0" disabled selected>
                        Select Major
                    </option>
                    @foreach ($arr_nganh as $nganh)
                        <option value="{{$nganh->ma_nganh}}">{{$nganh->ten_nganh}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4" style="display: none;" id="div_mon">
                <select id="mon" name="mon" class="selectpicker" data-title="Subject" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                </select>
            </div>
        </div>
</div>
<div class="content table-responsive table-full-width">
    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name book</th>
                <th>Quantity</th>
                <th>Name subject</th>
                <th class="disabled-sorting ">Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#nganh").change(function(){
                if($("#nganh").val() == ''){
                    return false;
                }
                getMon();
            });
            $("#mon").change(function(){
                getTable();
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
        function getTable() {

            $('#datatables').dataTable().fnDestroy();
            $('#datatables').DataTable({
                pagingType: "full_numbers",
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                },
                searching:false,
                sort:false,
                paging:false,
                serverSide: true,
                ajax: {
                    url: '{{ route('ajax.get_sach_theo_mon') }}',
                    data: {
                        ma_mon : $("#mon").val()
                    },
                    dataSrc: ""
                }
            });
        }
    </script>
@endpush