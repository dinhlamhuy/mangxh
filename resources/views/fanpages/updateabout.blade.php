@extends('fanpages.manaheader')
@section('header_fanpage_title')
    <title>{{ $school->school_name }} | Mạng xã hội Halo</title>
@endsection
@section('header_fanpage_css')
    <style>
        #previewbg img {
            width: 100%;
        }

    </style>
@endsection
@section('header_fanpage')
    <?php
    if (Auth::user()->avatar) {
        $avatar = Auth::user()->avatar;
    } else {
        $avatar = 'noteimg.png';
    }
    
    $anhbia = 'backgroundschool.jpg';
    if (!empty($school->school_background)) {
        $anhbia = $school->school_background;
    }
    $anhdaidien = 'noteimgschool.png';
    if (!empty($school->school_avatar)) {
        $anhdaidien = $school->school_avatar;
    }
    
    ?>
    <div class="container-fluid" style="margin-top: 20px">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-8 mx-auto">
                <div class="card" style="border-radius:12px; ">
                    <div class="card-body">
                        <form action="{{ url('fanpages/updateinfo') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-5">
                                    <h3 class="font-weight-bold">Giới thiệu</h3>
                                </div>
                                <div class="col-md-6 mb-5 text-right">
                                    <button class="btn hienformedit">Chỉnh sửa</button>
                                </div>

                                <input type="hidden" name="school_id" value="{{ $school->school_id }}">
                                <div class="col-md-3 mt-2">
                                    <label for="" class="font-weight-bold">Ảnh bìa</label>
                                </div>
                                <div class="col-md-9 mt-2">
                                    <div class="previewbackground" id="previewbg">
                                        <img src="{{ asset('storage/app/assets/img/anhbia/' . $anhbia) }}"
                                            class="w-100" style="height: 100px; object-fit: cover; " alt="">
                                    </div>
                                    <input type="file" id="sbg" name="school_background"
                                        class="form-control formedit d-none">
                                </div>
                                <div class="col-md-3 mt-2">
                                    <label for="" class="font-weight-bold">Ảnh đại diện</label>
                                </div>
                                <div class="col-md-9 mt-2 text-center">
                                    <div class="previewavatar" id="previewavt">
                                        <img src="{{ asset('storage/app/assets/img/school/' . $anhdaidien) }}"
                                            style="height: 100px; width:100px; border-radius:50%;  object-fit: cover;"
                                            alt="">
                                    </div>
                                    <input type="file" id="savt" name="school_avatar" class="form-control formedit d-none">
                                </div>




                                <div class="col-md-3 mt-2">
                                    <label for="" class="font-weight-bold">Loại trường</label>
                                </div>
                                <div class="col-md-9 mt-2">
                                    <div class="showabout">{{ $school->school_category }}</div>

                                    <select name="school_category" class="form-control formedit d-none">
                                        <option value="Trường đại học" <?php if ($school->school_category == 'Trường đại học') {
                                            echo 'selected';
                                        } ?>>Trường đại học</option>
                                        <option value="Trường cao đẳng" <?php if ($school->school_category == 'Trường cao đẳng') {
                                            echo 'selected';
                                        } ?>>Trường cao đẳng</option>
                                        <option value="Trường trung cấp" <?php if ($school->school_category == 'Trường trung cấp') {
                                            echo 'selected';
                                        } ?>>Trường trung cấp</option>
                                        <option value="Trường trung học phổ thông" <?php if ($school->school_category == 'Trường trung học phổ thông') {
                                            echo 'selected';
                                        } ?>>Trường trung học phổ
                                            thông</option>
                                        <option value="Trường trung học cơ sở" <?php if ($school->school_category == 'Trường trung học cơ sở') {
                                            echo 'selected';
                                        } ?>>Trường trung học cơ sở
                                        </option>
                                        <option value="Trường tiểu học" <?php if ($school->school_category == 'Trường tiểu học') {
                                            echo 'selected';
                                        } ?>>Trường tiểu học</option>
                                    </select>
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="" class="font-weight-bold">Tên trường</label>
                                </div>
                                <div class="col-md-9 mt-2">
                                    <div class="showabout">{{ $school->school_name }}</div>
                                    <input type="text" name="school_name" class="form-control formedit d-none"
                                        value="{{ $school->school_name }}">
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="" class="font-weight-bold">Số điện thoại</label>
                                </div>
                                <div class="col-md-9 mt-2">
                                    <div class="showabout">{{ $school->school_phone }}</div>
                                    <input type="text" name="school_phone" class="form-control formedit d-none"
                                        value="{{ $school->school_phone }}">
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="" class="font-weight-bold">Email</label>
                                </div>
                                <div class="col-md-9 mt-2">
                                    <div class="showabout">{{ $school->school_email }}</div>
                                    <input type="text" name="school_email" class="form-control formedit d-none"
                                        value="{{ $school->school_email }}">
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="" class="font-weight-bold">Địa chỉ</label>
                                </div>
                                <div class="col-md-9 mt-2">
                                    <div class="showabout">{{ $school->school_address }}</div>
                                    <input type="text" name="school_address" class="form-control formedit d-none"
                                        value="{{ $school->school_address }}">
                                </div>
                                <div class="col-md-3 mt-2">
                                    <label for="" class="font-weight-bold">Đường dẫn</label>
                                </div>
                                <div class="col-md-9 mt-2">
                                    <div class="showabout">{{ $school->school_link }}</div>
                                    <input type="text" name="school_link" class="form-control formedit d-none"
                                        value="{{ $school->school_link }}">
                                </div>



                                <div class="col-md-3 mt-2">
                                    <label for="" class="font-weight-bold">Chi tiết về trường</label>
                                </div>
                                <div class="col-md-9 mt-2">
                                    <div class="showabout">{!! $school->school_about !!}</div>
                                    <textarea name="school_about" class="form-control formedit d-none">{!! $school->school_about !!}</textarea>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <center>

                                        <button type="button"
                                            class="d-none anformedit formedit btn btn-primary">Hủy</button>
                                        <button type="submit" class="d-none formedit btn btn-primary">Cập nhật</button>
                                    </center>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>

            <div class="col-md-1"></div>

        </div>
    </div>
