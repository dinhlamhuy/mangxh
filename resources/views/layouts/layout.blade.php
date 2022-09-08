<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('/storage/app/assets/img/nen/logo1.png') }}" type="image/png">
    @yield('content-title')
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('public/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendor/font-awesome-4/css/font-awesome.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('public/vendor/emojionearea/dist/emojionearea.min.css')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.css"
        integrity="sha512-0Nyh7Nf4sn+T48aTb6VFkhJe0FzzcOlqqZMahy/rhZ8Ii5Q9ZXG/1CbunUuEbfgxqsQfWXjnErKZosDSHVKQhQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('public/vendor/grid_img/images-grid.css') }}" rel="stylesheet">
    <link href="http://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('resources/css/toastr.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        #search {
            width: 40px;
            -webkit-transition: width 0.4s ease-in-out;
            transition: width 0.4s ease-in-out;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            background-color: white;
            background-image: url('{{ asset('/storage/app/assets/img/icon/searchicon.png') }}');
            background-position: 10px 8px;
            background-repeat: no-repeat;
            padding: 10px 20px 13px 40px;
            border-radius: 24px;
        }

        .logo {
            /* background-color: #f5d020;
background-image: linear-gradient(315deg, #f5d020 0%, #f53803 74%); */
            background: linear-gradient(315deg, #f5d020 0%, #f53803 74%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-style: italic;
        }

        .btn-lighter,
        body {
            background-color: #e4e6eb !important;
        }

        .btn-in4 {
            background-color: #e7f3ff !important;
        }

        .bg-lighter {
            background-color: #f0f2f5 !important;
        }

    </style>
    @yield('content-css')
</head>

<body>
    <?php
    if (Auth::user()->avatar) {
        $avatar = Auth::user()->avatar;
    } else {
        $avatar = 'noteimg.png';
    }
    
    function rutgonnd($str, $maxChars, $holder = '...')
    {
        if (strlen($str) > $maxChars) {
            return trim(substr($str, 0, $maxChars)) . $holder;
        } else {
            return $str;
        }
    }
    ?>
    <header style="margin-bottom: 50px;">
        <nav class="navbar navbar-expand-lg fixed-top navbar-light shadow-sm bg-white background-navbar">
            <div class="container-fluid">
                <div class="col-md-4">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <a class="navbar-brand" href="{{ url('/home') }}">
                            {{-- {{ config('app.name', 'Halo') }} --}}
                            <img src="{{ asset('storage/app/assets/img/nen/logo1.png') }}"
                                style="height: 30px; margin-right:-5px; margin-top:-10px;" alt=""> <b
                                class="logo"><i>Halo</i></b>
                        </a>
                        <form action="{{ url('/searchfriend') }}" method="GET" class="form-inline my-2 my-lg-0"
                            enctype="multipart/form-data">
                            @csrf
                            <input class="form-control mr-sm-2 " type="text" id="search" name="search"
                                placeholder="Tìm kiếm" />
                            <input type="submit" hidden />
                            {{-- <button class="btn  text-muted" style="left:0;" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button> --}}
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="collapse navbar-collapse " id="navbarSupportedContent">
                        <ul class="navbar-nav container-fluid">
                            <li class="nav-item col-md-3  " id="home">
                                <a class="nav-link btn-white text-center" style="border-radius: 12px;"
                                    href="{{ url('/home') }}" title="Trang chủ"><i
                                        class="text-primary fa fa-home fa-2x" aria-hidden="true"></i>
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item col-md-3" id="friends">
                                <a class="nav-link btn-white text-center" style="border-radius: 12px;"
                                    href="{{ url('/friends') }}" title="Bạn bè"><i
                                        class="text-primary fa fa-user-plus fa-2x" aria-hidden="true"></i></a>
                            </li>
                            <li class="nav-item col-md-3" id="schools">
                                <a class="nav-link btn-white text-center" style="border-radius: 12px;"
                                    href="{{ url('/fanpages') }}" title="Trang">
                                    <i class="fa fa-flag fa-2x text-primary " aria-hidden="true"></i></a>
                            </li>
                            <li class="nav-item col-md-3" id="groups">
                                <a class="nav-link btn-white text-center" style="border-radius: 12px;"
                                    href="{{ url('/groups/feed') }}" title="Nhóm"><i
                                        class="text-primary fa fa-users fa-2x" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto  mx-2">
                            <li class="nav-item mt-1" style="vertical-align: middle">
                                <a class="nav-link ml-4 btn btn-light p-0 font-weight-bold"
                                    style=" height: 40px;  border-radius: 24px;  font-size: 15px;  "
                                    href="{{ url('/profile/' . Auth::user()->user_id) }}">
                                    <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"
                                        class="m-0 layout_avt">
                                    <span class="mx-2">{{ Auth::user()->name }}</span>
                                </a>
                            </li>
                            <li class="nav-item  mx-2">
                                <a href="{{ url('/chat') }}" class="nav-link btn btn-light  "
                                    style=" height: 45px; width: 45px; border-radius: 50%; font-size: 20px; "><i
                                        class="fa fa-comment-o " aria-hidden="true"></i></a>
                            </li>
                            {{-- <li class="nav-item dropdown dropdownhover mx-2">
                                <a class="nav-link dropdown-toggle btn btn-light text-dark text-muted"
                                    style=" height: 45px; width: 45px; border-radius: 50%; font-size: 20px; " href="#"
                                    id="thongbao" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="true"> <i class="fa fa-bell" aria-hidden="true"></i>
                                </a>
                                <div class="dropdown-menu mr-0 dropdown-menu-right" aria-labelledby="thongbao">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </li> --}}
                            <li class="nav-item dropdown dropdownhover mx-2 ">
                                <a class="nav-link dropdown-toggle btn btn-light text-dark text-muted"
                                    style=" height: 45px; width: 45px; border-radius: 50%; font-size: 20px; " href="#"
                                    id="setting" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"><i class="fa fa-caret-down" aria-hidden="true"></i>
                                </a>
                                <div class="dropdown-menu mr-0 dropdown-menu-right" aria-labelledby="setting"
                                    style="width:250px">
                                    <a class="nav-link btn btn-light p-0 font-weight-bold" style="  font-size: 15px;  "
                                        href="{{ url('/profile/' . Auth::user()->user_id) }}">
                                        <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"
                                            class="m-0"
                                            style=" height: 40px; width: 40px; border-radius: 50%;" alt="">
                                        <span
                                            class="mx-2">{{ Auth::user()->firtsname . ' ' . Auth::user()->name }}</span>
                                    </a>
                                    <hr>
                                    <a class="dropdown-item nav-link btn btn-light pl-4"
                                        href="{{ url('/changePassword') }}">
                                        Đổi mật khẩu
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


        </nav>
    </header>
    <main class="py-4">
        @yield('content')
    </main>



    <!-- Modal -->
    <div class="modal fade" id="tocaobaidang" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="tocaobaidangLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tocaobaidangLabel">Báo cáo vi phạm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="tocaopost">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="post_id" id="id_post_report" class="form-control">
                                <label for="so1" class="btn btn-danger">
                                    <input type="radio" name="rp_tieude" id="so1" class="btn btn-primary"
                                        value="Quấy rối">Quấy rối</label>
                                <label for="so2" class="btn btn-primary">
                                    <input type="radio" name="rp_tieude" id="so2" class="btn btn-primary"
                                        value="Thông tin sai sự thật">Thông tin sai sự thật</label>
                                <label for="so3" class="btn btn-success">
                                    <input type="radio" name="rp_tieude" id="so3" class="btn btn-primary"
                                        value="Giả mạo">Giả mạo</label>
                                <br>
                                <label for="">Chi tiết</label>
                                <textarea name="rp_noidung" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Tố cáo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- tố cáo user --}}
    <div class="modal fade " id="reportusr" tabindex="-1" aria-labelledby="reportusrLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportusrLabel">Báo cáo vi phạm cá nhân</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="baocaousr">
                        @csrf
                        <input type="hidden" name="user_id" class="idcuausr" value="">
                        <label for=""><b>Các vấn đề</b></label>
                        <select name="bcvp_tieude" class="form-control">
                            <option value="Giả mạo">Giả mạo</option>
                            <option value="Giả mạo tên tài khoản">Giả mạo tên tài khoản</option>
                            <option value="Quấy rối">Quấy rối</option>
                            <option value="Sử dụng ngôn từ không phù hợp">Sử dụng ngôn từ không phù hợp</option>
                            <option value="Các vấn đề khác">Các vấn đề khác</option>
                        </select>
                        <label for=""><b>Chi tiết</b></label>
                        <textarea name="bcvp_noidung" class="form-control"></textarea>
                        {{-- <button type="submit" class="mt-2  btn btn-primary w-100">Báo
                            cáo</button> --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Báo cáo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- tố cáo group --}}
    <div class="modal fade " id="reportgroup" tabindex="-1" aria-labelledby="reportgroupLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportgroupLabel">Báo cáo vi phạm nhóm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="baocaogroup" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="group_id" class="idcuagroup" value="">
                        <label for=""><b>Các vấn đề</b></label>
                        <select name="bcvp_tieude" class="form-control">
                            <option value="Giả mạo">Giả mạo</option>
                            <option value="Giả mạo tên tài khoản">Giả mạo tên tài khoản</option>
                            <option value="Quấy rối">Quấy rối</option>
                            <option value="Sử dụng ngôn từ không phù hợp">Sử dụng ngôn từ không phù hợp</option>
                            <option value="Các vấn đề khác">Các vấn đề khác</option>
                        </select>

                        <label for=""><b>Chi tiết</b></label>
                        <textarea name="bcvp_noidung" class="form-control"></textarea>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Báo cáo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- tố cáo school --}}
    <div class="modal fade " id="reportschool" tabindex="-1" aria-labelledby="reportschoolLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportschoolLabel">Báo cáo vi phạm trang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="baocaoschool" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="school_id" class="idcuaschool" value="">
                        <label for=""><b>Các vấn đề</b></label>
                        <select name="bcvp_tieude" class="form-control">
                            <option value="Giả mạo">Giả mạo</option>
                            <option value="Giả mạo tên tài khoản">Giả mạo tên tài khoản</option>
                            <option value="Quấy rối">Quấy rối</option>
                            <option value="Sử dụng ngôn từ không phù hợp">Sử dụng ngôn từ không phù hợp</option>
                            <option value="Các vấn đề khác">Các vấn đề khác</option>
                        </select>

                        <label for=""><b>Chi tiết</b></label>
                        <textarea name="bcvp_noidung" class="form-control"></textarea>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Báo cáo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('public/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/vendor/popper/popper.min.js') }}"></script>
    <script src="{{ asset('public/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/vendor/grid_img/images-grid.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.4.0/moment.min.js"></script>
    <script src="http://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('public/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"
        integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('public/vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('resources/js/toastr.min.js') }}"></script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dropup').hover(function() {
            $(this).find('.dropdown-menu').first().stop(true, true).delay(100).fadeIn(100);
        }, function() {
            $(this).find('.dropdown-menu').first().stop(true, true).delay(200).fadeOut(300);
        });


        $(document).on('click', '.thacamxuc', function(e) {
            e.preventDefault();
            var postid = $(this).data('post');
            var icon = $(this).data('icon');
            var icon_id = $(this).data('iconid');
            var comment = $(this).data('comment');
            var onoff = '';
            var so = $('#symbol' + postid).text();

            if ($(this).data('onoff')) {
                onoff = $(this).data('onoff');
            }
            var userid = <?= Auth::user()->user_id ?>;
            $.ajax({
                url: "{{ url('release_emotions') }}",
                method: "POST",
                data: {
                    "_token": '{{ csrf_token() }}',
                    "icon": icon,
                    "iconid": icon_id,
                    "onoff": onoff,
                    "post": postid,
                    "comment": comment,
                    "userid": userid
                },
                dataType: 'json',
                success: function(data) {
                    // console.log(postid + icon + comment + userid);
                    // load_comment();
                    $('#thacamxuc' + postid).html(data.emotions);
                    $('#symbol' + postid).text(Number(so) + Number(data.sl));

                }
            });
        });

        $(document).on('click', '.baocao', function(e) {
            e.preventDefault();
            var post_id = $(this).data('post');
            $('#id_post_report').val(post_id);
        });

        $(document).on('click', '.baocaousr', function(e) {
            e.preventDefault();
            var user_id = $(this).data('userid');
            $('.idcuausr').val(user_id);
        });

        $(document).on('click', '.baocaogroup', function(e) {
            e.preventDefault();
            var group_id = $(this).data('groupid');
            $('.idcuagroup').val(group_id);
        });
        $(document).on('click', '.baocaoschool', function(e) {
            e.preventDefault();
            var school_id = $(this).data('schoolid');
            $('.idcuaschool').val(school_id);
        });

        $(document).on('submit', '#tocaopost', function(e) {
            e.preventDefault();
            var data = new FormData(this);
            $.ajax({
                url: "{{ url('/baocao') }}",
                method: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#tocaobaidang').modal('hide');
                }
            });
        });
        $(document).on('submit', '#baocaousr', function(e) {
            e.preventDefault();
            var data = new FormData(this);
            // alert('dsjfsdkgv');
            $.ajax({
                url: "{{ url('/baocaousr') }}",
                method: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    alert(data.nd);
                    $('#reportusr').modal('hide');
                }
            });
        });
        $(document).on('submit', '#baocaogroup', function(e) {
            e.preventDefault();
            var data = new FormData(this);

            $.ajax({
                url: "{{ url('/baocaogroup') }}",
                method: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    alert(data.nd);
                    $('#reportgroup').modal('hide');
                }
            });
        });
        $(document).on('submit', '#baocaoschool', function(e) {
            e.preventDefault();
            var data = new FormData(this);

            $.ajax({
                url: "{{ url('/baocaoschool') }}",
                method: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    alert(data.nd);
                    $('#reportschool').modal('hide');
                }
            });
        });



        $(document).on('submit', '.editpost', function(e) {
            e.preventDefault();
            var data = new FormData(this);
            let TotalImages = $('#imgpost')[0].files.length;
            if (TotalImages > 0) {
                for (let i = 0; i < TotalImages; i++) {
                    data.append('imgpost' + i, $("#imgpost")[0].files[i]);
                }
                data.append('TotalImages', TotalImages);
                data.append('imgpost_type', $("#imgpost")[0].files[0].type);
            } else {
                data.append('TotalImages', '-1');
                data.append('imgpost', '');
                data.append('imgpost_type', '');
            }
            var postid = $(".editcap_post" + $(this).data('post') + " .emojionearea-editor").html();
            data.append('userid', {{ Auth::user()->user_id }});
            data.append('group_id', '');
            data.append('type_post', '1');
            data.append('category_post', '1');
            data.append('caption', $(".editcap_post" + $(this).data('post') + " .emojionearea-editor")
                .html());
            $.ajax({
                url: "{{ url('editpost') }}",
                method: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#upload_form')[0].reset();
                    $('.emojionearea-editor').html('');
                    $('#dangbai').modal('hide');
                    $('#preview').html('');
                    location.reload();
                }
            });
        });



        $(document).on('click', '.saved_post', function(e) {
            e.preventDefault();
            var postid = $(this).data('post');
            var userid = <?= Auth::user()->user_id ?>;

            $.ajax({
                url: "{{ url('savedpost') }}",
                method: "POST",
                data: {
                    "_token": '{{ csrf_token() }}',
                    "post_id": postid,
                    "user_id": userid
                },
                dataType: 'json',
                success: function(data) {

                }
            });


        });
    </script>

    @yield('content-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>

</body>
@stack('scripts')

</html>
