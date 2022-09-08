@extends('layouts.layoutadmin')
@section('right_content_title')
    <title>Trang quản trị | Halo </title>
@endsection
@section('right_content_css')
@endsection
@section('right_content')
    {{-- <div class="container-fluid"> --}}
    <div class="row tile_count">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
            <div class="count">{{ $totalusr }}</div>
            {{-- <span class="count_bottom"><i class="green">4% </i> From last Week</span> --}}
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-users"></i> Total Groups</span>
            <div class="count">{{ $totalgroup }}</div>
            {{-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last
                    Week</span> --}}
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-home"></i> Total Page</span>
            <div class="count green">{{ $totalschool }}</div>
            {{-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last
                    Week</span> --}}
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-users"></i> Total Group message</span>
            <div class="count">{{ $totalusr }}</div>
            {{-- <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last
                    Week</span> --}}
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Posts</span>
            <div class="count">{{ $totalposts }}</div>
            {{-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last
                    Week</span> --}}
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
            <div class="count">{{ $totalfriend }}</div>
            {{-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last
                    Week</span> --}}
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <iframe src="https://calendar.google.com/calendar/embed?src=dinhlamhuytak489%40gmail.com&ctz=Asia%2FHo_Chi_Minh"
            style="border: 0" width="100%" height="600" frameborder="0" scrolling="no"></iframe>

      </div>
    </div>



    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                    <h2>Thành phần tham gia</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>


                <div class="x_content">
                    <table class="" style="width:100%">

                        <tr>
                            <td>
                                <canvas class="canvasDoughnut" height="140" width="140"
                                    style="margin: 15px 10px 10px 0"></canvas>
                            </td>
                            <td>
                                <table class="tile_info">
                                    <tr>
                                        <td style="width:60%;">
                                            <p><i class="fa fa-square  purple"></i>Sinh Viên </p>
                                        </td>
                                        <td style="width:40%;">
                                            {{ number_format(($sv / $totalusr) * 100, 2, '.', ',') . '%' }} </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><i class="fa fa-square  blue"></i>Học sinh </p>
                                        </td>
                                        <td>{{ number_format(($hs / $totalusr) * 100, 2, '.', ',') . '%' }} </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><i class="fa fa-square green"></i>Khác </p>
                                        </td>
                                        <td>{{ number_format((($totalusr - $hs - $sv) / $totalusr) * 100, 2, '.', ',') . '%' }}
                                        </td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-7" style="overflow:hidden;">
            <span class="sparkline_one" style="height: 160px; padding: 10px 25px;">
                <canvas width="200" height="60"
                    style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
            </span>
            <h4 style="margin:18px">Bài đăng theo tháng</h4>
        </div>
    </div>
    {{-- </div> --}}
@endsection
@section('right_content_js')
    <script>
        function init_chart_doughnut() {
            if (typeof(Chart) === 'undefined') {
                return;
            }
            // console.log('init_chart_doughnut');
            if ($('.canvasDoughnut').length) {
                var chart_doughnut_settings = {
                    type: 'doughnut',
                    tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                    data: {
                        labels: [
                            "Sinh viên",
                            "Khác",
                            "Học sinh",
                        ],
                        datasets: [{
                            data: [{{ number_format(($sv / $totalusr) * 100, 2, '.', ',') }},
                                {{ number_format((($totalusr - $hs - $sv) / $totalusr) * 100, 2, '.', ',') }},
                                {{ number_format(($hs / $totalusr) * 100, 2, '.', ',') }}
                            ],
                            backgroundColor: [
                                // "#BDC3C7",
                                "#9B59B6",
                                // "#E74C3C",
                                "#26B99A",
                                "#3498DB"
                            ],
                            hoverBackgroundColor: [
                                // "#CFD4D8",
                                "#B370CF",
                                // "#E95E4F",
                                "#36CAAB",
                                "#49A9EA"
                            ]
                        }]
                    },
                    options: {
                        legend: false,
                        responsive: false
                    }
                }
                $('.canvasDoughnut').each(function() {
                    var chart_element = $(this);
                    var chart_doughnut = new Chart(chart_element, chart_doughnut_settings);

                });

            }
        }



        function init_sparklines() {

            if (typeof(jQuery.fn.sparkline) === 'undefined') {
                return;
            }
            console.log('init_sparklines');


            $(".sparkline_one").sparkline([
                @foreach ($posttheothang as $tpost)
                    {{ $tpost->slpost . ',' }}
                @endforeach
            ], {
                type: 'bar',
                height: '125',
                barWidth: 18,
                colorMap: {
                    '7': '#a1a1a1'
                },
                barSpacing: 2,
                barColor: '#26B99A'
            });


            $(".sparkline_two").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 5, 6, 7, 5, 4, 3, 5, 6], {
                type: 'bar',
                height: '40',
                barWidth: 9,
                colorMap: {
                    '7': '#a1a1a1'
                },
                barSpacing: 2,
                barColor: '#26B99A'
            });


            $(".sparkline_three").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 5, 6, 7, 5, 4, 3, 5, 6], {
                type: 'line',
                width: '200',
                height: '40',
                lineColor: '#26B99A',
                fillColor: 'rgba(223, 223, 223, 0.57)',
                lineWidth: 2,
                spotColor: '#26B99A',
                minSpotColor: '#26B99A'
            });


            $(".sparkline11").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 6, 2, 4, 3, 4, 5, 4, 5, 4, 3], {
                type: 'bar',
                height: '40',
                barWidth: 8,
                colorMap: {
                    '7': '#a1a1a1'
                },
                barSpacing: 2,
                barColor: '#26B99A'
            });


            $(".sparkline22").sparkline([2, 4, 3, 4, 7, 5, 4, 3, 5, 6, 2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 6], {
                type: 'line',
                height: '40',
                width: '200',
                lineColor: '#26B99A',
                fillColor: '#ffffff',
                lineWidth: 3,
                spotColor: '#34495E',
                minSpotColor: '#34495E'
            });


            $(".sparkline_bar").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 5, 6, 4, 5, 6, 3, 5], {
                type: 'bar',
                colorMap: {
                    '7': '#a1a1a1'
                },
                barColor: '#26B99A'
            });


            $(".sparkline_area").sparkline([5, 6, 7, 9, 9, 5, 3, 2, 2, 4, 6, 7], {
                type: 'line',
                lineColor: '#26B99A',
                fillColor: '#26B99A',
                spotColor: '#4578a0',
                minSpotColor: '#728fb2',
                maxSpotColor: '#6d93c4',
                highlightSpotColor: '#ef5179',
                highlightLineColor: '#8ba8bf',
                spotRadius: 2.5,
                width: 85
            });


            $(".sparkline_line").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 5, 6, 4, 5, 6, 3, 5], {
                type: 'line',
                lineColor: '#26B99A',
                fillColor: '#ffffff',
                width: 85,
                spotColor: '#34495E',
                minSpotColor: '#34495E'
            });


            $(".sparkline_pie").sparkline([1, 1, 2, 1], {
                type: 'pie',
                sliceColors: ['#26B99A', '#ccc', '#75BCDD', '#D66DE2']
            });


            $(".sparkline_discreet").sparkline([4, 6, 7, 7, 4, 3, 2, 1, 4, 4, 2, 4, 3, 7, 8, 9, 7, 6, 4, 3], {
                type: 'discrete',
                barWidth: 3,
                lineColor: '#26B99A',
                width: '85',
            });


        };
    </script>
@endsection
