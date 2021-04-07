@extends('layout/layout_gv')
@section('content')
<div class="header">
    <h4 class="title">Admin list</h4>
    <p class="category">Table information</p>
</div>
<div class="content table-responsive table-full-width">
    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
            <thead>
                <tr>
					<th>Id</th>
					<th>Name</th>
					<th>Age</th>
					<th>Sex</th>
					<th>Email</th>
					<th>Numberphone</th>
					<th>Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($arr_gv as $each)
                <tr>
					<td>{{$each->ma_gv}}</td>
					<td>{{$each->ten_gv}}</td>
					<td>{{$each->tuoi}}</td>
					<td>
						@if ($each->gioi_tinh==0)
							{{'Female'}}
						@else
							{{'Male'}}
						@endif
				    </td>
					<td>{{$each->email}}</td>
					<td>{{$each->SDT}}</td>
					<td>{{$each->dia_chi}}</td>
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