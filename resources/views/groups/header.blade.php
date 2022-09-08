@extends('layouts.layout')

@section('content-title')
    <title>{{ $group->group_name }} | Halo - Mạng xã hội</title>
@endsection

@section('content-css')
    <link rel="stylesheet" href="{{ asset('resources/css/groups.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/group_work.css') }}">
    <style>
        .tieude {
            background-color: white;
            border: none;
        }

        .acc_card {
            border: none;
        }

        .btn-acco {
            width: 100%;
            text-align: left;
        }
        
        .previewbgimg {
            height: 400px !important;
            width: 100% !important;
            object-fit: cover !important;
        }

    </style>
    @yield('header_groups_css')
@endsection
@section('content')
    <?php
    if (!empty($group->group_imgbg)) {
        $bia = $group->group_imgbg;
    } else {
        $bia = 'noimg.jpg';
    }
    ?>
    <div class="container-fluid" style="margin-top: -10px">
        <div class="row">
            <div class="col-md-12 mx-0 px-0">
                <div class="card">
                    <div class="card-body pb-0 pt-0">
                        <div class="row">
                            <div class="col-md-10 mx-auto">
                                <img src="{{ asset('storage/app/assets/img/group/' . $bia) }}" class="w-100 g-background">
                                @if ($group->group_founder == Auth::user()->user_id)
                                    <div class="text-right">
                                        <button data-toggle="modal" data-target="#backgroundmodal" class="btn btn-lighter btn-background " style="margin-top: -67px;">
                                            <i class="fa fa-camera"
                                                aria-hidden="true"></i>&ensp;Thay đổi ảnh bìa</button>
                                    </div>
                                @endif
                            </div>

                        </div>
                        <div class="row mt-0 mb-0" style="margin-top: -70px;">
                            <div class="col-md-1"></div>
                            <div class="col-md-10 mx-auto mb-0">
                                <h2 class=" font-weight-bold">{{ $group->group_name }}</h2>
                                <div class="row">
                                    <div class="col-md-6 pt-2">
                                        @if ($group->group_privacy == '1')
                                            <i class="fa fa-globe" aria-hidden="true"></i>&ensp;<b>Nhóm công khai</b>
                                        @elseif($group->group_privacy == '2')
                                            <i class="fa fa-lock" aria-hidden="true"></i>&ensp;<b>Nhóm riêng tư</b>
                                        @endif
                                        | {{ $num_members }} Thành viên
                                    </div>

                                    <div class="col-md-6">

                                        <a class="nav-link dropdown-toggle btn  btn-lighter text-dark text-muted  float-right p-0"
                                            style=" border-radius: 50%; height: 30px; width: 30px;" href="#" id="thongbao"
                                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu mr-0 dropdown-menu-right" aria-labelledby="thongbao">

                                            
                                            {{-- <button class="dropdown-item">Báo cáo vi phạm</button> --}}
                                            <button type="button" class="btn  w-100 dropdown-item" data-toggle="modal"
                                            data-target="#moibanbe">Mời bạn bè</button>
                                            <div class="dropdown-divider"></div>
                                            @if ($group->group_founder != Auth::user()->user_id)
                                            <button class="dropdown-item  baocaogroup" data-groupid="{{ $group->group_id }}"
                                                type="button"  data-toggle="modal" data-target="#reportgroup">Báo cáo nhóm</button>
                                            <button class="dropdown-item roinhom" data-group="{{ $group->group_id }}">Rời khỏi nhóm</button>
                                            @else 

                                            
                                            <button class="dropdown-item giaitannhom" data-group="{{ $group->group_id }}">Giải tán nhóm</button>

                                            @endif
                                            {{-- <button class="dropdown-item" >Chép link</button> --}}
                                        </div>

                                        <div class="modal fade" id="moibanbe" data-backdrop="static"
                                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Mời bạn bè</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid px-0 mx-0">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <form method="post" id="dsmoiban">
                                                                        @csrf
                                                                        <table id="dsbanbe" class="w-100">
                                                                            <thead>
                                                                                <tr>
                                                                                    <td style="width: 15%;"></td>
                                                                                    <td style="width: 70%;"></td>
                                                                                    <td style="width: 15%;"></td>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php $arrtv = []; ?>
                                                                                @foreach ($dsnhom as $tv)
                                                                                    <?php $arrtv[] = $tv->user_id; ?>
                                                                                @endforeach

                                                                                @foreach ($friends as $friend)
                                                                                    @if (in_array($friend->user_id, $arrtv))
                                                                                    @else
                                                                                        <?php
                                                                                        if (empty($friend->avatar)) {
                                                                                            $avatar = 'noteimg.png';
                                                                                        } else {
                                                                                            $avatar = $friend->avatar;
                                                                                        }
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="width: 15%; text-align:right;">
                                                                                                <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"
                                                                                                    class="m-0 cap_avt">
                                                                                            </td>
                                                                                            <td style="width: 70%;">
                                                                                                {{ $friend->firstname . ' ' . $friend->name }}
                                                                                            </td>
                                                                                            <td style="width: 15%;">
                                                                                                <input type="checkbox"
                                                                                                    name="danhsachmoiban[]"
                                                                                                    multiple="multiple" value="{{ $friend->user_id }}">
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        <button class="btn btn-primary float-right mt-5">Mời
                                                                            bạn</button>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        @if ($group->group_founder != Auth::user()->user_id)
                                            <button class="btn btn-light theodoigroup float-right mr-3 font-weight-bold"
                                                data-group="{{ $group->group_id }}"><i class="fa fa-users"
                                                    aria-hidden="true"></i>&ensp;
                                                @if (empty($ktthanhvien))
                                                    Tham gia nhóm
                                                @else
                                                    @if ($ktthanhvien->group_status == '1')
                                                        Đã tham gia
                                                    @elseif($ktthanhvien->group_status == '0')
                                                        Đã yêu cầu tham gia
                                                    @else
                                                        Tham gia nhóm
                                                    @endif
                                            </button>
                                        @endif
                                        @endif

                                    </div>
                                </div>
                                <hr class="mb-0">
                                <div class="row mt-0">
                                    <a id="about" href="{{ url('/groups/' . $group->group_id . '/about') }}"
                                        class="btn btn-bg ">Giới thiệu</a>
                                    <a id="discussion" href="{{ url('/groups/' . $group->group_id) }}"
                                        class="btn btn-bg ">Thảo luận</a>
                                    <a id="work" href="{{ url('/groups/' . $group->group_id . '/work') }}"
                                        class="btn btn-bg">Công việc</a>
                                    <a id="gmember" href="{{ url('/groups/' . $group->group_id . '/gmember') }}" class="btn btn-bg">Thành viên</a>
                                    {{-- <a id="people" href="{{ url('') }}" class="btn btn-bg">Mọi người</a> --}}
                                    {{-- <a id="event" href="{{ url('') }}" class="btn btn-bg">Sự kiện</a> --}}
                                    @if ($group->group_founder == Auth::user()->user_id)
                                        <a id="kiemduyet"
                                            href="{{ url('/groups/' . $group->group_id . '/dskiemduyet') }}"
                                            class="btn btn-bg">Duyệt thành viên</a>
                                        {{-- <a id="kiemduyet"
                                            href="{{ url('/groups/' . $group->group_id . '/thongtinnhom') }}"
                                            class="btn btn-bg">Thông tin nhóm</a> --}}
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('header_groups')



    <div class="modal fade" id="backgroundmodal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="imagebackgroundmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imagebackgroundmodalLabel">Cập nhật ảnh bìa</h5>
                <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/groups/uploadimggroup') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="group_id" value="{{ $group->group_id }}">
                <div class="modal-body">
                    <div id="imagebgpreview">
                        <img src="{{ asset('storage/app/assets/img/group/' . $bia) }}"
                            class="mx-0 float-left previewbgimg">
                    </div>
                    <input type="file" id="imgbackground" name="imgbackground" accept=".png, .jpg, .jpeg" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>





    
