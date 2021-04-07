@extends('layout/layout_gv')
@section('content')
<div class="main-content">
    <div class="header">
        <h4 class="title">Statistic</h4>
    </div>
    <div class="container-fluid">
    <div class="clearfix"></div>
       <div class="row">
        <div class="col-md-3">
            <select id="nganh" name="nganh" class="selectpicker" data-title="Major" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                @foreach ($array_nganh as $nganh)
                <option value="{{$nganh->ma_nganh}}">{{$nganh->ten_nganh}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select id="khoa" name="khoa" class="selectpicker" data-title="Course" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                @foreach ($array_khoa as $khoa)
                <option value="{{$khoa->ma_khoa}}">{{$khoa->ten_khoa}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3" style="display: none;" id="div_mon">
            <select id="mon" name="mon" class="selectpicker" data-title="Subject" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
            </select>
        </div>
        <div class="col-md-3" style="display: none;" id="div_sach">
            <select id="sach" name="sach[]" class="selectpicker" data-title="Books" data-style="btn-default btn-block" data-menu-style="dropdown-blue" multiple>
            </select>
        </div>
    </div>
    <div class="row">
        <p></p>
    </div>
    <div id="container"></div>
    {{-- <div id="chart" class="row" style="display: none;">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    Activity
                    <p class="category">Multiple Bars Chart</p>
                </div>
                <div class="content">
                    <div id="chartActivity" class="ct-chart "></div>
                </div>
            </div>
        </div>
    </div> --}}

</div>
</div>

<footer class="footer">
    <div class="container-fluid">
        <nav class="pull-left">
            <ul>
                <li>
                    <a href="#">
                        Home
                    </a>
                </li>
                <li>
                    <a href="#">
                        Company
                    </a>
                </li>
                <li>
                    <a href="#">
                        Portfolio
                    </a>
                </li>
                <li>
                    <a href="#">
                     Blog
                 </a>
             </li>
         </ul>
     </nav>
     <p class="copyright pull-right">
        &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
    </p>
</div>
</footer>


</div>
</div>
@endsection
@push('js')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<script>
    $(document).ready(function(){
        $("#nganh,#khoa").change(function(){
            hien_thi();
        });
    });
    function hien_thi(){
        if($("#nganh").val() == '' || $("#khoa").val() == ''){
            return false;
        }
        $.ajax({
            url: '{{ route('ajax.get_so_luong') }}',
            type: 'GET',
            dataType: 'json',
            data: {
                ma_nganh: $("#nganh").val(),
                ma_khoa: $("#khoa").val()
            },
            success:function(result){
                getChart(result);
            }
        })
    }
    function getData(data){
        return {
            series : Object.keys(data).map(function(index, elem) {
                return {
                    name : data[index].ten_lop,
                    y : data[index].tong_so_chua_nhan,
                    drilldown : data[index].ten_lop,
                };
            }),
            drilldown: Object.keys(data).map(function(index) {
                return {
                    name : data[index].ten_lop,
                    id : data[index].ten_lop,
                    data: Object.keys(data[index].tung_sach).map(function(key) {
                        return [
                        data[index].tung_sach[key].ten_sach,
                        data[index].tung_sach[key].so_luong_chua_nhan
                        ];
                    })

                };
            })
        };

    }
    function getChart(data){
        let data_series = getData(data).series;
        let data_drilldown = getData(data).drilldown;
        Highcharts.chart('container', {
          chart: {
            type: 'column'
        },
        title: {
            text: 'Books per class'
        },
        xAxis: {
            type: 'category'
        },
        legend: {
            enabled: false
        },
        yAxis: {
            min: 0,
            title: {
              text: 'Books'
          }
      },
      tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.f}</b> of total<br/>'
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.f}'
            }
        }
    },
    series:[
    { 
        name: 'Class Name',
        colorByPoint: true,
        data: data_series
    }
    ],
    drilldown: {
        series: data_drilldown
    }
});
    }
</script>
@endpush