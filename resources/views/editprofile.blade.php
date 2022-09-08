@extends('layouts.layout')
@section('content-title')
    <title>Trang cá nhân {{ $ttin_user->firstname . ' ' . $ttin_user->name }}</title>
@endsection
@section('content-css')
    <style>
        .btn-close .close {
            border-radius: 50%;
            background-color: white;
            border: 1px solid white;
            top: -25px;
            right: -30px;
            font-size: 25px;
            padding: 0px 3px;
            margin: 0px;
            position: relative;
            opacity: 1 !important;
        }

        .btn-close {
            border: 3px solid white;
            opacity: 1 !important;
        }

        .btn-avatar {
            box-shadow: none !important;
            outline: none !important;
        }

    </style>
@endsection
@section('content')
    <?php
    if ($ttin_user->avatar) {
        $avatar = $ttin_user->avatar;
    } else {
        $avatar = 'noteimg.png';
    }
    ?>
    <div class="container-fluid " style="background-color: rgba(240,242,245,255);">
        <div class="row">
            <div class="col-md-12 " style="border-radius:24px;">
                <div class="bg-info clearfix w-100">
                    <center><img src="{{ asset('storage/app/assets/img/anhbia/noimg.jpg') }}" class="mx-0 float-left"
                            style="height: 300px; width:100%; object-fit: cover;" alt=""></center>

                </div>

                <div class="clearfix bg-white row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <button class="pop btn float-left btn-avatar" data-toggle="modal" data-target="#imagemodal">
                            <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}" class="ml-3"
                                style="border:2px solid white; margin-top:-50px; height: 120px; width:120px; object-fit: cover; border-radius: 50%;"
                                alt="">

                        </button>
                        <h4 class="float-left ml-3 mt-3"><b>{{ $ttin_user->firstname . $ttin_user->name }}</b></h4>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="card my-3" style="border-radius:24px;">
                    <div class="card-body">
                        <h4><b>Giới thiệu</b></h4><br>
                        <p>{{ $ttin_user->job }} tại <b>{{ $ttin_user->school }}</b></p>
                        <p>Đến từ {{ $ttin_user->address }}</p>
                        <p>Giới tính {{ $ttin_user->sex }}</p>
                        <p>Ngày sinh {{ date('d-m-Y', strtotime($ttin_user->date)) }}</p>
                        <p>Tham gia vào
                            {{ date('\n\g\à\y\ d \t\h\á\n\g\ m \n\ă\m\ Y', strtotime($ttin_user->created_at)) }}</p>
                        <button class="w-100 btn btn-secondary">Chỉnh sửa thông tin cá nhân</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card my-3" style="border-radius:24px;">
                    <div class="card-body">
                        <div class="clean-fix">
                            <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}" class="m-0"
                                style=" height: 50px; width: 50px; border-radius: 50%;" alt="">
                            <button type="button" class="btn btn-light badge-pill text-left text-muted h-100 py-2 "
                                style="width:90%; font-size:20px;" data-toggle="modal" data-target="#dangbai">
                                Bạn đang nghĩ gì?
                            </button>
                        </div>

                    </div>


                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="row">
            
        </div>
    </div>


    {{-- <div class="modal fade" id="imagemodal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" data-dismiss="modal">
            <div class="modal-content">
                <form action="">
                    <div class="modal-body">
                        <button type="button" class="close btn-close" data-dismiss="modal">
                            <span aria-hidden="true" class="close">&times;</span><span
                                class="sr-only">Close</span></button>
                      
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}


  
  <!-- Modal -->
  <div class="modal fade" id="imagemodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="imagemodalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="imagemodalLabel">Cập nhật ảnh đại diện</h5>
          <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div id="imagepreview">

                <img src="{{ asset('storage/app/assets/img/avatar/'. $avatar) }}"  style="height: 400px; ">
            </div>
            <input type="file" accept="image/*" id="imgavatar/>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
          {{-- <button type="button" class="btn btn-primary"></button> --}}
        </div>
      </div>
    </div>
  </div>
@endsection
@section('content-js')
    <script>
  

    function previewImages() {
            var $preview = $('#imagepreview').empty();
            if (this.files) $.each(this.files, readAndPreview);
            function readAndPreview(i, file) {
                if (!/\.(jpe?g|png|gif|jpg)$/i.test(file.name)) {
                    $('#imgavatar').val('');
                    return alert(file.name + " không phải hình ảnh");
                } else {
                    var reader = new FileReader();
                    $(reader).on("load", function() {
                        $preview.append($("<img/>", {
                            src: this.result,
                            height: 400
                        }));
                    });
                    reader.readAsDataURL(file);
                }
            }
        }
        $('#imgavatar').on("change", previewImages);

        
    </script>
@endsection
