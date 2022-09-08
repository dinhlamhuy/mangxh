@extends('layouts.layout')

@section('content-title')
    <title>Halo - Mạng xã hội</title>
@endsection

@section('content-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.css"
        integrity="sha512-0Nyh7Nf4sn+T48aTb6VFkhJe0FzzcOlqqZMahy/rhZ8Ii5Q9ZXG/1CbunUuEbfgxqsQfWXjnErKZosDSHVKQhQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        
    </style>
@endsection
@section('content')
    <div class="container bg-light py-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4"><b>TÌM KIẾM</b></h2>
            </div>
            <div class="col-md-10 mx-auto ">
               
                <h3 class="font-weight-bold text-primary"><i class="fa fa-user-circle" aria-hidden="true"></i> &ensp;Mọi người</h3>
                <div class="row">
                    @if ($user->isEmpty())
                    <b class="text-muted ml-5 h5">Không tìm thấy</b>
                    @else
                    @foreach ($user as $listusr)
                        @if ($listusr->user_id != Auth::user()->user_id)
                            <?php
                            if ($listusr->avatar) {
                                $user_avatar = $listusr->avatar;
                            } else {
                                $user_avatar = 'noteimg.png';
                            }
                            ?>
                            <div class="col-md-12 ">
                                <hr class="m-0 p-0">
                                <a class="text-decoration-none text-dark my-0" href="{{ url('/profile/' . $listusr->user_id) }}">
                                    <div class="card border-0 bg-light my-2" style="height: 70px;">
                                        <div class="card-body pt-2 my-0">
                                            <div class="row">
                                                <div class="col-md-1 pt-0">
                                                    <img src="{{ asset('storage/app/assets/img/avatar/' . $user_avatar) }}"
                                                        class="m-0  cap_avt border" alt=""
                                                        style="height: 50px; width:50px;">
                                                </div>
                                                <div class="col-md-9 font-weight-bold mt-2">
                                                    <h5>
                                                        {{ $listusr->firstname . ' ' . $listusr->name }}
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @endforeach
                        @endif
                </div>
            </div>
            <div class="col-md-10 mx-auto">
                <h3 class="font-weight-bold text-primary"><i class="fa fa-home" aria-hidden="true"></i> &ensp;Trường</h3>
                @if ($schools->isEmpty())
                <b class="text-muted ml-5 h5">Không tìm thấy</b>
                @else
                    @foreach ($schools as $listschool)
                        <?php
                        if ($listschool->school_avatar) {
                            $school_avatar = $listschool->school_avatar;
                        } else {
                            $school_avatar = 'noteimgschool.png';
                        }
                        ?>
                    <div class="col-md-12 ">
                        <hr class="m-0 p-0">
                        <a class="text-decoration-none text-dark my-0" href="{{ url('/fanpage/' . $listschool->school_id) }}">
                            <div class="card border-0 bg-light my-2" style="height: 70px;">
                                <div class="card-body pt-2 my-0">
                                    <div class="row">
                                        <div class="col-md-1 pt-0">
                                            <img src="{{ asset('storage/app/assets/img/school/'.$school_avatar) }}"
                                                class="m-0  cap_avt border" alt=""
                                                style="height: 50px; width:50px;">
                                        </div>
                                        <div class="col-md-9 font-weight-bold mt-2">
                                            <h5>
                                                {{ $listschool->school_name }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        
                    </div>
                       
                    @endforeach
                @endif
            </div>
            <div class="col-md-10 mx-auto">
                <h3 class="font-weight-bold text-primary"><i class="fa fa-users" aria-hidden="true"></i> &ensp;Nhóm</h3>
                @if ($groups->isEmpty())
                <b class="text-muted ml-5 h5">Không tìm thấy</b>
                @else
                @foreach ($groups as $listgr)
                <div class="col-md-12 ">
                    <hr class="m-0 p-0">
                    <a class="text-decoration-none text-dark my-0" href="{{ url('/groups/' . $listgr->group_id) }}">
                        <div class="card border-0 bg-light my-2" style="height: 70px;">
                            <div class="card-body pt-2 my-0">
                                <div class="row">
                                    <div class="col-md-1 pt-0">
                                        <img src="{{ asset('storage/app/assets/img/group/notegroup.png') }}"
                                            class="m-0  cap_avt border" alt=""
                                            style="height: 50px; width:50px;">
                                    </div>
                                    <div class="col-md-9 font-weight-bold mt-2">
                                        <h5>
                                            {{ $listgr->group_name }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    
                </div>
                 
                @endforeach
                @endif

            </div>
        </div>
    </div>
@endsection
@section('content-js')
@endsection
