@foreach ($baidang as $post)
    <div class="row mt-2">
        <div class="col-sm-10 mx-auto">
            <div class="card p-0 w-100 ">
                <div class="card-body p-0 m-0">
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
                                        <a class="btn p-0" href="{{ url('/profile/' . $post->user_id) }}"
                                            style=" border-radius: 50%; border: 2px solid hsl(240, 100%, 50%);"><img
                                                src="{{ asset('storage/app/assets/img/school/' . $school_avatar) }}"
                                                class="m-0 cap_avt" loading="lazy"></a>
                                    </div>
                                    <div class="pl-4 col-md-10">

                                        <a href="{{ url('/fanpage/' . $post->idschool) }}"
                                            class="text-decoration-none"
                                            style=" vertical-align:baseline; color:black; font-weight: 600; font-size: 18px;">{{ $post->school_category . ' ' . $post->school_name }}
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
                                        <a class="btn p-0" href="{{ url('/profile/' . $post->user_id) }}"
                                            style=" border-radius: 50%; border: 2px solid hsl(240, 100%, 50%);"><img
                                                src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"
                                                class="m-0 cap_avt" loading="lazy"></a>
                                    </div>
                                    <div class="pl-4 col-md-10">
                                        <a href="{{ url('/profile/' . $post->user_id) }}" class="text-decoration-none"
                                            style=" vertical-align:baseline; color:black; font-weight: 600; font-size: 18px;">{{ $post->firstname . ' ' . $post->name }}</a>
                                        @if (!empty($post->group_id))
                                            &ensp;<i class="fa fa-caret-right" aria-hidden="true"></i>&ensp;
                                            <a href="{{ url('/groups/' . $post->group_id) }}"
                                                class="text-decoration-none"
                                                style=" vertical-align:baseline; color:black; font-weight: 600; font-size: 18px;">{{ $post->group_name }}</a>
                                        @endif
                                    @endif
                                    <p class="text-muted" style="font-size:13px;">
                                        {{ date('d/m/Y', strtotime($post->ngaydang)) }} lúc
                                        {{ date('H:i', strtotime($post->ngaydang)) }}
                                        ·
                                        @if ($post->type_post == '1')
                                            @if ($post->status == 'Công khai')
                                                <i class="fa fa-globe" aria-hidden="true"></i>
                                            @elseif($post->status == 'Bạn bè')
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                            @elseif($post->status == 'Riêng tư')
                                                <i class="fa fa-lock" aria-hidden="true"></i>
                                            @endif
                                        @elseif($post->type_post == '2')
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                        @elseif($post->type_post == '3')
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        @endif
                                    </p>
                                </div>
                                <div class=" mb-0 text-right col-md-1 pr-2 ">

                                    <a class="nav-link dropdown-toggle btn  btn-light text-dark text-muted  float-right p-0"
                                        style=" border-radius: 50%; height: 30px; width: 30px;" href="#" id="thongbao"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu mr-0 dropdown-menu-right" aria-labelledby="thongbao">

                                        <button class="dropdown-item saved_post" data-post="{{ $post->post_id }}">Lưu bài
                                            đăng</button>

                                        <div class="dropdown-divider"></div>
                                        <button class="dropdown-item baocao" type="button"  data-toggle="modal" data-target="#tocaobaidang" data-post="{{ $post->post_id }}">Báo cáo vi phạm</button>
                                        {{-- <button class="dropdown-item" >Chép link</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row  px-0">
                        <div class="col-sm-12 ">
                            <div class="px-2 ">{!! $post->caption !!} </div>
                            <?php
                            if($post->category_post == '3' ){?>
                             @foreach ($imgbaidang as $imgpost)
                             <?php if ($post->post_id == $imgpost->post_id) {?>
                             <object data={{ asset('storage/app/assets/img/baidang/' . $imgpost->img_name) }}"
                                         type="{{ $imgpost->img_type }}" width="300" height="200">
                                         <a href="{{ asset('storage/app/assets/img/baidang/' . $imgpost->img_name) }}"
                                             target="blank" class="img_name mt-3 mb-0 ml-2 text-decoration-none">
                                             <i class="fa fa-file text-primary"
                                                 aria-hidden="true"></i>&ensp;{{ $imgpost->img_name }}</a>
                                     </object>
                           <?php } ?>
                         @endforeach
                           <?php  }else if($post->category_post == '1' ) {
                            $kq = 0;
                            $img_post = []; ?>
                            @foreach ($imgbaidang as $imgpost)
                                <?php if ($post->post_id == $imgpost->post_id) {
                                    $img_post[] = ['img' => $imgpost->img_name];
                                }
                                
                                ?>
                            @endforeach
                            <?php if(count($img_post) >0){
                            $string= '';
                            foreach ($img_post as $imgpost):
                            $string.='storage/app/assets/img/baidang/'. $imgpost['img'].',';
                        endforeach;                                             
                        $string=substr($string, 0, -1); ?>
                            <div id="mangimg{{ $post->post_id }}" class="d-none">
                                <?= $string ?>
                            </div>
                            <div class="text-center  " onload="function loadimg('{{ $post->post_id }}')"
                                id="postimg{{ $post->post_id }}">
                            </div>
                            <?php } 
                        } else { ?>
                         @foreach ($imgbaidang as $imgpost)
                         <?php if ($post->post_id == $imgpost->post_id) {?>
                                <video controls preload="none"
                                autoplay="false" 
                                muted="false" loop="false" style="width:100%; height: 400px; background-color: cadetblue;">
                                    <source src="{{ asset('storage/app/assets/img/baidang/' . $imgpost->img_name) }}"
                                        type="{{ $imgpost->img_type }}">
                                </video>

                                 <?php }?>
                                 @endforeach
                              <?php   }?>

                        </div>
                    </div>
                    <div class="row pt-2 px-3">
                        <div class="col-sm-12">


                            <?php
                                $dsemoticons = array();
                                 foreach ($emoticons as $emoti) {
                                    if ($emoti->post_id == $post->post_id) {
                                        if(in_array($emoti->icon_symbol,$dsemoticons, TRUE)){
                                            
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
                    <div class="row px-1 mb-2 pt-0">
                        <div class="col-sm-5 mx-auto">
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
                                                $hien = '<img src="storage/app/assets/img/icon/' . $emoti->icon_symbol . '.png" style="height: 20px; width:20px; border-radius: 50%;" > ' . $emoti->icon_name;
                                            } else {
                                                $hien = '<i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Thích';
                                            }
                                        }
                                    }
                                    echo $hien;
                                    ?>
                                </button>
                                <div class="dropdown-menu text-muted badge-pill"
                                    aria-labelledby="thacamxuc{{ $post->post_id }}"
                                    style="width: 270px; margin-bottom: -5px;">
                                    @foreach($icon as $cx)
                                    <button class="btn badge-pill hovericon p-0 thacamxuc" data-icon="{{ $cx->icon_symbol }}"
                                        data-comment="{{ $cx->icon_name }}" data-iconid="{{ $cx->icon_id }}" data-post="{{ $post->post_id }}"><img
                                            src="{{ asset('storage/app/assets/img/icon/'.$cx->icon_symbol.'.png') }}"
                                            title="{{ $cx->icon_name }}"></button>
                                    @endforeach
                                  
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5 mx-auto">
                            <a href="{{ url('posts/' . $post->post_id) }}" class="btn btn-light w-100 btn-comment"><i
                                    class="fa fa-commenting-o" aria-hidden="true"></i> Bình luận</a>
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
@endforeach
