@extends('layouts.layout')
@section('content-title')
    <title>{{ $ttin_user->firstname . ' ' . $ttin_user->name }} | Trang cá nhân</title>
@endsection
@section('content-css')
    <link rel="stylesheet" href="{{ asset('resources/css/groups.css') }}">
    <style>
        .select2{
            width: 100% !important;
        }
        .btn-close .close {
            border-radius: 50%;
            background-color: white;
            border: 1px solid white;
            top: -25px;
            right: -30px;
            font-size: 25px;
            padding: 0px 3px;
            margin: 0px;
            position: relative;
            opacity: 1 !important;
        }

        .btn-close {
            border: 3px solid white;
            opacity: 1 !important;
        }

        .btn-avatar {
            box-shadow: none !important;
            outline: none !important;
        }

        .previewimg {
            height: 400px !important;
            width: 400px !important;
            object-fit: cover !important;
            border-radius: 50%;
        }

        .previewbgimg {
            height: 400px !important;
            width: 100% !important;
            object-fit: cover !important;
        }

        #imagepreview {
            text-align: center !important;
        }

        #imgavatar::-webkit-file-upload-button,
        #imgbackground::-webkit-file-upload-button {
            color: white;
            display: inline-block;
            background: #1CB6E0;
            border: none;
            padding: 7px 15px;
            font-weight: 700;
            border-radius: 3px;
            white-space: nowrap;
            cursor: pointer;
            font-size: 10pt;
            margin-top: 15px;
        }

        .btn-background {
            margin-top: -40px !important;
            background-color: rgba(99, 99, 85, 0.438);
            color: white;
        }

        .background {
            height: 350px !important;
            width: 100% !important;
            object-fit: cover !important;
        }

        .cap_post {
            border: none !important;
            box-shadow: none !important;
        }

        .emojionearea-editor {
            outline: none !important;
            box-shadow: none !important;
            max-height: 10em !important;
            min-height: 2.5em !important;
            border-radius: 24px !important;
        }

        .emojionearea {
            border-radius: 24px !important;
        }

        .emojionearea-editor:focus,
        .emojionearea-editor:active {
            outline: none !important;
            box-shadow: none !important;
        }

        .emojioneemoji {
            height: 18px !important;
            width: 18px !important;
        }

        .emojibtn .emojioneemoji {
            height: 25px !important;
            width: 25px !important;
        }

        .btn-profile {
            margin: 10px;
            font-weight: 600;
            font-size: 18px;
        }
    </style>
