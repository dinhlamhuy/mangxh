@extends('layouts.layout')

@section('content-title')
    <title>Xem bài viết</title>
@endsection

@section('content-css')
    <style>
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

        .replycmt:focus {
            box-shadow: none !important;
            outline: none !important;
        }

        #loadcmt {
            /* height: 65vh; */
            padding-bottom: 20px;
            overflow-y: auto;
            overflow-x: hidden;

        }

        .div_caption {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            /* number of lines to show */
            line-height: 1.4em;
            /* fallback */
            max-height: 4.2em;
            /* cái này phải = line-height x 2 */
        }

        .text-cmt button {
            font-size: 13px;
            top: 0;
            font-weight: bold;
            text-color: gray;
        }

        .text-cmt {
            /* background-color: darkcyan; */
            margin-left: 10px;
            background-color: rgba(160, 108, 108, 0.11);
            width: 620px;
            border-radius: 12px 12px 0 0;
            height: 50px;
            font-size: 13px;
        }

        .text-cmt .nd {
            text-overflow: ellipsis;
            overflow: hidden;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            display: -webkit-box;
            margin-left: -50px;
            float: left;

        }

        .name {
            font-size: 16px;
            float: left;
            font-weight: bold;
        }

    </style>
@endsection
@section('content')
    <?php
    if (Auth::user()->avatar) {
        $myavatar = Auth::user()->avatar;
    } else {
        $myavatar = 'noteimg.png';
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
            <div class="col-md-6 ">
                <div class="card p-0 w-auto">
                    <div class="card-body p-0 m-0">
                        <div class="row bg-white border-bottom p-0 m-0">
                            <div class="col-md-1 px-0">
                                <a href="{{ url()->previous() }}" class="btn  text-left">
                                    <i class="fa fa-2x fa-arrow-circle-left text-info " aria-hidden="true"></i></a>
                            </div>
                            <div class="col-md-10 pt-2">
                                <center>
                                    <h4 clas="">Bài viết của
                                        @if ($post->type_post == '3')
                                            {{ $post->school_name }}
                                        @elseif($post->type_post == '2')
                                            {{ $post->group_name }}
                                        @else
                                            {{ $post->name }}
                                        @endif
                                    </h4>
                                </center>
                            </div>
                            <div class="col-md-1  pt-2">
                                {{-- <button class="btn"> <i class="fa fa-bars" aria-hidden="true"></i></button> --}}
                                <a class="nav-link dropdown-toggle btn  btn-light text-dark text-muted  float-right p-0"
                                    style=" border-radius: 50%; height: 30px; width: 30px;" href="#" id="thongbao"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                </a>
                                <div class="dropdown-menu mr-0 dropdown-menu-right" aria-labelledby="thongbao">

                                    <button class="dropdown-item saved_post" data-post="{{ $post->post_id }}">Lưu bài
                                        đăng</button>

                                    <div class="dropdown-divider"></div>
                                    <button class="dropdown-item baocao" type="button" data-toggle="modal"
                                        data-target="#tocaobaidang" data-post="{{ $post->post_id }}">Báo cáo vi
                                        phạm</button>
                                    {{-- <button class="dropdown-item" >Chép link</button> --}}
                                </div>
                            </div>
                        </div>
                        <div class="row mx-0 ">
                            <div class="col-sm-12 mr-0 pr-0  ">
                                <div class="row p-0">
                                    <div class="col-sm-12">
                                        <div class="row mx-1 mt-2 w-100">
                                            @if ($post->type_post == '3')
                                                <div class=" col-md-1">
                                                    <?php
                                                    if ($post->school_avatar) {
                                                        $school_avatar = $post->school_avatar;
                                                    } else {
                                                        $school_avatar = 'noteimgschool.png';
                                                    }
                                                    ?>
                                                    <a class="btn p-0"
                                                        href="{{ url('/profile/' . $post->user_id) }}"
                                                        style=" border-radius: 50%; border: 2px solid hsl(240, 100%, 50%);"><img
                                                            src="{{ asset('storage/app/assets/img/school/' . $school_avatar) }}"
                                                            class="m-0 cap_avt" loading="lazy"></a>
                                                </div>
                                                <div class="pl-4 col-md-10">

                                                    <a href="{{ url('/fanpage/' . $post->school_id) }}"
                                                        class="text-decoration-none"
                                                        style=" vertical-align:baseline; color:black; font-weight: 600; font-size: 18px;">{{  $post->school_name }}
                                                    </a>
                                                @else
                                                    <div class=" col-md-1">
                                                        <?php
                                                        if ($post->avatar) {
                                                            $avatar = $post->avatar;
                                                        } else {
                                                            $avatar = 'noteimg.png';
                                                        }
                                                        ?>
                                                        <a class="btn p-0"
                                                            href="{{ url('/profile/' . $post->user_id) }}"
                                                            style=" border-radius: 50%; border: 2px solid hsl(240, 100%, 50%);"><img
                                                                src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"
                                                                class="m-0 cap_avt" loading="lazy"></a>
                                                    </div>
                                                    <div class="pl-4 col-md-10">
                                                        <a href="{{ url('/profile/' . $post->user_id) }}"
                                                            class="text-decoration-none"
                                                            style=" vertical-align:baseline; color:black; font-weight: 600; font-size: 18px;">{{ $post->firstname . ' ' . $post->name }}</a>
                                                        @if (!empty($post->group_id))
                                                            &ensp;<i class="fa fa-caret-right" aria-hidden="true"></i>&ensp;
                                                            <a href="{{ url('/groups/' . $post->group_id) }}"
                                                                class="text-decoration-none"
                                                                style=" vertical-align:baseline; color:black; font-weight: 600; font-size: 18px;">{{ $post->group_name }}</a>
                                                        @endif
                                            @endif
                                            <p class="text-muted" style="font-size:13px;">
                                                {{ date('H:i A', strtotime($post->created_at)) }} |
                                                {{ date('d/m/Y', strtotime($post->created_at)) }}</p>
                                        </div>

                                    </div>
                                    <div class="px-2 ">{!! $post->caption !!}
                                    </div>
                                    {{-- chủ bài đăng đã share bài --}}
                                    @if ($post->sharepost_id)
                                        @if (empty($chupost->post_id))
                                        <center>
                                            <div class="text-muted bg-lighter disabled w-auto py-5 h3 mr-5">Bài viết không còn tồn tại</div>

                                        </center>
                                        @else
                                            <hr>
                                            <div class="row mx-3 mt-2 w-100">
                                                @if ($chupost->type_post == '3')
                                                    <div class=" col-md-1">
                                                        <?php
                                                        if ($post->school_avatar) {
                                                            $school_avatar = $chupost->school_avatar;
                                                        } else {
                                                            $school_avatar = 'noteimgschool.png';
                                                        }
                                                        ?>
                                                        <a class="btn p-0"
                                                            href="{{ url('/profile/' . $chupost->user_id) }}"
                                                            style=" border-radius: 50%; border: 2px solid hsl(240, 100%, 50%);"><img
                                                                src="{{ asset('storage/app/assets/img/school/' . $school_avatar) }}"
                                                                class="m-0 cap_avt" loading="lazy"></a>
                                                    </div>
                                                    <div class="pl-4 col-md-10">

                                                        <a href="{{ url('/fanpage/' . $chupost->school_id) }}"
                                                            class="text-decoration-none"
                                                            style=" vertical-align:baseline; color:black; font-weight: 600; font-size: 18px;">{{ $chupost->school_name }}
                                                        </a>
                                                    @else
                                                        <div class=" col-md-1">
                                                            <?php
                                                            if ($chupost->avatar) {
                                                                $avatar = $chupost->avatar;
                                                            } else {
                                                                $avatar = 'noteimg.png';
                                                            }
                                                            ?>
                                                            <a class="btn p-0"
                                                                href="{{ url('/profile/' . $chupost->user_id) }}"
                                                                style=" border-radius: 50%; border: 2px solid hsl(240, 100%, 50%);"><img
                                                                    src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"
                                                                    class="m-0 cap_avt" loading="lazy"></a>
                                                        </div>
                                                        <div class="pl-4 col-md-10">
                                                            <a href="{{ url('/profile/' . $chupost->user_id) }}"
                                                                class="text-decoration-none"
                                                                style=" vertical-align:baseline; color:black; font-weight: 600; font-size: 18px;">{{ $chupost->firstname . ' ' . $chupost->name }}</a>
                                                            @if (!empty($chupost->group_id))
                                                                &ensp;<i class="fa fa-caret-right"
                                                                    aria-hidden="true"></i>&ensp;
                                                                <a href="{{ url('/groups/' . $chupost->group_id) }}"
                                                                    class="text-decoration-none"
                                                                    style=" vertical-align:baseline; color:black; font-weight: 600; font-size: 18px;">{{ $chupost->group_name }}</a>
                                                            @endif
                                                @endif
                                                <p class="text-muted" style="font-size:13px;">
                                                    {{ date('H:i A', strtotime($chupost->created_at)) }} |
                                                    {{ date('d/m/Y', strtotime($chupost->created_at)) }}</p>
                                            </div>

                                </div>
                                <div class="px-2  ml-3 div_caption">{!! $chupost->caption !!}
                                </div>
                                <br>
                                @endif
                                @endif
                            </div>


                        </div>
                        <div class="row  px-0 ">
                            <div class="col-sm-12 pl-0 pt-0">

                                <?php
                                 $loaipost=$post->category_post;
                                    if(!empty($post->sharepost_id)){
                                    if(empty($chupost->post_id)){
                                        $loaipost='4';
                                    }else{
                                        $loaipost=$chupost->category_post;
                                    }
                                    }
                                    if($loaipost=='4'){

                                    }else
                                    if($loaipost == '3'  ){?>
                                @foreach ($imgbaidang as $imgpost)
                                    <?php if ($post->post_id == $imgpost->post_id || 1==1) {?>
                                    <object data={{ asset('storage/app/assets/img/baidang/' . $imgpost->img_name) }}"
                                        type="{{ $imgpost->img_type }}" width="300" height="200">
                                        <a href="{{ asset('storage/app/assets/img/baidang/' . $imgpost->img_name) }}"
                                            target="blank" class="img_name mt-3 mb-0 ml-2 text-decoration-none">
                                            <i class="fa fa-file text-primary"
                                                aria-hidden="true"></i>&ensp;{{ $imgpost->img_name }}</a>
                                    </object>
                                    <?php } ?>
                                @endforeach
                                <?php  } else if($loaipost == '1' ) { $kq = 0;
                                        $img_post = []; ?>
                                @foreach ($imgbaidang as $imgpost)
                                    <?php if ($post->post_id == $imgpost->post_id || 1 == 1) {
                                        $img_post[] = ['img' => $imgpost->img_name];
                                    } ?>
                                @endforeach
                                <?php if(count($img_post) >0){
                                            $string= '';
                                            foreach ($img_post as $imgpost):
                                            $string.='../storage/app/assets/img/baidang/'. $imgpost['img'].',';
                                        endforeach;                                             
                                        $string=substr($string, 0, -1); ?>
                                <div id="mangimg{{ $post->post_id }}" class="d-none">
                                    <?= $string ?>
                                </div>
                                <div class="text-center  border-bottom mt-0"
                                    onload="function loadimg('{{ $post->post_id }}')"
                                    id="postimg{{ $post->post_id }}">
                                </div>
                                <?php }} else { ?>
                                @foreach ($imgbaidang as $imgpost)
                                    <?php if ($post->post_id == $imgpost->post_id || 1==1) {?>
                                    <video controls preload="none" autoplay="false" muted="false" loop="false"
                                        style="width:100%; height: 400px; background-color: cadetblue;">
                                        <source src="{{ asset('storage/app/assets/img/baidang/' . $imgpost->img_name) }}"
                                            type="{{ $imgpost->img_type }}">
                                    </video>

                                    <?php }?>
                                @endforeach
                                <?php   }
                                
                                ?>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12  ml-0  mx-auto">
                        <div class="row pt-2 px-3">
                            <div class="col-sm-12">


                                <?php
                                            $dsemoticons = array();
                                             foreach ($emoticons as $emoti) {
                                                if ($emoti->post_id == $post->post_id) {
                                                    if(in_array($emoti->icon_symbol, $dsemoticons, TRUE)){
                                                        
                                                    }else {
                                                        $dsemoticons[]=$emoti->icon_symbol;?>
                                <img src="{{ asset('storage/app/assets/img/icon/' . $emoti->icon_symbol . '.png') }}"
                                    style="height: 20px; width:20px; border-radius: 50%; margin-left: -7px;">
                                <?php 
                                        }
                                                }
                                            } 
                                            ?>
                                <span class="text-muted" id="symbol{{ $post->post_id }}"> &ensp;
                                    <?php
                                    
                                    foreach ($slicon as $slcamxuc) {
                                        if ($slcamxuc->post_id == $post->post_id) {
                                            echo $slcamxuc->bieucam;
                                            // echo $slcamxuc->icon_symbol;
                                        } else {
                                        }
                                    }
                                    ?>
                                </span>
                                <span class="text-muted float-right"></span>
                            </div>
                        </div>
                        <hr class="my-1">
                        <div class="row px-1 mb-2 pt-0 ">
                            <div class="col-sm-4">
                                <div class="btn-group dropup w-100">
                                    <button class="btn btn-light w-100 dropup-toggle thacamxuc hiencamxuc "
                                        id="thacamxuc{{ $post->post_id }}" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" data-icon="like" data-comment="Thích" data-onoff="yes"
                                        data-post="{{ $post->post_id }}">
                                        <?php
                                        $hien = '<i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Thích';
                                        foreach ($emoticons as $emoti) {
                                            if ($emoti->post_id == $post->post_id) {
                                                if ($emoti->user_id == Auth::user()->user_id) {
                                                    $hien = '<img src="../storage/app/assets/img/icon/' . $emoti->icon_symbol . '.png" style="height: 20px; width:20px; border-radius: 50%;" > ' . $emoti->icon_name;
                                                } else {
                                                    $hien = '<i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Thích';
                                                    // $hien = '<img src="../storage/app/assets/img/icon/' . $emoti->icon_symbol . '.png" style="height: 20px; width:20px; border-radius: 50%;" > ' . $emoti->icon_name;
                                                }
                                            }
                                        }
                                        echo $hien;
                                        ?>
                                    </button>
                                    <div class="dropdown-menu text-muted badge-pill"
                                        aria-labelledby="thacamxuc{{ $post->post_id }}"
                                        style="width: 270px; margin-bottom: -5px;">
                                        @foreach ($icon as $cx)
                                            <button class="btn badge-pill hovericon p-0 thacamxuc"
                                                data-icon="{{ $cx->icon_symbol }}" data-comment="{{ $cx->icon_name }}"
                                                data-iconid="{{ $cx->icon_id }}" data-post="{{ $post->post_id }}"><img
                                                    src="{{ asset('storage/app/assets/img/icon/' . $cx->icon_symbol . '.png') }}"
                                                    title="{{ $cx->icon_name }}"></button>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-light w-100 btn-comment"><i class="fa fa-commenting-o"
                                        aria-hidden="true"></i> Bình luận</button>
                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-light w-100 "><i class="fa fa-share" aria-hidden="true"></i>
                                    Chia sẻ</button>
                            </div>
                        </div>
                        <div class="row comment  mt-1" id="post{{ $post->post_id }}">
                            <div id="democmt" style="margin-left: 70px"></div>
                            <div class="col-md-12 mx-auto">
                                <form class="commentform" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-1 text-right">
                                            <img src="{{ asset('storage/app/assets/img/avatar/' . $myavatar) }}"
                                                class="mr-3 user_cmt">
                                        </div>
                                        <div class="col-md-11 px-1 pr-3">
                                            <input type="hidden" id="reply" name="cmt_reply" value="">
                                            {{-- <input type="hidden" name="user_id" value="{{Auth::user()->user_id}}"> --}}
                                            <input type="hidden" name="post_id" value="{{ $post->post_id }}">
                                            <div type="text" name="cmt_noidung"
                                                class="form-control cmt_noidung float-left bg-light "
                                                style=" border-radius:24px; padding-right:30px;" value=""
                                                placeholder="Viết bình luận ..."></div>
                                        </div>
                                    </div>
                                </form>
                                <div id="loadcmt">
                                    @foreach ($comment as $cmt)
                                        <?php $cmtavatar = 'noteimg.png';
                                        if (!empty($cmt->avatar)) {
                                            $cmtavatar = $cmt->avatar;
                                        } ?>
                                        <div class="row mt-2 ">
                                            <div class="col-md-12 pl-5 pr-0 ">
                                                <div class="media ">
                                                    <img src="{{ asset('storage/app/assets/img/avatar/' . $cmtavatar) }}"
                                                        class="mr-1 user_cmt mt-2">
                                                    <div class="  py-1">
                                                        <div class="border bg-lighter w-auto p-2 mx-0"
                                                            style="width:auto; border-radius:24px;">
                                                            <h6 class=" my-0 font-weight-bold ">
                                                                {{ $cmt->firstname . ' ' . $cmt->name }}
                                                                @if ($post->user_id == $cmt->user_cmt)
                                                                    <span class="text-muted"
                                                                        style="font-size:11px;">Tác giả</span>
                                                                @endif
                                                            </h6>
                                                            <span style="font-size: 14px; ">{!! $cmt->cmt_noidung !!}</span>
                                                        </div>
                                                        <button style="font-size:13px;"
                                                            class="replycmt btn mr-1 float-right   py-0 text-muted border-none"
                                                            onclick="tagfriend('{{ $cmt->cmt_id }}','{{ $cmt->cmt_noidung }}','{{ $cmt->firstname . ' ' . $cmt->name }}')">Trả
                                                            lời</button>
                                                        <span class="float-right mr-2 text-muted "
                                                            style="font-size:12px;">{{ date('H:i d/m/Y', strtotime($cmt->created_at)) }}</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        @foreach ($comment_reply as $cmtreply)
                                            <?php $cmtreplyavatar = 'noteimg.png';
                                            if (!empty($cmtreply->avatar)) {
                                                $cmtreplyavatar = $cmtreply->avatar;
                                            } ?>
                                            @if ($cmtreply->cmt_reply == $cmt->cmt_id)
                                                <div class="row mt-2 ml-4 ">
                                                    <div class="col-md-12 pl-5 pr-0 ">
                                                        <div class="media ">
                                                            <img src="{{ asset('storage/app/assets/img/avatar/' . $cmtreplyavatar) }}"
                                                                class="mr-1 user_cmt mt-2">
                                                            <div class="  py-1">
                                                                <div class="border bg-lighter w-auto p-2 mx-0"
                                                                    style="width:auto; border-radius:24px;">
                                                                    <h6 class=" my-0 font-weight-bold ">
                                                                        {{ $cmtreply->firstname . ' ' . $cmtreply->name }}
                                                                        @if ($post->user_id == $cmtreply->user_cmt)
                                                                            <span class="text-muted"
                                                                                style="font-size:11px;">Tác
                                                                                giả</span>
                                                                        @endif
                                                                    </h6>
                                                                    <span
                                                                        style="font-size: 14px; ">{!! $cmtreply->cmt_noidung !!}</span>
                                                                </div>
                                                                <button style="font-size:13px;"
                                                                    class="replycmt btn mr-1 float-right   py-0 text-muted border-none"
                                                                    onclick="tagfriend('{{ $cmt->cmt_id }}','{{ $cmtreply->cmt_noidung }}','{{ $cmtreply->firstname . ' ' . $cmtreply->name }}')">Trả
                                                                    lời</button>
                                                                <span class="float-right mr-2 text-muted "
                                                                    style="font-size:12px;">{{ date('H:i d/m/Y', strtotime($cmtreply->created_at)) }}</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach
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
@endsection
@section('content-js')
    <script>
        function tagfriend(cmt_id, cmt_nd, username) {
            $('#reply').val(cmt_id);
            nd = '<div class="text-cmt "><button onclick="removetag()" class="btn p-0 btn-cancel float-right">Hủy</button><p class="float-left ml-2 name">' +
                username + '</p><br><p class="nd">' + cmt_nd + '<p></div> ';
            $('#democmt').html(nd);
        }

        function removetag() {
            $('#democmt').html('');
            $('#reply').val('');
            // alert('sdgnsdjn');
        }

        $(document).ready(function() {

            function loadimg(id) {
                var str = $('#mangimg' + id).text().toString();
                var images = str.split(',');
                $('#postimg' + id).imagesGrid({
                    images: images
                });
            }


            loadimg({{ $post->post_id }});


            $(".cmt_noidung").emojioneArea({
                pickerPosition: "bottom",
                filtersPosition: "bottom",
                events: {
                    keypress: function(editor, event) {
                        // $('#gioihansl').text($('.emojionearea-editor').text().length + '/1000');
                        if (event.which === 13 && !event.shiftKey) {
                            // if ($('.cmt_noidung .emojionearea-editor').text().length > 1000) {
                            //     alert('Không được lớn hơn 1000 ký tự nha');
                            //     event.preventDefault();
                            // } else {
                            event.preventDefault();
                            let cmt_noidung = $('.cmt_noidung .emojionearea-editor').html();
                            $('.cmt_noidung .emojionearea-editor').html('');
                            action_comment(cmt_noidung);
                            // alert(cmt_noidung);
                            // }
                        }
                    }
                }
            });
            $(document).on('click', '.saved_post', function(e) {
                e.preventDefault();
                var postid = $(this).data('post');
                var userid = <?= Auth::user()->user_id ?>;

                $.ajax({
                    url: "{{ url('savedpost') }}",
                    method: "POST",
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "post_id": postid,
                        "user_id": userid
                    },
                    dataType: 'json',
                    success: function(data) {}
                });
            });

            function action_comment(cmt_noidung) {
                console.log(cmt_noidung);
                cmt_reply = $('#reply').val();

                var formData = new FormData();
                let token = "{{ csrf_token() }}";
                formData.append('_token', token);
                formData.append('userid', {{ Auth::user()->user_id }});
                formData.append('post_id', {{ $post->post_id }});
                formData.append('cmt_noidung', cmt_noidung);
                formData.append('cmt_reply', cmt_reply);
                if (cmt_noidung !== '') {
                    $.ajax({
                        url: "{{ url('/comment') }}",
                        method: "POST",
                        data: formData,
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            cmt = '<div class="row mt-2">\
                                                                                <div class="col-md-11 mx-auto" >\
                                                                                    <div class="media" ><img src="{{ asset('storage/app/assets/img/avatar/' . $myavatar) }}" class="mr-1 user_cmt mt-2" >\
                                                                                    <div class="py-1" ><div class="border bg-lighter w-auto p-2 mx-0" style="border-radius:24px;">\
                                                                                <h6 class=" my-0 font-weight-bold">' + data
                                .firstname +
                                ' ' +
                                data
                                .name + '</h6>\
                                                                                <span style = "font-size: 14px;" >' + data
                                .cmt_noidung + '</span></div>\
                                                                                <button style="font-size:13px;" class="replycmt btn mr-1 float-right py-0 text-muted border-none">Trả lời</button>\
                                                                                     <span class="float-right mr-2 text-muted " style="font-size:12px;">Vừa xong</span>\
                                                                                     </div></div></div></div>';
                            $('#loadcmt').prepend(cmt);
                            $('.commentform')[0].reset();
                        }
                    });
                }
            }
        });
    </script>
@endsection
