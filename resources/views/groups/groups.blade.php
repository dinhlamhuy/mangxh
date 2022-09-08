@extends('layouts.layout')

@section('content-title')
    <title>Nhóm | Halo - Mạng xã hội</title>
@endsection
@section('content-css')
    <style>
        body {
            background-color: #e4e4ec;
        }

        .bx-shadow {
            box-shadow: rgba(0, 0, 0, 0.4) 0px 0px 10px;
            height: 87vh;
            overflow-y: auto;
        }

        .avt-group {
            width: 35px;
            height: 35px;
            border-radius: 50%;

            margin-left: 10px;
        }

    </style>
@endsection
@section('content')
    <div class="container-fluid pb-0 mb-0 " style="margin-top: -10px;">
        <div class="row ">

            <div class="col-md-3 col-sm-3 bg-light mt-0 pt-0 bx-shadow position-fixed " style="height:90vh;">
                <a href="{{ url('groups/loimoigroup') }}" class="w-100 mt-2 p-2 text-left font-weight-bold text-decoration-none text-muted btn">Lời mời theo dõi
                    nhóm</a>
                <a href="{{ url('groups/create') }}" class="btn btn-lighter w-100 mt-2 p-2 text-primary">+ Tạo nhóm
                    mới</a>
                <hr>
                <h3 class="font-weight-bold ">Nhóm quản lý </h3>
                @foreach ($group_founder as $groups)
                    <div class="row mt-3">
                        <div class="col-md-2">
                            <img src="{{ asset('storage/app/assets/img/group/notegroup.png') }}" class="avt-group"
                                alt="">
                        </div>
                        <div class="col-md-10 py-auto text-truncate pt-1">
                            <a class="text-decoration-none" href="{{ url('groups/' . $groups->group_id) }}"
                                title="{{ $groups->group_name }}">
                                <h5 class="font-weight-bold text-dark">{{ $groups->group_name }}</h5>
                            </a>
                        </div>
                    </div>
                @endforeach

                <h3 class="font-weight-bold ">Nhóm đã tham gia </h3>
                @foreach ($mygroups as $groups)
                <?php $trangthai=''; ?>
                @if(!$kttv->isEmpty())
                @foreach ($kttv as $checktv)
                    <?php 
                    if($checktv->group_id==$groups->group_id && $checktv->group_status=='0'){
                        $trangthai='Đã gửi yêu cầu';
                    }
                    ?>
                    @endforeach
                @endif
                    <div class="row mt-3">
                        <div class="col-md-2">
                            <img src="{{ asset('storage/app/assets/img/group/notegroup.png') }}" class="avt-group"
                                alt="">
                        </div>
                        <div class="col-md-10 py-auto text-truncate pt-1">
                            <a class="text-decoration-none mb-0" href="{{ url('groups/' . $groups->group_id) }}"
                                title="{{ $groups->group_name }}">
                                <h5 class="font-weight-bold text-dark">{{ $groups->group_name }}</h5>
                            </a>
                            <span class="text-muted pt-0 " style="font-size: 10px; margin-top:-10px; ">{{ $trangthai }}</span>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
        <div class="row">
            <div class="col-md-3 " style="z-index: -999;">
            </div>
            <div class="col-md-6 mx-auto">

                <div id="post-data">
                    @include('groups.group_feed')
                </div>


            </div>

        </div>
    </div>
@endsection
@section('content-js')
    <script>
        $('#groups').addClass('indam');
        $(document).ready(function() {
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
           
            var timer;
            $('.hiencamxuc').hover(function() {
                // on mouse in, start a timeout
                timer = setTimeout(function() {}, 1000);
            }, function() {
                // on mouse out, cancel the timer
                clearTimeout(timer);
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

        });
    </script>
@endsection
