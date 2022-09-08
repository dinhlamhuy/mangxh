@extends('fanpages.header')
@section('header_fanpage_title')
    <title>{{ $school->school_name }} | Mạng xã hội Halo</title>
@endsection
@section('header_fanpage_css')
@endsection
@section('header_fanpage')
    <?php
    if (Auth::user()->avatar) {
        $avatar = Auth::user()->avatar;
    } else {
        $avatar = 'noteimg.png';
    }

    ?>
    <div class="container-fluid" style="margin-top: 20px">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-8 mx-auto">
                <div class="card" style="border-radius:12px; ">
                    <div class="card-body">
                     
                        <div class="row">
                            <div class="col-md-12 mb-5">
                                <h3 class="font-weight-bold">Giới thiệu</h3>
                            </div>
                                <div class="col-md-3 mt-2">
                                    <label for="" class="font-weight-bold">Loại trường</label>
                                </div>
                                <div class="col-md-9 mt-2">
                                    <div class="showabout">{{ $school->school_category }}</div>

                                   
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="" class="font-weight-bold">Tên trường</label>
                                </div>
                                <div class="col-md-9 mt-2">
                                    <div class="showabout">{{ $school->school_name }}</div>
                               
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="" class="font-weight-bold">Số điện thoại</label>
                                </div>
                                <div class="col-md-9 mt-2">
                                    <div class="showabout">{{ $school->school_phone }}</div>
                                   
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="" class="font-weight-bold">Email</label>
                                </div>
                                <div class="col-md-9 mt-2">
                                    <div class="showabout">{{ $school->school_email }}</div>
                                   
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="" class="font-weight-bold">Đường dẫn</label>
                                </div>
                                <div class="col-md-9 mt-2">
                                    <div class="showabout">{{ $school->school_link }}</div>
                                   
                                </div>



                                <div class="col-md-3 mt-2">
                                    <label for="" class="font-weight-bold">Chi tiết về trường</label>
                                </div>
                                <div class="col-md-9 mt-2">
                                    <div class="showabout">{!! $school->school_about !!}</div>
                                    
                                </div>

                             
                            </div>
                            

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
          
        });
    </script>
@endsection
