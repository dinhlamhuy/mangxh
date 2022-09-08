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
                <a href="{{ url('groups/loimoigroup') }}"
                    class="w-100 mt-2 p-2 text-left font-weight-bold text-decoration-none text-muted btn">Lời mời theo dõi
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

            </div>

        </div>
        <div class="row">
            <div class="col-md-3 " style="z-index: -999;">
            </div>
            <div class="col-md-9 mx-auto">
                <h3 class="my-3 font-weight-bold">Các gửi lời mời</h3>
                @foreach ($dsnhom as $nhom)
                    <?php
                    if (!empty($nhom->group_imgbg)) {
                        $bianhom = $nhom->group_imgbg;
                    } else {
                        $bianhom = 'bggroup.jpg';
                    }
                    ?>
                    <div class="col-md-4 mt-2 groupso{{ $nhom->group_id }}">
                        <div class="card" style="height: 300px !important; ">
                            <div class="card-body" style="position: relative;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img src="{{ asset('storage/app/assets/img/group/' . $bianhom) }}"
                                            class="w-100" style="height: 170px; object-fit: cover;" alt="">
                                        {{-- <p class="text-muted my-0">người mời </p> --}}
                                        <p class="h4 font-weight-bold mt-1">{{ $nhom->group_name }}</p>
                                    </div>
                                    <div class="col-md-12"
                                        style="bottom:10px; vertical-align: bottom; position: absolute; ">

                                        <button class="btn btn-lighter huyloimoi" data-group="{{ $nhom->group_id }}" style="float:left; width: 45%;">Hủy</button>
                                        <button class="btn btn-primary nhanloithamgia" data-group="{{ $nhom->group_id }}" style="float:right; width: 45%;">Tham gia</button>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
        </div>

    </div>
    </div>
@endsection
@section('content-js')
    <script>
        $('#groups').addClass('indam');

        $(document).on('click', '.nhanloithamgia', function(e) {
            e.preventDefault();
            // alert($(this).data('group'));
            $.ajax({
                url: "{{ url('/groups/nhanloimoi') }}",
                method: "POST",
                data: {
                    "_token": '{{ csrf_token() }}',
                    "group_id": $(this).data('group'),
                    "user_id": {{ Auth::user()->user_id }}
                },
                dataType: 'json',
                success: function(data) {
                    alert(data.nd);
                    location.reload();
                }
            });
        });
        $(document).on('click', '.huyloimoi', function(e) {
            e.preventDefault();
            // alert($(this).data('group'));
            $.ajax({
                url: "{{ url('/groups/huyloimoi') }}",
                method: "POST",
                data: {
                    "_token": '{{ csrf_token() }}',
                    "group_id": $(this).data('group'),
                    "user_id": {{ Auth::user()->user_id }}
                },
                dataType: 'json',
                success: function(data) {
                 
                    alert(data.nd);
                    location.reload();
                }
            });
        });
    </script>
@endsection
