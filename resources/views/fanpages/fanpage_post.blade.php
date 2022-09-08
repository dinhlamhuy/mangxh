@foreach ($baidang as $post)
    <div class="row mt-2">
        <div class="col-sm-12 mx-auto">
            <div class="card p-0 w-100 ">
                <div class="card-body p-0 m-0">
                    <div class="row p-0">
                        <div class="col-sm-12">
                            <div class="row mx-1 mt-2 w-100">
                                
                                <div class=" col-md-1">
                                    <?php
                                        $school_avatar = 'noteimgschool.png';
                                    if ($post->school_avatar) {
                                        $school_avatar = $post->school_avatar;
                                    } 
                                    ?>
                                    <a class="btn p-0" href="{{ url('/profile/' . $post->user_id) }}"
                                        style=" border-radius: 50%; border: 2px solid hsl(240, 100%, 50%);"><img
                                            src="{{ asset('storage/app/assets/img/school/' . $school_avatar) }}"
                                            class="m-0 cap_avt" loading="lazy"></a>
                                </div>
                                <div class="pl-4 col-md-10">
                                    <a href="{{ url('/fanpage/' . $post->idschool) }}" class="text-decoration-none"
                                        style=" vertical-align:baseline; color:black; font-weight: 600; font-size: 18px;">{{ $post->school_name}}
                                        </a>
                                    <p class="text-muted" style="font-size:13px;">
                                        {{-- {{ $post->firstname . ' ' . $post->name }}  --}}
                                        {{ date('d/m/Y', strtotime($post->created_at)) }} lúc 
                                        {{ date('H:i', strtotime($post->created_at)) }} 
                                         · 
                                        @if($post->status=='Công khai')
                                        <i class="fa fa-globe" aria-hidden="true"></i>
                                        @elseif($post->status=='Bạn bè')
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        @elseif($post->status=='Riêng tư')
                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                        @endif
                                    </p>
                                        
                                </div>
                                <div class=" mb-0 text-right col-md-1 pr-2 " >
                                    <a class="nav-link dropdown-toggle btn  btn-light text-dark text-muted  float-right p-0"
                                    style=" border-radius: 50%; height: 30px; width: 30px;" href="#" id="thongbao"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                </a>
                                <div class="dropdown-menu mr-0 dropdown-menu-right" aria-labelledby="thongbao">

                                    <button class="dropdown-item saved_post" data-post="{{ $post->post_id }}">Lưu bài
                                        đăng</button>
                                        {{-- @if($post->user_id == Auth::user()->user_id)
                                        <button class="dropdown-item xoabaidang"
                                                data-post="{{ $post->post_id }}">Xóa bài đăng</button>
                                        @endif --}}
                                    <div class="dropdown-divider"></div>
                                    <button class="dropdown-item baocao" type="button" data-toggle="modal"
                                        data-target="#tocaobaidang" data-post="{{ $post->post_id }}">Báo cáo vi
                                        phạm</button>
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
                            $string.='../storage/app/assets/img/baidang/'. $imgpost['img'].',';
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
                            <video controls preload="none" autoplay="false" muted="false" loop="false"
                                style="width:100%; height: 400px; background-color: cadetblue;">
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
                        <div class="col-sm-4">
                            <a href="{{ url('posts/'.$post->post_id) }}" class="btn btn-light w-100 btn-comment"><i class="fa fa-commenting-o"
                                    aria-hidden="true"></i> Bình luận</a>
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-light w-100 " data-toggle="modal"
                            data-target="#post{{ $post->post_id }}"><i class="fa fa-share" aria-hidden="true"></i>
                            Chia
                            sẻ</button>
                        <div class="modal fade" id="post{{ $post->post_id }}" data-backdrop="static"
                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Chia sẻ bài đăng của
                                            {{ $post->post_id }}</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" class="sharepost" enctype="multipart/form-data"
                                            data-post="{{ $post->post_id }}">
                                            {{ csrf_field() }}
                                            <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"
                                                class="m-0"
                                                style="height: 40px; border-radius: 50%; width: 40px;" alt="">&emsp;
                                            <b
                                                style="top: -70px; vertical-align: top;">{{ Auth::user()->name }}</b><br>
                                            <select name="status" id="status"
                                                style="border: none; vertical-align: top; margin-top: -20px; margin-left: 60px; font-size:13px;  float-left"
                                                class=" text-muted">
                                                <option value="Công khai" selected>Công khai</option>
                                                <option value="Bạn bè">Bạn bè</option>
                                                <option value="Riêng tư">Riêng tư</option>
                                            </select>
                                            <div class="form-control cap_post cap_post{{ $post->post_id }}"
                                                placeholder="Đăng cảm nghĩ của bạn?"></div>
                                            {{-- <div id="preview"></div> --}}
                                            <input type="file" name="imgpost[]" class="form-control imgpost  float-left"
                                                style="width:100%;" id="imgpost" hidden>
                                            <input type="hidden" name="post_id" class="post_id"
                                                value="{{ $post->post_id }}">
                                            <div class="row border mx-3">
                                                <div class="col-md-2">
                                                    <img src="{{ asset('storage/app/assets/img/icon/posttoshare.png') }}"
                                                        style="height: 70px;" alt="">
                                                </div>
                                                <div class="col-md-10 ">
                                                    <div class="mt-3">
                                                        <h4 class="font-weight-bold">
                                                            Chia sẻ bài viết
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                            <button type="submit" id="dangbai"
                                                class="mt-2 dangbai btn btn-primary w-100">Đăng bài</button>
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
@endforeach
