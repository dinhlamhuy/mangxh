@extends('layouts.layout')

@section('content-title')
    <title>Trường học | EDuck - Mạng xã hội</title>
@endsection
@section('content-css')
    <style>
        body {
            background-color: #e4e4ec;
        }
        .bx-shadow {
            box-shadow: rgba(0, 0, 0, 0.4) 0px 0px 10px;
            height: 87vh;
            overflow-y: auto;
        }
        .avt-group {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            margin-left: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pb-0 mb-0 " style="margin-top: -10px;">
        <div class="row ">
            <div class="col-md-3 col-sm-3 bg-light mt-0 pt-0 bx-shadow position-fixed " style="height:90vh;">
                <a href="{{ url('fanpages/create') }}" class="btn btn-lighter w-100 mt-2 p-2 text-primary">+ Tạo trang mới</a>
                <hr>
                @foreach ($myschoolmanager as $qtvschools)
                <?php  
               $anhtruong='noteschool.png';
               if(!empty($qtvschools->school_avatar)){
                    $anhtruong=$qtvschools->school_avatar;
                }  ?>
                @if($qtvschools->school_status=='2')
                    <div class="row mt-3">
                        <div class="col-md-2">
                            <img src="{{ asset('storage/app/assets/img/school/'.$anhtruong) }}" class="avt-group"
                                alt="">
                        </div>
                        <div class="col-md-10 py-auto text-truncate pt-1">
                            <a class="text-decoration-none" href="{{ url('fanpages/' . $qtvschools->school_id) }}"
                                title="{{ $qtvschools->school_name }}">
                                <h5 class="font-weight-bold text-dark mb-0 pb-0">{{ $qtvschools->school_name }}</h5>
                                <div class="text-muted mt-0 pt-0">Đang chờ duyệt</div>
                            </a>
                        </div>
                    </div>
                    @else 
                    <div class="row mt-3">
                        <div class="col-md-2">
                            <img src="{{ asset('storage/app/assets/img/school/'.$anhtruong) }}" class="avt-group"
                                alt="">
                        </div>
                        <div class="col-md-10 py-auto text-truncate pt-1">
                            <a class="text-decoration-none" href="{{ url('fanpage/' . $qtvschools->school_id) }}"
                                title="{{ $qtvschools->school_name }}">
                                <h5 class="font-weight-bold text-dark mb-0 pb-0">{{ $qtvschools->school_name }}</h5>
                                {{-- <div class="text-muted mt-0 pt-0"></div> --}}
                            </a>
                        </div>
                    </div>
                    @endif
                @endforeach
                <h3 class="font-weight-bold ">Đang theo dõi </h3>
                @foreach ($myschool as $schools)
                <?php  if($schools->userql != Auth::user()->user_id){
               $anhtruong='noteschool.png';
               if(!empty($schools->school_avatar)){
                    $anhtruong=$schools->school_avatar;
                }  ?>
                    <div class="row mt-3">
                        <div class="col-md-2">
                            <img src="{{ asset('storage/app/assets/img/school/'.$anhtruong) }}" class="avt-group"
                                alt="">
                        </div>
                        <div class="col-md-10 py-auto text-truncate pt-1">
                            <a class="text-decoration-none" href="{{ url('fanpage/' . $schools->school_id) }}"
                                title="{{ $schools->school_name }}">
                                <h5 class="font-weight-bold text-dark">{{ $schools->school_name }}</h5>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                @endforeach

            </div>

        </div>
    
    </div>
@endsection
@section('content-js')
    <script>
        $(document).ready(function() {
            $('#schools').addClass('indam');
          

        });
    </script>
@endsection
