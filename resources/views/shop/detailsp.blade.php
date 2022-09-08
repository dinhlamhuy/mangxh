@extends('shop.header')

@section('header_shop_title')
    <title>Chi tiết sản phẩm</title>
@endsection

@section('header_shop_css')
    {{-- <link rel="stylesheet" href="{{ asset('resources/css/shop.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('resources/css/group_work.css') }}"> --}}
    <style>
        .tieude {
            background-color: white;
            border: none;
        }

        .acc_card {
            border: none;
        }

        .btn-acco {
            width: 100%;
            text-align: left;
        }

        .rutgonnd {
            text-overflow: ellipsis;
            overflow: hidden;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            display: -webkit-box;
            font-size: 17px;
        }

        .imgpost {
            vertical-align: middle;
        }

        * {
            box-sizing: border-box;
        }

        .demo {
            opacity: 0.2;
        }

        .active,
        .demo:hover {
            opacity: 1;
        }

        .khunghinh {
            position: relative;
            padding: 0px;
            margin: 0px;
            width: 100%;
        }

        .trinhchieu {
            display: none;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .cursor {
            cursor: pointer;
        }

        .lui,
        .tien {
            cursor: pointer;
            position: absolute;
            top: 40%;
            width: auto;
            padding: 16px;
            margin-top: -50px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            border-radius: 0 3px 3px 0;
            user-select: none;
            -webkit-user-select: none;
            /* background-color: rgba(0, 0, 0, 0.8); */
            background-color: rgba(0, 0, 0, 0.5);
        }

        .tien {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .lui:hover,
        .tien:hover {
            background-color: rgba(0, 0, 0, 0.8);
            text-decoration: none;
        }

        .numbertext {
            color: white;
            font-size: 16px;
            padding: 8px 12px;
            position: absolute;
            bottom: 130px;
            right: 0px;
            font-weight: bold;
        }

        .caption-khunghinh {
            text-align: center;
            background-color: #222;
            padding: 2px 16px;
            color: white;
            font-size: 13px;
        }

        .rw {
            vertical-align: middle;
        }

        .rw:after {
            content: "";
            display: table;
            clear: both;
        }

    </style>
@endsection
@section('header_shop')
    <?php
    $avatar = 'noteimg.png';
    if ($sanpham->avatar) {
        $avatar = $sanpham->avatar;
    }
    
    ?>
    <div class="row">

        <?php $imgpro = [];
        foreach ($imgsanpham as $imgsp) {
            $imgpro[] = $imgsp->imgsp_ten;
        }
        $total = count($imgpro);
        $w = 20;
        if (100 / $total < 20) {
            $w = 100 / $total;
        }
        ?>
        {{-- <div class="col-md-3 px-1">
                <a href="" class="text-decoration-none">
                    <div class="card mb-2 ">
                        <img src="{{ asset('storage/app/assets/img/product/' . $imgpro[0]) }}" class="card-img-top" style="height: 300px; object-fit: cover;">
                        <div class="card-body">
                            <p class="text-muted my-1" style="font-size:13px; ">{{ $sanpham->sp_gia }}</p>
                            <p class="card-text font-weight-bold text-dark h4 rutgonnd" title="{{ $sanpham->sp_ten }}">{{ $sanpham->sp_ten }}</p>
                            <span class="text-muted my-1" style="font-size:13px; ">{{ $sanpham->sp_diachi }}</span>
                        </div>
                    </div>
                </a>
            </div> --}}

        <div class="col-md-7">
            <div class="khunghinh bg-dark">
                <?php $i=1; foreach($imgpro as $img){?>
                <div class="trinhchieu">
                    <center>
                        <img src="{{ asset('storage/app/assets/img/product/' . $img) }}" class="imgpost"
                            style="max-width:100%; height:450px;">
                    </center>
                    <div class="numbertext">{{ $i++ . ' / ' . $total }} </div>
                </div>
                <?php } ?>
                <a class="lui" onclick="plusSlides(-1)">❮</a>
                <a class="tien" onclick="plusSlides(1)">❯</a>
                <div class="caption-khunghinh w-100 mx-0">
                    <p class="text-right m-0"> {{ date('\L\ú\c\ H:i d/m/Y', strtotime($sanpham->ngaydangban)) }} </p>
                </div>
                <div class="row rw mx-0">
                    <?php $i=1; foreach($imgpro as $thumimg){?>
                    <div style="float:left; border:1px solid #6c757d; width:{{ $w }}%;">
                        <img class="demo cursor" src="{{ asset('storage/app/assets/img/product/' . $thumimg) }}"
                            style="width:100%; height:100px; object-fit: cover;"
                            onclick="currentSlide({{ $i++ }})">
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-5 ">
            <div class="row" style="margin-top: -10px;">
                
                <div class="col-md-5 bg-white h-100 w-100  position-fixed overflow-auto pb-lg-5 pt-3 ">
               
                    <a href="{{ url('/pageshop/'.$sanpham->nguoiban) }}" class="text-decoration-none  text-dark">
                        <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}" class="cap_avt"
                            alt="">&ensp;<span class="pt-3 h4"
                            style="vertical-align: middle">{{ $sanpham->firstname . ' ' . $sanpham->name }}</span>
                    </a>
                    <br><br>
                    @if($sanpham->nguoiban!=Auth::user()->user_id)
                    <a href="{{ url('conversation/'.$sanpham->user_id) }}" class="btn btn-lighter font-weight-bold px-5 mr-3"><i class="fa fa-comments-o" aria-hidden="true"></i> Nhắn tin</a>
                    <a href="tel:{{ $sanpham->sp_sdt }}" class="btn btn-success font-weight-bold px-5"><i class="fa fa-phone" aria-hidden="true"></i> Liên hệ</a>
                  
                    @endif
                    <hr>
                    <p class="">Giá: {{ $sanpham->sp_gia }}&emsp; <span style="font-size: 10px;"><i class="fa fa-dot-circle-o" aria-hidden="true"></i></span> &emsp;Số Lượng: {{ $sanpham->sp_soluong }}
                    </p>
                    <p  style="width:450px;">Mô tả:  {!! $sanpham->sp_mota !!}</p>
                    <p>Tình trạng:&ensp; {{ $sanpham->sp_tinhtrang }}</p>
                    <p><i class="fa fa-mobile" aria-hidden="true"></i>&ensp; {{ $sanpham->sp_sdt }}</p>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i>&ensp; {{ $sanpham->sp_diachi }}</p>
                    <hr>
                    <h5>
                        <b>Sản phẩm của {{ $sanpham->firstname . ' ' . $sanpham->name }}</b>
                    </h5>
                    @foreach ($sanphamlq as $sp)
                        <div class="row px-auto">
                            <?php $imgpro = '';
                            foreach ($imgsanphamlq as $imgsp) {
                                if ($sp->sp_id == $imgsp->sp_id) {
                                    $imgpro = $imgsp->imgsp_ten;
                                    break;
                                }
                            }
                            ?>

                            <div class="col-md-5 px-2 ml-5 " style="margin-left: 50px;">
                                <a href="{{ url('shop/' . $sp->pl_tag . '/' . $sp->sp_id) }}" class="text-decoration-none">
                                    <div class="card mb-2 ">
                                        <img src="{{ asset('storage/app/assets/img/product/' . $imgpro) }}"
                                            class="card-img-top" style="height: 150px; object-fit: cover;">
                                        <div class="card-body">
                                            <p class="text-muted my-1" style="font-size:13px; ">Giá: {{  $sp->sp_gia }}
                                            </p>
                                            <p class="card-text font-weight-bold text-dark h4 rutgonnd"
                                                title="{{ $sp->sp_ten }}">{{ $sp->sp_ten }}</p>
                                            <span class="text-muted my-1"
                                                style="font-size:13px; ">{{ $sp->sp_diachi }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>


                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
@section('header_shop_js')
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("trinhchieu");
            var dots = document.getElementsByClassName("demo");
            var captionText = document.getElementById("caption");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            // captionText.innerHTML = dots[slideIndex - 1].alt;
        }
    </script>
@endsection
