@extends('layouts.layout')

@section('content-title')
    {{-- <title> EDuck - Mạng xã hội</title> --}}
    @yield('header_shop_title')

@endsection

@section('content-css')
    {{-- <link rel="stylesheet" href="{{ asset('resources/css/shop.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('resources/css/group_work.css') }}"> --}}
    <style>
        body {
            background-color: #e4e4ec;
        }

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

        .plicon {
            height: 40px !important;
            width: 40px !important;
            border-radius: 50% !important;
            background-color: #e4e6eb !important;
            float: left !important;
            text-align: center;
            vertical-align: middle !important;
            padding-top: 4px;
        }

        .plname {
            margin-left: 15px;
            margin-top: 5px;
            float: left !important;
        }

        .plsp {
            font-size: 20px;
            font-weight: 600;
        }

        .plsp:hover {
            background-color: #e4e6eb !important;

            font-weight: 700;
        }

    </style>
    @yield('header_shop_css')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="row" style="margin-top: -10px;">
                    <div
                        class="col-md-3 bg-white bx-shadow mt-0 pt-0 bx-shadow h-100 w-100 position-fixed overflow-auto pb-lg-5">
                        <a href="{{ url('/shop') }}" class="text-decoration-none text-dark">
                            <h4 class="mt-3"><b>Shopping</b></h4>
                        </a>
                        <a href="{{ url('/myshop') }}" class="btn ">Sản phẩm của bạn</a>
                        <hr>
                        <!-- Button trigger modal -->

                        <button type="button" class="btn btn-in4 w-100" data-toggle="modal" data-target="#addproduct">
                            <span class="text-primary"><i class="fa fa-plus" aria-hidden="true"></i>&ensp;Thêm sản phẩm
                                muốn bán</span>
                        </button>

                        <hr>
                        @foreach ($loaisp as $lsp)
                            <a href="{{ url('/shop/' . $lsp->pl_tag) }}"
                                class="btn  w-100 text-left my-3 plsp">{!! '<div class="plicon">' . $lsp->pl_icon . '</div> &ensp;<div class="plname">' . $lsp->pl_ten . '</div>' !!}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-9 px-4">
                @yield('header_shop')
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addproduct" tabindex="-1" aria-labelledby="addproductLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addproductLabel">Thêm sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('shop/add_product') }}" method="post" enctype="multipart/form-data"
                    onsubmit="return confirm('Bạn có chắc đăng bán sản phẩm này chưa?');">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <select name="pl_ma" id="pl_ma" class="form-control" required>
                                    <option value="" selected>Hạng mục</option>
                                    @foreach ($loaisp as $lsp)
                                        <option value="{{ $lsp->pl_id }}">{{ $lsp->pl_ten }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="nguoiban" id="nguoiban" class="form-control mt-2"
                                    value="{{ Auth::user()->user_id }}" required>
                                <input type="text" name="sp_ten" id="sp_ten" class="form-control mt-2" placeholder="Tiêu đề"
                                    required>
                                <input type="file" name="sp_img[]" id="sp_img" class="form-control mt-2" required
                                    multiple="multiple">
                                <input type="text" name="sp_gia" id="sp_gia" style="width:24.5%"
                                    class="form-control d-inline mt-2" placeholder="Giá" required>
                                <input type="number" name="sp_soluong" id="sp_soluong" style="width:24%"
                                    class="form-control d-inline mt-2" placeholder="Số lượng" required>
                                <input type="number" name="sp_sdt" id="sp_sdt" class="form-control w-50 d-inline mt-2"
                                    placeholder="Số điện thoại" required>
                                <input type="text" name="sp_tinhtrang" id="sp_tinhtrang" class="form-control mt-2"
                                    placeholder="Tình trạng" required>
                                <input type="text" name="sp_diachi" id="sp_diachi" class="form-control mt-2"
                                    placeholder="Địa chỉ" required>
                                <textarea name="sp_mota" id="sp_mota" rows="3" class="form-control mt-2" placeholder="Mô tả" required></textarea>
                            </div>
                            <div class="col-md-4">
                                <div id="preview"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-block">
                        <center>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </center>


                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('content-js')
    <script>
        $(document).ready(function() {
            function previewImages() {
                var $preview = $('#preview').empty();
                if (this.files) $.each(this.files, readAndPreview);

                function readAndPreview(i, file) {
                    if (!/\.(jpe?g|png|gif|jpg)$/i.test(file.name)) {
                        $('#sp_img').val('');
                        return alert(file.name + " không phải hình ảnh");
                    } else {
                        var reader = new FileReader();
                        $(reader).on("load", function() {
                            $preview.append($("<img/>", {
                                src: this.result,
                                height: 150,
                                width: 150
                            }));
                        });
                        reader.readAsDataURL(file);
                    }
                }
            }
            $('#sp_img').on("change", previewImages);
        });
        
    </script>
    @yield('header_shop_js')
@endsection
