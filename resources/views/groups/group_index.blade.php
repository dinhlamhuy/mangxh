@extends('groups.header')



@section('header_groups_css')
    <link rel="stylesheet" href="{{ asset('resources/css/groups.css') }}">
    <style>
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

    </style>
@endsection
@section('header_groups')
    <?php
    if (Auth::user()->avatar) {
        $avatar = Auth::user()->avatar;
    } else {
        $avatar = 'noteimg.png';
    }
    ?>


  
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
                    <b style="top: -70px; vertical-align: top;"
                        class="titlepostgrop">{{ Auth::user()->firstname . ' ' . Auth::user()->name }}
                        &ensp;<i class="fa fa-caret-right"
                            aria-hidden="true"></i>&ensp;{{ $group->group_name }}</b><br>
                    <select name="status" id="status"
                        style="border: none; vertical-align: top; margin-top: -15px; margin-left: 60px; font-size:13px;  float-left"
                        class="text-muted">
                        {{-- <option value="Công khai" selected>Công khai</option>
                        <option value="Bạn bè">Bạn bè</option>
                        <option value="Riêng tư">Riêng tư</option> --}}
                        <?php if ($group->group_privacy == '1') {
                            echo '<option value="Công khai">Công khai</option>';
                        } else {
                            echo '<option value="Riêng tư">Riêng tư</option>';
                        } ?>
                    </select>
                    <div class="form-control cap_post" placeholder="Đăng bài viết cho nhóm?"></div>
                    <div id="preview"></div>
                    <input type="hidden" name="category_post" id="category_post" value="1">
                    <input type="file" name="imgpost[]" class="form-control imgpost  float-left" style="width:100%;"
                        id="imgpost" multiple>
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button type="submit" id="btndangbai" class="mt-2 dangbai btn btn-primary w-100">Đăng bài</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <div class="container-fluid" style="margin-top: 20px">
        <div class="row">
            @if ($group->group_privacy == '1')
                <div class="col-md-1"></div>
                <div class="col-md-6 mx-auto">
                    <div class="card p-0 w-100 " style="border-radius:12px; ">
                        <div class="card-body p-0 m-0">

                            <div class="row mx-2 my-3">
                                <div class="col-sm-1">
                                    <button class="btn p-0" style=" border-radius: 50%; border: 2px solid blue;"><img
                                            src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"
                                            class="m-0 cap_avt" alt=""></button>
                                </div>
                                <div class="col-sm-10 px-0 ">
                                    <button type="button"
                                        class="btn btn-light  w-100 ml-2 badge-pill text-muted h-100 text-left"
                                        data-toggle="modal" data-target="#dangbai">
                                        Bạn có muốn viết gì cho nhóm?
                                    </button>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn  px-0 text-muted  " data-toggle="modal"
                                        data-target="#dangbai">
                                        <i class="fa fa-picture-o fa-2x" aria-hidden="true"></i>
                                    </button>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div id="post-data">
                        @include('groups.group_post')
                    </div>
                </div>
            @elseif($group->group_privacy == '2' && $ktthanhvien==null )
                <div class="col-md-1"></div>
                <div class="col-md-6 ">
                    <div class="card  w-100 " style="border-radius:12px; ">
                        <div class="card-body p-0 m-0 py-5">
                            <center>
                                <h1><i class="fa fa-3x fa-lock text-muted" aria-hidden="true"></i></h1>
                                <h1>Đây là nhóm riêng tư</h1>
                                <h4 class="text-muted">
                                    Hãy tham gia nhóm này để xem hoặc cùng thảo luận nhé.
                                </h4>
                            </center>
                        </div>
                    </div>
                </div>
            @else
                @if ($ktthanhvien->group_status == '1' )
                    <div class="col-md-1"></div>
                    <div class="col-md-6 mx-auto">
                        <div class="card p-0 w-100 " style="border-radius:12px; ">
                            <div class="card-body p-0 m-0">

                                <div class="row mx-2 my-3">
                                    <div class="col-sm-1">
                                        <button class="btn p-0"
                                            style=" border-radius: 50%; border: 2px solid blue;"><img
                                                src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"
                                                class="m-0 cap_avt" alt=""></button>
                                    </div>
                                    <div class="col-sm-10 px-0 ">
                                        <button type="button"
                                            class="btn btn-light  w-100 ml-2 badge-pill text-muted h-100 text-left"
                                            data-toggle="modal" data-target="#dangbai">
                                            Bạn có muốn viết gì cho nhóm?
                                        </button>

                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn  px-0 text-muted  " data-toggle="modal"
                                            data-target="#dangbai">
                                            <i class="fa fa-picture-o fa-2x" aria-hidden="true"></i>
                                        </button>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div id="post-data">
                            @include('groups.group_post')
                        </div>
                    </div>
                @elseif($ktthanhvien->group_status == '0')
                    <div class="col-md-1"></div>
                    <div class="col-md-6 ">
                        <div class="card  w-100 " style="border-radius:12px; ">
                            <div class="card-body p-0 m-0 py-5">
                                <center>
                                    <h1><i class="fa fa-3x fa-lock text-muted" aria-hidden="true"></i></h1>
                                    <h1>Đây là nhóm riêng tư</h1>
                                    <h4 class="text-muted">
                                        Hãy tham gia nhóm này để xem hoặc cùng thảo luận nhé.
                                    </h4>
                                </center>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            <div class="col-md-4">
                <div class="card" style="border-radius:12px; ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Giới thiệu nhóm</h4>
                                <h6><b>
                                    @if ($group->group_privacy == '1')
                                    <i class="fa fa-globe" aria-hidden="true"></i>&ensp;Đây là nhóm công khai<br></b>
                                    {{-- <span class="text-muted ml-3" style="font-size: 12px;">
                                      Bất kỳ ai cũng có thể nhìn thấy mọi người trong nhóm và những gì họ đăng.
                                    </span> --}}
                                    @elseif($group->group_privacy == '2')
                                    <i class="fa fa-lock" aria-hidden="true"></i>&ensp;Đây là nhóm riêng tư<br></b>
                                    {{-- <span class="text-muted ml-3" style="font-size: 12px;">
                                      Những ai tham gia vào nhóm mới có thể nhìn thấy mọi người trong nhóm và những gì họ đăng.
                                    </span> --}}
                                @endif
                                    </h6>
                                    <h6><b><i class="fa fa-clock-o" aria-hidden="true"></i>&ensp;Ngày tạo nhóm</b><br>
                                  <span class="text-muted ml-3" style="font-size: 12px;">
                                    Đang tạo nhóm vào {{ date('\L\ú\c\ H:i A \N\g\à\y d \T\h\á\n\g m \N\ă\m Y',strtotime($group->created_at)) }}
                                  {{-- . Lần cập nhật gần nhất là {{ date('\L\ú\c\ H:i A \N\g\à\y d \T\h\á\n\g m \N\ă\m Y',strtotime($group->updated_at)) }} --}}
                                  </span>
                                    </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>

           
        </div>
    </div>

  