@endsection
@section('header_fanpage_js')
    <script>
        $(document).ready(function() {
            $('#discussion').addClass('btn-active');

            $(document).on('click', '.hienformedit', function(e) {
                e.preventDefault();
                $('.formedit').removeClass('d-none');
                $('.showabout').addClass('d-none');

            })
            $(document).on('click', '.anformedit', function(e) {
                e.preventDefault();
                $('.formedit').addClass('d-none');
                $('.showabout').removeClass('d-none');

            })



            function previewImages() {
                var $preview = $('#previewavt').empty();
                if (this.files) $.each(this.files, readAndPreview);

                function readAndPreview(i, file) {
                    if (!/\.(jpe?g|png|gif|jpg)$/i.test(file.name)) {
                        $('#savt').val('');
                        return alert(file.name + " không phải hình ảnh");
                    } else {
                        var reader = new FileReader();
                        $(reader).on("load", function() {
                            $preview.append($("<img/>", {
                                src: this.result,
                                width: 100,
                                height: 100,
                            }));
                        });
                        reader.readAsDataURL(file);
                    }
                }
            }
            $('#savt').on("change", previewImages);

            function previewImages2() {
                var $preview = $('#previewbg').empty();
                if (this.files) $.each(this.files, readAndPreview2);

                function readAndPreview2(i, file) {
                    if (!/\.(jpe?g|png|gif|jpg)$/i.test(file.name)) {
                        $('#sbg').val('');
                        return alert(file.name + " không phải hình ảnh");
                    } else {
                        var reader = new FileReader();
                        $(reader).on("load", function() {
                            $preview.append($("<img/>", {
                                src: this.result,
                                height: 100,
                                width: 550,
                                // object-fit: cover,
                            }));
                        });
                        reader.readAsDataURL(file);
                    }
                }
            }
            $('#sbg').on("change", previewImages2);
        });
    </script>
@endsection