</div>
@endsection
@section('content-js')
    <script>
        $(document).on('click', '.theodoigroup', function(e) {
            e.preventDefault();
            // alert($(this).data('group'));
            $.ajax({
                url: "{{ url('/groups/adduser_group') }}",
                method: "POST",
                data: {
                    "_token": '{{ csrf_token() }}',
                    "group_id": $(this).data('group'),
                    "user_id": {{ Auth::user()->user_id }}
                },
                dataType: 'json',
                success: function(data) {
                    // console.log(postid + icon + comment + userid);
                    // load_comment();
                    $('.theodoigroup').html(data.nd);
                }
            });
        });
        $(document).on('click', '.roinhom', function(e) {
            e.preventDefault();
            group_id=$(this).data('group');
            $.ajax({
                url: "{{ url('/groups/roinhom') }}",
                method: "POST",
                data: {
                    "_token": '{{ csrf_token() }}',
                    "group_id": $(this).data('group'),
                    "user_id": {{ Auth::user()->user_id }}
                },
                dataType: 'json',
                success: function(data) {
                   
                    location.reload();
                }
            });

        });
        $(document).on('click', '.giaitannhom', function(e) {
            e.preventDefault();
            if(confirm('Bạn có chắc muốn giải tán nhóm hay không')){
                group_id=$(this).data('group');
                $.ajax({
                    url: "{{ url('/admin/deletegroup') }}",
                    method: "POST",
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "group_id": $(this).data('group'),
                        "user_id": {{ Auth::user()->user_id }}
                    },
                    dataType: 'json',
                    success: function(data) {
                       alert('Đã giải tán nhóm')
                        location.href='http://localhost/mangxh/home';
                    }
                });

            }

        });
        $(document).on('submit', '#dsmoiban', function(e) {
            e.preventDefault();
            var data = new FormData(this);
            data.append('group_id', {{ $group->group_id }});

            $.ajax({
                url: "{{ url('/groups/moivaogroup') }}",
                method: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    // console.log(postid + icon + comment + userid);
                    // load_comment();
                    alert(data.nd);
                }
            });
        });


        $('#imgbackground').change(function() {
            $("#imagebgpreview").html('');
            var img = $('#imgbackground').val();
            var duoi = img.lastIndexOf(".") + 1;
            var extFile = img.substr(duoi, img.length).toLowerCase();
            if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    $("#imagebgpreview").append('<img src="' + window.URL.createObjectURL(this.files[i]) +
                        '" class="previewbgimg" />');
                }
            } else {
                $("#imagebgpreview").append(
                    '<img src="{{ asset('storage/app/assets/img/group/' . $bia) }}" class="previewbgimg" />'
                );
                $('#imgbackground').val("");
                alert("Chỉ chấp nhận file image có đuôi .jpg, .jpeg, .png!");
            }
        });


        $(document).on('submit', '.sharepost', function(e) {
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
                var postid = $(".cap_post" + $(this).data('post') + " .emojionearea-editor").html();
                data.append('userid', {{ Auth::user()->user_id }});
                data.append('group_id', '');
                data.append('type_post', '1');
                data.append('category_post', '1');
                data.append('caption', $(".cap_post" + $(this).data('post') + " .emojionearea-editor")
                    .html());
                $.ajax({
                    url: "{{ url('upload') }}",
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
                        // location.reload();
                    }
                });
            });
            $(document).on('click', '.xoabaidang', function(e) {
            e.preventDefault();
            if(confirm('Bạn có chắc muốn xóa bài đăng này hay không')){
                group_id=$(this).data('post');
                $.ajax({
                    url: "{{ url('/admin/deletepost') }}",
                    method: "POST",
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "post_id": $(this).data('post'),
                        "user_id": {{ Auth::user()->user_id }}
                    },
                    dataType: 'json',
                    success: function(data) {
                       alert('Đã xóa bài đăng thành công')
                        location.reload();
                    }
                });

            }

        });
        $('#dsbanbe').DataTable({
            // "language": {
            //     // "url": "http://cdn.datatables.net/plug-ins/1.11.5/i18n/vi.json"
            // }
        });
    </script>
    @yield('header_groups_js')
@endsection
