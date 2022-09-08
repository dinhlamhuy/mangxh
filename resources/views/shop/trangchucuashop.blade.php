@extends('shop.header')

@section('header_shop_title')
    <title>Sản phẩm cá nhân</title>
@endsection

@section('header_shop_css')
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

        .review {
            height: 150px;
            width: 150px;
        }

    </style>
@endsection
@section('header_shop')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <?php
    $avatar = 'noteimg.png';
    if ($nguoiban->avatar) {
        $avatar = $nguoiban->avatar;
    }
    
    ?>
    <div class="row">
        <div class="col-md-12 text-center">
            <a href="{{ url('profile/'.$nguoiban->user_id) }}" class="text-decoration-none">
                <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}" style="height:150px; width:150px; object-fit: cover; border-radius:50%;"  alt="">
                <h3 class="pt-3 h3 font-weight-bold"
                    style="vertical-align: middle">{{ $nguoiban->firstname . ' ' . $nguoiban->name }}</h3>
            </a>
        </div>
    </div>
    <div class="row my-2">
        <h5><b>Các sản phẩm của {{ $nguoiban->firstname . ' ' . $nguoiban->name }}</b></h5>

    </div>
    <div class="row">
        @foreach ($thongtinuser as $sp)
            <?php $imgpro = '';
            foreach ($imgsanpham as $imgsp) {
                if ($sp->sp_id == $imgsp->sp_id) {
                    $imgpro = $imgsp->imgsp_ten;
                    break;
                }
            }
            ?>
            <div class="col-md-3 px-1">
                <a href="{{ url('shop/' . $sp->pl_tag . '/' . $sp->sp_id) }}" class="text-decoration-none">
                    <div class="card mb-2 ">
                        <img src="{{ asset('storage/app/assets/img/product/' . $imgpro) }}" class="card-img-top"
                            style="height: 300px; object-fit: cover;">
                        <div class="card-body">
                            <p class="text-muted my-1" style="font-size:13px; ">Giá: {{ $sp->sp_gia }}</p>
                            <p class="card-text font-weight-bold text-dark h4 rutgonnd" title="{{ $sp->sp_ten }}">
                                {{ $sp->sp_ten }}</p>
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
        var imagesPreview = function(input, placeToInsertImagePreview) {
            $(placeToInsertImagePreview).empty();
            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    if (!/\.(jpe?g|png|gif)$/i.test(input.files[i].name)) {
                        $(input).val('');
                        $(placeToInsertImagePreview).empty();
                        alert(input.files.name + " is not an image");
                        break;
                    } else {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img class="review">')).attr('src', event.target.result).appendTo(
                                placeToInsertImagePreview);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            }
        };
    </script>
@endsection
