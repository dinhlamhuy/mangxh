@extends('layouts.layout')
@section('content-title')
    <title>
        {{ $ttin_user->firstname . ' ' . $ttin_user->name }} | Trang cá nhân</title>
@endsection
@section('content-css')
    <link rel="stylesheet" href="{{ asset('resources/css/groups.css') }}">
    <style>
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
    <div class="container-fluid" style="background-color: rgba(240,242,245,255);">
        <div class="row">
            <div class="col-md-11 mx-auto pl-0" style="border-radius:24px;">
                <div class="bg-info clearfix  ">
                    <img src="{{ asset('storage/app/assets/img/anhbia/' . $ttin_user->background) }}"
                        class="m-0 p-0 float-left background">
                </div>

                <button data-toggle="modal" data-target="#backgroundmodal" class="btn btn-background  float-right "><i
                        class="fa fa-camera" aria-hidden="true"></i> Thay đổi ảnh nền</button>

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
                <a href="{{ url('/profile/'.$ttin_user->user_id.'/about') }}" class="btn btn-lighter mt-3">Chỉnh sửa trang cá nhân</a>

            </div>
            <div class="col-md-1"></div>
            <div class="col-md-10 mx-auto">
                <hr class="m-0 p-0">

                <a id="baiviet" href="{{ url('/profile/' . $ttin_user->user_id) }}" class="btn btn-bg  btn-profile">Bài viết</a>
                <a id="discussion" href="{{ url('/profile/' . $ttin_user->user_id . '/about') }}"
                    class="btn btn-bg  btn-profile">Giới thiệu</a>
                    <a id="work" href="{{ url('/profile/'.$ttin_user->user_id.'/friend') }}" class="btn btn-bg btn-profile">Bạn bè</a>
                {{-- <a id="topic" href="{{ url('') }}" class="btn btn-bg btn-profile">Đa phương tiện</a> --}}
            </div>
        </div>

        <div class="row ">
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="card my-3" style="border-radius:24px;">
                    <div class="card-body">
                        <h4><b>Giới thiệu</b></h4><br>
                        <p>{{ $ttin_user->job }} tại @if (!empty($school))
                                <b>{{ $school->school_name }}</b>
                            @endif
                        </p>
                        <p>Đến từ {{ $ttin_user->address }}</p>
                        <p>Giới tính {{ $ttin_user->sex }}</p>
                        <p>Ngày sinh {{ date('d-m-Y', strtotime($ttin_user->birthday)) }}</p>
                        <p>Tham gia vào
                            {{ date('\n\g\à\y\ d \t\h\á\n\g\ m \n\ă\m\ Y', strtotime($ttin_user->created_at)) }}</p>
                        <a href="{{ url('profile/' . $ttin_user->user_id . '/about') }}" class="w-100 btn btn-lighter">Chỉnh
                            sửa thông tin cá
                            nhân</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row ">
                    <div class="col-md-12">
                        <div class="card my-3 w-100" style="border-radius:24px;">
                            <div class="card-body w-100">
                                <div class="clean-fix">
                                    <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"
                                        class="m-0 cap_avt" style="" alt="">
                                    <button type="button" class="btn btn-light badge-pill text-left text-muted h-100 py-2 "
                                        style="width:90%; font-size:20px;" data-toggle="modal" data-target="#dangbai">
                                        Bạn đang nghĩ gì?
                                    </button>
                                    <div class="modal fade " id="dangbai" tabindex="-1" aria-labelledby="dangbaiLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="dangbaiLabel">Tạo bài viết</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" id="upload_form" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}" class="m-0"
                                                            style="height: 40px; border-radius: 50%; width: 40px;" alt="">&emsp;
                                                        <b style="top: -70px; vertical-align: top;">{{ Auth::user()->name }}</b><br>
                                                        <select name="status" id="status"
                                                            style="border: none; vertical-align: top; margin-top: -20px; margin-left: 60px; font-size:13px;  float-left"
                                                            class=" text-muted">
                                                            <option value="Công khai" selected>Công khai</option>
                                                            <option value="Bạn bè">Bạn bè</option>
                                                            <option value="Riêng tư">Riêng tư</option>
                                                        </select>
                                                        <div class="form-control cap_post" placeholder="Đăng cảm nghĩ của bạn?"></div>
                                                        <div id="preview"></div>
                                                        <input type="file" name="imgpost[]" class="form-control imgpost  float-left" style="width:100%;"
                                                            id="imgpost" multiple>
                                                            <input type="hidden" name="category_post" id="category_post" value="1">
                                                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                                        <button type="submit" id="dangbai" class="mt-2 dangbai btn btn-primary w-100">Đăng bài</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="post-data">
                    @include('profile_post')

                </div>
                

            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="row">

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"
        integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#baiviet').addClass('btn-active');
        $(".cap_post").emojioneArea({
            pickerPosition: "top",
            filtersPosition: "bottom",
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


        function loadimg(id) {
            var str = $('#mangimg' + id).text().toString();
            var images = str.split(',');
            $('#postimg' + id).imagesGrid({
                images: images
            });
        }
        @foreach ($baidang as $post)
            loadimg({{ $post->post_id }});
            // load_comment({{ $post->post_id }});
        @endforeach
        $(document).on('submit', '#upload_form', function(e) {
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
            data.append('userid', {{ Auth::user()->user_id }});
            data.append('group_id', '');
            data.append('type_post', '1');
            // data.append('category_post', '1');
            data.append('post_choduyet', '1');
            data.append('caption', $(".cap_post .emojionearea-editor").html());
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
                    post =
                        '<div class="row mt-2"><div class="col-sm-12 "> <div class="card p-0 w-100 "> <div class="card-body p-0 m-0"><div class="row p-0"><div class="col-sm-12"><div class="row mx-1 mt-2">\
                                                    <div class="col-sm-1"><a href="{{ url('/profile/' . Auth::user()->user_id) }}" class="btn p-0" style=" border-radius: 50%; border: 2px solid border: 2px solid hsl(240, 100%, 50%);">\
                                                        <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}" class="m-0"\
                                                        style="height: 40px; border-radius: 50%; width: 40px;" alt=""></a></div>\
                                                    <div class="pl-4 col-md-10">\
                                                    <a href="{{ url('/profile/' . Auth::user()->user_id) }}" class="text-decoration-none"\
                                                        style=" vertical-align:baseline; color:black; font-weight: 600; font-size: 18px;">{{ Auth::user()->firstname . ' ' . Auth::user()->name }}</a>\
                                                                    <p class="text-muted" style="font-size:13px;">\
                                                                        Vừa xong·' +
                        data
                        .status + '</p>\
                                                            </div>\
                                                            <div class="col-sm-1 text-right">\
                                                                <button class="btn p-0 btn-light"\
                                                                    style=" border-radius: 50%; height: 30px; width: 30px;"><i\
                                                                        class="fa fa-ellipsis-h" aria-hidden="true"></i></button>\
                                                            </div>\
                                                        </div>\
                                                    </div>\
                                                </div>\
                                                <div class="row  px-0">\
                                                    <div class="col-sm-12 ">\
                                                        <div class="px-2 ">' + data.caption + '</div>';

                    chuoiimg = '';
                    if (data.img.length > 0) {
                        for (var i = 0; i < data.img.length; i++) {
                            chuoiimg += '../storage/app/assets/img/baidang/' + data.img[i] +
                                ',';
                        }
                        chuoiimg = chuoiimg.slice(0, -1);
                        post += '<div id="mangimg' + data.postid + '" class="d-none">' +
                            chuoiimg +
                            ' </div> <div class="text-center  " onload="function loadimg(' +
                            data.postid + ')" id="postimg' +
                            data.postid + '"></div>  ';
                        // var images = chuoiimg.split(',');
                    }
                    post +=
                        '</div> </div><div class="row pt-2 px-3">\
                                                        <div class="col-sm-12">\
                                                        <span class="text-muted"></span>\
                                                    <span class="text-muted float-right"></span> </div>\
                                                    </div><hr><div class="row px-1 mb-2">\
                                                        <div class="col-sm-4">\
                                                            <div class="btn-group dropup w-100">\
                                                                <button class="btn btn-light w-100 dropup-toggle thacamxuc" id="thacamxuc' +
                        data.postid +
                        '" data-toggle="dropdown"\
                                                        aria-haspopup="true" aria-expanded="false" data-icon="like" data-iconid="1" data-comment="Thích" data-post="' +
                        data.postid +
                        '"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>Thích</button>\
                                                        <div class="dropdown-menu  text-muted badge-pill " aria-labelledby="thacamxuc' +
                        data.postid +
                        '"\
                                                            style="width: 270px !important;">\
                                                            <button class="btn badge-pill hovericon p-0 icon thacamxuc" data-icon="like" data-comment="Thích" data-iconid="1" data-post="' +
                        data.postid +
                        '"><img\
                                                                    src="{{ asset('storage/app/assets/img/icon/like.png') }}" style="height: 35px; width:35px; border-radius: 50%;"\
                                                                    alt="Thích"></button>\
                                                            <button class="btn badge-pill hovericon p-0 icon thacamxuc" data-icon="haha" data-iconid="3" data-comment="Haha" data-post="' +
                        data.postid +
                        '"><img\
                                                                    src="{{ asset('storage/app/assets/img/icon/haha.png') }}" style="height: 35px; width:35px; border-radius: 50%;"\
                                                                    alt="HaHa"></button>\
                                                            <button class="btn badge-pill hovericon p-0 icon thacamxuc" data-icon="love" data-comment="Yêu thích" data-iconid="2" data-post="' +
                        data.postid +
                        '"><img\
                                                                    src="{{ asset('storage/app/assets/img/icon/love.png') }}" style="height: 35px; width:35px; border-radius: 50%;"\
                                                                    alt="Yêu thích"></button>\
                                                            <button class="btn badge-pill hovericon p-0 icon thacamxuc" data-icon="sad" data-iconid="4" data-comment="Buồn bã" data-post="' +
                        data.postid +
                        '"><img\
                                                                    src="{{ asset('storage/app/assets/img/icon/sad.png') }}" style="height: 35px; width:35px; border-radius: 50%;"\
                                                                    alt="Buồn bã"></button>\
                                                            <button class="btn badge-pill hovericon p-0 icon thacamxuc" data-icon="wow" data-comment="Ngạc nhiên" data-iconid="5" data-post="' +
                        data.postid +
                        '"><img\
                                                                    src="{{ asset('storage/app/assets/img/icon/wow.png') }}" style="height: 35px; width:35px; border-radius: 50%;"\
                                                                    alt="Ngạc nhiên"></button>\
                                                            <button class="btn badge-pill hovericon p-0 icon thacamxuc" data-icon="angry" data-comment="Giận dữ" data-iconid="6"    data-post="' +
                        data.postid +
                        '"><img\
                                                                    src="{{ asset('storage/app/assets/img/icon/angry.png') }}" style="height: 35px; width:35px; border-radius: 50%;"\
                                                                    alt="Phẫn nộ"></button>\
                                                        </div></div></div>\
                                                                                            <div class="col-sm-4">\
                                                                                                <a href="http://localhost/mangxh/posts/' +
                        data.postid + '" class="btn btn-comment btn-light w-100 "><i class="fa fa-commenting-o" aria-hidden="true"></i>Bình luận</a>\
                                                                                            </div>\
                                                                                            <div class="col-sm-4">\
                                                                                                <button class="btn btn-light w-100 "><i class="fa fa-share" aria-hidden="true"></i> Chia sẻ</button>\
                                                                                            </div></div>\
                                                                                      </div></div></div></div>';
                    $('#post-data').prepend(post).ready(function() {
                        if (data.img.length > 0) {
                            var str = chuoiimg.toString();
                            var images = str.split(',');
                            $('#postimg' + data.postid).imagesGrid({
                                images: images
                            });
                        }
                    });
                }
            });
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
      
  function previewImages() {
            var $preview = $('#preview').empty();
            if (this.files) $.each(this.files, readAndPreview);

            function readAndPreview(i, file) {
                if (/\.(mp4|avi)$/i.test(file.name)) {
                    $('#category_post').val('2');
                }else
                if (/\.(jpe?g|png|gif|jpg)$/i.test(file.name)) {
                    $('#category_post').val('1');
                    var reader = new FileReader();
                    $(reader).on("load", function() {
                        $preview.append($("<img/>", {
                            src: this.result,
                            height: 200,
                            width: 200
                        }));
                    });
                
                    reader.readAsDataURL(file);
                } else {
                    $('#category_post').val('3');
                }
            }
        }
        $('.imgpost').on("change", previewImages);

        $(document).on('submit', '.sharepost', function(e) {
            e.preventDefault();
            var data = new FormData(this);
        
            var postid = $(".cap_post" + $(this).data('post') + " .emojionearea-editor").html();
            data.append('userid', {{ Auth::user()->user_id }});
            data.append('group_id', '');
            data.append('type_post', '1');
            data.append('category_post', '1');
            data.append('caption', $(".sharecap_post" + $(this).data('post') + " .emojionearea-editor").html());
                console.log($(".sharecap_post" + $(this).data('post') + " .emojionearea-editor").html());
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


        $(document).on('submit', '.editpost', function(e) {
            e.preventDefault();
            var data = new FormData(this);
            let TotalImages = $('#imgpost'+$(this).data('post'))[0].files.length;
            if (TotalImages > 0) {
                for (let i = 0; i < TotalImages; i++) {
                    data.append('imgpost' + i, $("#imgpost"+$(this).data('post'))[0].files[i]);
                }
                data.append('TotalImages', TotalImages);
                data.append('imgpost_type', $("#imgpost"+$(this).data('post'))[0].files[0].type);
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
                    // $('.editpost')[0].reset();
                    $('.emojionearea-editor').html('');
                    // $('#dangbai').modal('hide');
                    $('#preview').html('');
                //    location.reload();
                }
            });
        });
    </script>
@endsection
