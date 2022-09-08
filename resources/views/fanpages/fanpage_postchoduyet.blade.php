@foreach ($baidang as $post)
    <div class="row mt-2 post{{ $post->post_id }}">
        <div class="col-sm-12 mx-auto">
            <div class="card p-0 w-100 ">
                <div class="card-body p-0 m-0">
                    <div class="row p-0">
                        <div class="col-sm-12">
                            <div class="row mx-1 mt-2 w-100">
                                
                                <div class=" col-md-1">
                                    <?php
                                        $avatar = 'noteimg.png';
                                    if ($post->avatar) {
                                        $avatar = $post->avatar;
                                    } 
                                    ?>
                                    <a class="btn p-0" href="{{ url('/profile/' . $post->user_id) }}"
                                        style=" border-radius: 50%; border: 2px solid hsl(240, 100%, 50%);"><img
                                            src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"
                                            class="m-0 cap_avt" loading="lazy"></a>
                                </div>
                                <div class="pl-4 col-md-10">
                                    <a href="{{ url('/profile/' . $post->user_id) }}" class="text-decoration-none"
                                        style=" vertical-align:baseline; color:black; font-weight: 600; font-size: 18px;">{{ $post->firstname.' '.$post->name}}
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
                            <?php $kq = 0;  $img_post = []; ?>
                            @foreach ($imgbaidang as $imgpost)
                                <?php if ($post->post_id == $imgpost->post_id) {
                                    $img_post[] = ['img' => $imgpost->img_name];
                                } ?>
                            @endforeach
                            <?php if(count($img_post) >0){
                            $string= '';
                            foreach ($img_post as $imgpost):
                            $string.='http://localhost/mangxh/storage/app/assets/img/baidang/'. $imgpost['img'].',';
                        endforeach;                                             
                        $string=substr($string, 0, -1); ?>
                            <div id="mangimg{{ $post->post_id }}" class="d-none">
                                <?= $string ?>
                            </div>
                            <div class="text-center  " onload="function loadimg('{{ $post->post_id }}')"
                                id="postimg{{ $post->post_id }}">
                            </div> 
                            <?php } ?>
                        </div>
                    </div>
                    <hr class="my-1">
                    <div class="row px-1 mb-2 pt-0">
                     <div class="col-md-5 mx-auto">
                         <button class="btn btn-lighter w-100 text-success duyetbaidang" data-post="{{ $post->post_id }}"><i class="fa fa-check text-success"></i>&ensp; Duyệt</button>
                     </div>
                     <div class="col-md-5 mx-auto">
                         <button class="btn btn-lighter w-100 text-danger "><i class="fa fa-times text-danger"></i>&ensp; Xóa</button>
                     </div>
                    </div>
                 
                    
                </div>
            </div>
        </div>
    </div>
@endforeach
