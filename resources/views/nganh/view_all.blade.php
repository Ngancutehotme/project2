@extends('layout/layout_gv')
@section('content')
<div class="header">
    Industry list 
    <a href="{{ route('nganh.view_insert') }}"><p class="text-left">Insert Major</p></a>
</div>
<div class="content table-responsive table-full-width">
        {{-- <a href="{{ route('khoa.view_insert') }}" class="btn btn-primary">Thêm khóa học</a> --}}
        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th class="disabled-sorting text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($arr_nganh as $each)
                <tr>
                    <td>{{$each->ma_nganh}}</td>
                    <td>{{$each->ten_nganh}}</td>
                    <td class="text-right">
                       {{--  <a href="#" class="btn btn-simple btn-info btn-icon like"><i class="fa fa-heart"></i></a> --}}
                        <a href="{{ route('nganh.view_update',['ma'=>$each->ma_nganh]) }}" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                        {{-- <a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="fa fa-times"></i></a> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
@push('js')
    <script type="text/javascript">
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            responsive: true,
            language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
            }

        });


        var table = $('#datatables').DataTable();
    </script>
@endpush