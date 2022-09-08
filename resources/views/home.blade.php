@extends('layouts.layout')

@section('content-title')
    <title>Halo - Mạng xã hội</title>
@endsection

@section('content-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.css"
        integrity="sha512-0Nyh7Nf4sn+T48aTb6VFkhJe0FzzcOlqqZMahy/rhZ8Ii5Q9ZXG/1CbunUuEbfgxqsQfWXjnErKZosDSHVKQhQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #e4e4ec;
        }

        .cap_post {
            border: none !important;
            box-shadow: none !important;
        }

        .khunghinh {
            background: #0F2027;
            background: -webkit-linear-gradient(to right, #2C5364, #203A43, #0F2027);
            background: linear-gradient(to right, #2C5364, #203A43, #0F2027);
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

        .lishfriend {
            width: 40px !important;
            height: 40px !important;
            border-radius: 50% !important;
        }

        .btn-lighter {
            background-color: #e4e6eb !important;
        }

        .mucluc {
            clear: both;

        }

    </style>
@endsection
@section('content')
    <?php
    if (Auth::user()->avatar) {
        $avatar = Auth::user()->avatar;
    } else {
        $avatar = 'noteimg.png';
    }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3  ">
                <div class="row">
                    <div class="col-md-3 h-100 w-100 position-fixed ">
                        <h2><b>Trang chủ</b></h2>
                        <a href="{{ url('friends') }}" class="text-decoration-none text-dark font-weight-bold h5 row mt-3">
                            <div class="col-md-2 " style="width:70px;">
                                <img src="{{ asset('storage/app/assets/img/icon/iconfriends.png') }}"
                                    style="height: 40px; ">
                            </div>
                            <div class="col-md-10 mt-3">Bạn bè</div>
                        </a>
                        <a href="{{ url('watch') }}" class="text-decoration-none text-dark font-weight-bold h5 row mt-3">
                            <div class="col-md-2 " style="width:70px;">
                                <i class="fa fa-2x fa-television" aria-hidden="true"></i>

                            </div>
                            <div class="col-md-10 mt-2">Xem video</div>
                        </a>
                        <a href="{{ url('/fanpages/') }}"
                            class="text-decoration-none text-dark font-weight-bold h5 row mt-3">
                            <div class="col-md-2 " style="width:70px;">
                                <img src="{{ asset('storage/app/assets/img/icon/iconschools.png') }}"
                                    style="height: 50px;">
                            </div>
                            <div class="col-md-10 mt-3">Trường học</div>
                        </a>

                        <a href="{{ url('/groups/feed') }}"
                            class="text-decoration-none text-dark font-weight-bold h5 row mt-3">
                            <div class="col-md-2 " style="width:70px;">
                                <img src="{{ asset('storage/app/assets/img/icon/icongroups.png') }}"
                                    style="height: 45px;">
                            </div>
                            <div class="col-md-10 mt-3">Nhóm</div>
                        </a>
                        <a href="{{ url('/shop') }}" class="text-decoration-none text-dark font-weight-bold h5 row mt-3">
                            <div class="col-md-2 " style="width:70px;">
                                <img src="{{ asset('storage/app/assets/img/icon/iconshop.png') }}" style="height: 45px;">
                            </div>
                            <div class="col-md-10 mt-3">Cửa hàng</div>
                        </a>
                        <a href="{{ url('/saved') }}" class="text-decoration-none text-dark font-weight-bold h5 row mt-3">
                            <div class="col-md-2 " style="width:70px;">
                                <img src="{{ asset('storage/app/assets/img/icon/iconbookmark.png') }}"
                                    style="height: 45px;">
                            </div>
                            <div class="col-md-10 mt-3">Đã lưu</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 ">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-10 mx-auto">
                            <div class="card p-0 w-100 ">
                                <div class="card-body p-0 m-0">
                                    <div class="row p-0">
                                        <div class="col-sm-12">
                                            <div class="row mx-1 my-2">
                                                <div class="col-sm-2">
                                                    <button class="btn p-0"
                                                        style=" border-radius: 50%; border: 2px solid blue;"><img
                                                            src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"
                                                            class="m-0 cap_avt" alt=""></button>
                                                </div>
                                                <div class="col-sm-10 px-0">
                                                    <button type="button"
                                                        class="btn btn-light badge-pill px-4 text-muted h-100"
                                                        data-toggle="modal" data-target="#dangbai">
                                                        Bạn có muốn chia sẻ hay đặt câu hỏi không?
                                                    </button>
                                                    <button type="button" class="btn  float-right mr-3 text-muted h-100 "
                                                        data-toggle="modal" data-target="#dangbai">
                                                        <i class="fa fa-picture-o fa-2x" aria-hidden="true"></i>
                                                    </button>
                                                    <div class="modal fade " id="dangbai" tabindex="-1"
                                                        aria-labelledby="dangbaiLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="dangbaiLabel">Tạo bài
                                                                        viết</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="POST" id="upload_form"
                                                                        enctype="multipart/form-data">
                                                                        {{ csrf_field() }}
                                                                        <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"
                                                                            class="m-0"
                                                                            style="height: 40px; border-radius: 50%; width: 40px;"
                                                                            alt="">&emsp;
                                                                        <b
                                                                            style="top: -70px; vertical-align: top;">{{ Auth::user()->name }}</b><br>
                                                                        <select name="status" id="status"
                                                                            style="border: none; vertical-align: top; margin-top: -20px; margin-left: 60px; font-size:13px;  float-left"
                                                                            class=" text-muted">
                                                                            <option value="Công khai" selected>Công khai
                                                                            </option>
                                                                            <option value="Bạn bè">Bạn bè</option>
                                                                            <option value="Riêng tư">Riêng tư</option>
                                                                        </select>
                                                                        <div class="form-control cap_post"
                                                                            placeholder="Đăng cảm nghĩ của bạn?"></div>
                                                                        <div id="previews"></div>
                                                                        <input type="hidden" name="category_post"
                                                                            id="category_post" value="1">
                                                                        <input type="file" name="imgpost[]"
                                                                            class="form-control imgpost  float-left"
                                                                            style="width:100%;" id="imgpost" multiple>
                                                                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                                                        <button type="submit" id="dangbai"
                                                                            class="mt-2 dangbai btn btn-primary w-100">Đăng
                                                                            bài</button>
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
                            </div>
                        </div>
                    </div>

                    <div id="post-data">
                        @include('post')
                    </div>
                    <div class="ajax-load text-center mt-3" id="ajax-load">
                        <button class="btn font-weight-bold btn-info">Xem thêm</button>
                        {{-- <p><img src="{{ asset('storage/app/assets/img/icon/loadicon.gif') }}" height="30px" alt=""></p> --}}
                    </div>
                </div>
            </div>
            <div class="col-sm-3 border-left">
                <div class="row">
                    <div class="col-md-3 h-100 w-100 position-fixed ">
                        <h3><b>Bạn bè</b></h3>
                        <ul class="list-group list-group-flush w-100 mr-0" id="listusr">
                            @foreach ($friends as $friend)
                                <?php $friend_avatar = 'noteimg.png';
                                if ($friend->avatar) {
                                    $friend_avatar = $friend->avatar;
                                }
                                ?>
                                <li class="list-group-item bg-transparent">
                                    <a href="{{ url('conversation/' . $friend->user_id) }}" class="text-decoration-none">
                                        <img src="{{ asset('storage/app/assets/img/avatar/' . $friend_avatar) }}"
                                            class="lishfriend">
                                        <span
                                            class="text-muted h6">{{ $friend->firstname . ' ' . $friend->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        @if ($groups->count())
                            <h3><b>Nhóm</b></h3>
                            <ul class="list-group list-group-flush w-100 mr-0 " id="listusr">
                                @foreach ($groups as $group)
                                    <li class="list-group-item bg-transparent">
                                        <a href="{{ route('message-group.show', $group->id) }}"
                                            class="text-decoration-none">
                                            <img src="{{ asset('storage/app/assets/img/group/notegroup.png') }}"
                                                class="lishfriend">
                                            <span class="text-muted h6  ml-2">
                                                <?php
                                                if (strlen($group->groupname) > 30) {
                                                    echo trim(substr($group->groupname, 0, 30)) . '...';
                                                } else {
                                                    echo $group->groupname;
                                                }
                                                ?>
                                            </span>
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        @endif
                    </div>
                </div>


            </div>
        </div>
    </div>






@endsection
@section('content-js')
    <script src="{{ asset('public/vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"
        integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#home').addClass('indam');
            $(".cap_post").emojioneArea({
                pickerPosition: "bottom",
                filtersPosition: "bottom",
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
                        $('#previews').html('');
                        post =
                            '<div class="row mt-2"><div class="col-sm-10 mx-auto"> <div class="card p-0 w-100 "> <div class="card-body p-0 m-0"><div class="row p-0"><div class="col-sm-12"><div class="row mx-1 mt-2">\
                                                    <div class="col-sm-1"><a href="{{ url('/profile/' . Auth::user()->user_id) }}" class="btn p-0" style=" border-radius: 50%; border: 2px solid border: 2px solid hsl(240, 100%, 50%);">\
                                                        <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}" class="m-0"\
                                                        style="height: 40px; border-radius: 50%; width: 40px;" alt=""></a></div>\
                                                    <div class="pl-4 col-md-10">\
                                                    <a href="{{ url('/profile/' . Auth::user()->user_id) }}" class="text-decoration-none"\
                                                        style=" vertical-align:baseline; color:black; font-weight: 600; font-size: 18px;">{{ Auth::user()->firstname . ' ' . Auth::user()->name }}</a>\
                                                                    <p class="text-muted" style="font-size:13px;">\
                                                                        Vừa xong ·' +
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
                                chuoiimg += 'storage/app/assets/img/baidang/' + data.img[i] +
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
                        $('#previews').html('');
                        location.reload();
                    }
                });
            });

            var timer;
            $('.hiencamxuc').hover(function() {
                // on mouse in, start a timeout
                timer = setTimeout(function() {}, 1000);
            }, function() {
                // on mouse out, cancel the timer
                clearTimeout(timer);
            });






        });



        function previewImages() {
            var $preview = $('#previews').empty();
            if (this.files) $.each(this.files, readAndPreview);

            function readAndPreview(i, file) {
                if (/\.(jpe?g|png|gif|jpg)$/i.test(file.name)) {
                    var reader = new FileReader();
                    $(reader).on("load", function() {
                        $preview.append($("<img/>", {
                            src: this.result,
                            height: 200,
                            width: 200
                        }));
                    });
                
                    $('#category_post').val('1');
                    reader.readAsDataURL(file);

                } else
                if (/\.(mp4|avi)$/i.test(file.name)) {
                    $('#category_post').val('2');

                } else {
                    $('#category_post').val('3');
                }
            }
        }
        $('#imgpost').on("change", previewImages);
    </script>
@endsection
