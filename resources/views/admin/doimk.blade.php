@extends('layouts.layoutadmin')
@section('right_content_title')
@endsection
@section('right_content_css')
    <style>
        #qlbaidang {
            color: black;
        }

        .emojioneemoji {
            height: 20px !important;
        }

    </style>
@endsection
@section('right_content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('tbaomk'))
                <div class="alert alert-danger">
                    {{ session('tbaomk') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4 mx-auto">
                <center>

                    <h1 class="font-weight-bold">Đổi mật khẩu</h1>
                </center>
                    <form action="{{ url('admin/doimk') }}" method="post" onsubmit="return confirm('Bạn có chắc thay đổi mật khẩu');">
                        @csrf
                        <label for="" class="float-left">Mật khẩu cũ</label>
                        <input type="hidden" name="ad_ma" class="form-control" value="{{Session::get('ad_ma')}}">
                        <input type="password" name="old_pass" class="form-control" required="required">
                        <label for="" class="float-left">Mật khẩu mới</label>
                        <input type="password" name="new_pass" class="form-control" required="required">
                        <label for="" class="float-left">Xác nhận mật khẩu mới</label>
                        <input type="password" name="xnnew_pass" class="form-control" required="required"><br>
                        <center>
                            <button class="btn btn-primary w-100 mt-4">Cập nhật mật khẩu</button>
                        </center>
                    </form>
                
            </div>
            <div class="col-md-4"></div>
        </div>

    </div>
@endsection
@section('right_content_js')
@endsection
