@extends('shop.header')

@section('header_shop_title')
    <title>Shopping | EDuck</title>
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
        .rutgonnd{
            text-overflow: ellipsis;
            overflow: hidden;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            display: -webkit-box;
            font-size: 17px;
        }

    </style>
@endsection
@section('header_shop')
    <div class="row">
        @foreach ($sanpham as $sp)
            <?php $imgpro='';
            foreach ($imgsanpham as $imgsp) {
                if ($sp->sp_id == $imgsp->sp_id) {
                    $imgpro=$imgsp->imgsp_ten;
                    break;
                }
            } 
            ?>
            <div class="col-md-3 px-1">
                <a href="{{ url('shop/'.$sp->pl_tag.'/'.$sp->sp_id) }}" class="text-decoration-none">
                    <div class="card mb-2 ">
                        <img src="{{ asset('storage/app/assets/img/product/' . $imgpro) }}" class="card-img-top" style="height: 300px; object-fit: cover;">
                        <div class="card-body">
                            <p class="text-muted my-1" style="font-size:13px; ">Giá: {{ $sp->sp_gia }}</p>
                            <p class="card-text font-weight-bold text-dark h4 rutgonnd" title="{{ $sp->sp_ten }}">{{ $sp->sp_ten }}</p>
                            <span class="text-muted my-1" style="font-size:13px; ">{{ $sp->sp_diachi }}</span>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
@section('header_shop_js')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
