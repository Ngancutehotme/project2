@extends('layout/layout_gv')
@section('content')
<div class="header">
    <h4 class="title">Subject list</h4>
    <p class="category">Subject</p>
    <a href="{{ route('mon.view_insert') }}"><p class="text-left">Subject insert</p></a>
</div>

<div class="col-md-6">
    <legend>Select to view</legend>
        <div class="row">
            <div class="col-md-6">
                <select id="nganh" name="cities" class="selectpicker" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                    <option value="0" disabled selected>
                        Select Industry
                    </option>
                    @foreach ($arr_nganh as $nganh)
                        <option value="{{$nganh->ma_nganh}}">{{$nganh->ten_nganh}}</option>
                    @endforeach
                </select>
            </div>
        </div>
</div>
<div class="content table-responsive table-full-width">
    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Subject</th>
                <th>Industry</th>
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
                getTable();
                // alert($("#nganh").val());
            });
        });
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
                serverSide: true,
                paging: false,
                searching: false,
                ajax: {
                    url: '{{ route('ajax.get_table_mon_theo_nganh') }}',
                    data: {
                        ma_nganh : $("#nganh").val()
                    },
                    dataSrc: ""
                }
            });
        }

        
    </script>
@endpush