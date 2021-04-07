
@extends('layout/layout_gv')
@section('content')
<style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Open+Sans);

    body{
      background: #f2f2f2;
      font-family: 'Open Sans', sans-serif;
  }

  .search {
      width: 100%;
      position: relative;
      display: flex;
  }

  .searchTerm {
      width: 100%;
      border: 3px solid #00B4CC;
      border-right: none;
      padding: 5px;
      /*height: 20px;*/
      border-radius: 5px 0 0 5px;
      outline: none;
      color: #9DBFAF;
  }

  .searchTerm:focus{
      color: #00B4CC;
  }

  .searchButton {
      width: 40px;
      height: 36px;
      border: 1px solid #00B4CC;
      background: #00B4CC;
      text-align: center;
      color: #fff;
      border-radius: 0 5px 5px 0;
      cursor: pointer;
      font-size: 20px;
  }

  /*Resize the wrap to see the search bar change!*/
  .wrap{
      width: 30%;
      position: absolute;
      top: 50%;
      left: 80%;
      transform: translate(-50%, -50%);
  }
</style>
<div class="header">
    <h4 class="title">Class list</h4>
    <p class="category">Class</p>
    <a href="{{ route('lop.view_insert') }}"><p>Class Insert</p></a>
</div>

<div class="clearfix"></div>
<div class="col-md-6">
    <legend>Select to view</legend>
        <div class="row">
            <div class="col-md-6">
                <select id="nganh" name="cities" class="search_item" style="width: 200px;" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                    <option value="0" disabled selected>
                        Select Major
                    </option>
                    @foreach ($arr_nganh as $nganh)
                        <option value="{{$nganh->ma_nganh}}">{{$nganh->ten_nganh}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <select id="khoa" name="cities" class="search_item" style="width: 200px;" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                    <option value="0" disabled selected>
                        Select Course
                    </option>
                    @foreach ($arr_khoa as $khoa)
                        <option value="{{$khoa->ma_khoa}}">{{$khoa->ten_khoa}}</option>
                    @endforeach
                </select>
            </div>
        </div>
</div>
<div class="content table-responsive table-full-width">
    {{-- <a href="{{ route('khoa.view_insert') }}" class="btn btn-primary">Thêm khóa học</a> --}}
    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Class</th>
                <th>Major</th>
                <th class="disabled-sorting ">Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection
@push('js')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.search_item').select2({
              width: 'resolve'
            });
            $("#nganh, #khoa").change(function(){
                getTable();
            });
        });
        // function getTableSearch() {
        //     $('#datatables').dataTable().fnDestroy();
        //     $('#datatables').DataTable({
        //         pagingType: "full_numbers",
        //         lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        //         responsive: true,
        //         language: {
        //             search: "_INPUT_",
        //             searchPlaceholder: "Search records",
        //         },
        //         searching:false,
        //         sort:false,
        //         paging:false,
        //         serverSide: true,
        //         ajax: {
        //             url: ' route('ajax.tim_kiem') }}',
        //             data: {
        //                 tim_kiem = $("#tim_kiem").val()
        //             },
        //             dataSrc: ""
        //         }
        //     });
        // }
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
                    url: '{{ route('ajax.get_table_lop_theo_nganh_khoa') }}',
                    data: {
                        ma_khoa : $("#khoa").val(),
                        ma_nganh : $("#nganh").val()
                    },
                    dataSrc: ""
                }
            });
        }

        
    </script>
@endpush