@endsection
@section('content')
<?php
if ($ttin_user->avatar) {
    $avatar = $ttin_user->avatar;
} else {
    $avatar = 'noteimg.png';
}
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11 mx-auto pl-0" style="border-radius:24px;">
                <div class="bg-info clearfix  ">
                    <img src="{{ asset('storage/app/assets/img/anhbia/' . $ttin_user->background) }}"
                        class="m-0 p-0 float-left background">
                </div>
                @if (Auth::user()->user_id == $ttin_user->user_id)
                    <button data-toggle="modal" data-target="#backgroundmodal" class="btn btn-background  float-right "><i
                            class="fa fa-camera" aria-hidden="true"></i> Thay đổi ảnh nền</button>
                @endif
            </div>
        </div>
        <div class="clearfix bg-white row">
            <div class="col-md-1"></div>
            <div class="col-md-7 ">
                <button class="pop btn float-left btn-avatar" data-toggle="modal" data-target="#imagemodal">
                    <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}" class="ml-3"
                        style="border:2px solid white; margin-top:-50px; height: 120px; width:120px; object-fit: cover; border-radius: 50%;"
                        alt="">
                </button>
                <h4 class="float-left ml-3 mt-3"><b>{{ $ttin_user->firstname . ' ' . $ttin_user->name }}</b></h4>
            </div>
            <div class="col-md-3 text-right">
                @if (Auth::user()->user_id != $ttin_user->user_id)

                <a class="nav-link dropdown-toggle btn  btn-light text-dark text-muted mt-3 ml-3  float-right "
                    style=" border-radius: 50%; " href="#" id="thongbao" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                </a>
                <div class="dropdown-menu mr-0 dropdown-menu-right" aria-labelledby="thongbao">
                    @if (!empty($ttkb))
                        @if ($ttkb->f_trangthai == '0')
                        <form action="{{ url('/huykb') }}" method="post" onsubmit="return confirm('Bạn có chắc muốn hủy')">
                        @csrf
                        <input type="hidden" name="user_from"  value="{{ $ttkb->user_from}}">
                        <input type="hidden" name="user_to" value="{{ $ttkb->user_to }}">
                        <button type="submit"  class="dropdown-item ">Hủy lời mời</button>
                        </form>
                        @elseif($ttkb->f_trangthai == '1')
                        <form action="{{ url('/huykb') }}" method="post" onsubmit="return confirm('Bạn có chắc muốn hủy')">
                        @csrf
                        <input type="hidden" name="user_from"  value="{{ $ttkb->user_from}}">
                        <input type="hidden" name="user_to" value="{{ $ttkb->user_to }}">
                        <button type="submit"  class="dropdown-item ">Hủy kết bạn</button>
                        </form>
                        @endif
                    @endif
                    <div class="dropdown-divider"></div>
                    <button class="dropdown-item baocaousr" data-userid="{{ $ttin_user->user_id }}" type="button"
                        data-toggle="modal" data-target="#reportusr">Báo cáo vi phạm</button>
                    {{-- <button class="dropdown-item" >Chép link</button> --}}
                </div>
                <a href="{{ url('conversation/' . $ttin_user->user_id) }}"
                    class="btn btn-lighter mt-3 ml-3 float-right"><i class="fa fa-commenting-o"
                        aria-hidden="true"></i>&ensp;Nhắn
                    tin</a>


                @if (empty($ttkb))
                    <form class="fromxacnhan">
                        <button class="btn btn-primary mt-3 btnketban " value="1"
                            data-userid="{{ $ttin_user->user_id }}">Thêm kết bạn</button>
                    </form>
                @else
                    @if ($ttkb->f_trangthai == '0')
                        @if ($ttkb->user_to == Auth::user()->user_id)
                            <form class="fromxacnhan float-right" id="formxn{{ $ttin_user->user_id }}">
                                <button class="btn btn-primary mt-3 ml-3 btnxacnhan  " value="1"
                                    data-userid="{{ $ttin_user->user_id }}" data-xacnhan="1">
                                    <i class="fa fa-user-o" aria-hidden="true"></i>
                                    Xác nhận lời mời</button>
                            </form>
                        @else
                            <button class="btn btn-lighter ml-3 mt-3 float-right"> <i class="fa fa-user-o"
                                    aria-hidden="true"></i>
                                {{ $ttkb->f_ghichu }}</button>
                        @endif
                    @elseif($ttkb->f_trangthai == '1')
                        <button class="btn btn-lighter float-right ml-3 mt-3"> <i class="fa fa-user-o"
                                aria-hidden="true"></i>
                            {{ $ttkb->f_ghichu }}</button>
                    @endif

                @endif
            @elseif(Auth::user()->user_id == $ttin_user->user_id)
                <button class="btn btn-lighter mt-3">Chỉnh sửa trang cá nhân</button>
            @endif
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-10 mx-auto">
                <hr class="m-0 p-0">

                <a id="about" href="{{ url('/profile/' . $ttin_user->user_id) }}" class="btn btn-bg  btn-profile">Bài
                    viết</a>
                <a id="discussion" href="{{ url('/profile/' . $ttin_user->user_id . '/about') }}"
                    class="btn btn-bg  btn-profile">Giới thiệu</a>
                <a id="work" href="{{ url('/profile/' . $ttin_user->user_id . '/friend') }}"
                    class="btn btn-bg btn-profile">Bạn bè</a>
                {{-- <a id="topic" href="{{ url('') }}" class="btn btn-bg btn-profile">Đa phương tiện</a> --}}
            </div>
        </div>
        @if (session('tbaoprofile'))
            <div class="alert alert-success">
                {{ session('tbaoprofile') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row px-3">
            <div class="col-md-9 mx-auto bg-lighter">

                <h2 class="font-weight-bold">Giới thiệu</h2><br><br>


                <div class="px-5">
                    <table class="table  ">
                        <tr style="border-top:none;">
                            <td colspan="2">
                                <h5><i class="fa fa-user-circle-o" aria-hidden="true"></i> Thông tin cá nhân</h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:25%;">Tên tài khoản: </td>
                            <td style="width:75%;"><b>{{ $ttin_user->firstname . ' ' . $ttin_user->name }}</b></td>
                        </tr>
                        <tr>
                            <td>Giới tính: </td>
                            <td><b>{{ $ttin_user->sex }}</b></td>
                        </tr>
                        <tr>
                            <td>Ngày sinh: </td>
                            <td><b>{{ date('d/m/Y', strtotime($ttin_user->birthday)) }}</b></td>
                        </tr>
                        <tr>
                            <td>Nghề nghiệp: </td>
                            <td><b>{{ $ttin_user->job }}</b></td>
                        </tr>
                        <tr>
                            <td>Trường học: </td>
                            <td>
                                @if (!empty($school))
                                    <b>{{ $school->school_name }}</b>
                                @endif
                            </td>
                            {{-- <td></td> --}}
                        </tr>
                        <tr>
                            <td>Địa chỉ: </td>
                            <td><b>{{ $ttin_user->address }}</b></td>
                        </tr>
                    </table>
                    @if ($ttin_user->user_id == Auth::user()->user_id)
                        <center>
                            <button type="button" class="btn btn-lighter m-4" data-toggle="modal"
                                data-target="#editttcanhan">Chỉnh sửa thông tin cá nhân</button>
                        </center>
                        <!-- Modal -->
                        <div class="modal fade" id="editttcanhan" data-backdrop="static" data-keyboard="false"
                            aria-labelledby="editttcanhanLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editttcanhanLabel"><i class="fa fa-user-circle-o"
                                                aria-hidden="true"></i> Cập nhật thông tin cá nhân</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ url('/profile/edit') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table  ">

                                                        <tr>
                                                            <td style="">Họ: </td>
                                                            <td style="">
                                                                <input type="hidden" name="iduser" class="form-control"
                                                                    value="{{ $ttin_user->user_id }}">
                                                                <input type="text" name="ho" class="form-control"
                                                                    value="{{ $ttin_user->firstname }}">
                                                            </td>
                                                            <td>Tên:</td>
                                                            <td>
                                                                <input type="text" name="ten" class="form-control"
                                                                    value="{{ $ttin_user->name }}">

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Giới tính: </td>
                                                            <td>

                                                                <select name="gioitinh" class="form-control">
                                                                    <option value="Nam" <?php if ($ttin_user->sex == 'Nam') {
    echo 'selected';
} ?>>Nam</option>
                                                                    <option value="Nữ" <?php if ($ttin_user->sex == 'Nữ') {
    echo 'selected';
} ?>>Nữ</option>
                                                                    <option value="Khác" <?php if ($ttin_user->sex == 'Khác') {
    echo 'selected';
} ?>>Khác</option>
                                                                </select>

                                                            <td>Ngày sinh: </td>
                                                            <td><input type="date" name="ngaysinh" class="form-control"
                                                                    value="{{ date('Y-m-d', strtotime($ttin_user->birthday)) }}">
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>Nghề nghiệp: </td>
                                                            <td colspan="3"><input type="text" name="nghenghiep"
                                                                    class="form-control" value="{{ $ttin_user->job }}">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Trường học: </td>
                                                            {{-- <td><input type="text" class="form-control" value="{{ $school->school_name }}" ></td> --}}
                                                            <td colspan="3">
                                                                <select name="truonghoc" class="form-control timkiemselect ">
                                                                    <option value="" >Chọn trường học</option>
                                                                    @foreach ($listschool as $lschool)
                                                                        <option value="{{ $lschool->school_id }}"
                                                                            <?php if (!empty($chool) && $lschool->school_id == $school->school_id) {
                                                                                echo 'selected';
                                                                            } ?>>
                                                                            {{ $lschool->school_name }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Địa chỉ: </td>
                                                            <td colspan="3"><input type="text" name="diachi"
                                                                    class="form-control"
                                                                    value="{{ $ttin_user->address }}"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="imagemodal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="imagemodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imagemodalLabel">Cập nhật ảnh đại diện</h5>
                <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/uploadavatar') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div id="imagepreview">
                        <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}" class="previewimg">
                    </div>
                    <input type="file" id="imgavatar" name="imgavatar" accept=".png, .jpg, .jpeg" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
            <form action="{{ url('/uploadavatar') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div id="imagebgpreview">
                        <img src="{{ asset('storage/app/assets/img/anhbia/' . $ttin_user->background) }}"
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
        $(document).ready(function() {
    $('.timkiemselect').select2();
});

$('#imgavatar').change(function() {
            $("#imagepreview").html('');
            var img = $('#imgavatar').val();
            var duoi = img.lastIndexOf(".") + 1;
            var extFile = img.substr(duoi, img.length).toLowerCase();
            if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    $("#imagepreview").append('<img src="' + window.URL.createObjectURL(this.files[i]) +
                        '" class="previewimg" />');
                }
            } else {
                $("#imagepreview").append(
                    '<img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}" class="previewimg" />'
                );
                $('#imgavatar').val("");
                alert("Chỉ chấp nhận file image có đuôi .jpg, .jpeg, .png!");
            }
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
                    '<img src="{{ asset('storage/app/assets/img/anhbia/' . $ttin_user->background) }}" class="previewbgimg" />'
                );
                $('#imgbackground').val("");
                alert("Chỉ chấp nhận file image có đuôi .jpg, .jpeg, .png!");
            }
        });

    </script>
@endsection
