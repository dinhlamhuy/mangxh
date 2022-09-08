@extends('layouts.layout')

@section('content-title')
    <title>Halo - Mạng xã hội</title>
@endsection

@section('content-css')
    <style>
        .emojioneemoji {
            height: 16px !important;
            width: 16px !important;
        }

    </style>
@endsection
@section('content')
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
            <div class="col-md-6  mt-2">
                <h3><b>Bài đăng đã lưu</b></h3>
                @foreach ($listsaved as $savepost)
                    <?php
                    if ($savepost->avatar) {
                        $avatar = $savepost->avatar;
                    } else {
                        $avatar = 'noteimg.png';
                    }
                    if ($savepost->avatar) {
                        $avatar = $savepost->avatar;
                    } else {
                        $avatar = 'noteimg.png';
                    }
                    if ($savepost->school_avatar) {
                        $schoolavt = $savepost->school_avatar;
                    } else {
                        $schoolavt = 'noteimgschool.png';
                    }
                    ?>


                    {{-- {{  $savepost-> }} --}}
                    <div class="card bookmark{{ $savepost->bm_id }}" style="height: 90px;">
                        <div class="card-body p-1">
                            <div class="row">
                                <div class="col-md-1">
                                    <center>
                                        @if ($savepost->type_post == '1')
                                            <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"
                                                class="m-0   border" alt=""
                                                style="height: 70px; width:70px; border-radius:50%; object-fit: cover;">
                                        @elseif($savepost->type_post == '2')
                                            <img src="{{ asset('storage/app/assets/img/group/notegroup.png') }}"
                                                class="m-0   border" alt=""
                                                style="height: 70px; width:70px; border-radius:50%; object-fit: cover;">
                                        @elseif($savepost->type_post == '3')
                                            <img src="{{ asset('storage/app/assets/img/school/' . $schoolavt) }}"
                                                class="m-0   border" alt=""
                                                style="height: 70px; width:70px; border-radius:50%; object-fit: cover;">
                                        @endif

                                    </center>
                                </div>
                                <div class="col-md-8 py-0 pl-4">
                                    <h5 class="font-weight-bold">
                                        Từ
                                        @if ($savepost->type_post == '1')
                                            {{ $savepost->firstname . ' ' . $savepost->name }}
                                        @elseif($savepost->type_post == '2')
                                            {{ $savepost->group_name }}
                                        @elseif($savepost->type_post == '3')
                                            {{ $savepost->school_name }}
                                        @endif
                                    </h5>
                                    @if (!empty($savepost->caption))
                                        <div class="text-muted ml-3 "
                                            style="font-size:10px; height:45px; overflow: hidden;">{!! $savepost->caption !!}
                                        </div>
                                    @endif

                                </div>
                                <div class="col-md-3" style="vertical-align: bottom;">

                                    <p style="font-size:10px; " class="text-muted text-right mb-0">Ngày lưu:
                                        {{ date('H:i d/m/Y', strtotime($savepost->ngayluu)) }}</p>
                                    <br>
                                    <button style="font-size: 13px;"
                                        class="btn float-right cancel_post mt-0 btn-light"
                                        data-bmid="{{ $savepost->bm_id }}"><i class="fa fa-bookmark-o"
                                            aria-hidden="true"></i><i class="fa fa-ban"
                                            style="margin-left: -4px; font-size:8px;" aria-hidden="true"></i></button>
                                    <a href="{{ url('posts/' . $savepost->post_id) }}" style="font-size: 13px;"
                                        class="float-right  btn text-light btn-primary">Xem chi
                                        tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
@section('content-js')
    <script>
        $(document).ready(function() {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            $(document).on('click', '.cancel_post', function(e) {
                e.preventDefault();
                var bmid = $(this).data('bmid');
                $.ajax({
                    url: "{{ url('cancelpost') }}",
                    method: "POST",
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "bm_id": bmid,
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('.' + data.bm_id).remove();
                        toastr["success"](
                            "Xóa bài đăng đã lưu!"
                            );
                    }
                });
            });



        });
    </script>
@endsection
