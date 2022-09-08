@extends('fanpages.manaheader')
@section('header_fanpage_title')
    <title>{{ $school->school_name }} | Mạng xã hội EDuck</title>
@endsection
@section('header_fanpage_css')
@endsection
@section('header_fanpage')
    <?php
    if (Auth::user()->avatar) {
        $avatar = Auth::user()->avatar;
    } else {
        $avatar = 'noteimg.png';
    }

    $anhdaidien='noteimgschool.png';
if(!empty($school->school_avatar)){
    $anhdaidien=$school->school_avatar;

}
    ?>
    <div class="container-fluid" style="margin-top: 20px">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="card" style="border-radius:12px; ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Giới thiệu</h4>
                                <div>{!! $school->school_about !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mx-auto">
                <div class="card p-0 w-100 " style="border-radius:12px; ">
                    <div class="card-body p-0 m-0">
                        <div class="row mx-2 my-3">
                            <div class="col-sm-1 mx-auto">
                                <button class="btn p-0" style=" border-radius: 50%; border: 2px solid blue;"><img
                                        src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"
                                        class="m-0 cap_avt" alt=""></button>
                            </div>
                            <div class="col-sm-8 px-0 ">
                                <button type="button"
                                    class="btn btn-light  w-100 ml-2 badge-pill text-muted h-100 text-center font-weight-bold"
                                    data-toggle="modal" data-target="#dangbai">
                                    Tạo bài viết
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
                                                        {{-- <option value="Bạn bè">Bạn bè</option>
                                                        <option value="Riêng tư">Riêng tư</option> --}}
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
                            <div class="col-md-1 mx-auto">
                                <button type="button" class="btn  px-0 text-muted  " data-toggle="modal"
                                    data-target="#dangbai">
                                    <i class="fa fa-picture-o fa-2x" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="post-data">
                @include('fanpages.fanpage_post')
            </div>
            </div>

            <div class="col-md-1"></div>

        </div>
    </div>
  
@endsection
@section('header_fanpage_js')
    <script>
        $(document).ready(function() {
            $('#index').addClass('btn-active');
            $(".cap_post").emojioneArea({
                pickerPosition: "top",
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
                data.append('school_id', {{ $school->school_id }});
                data.append('type_post', '3');
                // data.append('category_post', '1');
                data.append('post_choduyet', '1');
                data.append('group_id', '');
                // data.append('caption', $(".editor").val());
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
                        post = '<div class="row mt-2"><div class="col-sm-12 mx-auto"> <div class="card p-0 w-100 "> <div class="card-body p-0 m-0"><div class="row p-0"><div class="col-sm-12"><div class="row mx-1 mt-2">\
                                            <div class="col-sm-2"><button class="btn p-0"style=" border-radius: 50%; border: 2px solid blue;">\
                                                <img src="{{ asset('storage/app/assets/img/school/' . $anhdaidien) }}" class="m-0"\
                                                style="height: 40px; border-radius: 50%; width: 40px;" alt=""></button></div>\
                                            <div class="col-sm-8 px-0">\
                                            <a href="" class="text-decoration-none" style=" vertical-align:baseline; color:black; font-weight: 600; font-size: 18px;">{{ $school->school_name }}</a>\
                                                            <p class="text-muted" style="font-size:13px;">\
                                                                Vừa xong</p>\
                                                        </div>\
                                                        <div class="col-sm-2 text-right">\
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