@endsection
@section('header_groups_js')
    <script src="{{ asset('public/vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"
        integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#discussion').addClass('btn-active');
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
                data.append('group_id', {{ $group->group_id }});
                data.append('type_post', '2');
                // data.append('category_post', '1');
                // data.append('caption', $(".editor").val());
                data.append('caption', $(".cap_post .emojionearea-editor").html());
                console.log($(".cap_post .emojionearea-editor").html());
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
                        $('#dangbai').modal('hide')
                        $('#preview').html('');
                        post =
                            '<div class="row mt-2 "><div class="col-sm-12 mx-auto"> <div class="card p-0 w-100 "> <div class="card-body p-0 m-0"><div class="row p-0"><div class="col-sm-12"><div class="row mx-1 mt-2">\
                                                                                                <div class="col-sm-1"><a href="{{ url('/profile/' . Auth::user()->user_id) }}" class="btn p-0" style=" border-radius: 50%; border: 2px solid border: 2px solid hsl(240, 100%, 50%);">\
                                                                                                    <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}" class="m-0"\
                                                                                                    style="height: 40px; border-radius: 50%; width: 40px;" alt=""></a></div>\
                                                                                                <div class="pl-4 col-md-10">\
                                                                                                <a href="{{ url('/profile/' . Auth::user()->user_id) }}" class="text-decoration-none"\
                                                                                                    style=" vertical-align:baseline; color:black; font-weight: 600; font-size: 18px;">{{ Auth::user()->firstname . ' ' . Auth::user()->name }}</a>\
                                                                                                                <p class="text-muted" style="font-size:13px;">\
                                                                                                                    Vừa xong·' +
                            data
                            .status +
                            '</p>\
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
                                                                                                        <div class="px-2 ">' +
                            data
                            .caption + '</div>';
                        chuoiimg = '';
                        if (data.img.length > 0) {
                            for (var i = 0; i < data.img.length; i++) {
                                chuoiimg += '../storage/app/assets/img/baidang/' + data.img[i] +
                                    ',';
                            }
                            chuoiimg = chuoiimg.slice(0, -1);
                            post += '<div id="mangimg' + data.postid + '" class="d-none">' +
                                chuoiimg +
                                ' </div> <div class="text-center " onload="function loadimg(' +
                                data.postid + ')" id="postimg' + data.postid + '"></div>  ';
                        }
                        post +=
                            '</div> </div><div class="row pt-2 px-3">\
                                                    <div class="col-sm-12">\
                                                    <span class="text-muted"></span>\
                                                <span class="text-muted float-right"></span> </div>\
                                                </div><hr><div class="row px-1 mb-2">\
                                                    <div class="col-sm-4">\
                                                        <div class="btn-group dropup w-100">\
                                                            <button class="btn btn-light w-100 dropup-toggle thacamxuc" id="thacamxuc' +data.postid +'" data-toggle="dropdown"\
                                                    aria-haspopup="true" aria-expanded="false" data-icon="like" data-iconid="1" data-comment="Thích" data-post="'+data.postid+'"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>Thích</button>\
                                                    <div class="dropdown-menu  text-muted badge-pill " aria-labelledby="thacamxuc'+data.postid +'"\
                                                        style="width: 270px !important;">\
                                                        <button class="btn badge-pill hovericon p-0 icon thacamxuc" data-icon="like" data-comment="Thích" data-iconid="1" data-post="'+ data.postid +'"><img\
                                                                src="{{ asset('storage/app/assets/img/icon/like.png') }}" style="height: 35px; width:35px; border-radius: 50%;"\
                                                                alt="Thích"></button>\
                                                        <button class="btn badge-pill hovericon p-0 icon thacamxuc" data-icon="haha" data-iconid="3" data-comment="Haha" data-post="'+data.postid +'"><img\
                                                                src="{{ asset('storage/app/assets/img/icon/haha.png') }}" style="height: 35px; width:35px; border-radius: 50%;"\
                                                                alt="HaHa"></button>\
                                                        <button class="btn badge-pill hovericon p-0 icon thacamxuc" data-icon="love" data-comment="Yêu thích" data-iconid="2" data-post="'+data.postid +'"><img\
                                                                src="{{ asset('storage/app/assets/img/icon/love.png') }}" style="height: 35px; width:35px; border-radius: 50%;"\
                                                                alt="Yêu thích"></button>\
                                                        <button class="btn badge-pill hovericon p-0 icon thacamxuc" data-icon="sad" data-iconid="4" data-comment="Buồn bã" data-post="'+data.postid +'"><img\
                                                                src="{{ asset('storage/app/assets/img/icon/sad.png') }}" style="height: 35px; width:35px; border-radius: 50%;"\
                                                                alt="Buồn bã"></button>\
                                                        <button class="btn badge-pill hovericon p-0 icon thacamxuc" data-icon="wow" data-comment="Ngạc nhiên" data-iconid="5" data-post="'+data.postid +'"><img\
                                                                src="{{ asset('storage/app/assets/img/icon/wow.png') }}" style="height: 35px; width:35px; border-radius: 50%;"\
                                                                alt="Ngạc nhiên"></button>\
                                                        <button class="btn badge-pill hovericon p-0 icon thacamxuc" data-icon="angry" data-comment="Giận dữ" data-iconid="6"    data-post="'+data.postid +'"><img\
                                                                src="{{ asset('storage/app/assets/img/icon/angry.png') }}" style="height: 35px; width:35px; border-radius: 50%;"\
                                                                alt="Phẫn nộ"></button>\
                                                    </div></div></div>\
                                                                                        <div class="col-sm-4">\
                                                                                            <a href="http://localhost/mangxh/posts/'+data.postid+'" class="btn btn-comment btn-light w-100 "><i class="fa fa-commenting-o" aria-hidden="true"></i>Bình luận</a>\
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
            
            var timer;
            $('.hiencamxuc').hover(function() {
                // on mouse in, start a timeout
                timer = setTimeout(function() {}, 1000);
            }, function() {
                // on mouse out, cancel the timer
                clearTimeout(timer);
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
            $('#imgpost').on("change", previewImages);
        });



        
       
    </script>
@endsection
