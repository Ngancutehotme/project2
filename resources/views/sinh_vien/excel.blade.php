@extends('layout/layout_gv')
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"> 
                @if (Session::has('success'))
                <h4 style="color: red;">
                    {{Session::get('success')}}
                </h4>
                @endif
                @if (Session::has('error'))
                <h4 style="color: red;">
                    {{Session::get('error')}}
                </h4>
                @endif

                <div class="card">
                    <div class="header">Create file excel <a href="{{ route('sinh_vien.download_file_excel_mau') }}">Dowload file excel</a></div>
                    <div class="content">
                        <form class="form-horizontal" method="post" action="{{ route('sinh_vien.create_file_excel') }}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{ method_field("PUT") }}
                            <div class="form-group">
                                <label class="col-md-3 control-label">Number of columns</label>
                                <div class="col-md-9" id="div_so_cot">
                                    <input type="number" class="form-control" id="so_cot">
                                </div>
                            </div>

                            <div class="form-group" id="div_table_excel" style="display: none;">
                            </div>

                            <div class="form-group">
                                <label class="col-md-3"></label>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-fill btn-info">Submit</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div> <!-- end card -->

            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="header">Insert excel</div>
                        <div class="content">
                            <form class="form-horizontal" method="post" action="{{ route('sinh_vien.insert_excel') }}" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Click file</label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="ds_sinh_vien">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3"></label>
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-fill btn-info">Insert</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> <!-- end card -->

                </div> <!--  end col-md-6  -->
            </div> <!--  end col-md-6  -->
        </div> 
    </div> 
    @endsection
    @push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#so_cot').change(function(event) {
            // console.log($('#so_cot').val());
            var n = $('#so_cot').val();
            $('#div_table_excel').show();
            $('#div_table_excel').empty();
            for (var i = 1; i <= n; i++) {
                $('#div_table_excel').append(`
                    Column ${i}: <input type="text" class="form-control" name="cot_excel[${i}]"><br>
                    `);
            }
        });

        });

    </script>
    @endpush