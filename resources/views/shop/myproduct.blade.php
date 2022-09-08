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
    <div class="row">
        @foreach ($sanpham as $sp)
            <?php $imgpro = '';
            foreach ($imgsanpham as $imgsp) {
                if ($sp->sp_id == $imgsp->sp_id) {
                    $imgpro = $imgsp->imgsp_ten;
                    break;
                }
            }
            ?>
            <div class="col-md-3 px-1">

                <div class="card mb-2 ">
                    <img src="{{ asset('storage/app/assets/img/product/' . $imgpro) }}" class="card-img-top"
                        style="height: 300px; object-fit: cover;">
                    <div class="card-body">
                        <p class="text-muted my-1" style="font-size:13px; ">Giá: {{ $sp->sp_gia }}</p>
                        <p class="card-text font-weight-bold text-dark h4 rutgonnd" title="{{ $sp->sp_ten }}">
                            {{ $sp->sp_ten }}</p>
                        <span class="text-muted my-1" style="font-size:13px; ">{{ $sp->sp_diachi }}</span>
                    </div>
                    <button type="button" class="btn btn-in4 w-100" data-toggle="modal"
                        data-target="#editproduct{{ $sp->sp_id }}">
                        <span class="text-primary"><i class="fa fa-plus" aria-hidden="true"></i>&ensp;Chỉnh sửa sản
                            phẩm</span>
                    </button>
                    <form action="{{ url('shop/delete_product') }}" method="post" 
                    onsubmit="return confirm('Không thể khôi phục sau khi xóa?');">
                        @csrf
                        <input type="hidden" name="sp_id" class="form-control mt-2" value="{{ $sp->sp_id }}" required>
                        <button type="submit" class="btn btn-in4 w-100 mt-1">Xóa</button>
                    </form>
                </div>

            </div>
            <!-- Modal -->
            <div class="modal fade" id="editproduct{{ $sp->sp_id }}" tabindex="-1" aria-labelledby="editproductLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editproductLabel">Chỉnh sửa sản phẩm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('shop/edit_product') }}" method="post" enctype="multipart/form-data"
                            onsubmit="return confirm('Kiểm tra kỹ trước khi update sản phẩm?');">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <select name="pl_ma" class="form-control" required>
                                            {{-- <option value="">Hạng mục</option> --}}
                                            @foreach ($loaisp as $lsp)
                                                <option value="{{ $lsp->pl_id }}" <?php if ($lsp->pl_id == $sp->pl_id) {
    echo 'selected'; } ?>>{{ $lsp->pl_ten }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="nguoiban" class="form-control mt-2"
                                            value="{{ Auth::user()->user_id }}" required>
                                        <input type="hidden" name="sp_id" class="form-control mt-2"
                                            value="{{ $sp->sp_id }}" required>
                                        <input type="text" name="sp_ten" class="form-control mt-2" placeholder="Tiêu đề"
                                            value="{{ $sp->sp_ten }}" required>
                                        <input type="file" name="sp_img[]"
                                            onchange="imagesPreview(this, '#preview{{ $sp->sp_id }}')"
                                            class="sp_img form-control mt-2" multiple="multiple">
                                        <input type="text" name="sp_gia" style="width:24.5%"
                                            class="form-control d-inline mt-2" value="{{ $sp->sp_gia }}"
                                            placeholder="Giá" required>
                                        <input type="number" name="sp_soluong" style="width:24%"
                                            class="form-control d-inline mt-2" value="{{ $sp->sp_soluong }}"
                                            placeholder="Số lượng" required>
                                        <input type="number" name="sp_sdt" class="form-control w-50 d-inline mt-2"
                                            placeholder="Số điện thoại" value="{{ $sp->sp_sdt }}" required>
                                        <input type="text" name="sp_tinhtrang" class="form-control mt-2"
                                            placeholder="Tình trạng" value="{{ $sp->sp_tinhtrang }}" required>
                                        <input type="text" name="sp_diachi" class="form-control mt-2" placeholder="Địa chỉ"
                                            value="{{ $sp->sp_diachi }}" required>
                                        <textarea name="sp_mota" rows="3" class="form-control mt-2" placeholder="Mô tả"
                                            required>{{ $sp->sp_mota }}</textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <div id="preview{{ $sp->sp_id }}">
                                            <?php foreach ($imgsanpham as $imgsp) {
                                                    if ($sp->sp_id == $imgsp->sp_id) { ?>
                                            <img src="{{ asset('storage/app/assets/img/product/' . $imgsp->imgsp_ten) }}"
                                                style="height: 150px; width: 150px;" alt="">
                                            <?php }
                                                }
                                                ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-block">
                                <center>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
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
