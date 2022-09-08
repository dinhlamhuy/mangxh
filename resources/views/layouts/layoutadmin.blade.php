<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('/storage/app/assets/img/nen/logo1.png') }}" type="image/png">


    {{-- <title>Trang quản trị - Halo | Mạng xã hội</title> --}}
    @yield('right_content_title')


    <link href="{{ asset('public/vendor/bootstrap2/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('public/vendor/font-awesome-4/css/font-awesome.min.css') }}" rel="stylesheet">

    <link href="{{ asset('public/vendor/nprogress/nprogress.css') }}" rel="stylesheet">

    <link href="{{ asset('public/vendor/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    {{-- <link href="http://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <link href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">

    <link href="{{ asset('public/css/custom.min.css') }}" rel="stylesheet">
    <style>
        .logo {
            background: linear-gradient(315deg, #f0cd1f 0%, #f53803 74%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-style: italic;
            font-weight: bold;
            font-size: 24px;

        }

    </style>
    @yield('right_content_css')

</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0; ">
                        <a href="{{ url('admin/dashboard') }}" class="site_title"><img
                                src="{{ asset('/storage/app/assets/img/nen/logo1.png') }}" style="height: 40px;"
                                alt=""> <b class="logo" style="margin-left:5px; ">Halo</b></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="{{ asset('/storage/app/assets/img/avatar/iconadmin.png') }}" alt="..."
                                class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>{{ Session::get('ad_account') }}</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>Danh mục</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-home"></i> Trang chủ <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>

                                    </ul>
                                </li>
                                <li><a><i class="fa fa-edit"></i> QL bài đăng <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ url('/admin/dsbaidang') }}">Danh sách bài đăng</a></li>
                                        <li><a href="{{ url('/admin/dsbaidangvipham') }}">Danh sách bài đăng bị tố
                                                cáo</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-user"></i> QL người dùng <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ url('/admin/qluser') }}">Danh sách người dùng</a></li>
                                        <li><a href="{{ url('/admin/qlusersv') }}">Danh sách sinh viên</a></li>
                                        <li><a href="{{ url('/admin/qluserhs') }}">Danh sách học sinh</a></li>
                                        <li><a href="{{ url('/admin/qluserkhac') }}">Danh sách khác</a></li>
                                        <li><a href="{{ url('/admin/dsuservipham') }}">Danh sách người dùng vi
                                                phạm</a></li>

                                    </ul>
                                </li>
                                <li><a><i class="fa fa-flag"></i> QL trang <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ url('/admin/school') }}">Danh sách trang</a></li>
                                        <li><a href="{{ url('/admin/schoolchoduyet') }}">Danh sách chờ duyệt</a></li>
                                        <li><a href="{{ url('/admin/dsschoolvipham') }}">Danh sách trang vi phạm</a>
                                        </li>

                                    </ul>
                                </li>
                                <li><a><i class="fa fa-users"></i> QL nhóm <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ url('admin/groups') }}">Danh sách nhóm</a></li>
                                        <li><a href="{{ url('admin/dsgroupvipham') }}">Danh sách nhóm vi phạm</a>
                                        </li>

                                    </ul>
                                </li>



                            </ul>
                        </div>


                    </div>
                    <!-- /sidebar menu -->


                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <img
                                        src="{{ asset('/storage/app/assets/img/avatar/iconadmin.png') }}">{{ Session::get('ad_account') }}
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    {{-- <li><a href="javascript:;"> Profile</a></li> --}}
                                    {{-- <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li> --}}

                                    <li><a href="{{ url('/admin/admindoimk') }}"><i class="fa fa-key pull-right"></i>
                                            Đổi mật khẩu</a></li>
                                    <li><a href="{{ url('/admin/adminlogout') }}"><i
                                                class="fa fa-sign-out pull-right"></i> Đăng xuất</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <!-- top tiles -->

                @yield('right_content')


            </div>
        </div>
    </div>
    </div>
    <!-- /page content -->

    <!-- footer content -->
    <footer>
        <div class="pull-right">
            {{-- Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a> --}}
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
    </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('public/vendor/jquery2/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('public/vendor/bootstrap2/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/vendor/popper/popper.min.js') }}"></script>
    <!-- FastClick -->

    <!-- NProgress -->
    <script src="{{ asset('public/vendor/nprogress/nprogress.js') }}"></script>

    <script src="{{ asset('public/vendor/Chart.js/dist/Chart.min.js') }}"></script>


    <!-- bootstrap-progressbar -->
    <script src="{{ asset('public/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>


    <script src="{{ asset('public/vendor/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <!-- Flot -->
    <script src="{{ asset('public/vendor/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('public/vendor/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('public/vendor/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('public/vendor/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('public/vendor/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('public/vendor/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('public/vendor/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('public/vendor/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('public/vendor/DateJS/build/date.js') }}"></script>
    <!-- JQVMap -->

    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('public/vendor/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('public/vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    {{-- <script src="http://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('public/js/custom.min.js') }}"></script>
    @yield('right_content_js')


    <script>
        $(document).on('click', '.xoabaidang', function(e) {
            e.preventDefault();
            if (confirm('Bạn có chắc muốn xóa bài đăng số'+ $(this).data('post') +' này hay không?')) {
            $.ajax({
                url: "{{ url('/admin/deletepost') }}",
                method: "POST",
                data: {
                    "_token": '{{ csrf_token() }}',
                    "post_id": $(this).data('post'),

                },
                dataType: 'json',
                success: function(data) {
                    alert(data.mess);
                    location.reload();
                }
            });
        }
        });
        $(document).on('click', '.xoanguoidung', function(e) {
            e.preventDefault();
            if (confirm('Bạn có chắc muốn xóa người dùng số'+ $(this).data('user') +' này hay không?')) {
            $.ajax({
                url: "{{ url('/admin/deleteuser') }}",
                method: "POST",
                data: {
                    "_token": '{{ csrf_token() }}',
                    "user_id": $(this).data('user'),
                },
                dataType: 'json',
                success: function(data) {
                    alert(data.mess);
                    location.reload();

                }
            });
        }
        });
        $(document).on('click', '.xoanhom', function(e) {
            e.preventDefault();
            if (confirm('Bạn có chắc muốn xóa nhóm số'+ $(this).data('group') +' này hay không?')) {
            $.ajax({
                url: "{{ url('/admin/deletegroup') }}",
                method: "POST",
                data: {
                    "_token": '{{ csrf_token() }}',
                    "group_id": $(this).data('group'),
                },
                dataType: 'json',
                success: function(data) {
                    alert(data.mess);
                    location.reload(true);

                }
            });
        }
        });
        $(document).on('click', '.xoatrang', function(e) {
            e.preventDefault();
            if (confirm('Bạn có chắc muốn xóa nhóm số'+ $(this).data('school') +' này hay không?')) {
            $.ajax({
                url: "{{ url('/admin/deleteschool') }}",
                method: "POST",
                data: {
                    "_token": '{{ csrf_token() }}',
                    "school_id": $(this).data('school'),
                },
                dataType: 'json',
                success: function(data) {
                    alert(data.mess);
                    location.reload(true);

                }
            });
        }
        });
    </script>
</body>

</html>
