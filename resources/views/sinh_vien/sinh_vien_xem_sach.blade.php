@extends('layout/layout_sv')
@section('content')
<div class="toolbar">
  <h4>{{"Ngành: "}}{{$arr_nganh[0]->ten_nganh}} - {{$arr_lop[0]->ten_lop}}</h4>
</div>
<div class="fresh-datatables">
 <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
  <thead>
   <tr>
    <th>Sujects</th>
    <th>Books</th>
    <th>Distributor</th>
    <th>Date</th>
    <th class="disabled-sorting text-center">Status</th>
  </tr>
</thead>
<tfoot>
 <tr>
    <th>Sujects</th>
    <th>Books</th>
    <th>Distributor</th>
    <th>Date</th>
    <th class="disabled-sorting text-center">Status</th>
</tr>
</tfoot>
<tbody>
  @foreach ($array as $each)
    <tr>
      <td>{{$each->ten_mon}}</td>
      <td>{{$each->ten_sach}}</td>
      @if (isset($each->ten_gv))
        <td>{{$each->ten_gv}}</td>
      @else
        <td>{{"trống"}}</td>
      @endif
      @if (isset($each->ngay_phat))
        <td>{{$each->ngay_phat}}</td>
      @else
        <td>{{"trống"}}</td>
      @endif
      @if (isset($each->tinh_trang))
        <td class="text-center">
        <a href="#" class="font-icon-detail"><p class="fa fa-check-square-o"></p></a>
        </td>
      @else
        <td class="text-center">
        <a href="#" class="btn btn-simple btn-danger btn-icon remove"><p class="fa fa-times"></p></a>
        </td>
      @endif
    </tr>
  @endforeach
</tbody>
</table>
</div>
@endsection

@push('js')
<script type="text/javascript">
  $(document).ready(function() {
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

    // Edit record
    table.on( 'click', '.edit', function () {
      $tr = $(this).closest('tr');

      if($tr.hasClass('child')){
        $tr = $tr.prev('.parent');
      }

      var data = table.row($tr).data();
      alert( 'You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.' );
    } );

    // Delete a record
    table.on( 'click', '.remove', function (e) {
      $tr = $(this).closest('tr');
      table.row($tr).remove().draw();
      e.preventDefault();
    } );

    //Like record
    table.on( 'click', '.like', function () {
      alert('You clicked on Like button');
    });
  });
</script>
@endpush