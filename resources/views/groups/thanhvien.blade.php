@extends('groups.header')
@section('header_groups')
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-9 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5><b>Thành viên</b></h5>
                        <hr>
                        @if (!empty($ktthanhvien))
                        @foreach ($list_members as $mem)
                            <?php
                            if ($mem->avatar) {
                                $avatar = $mem->avatar;
                            } else {
                                $avatar = 'noteimg.png';
                            }
                            ?>

                            <div class="row ">
                                <div class="col-md-2 mt-1 text-right">
                                    <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"
                                        class="m-0 cap_avt" loading="lazy">
                                </div>
                                <div class="col-md-6 mt-1 pt-2">
                                    <a href="{{ url('profile/' . $mem->user_id) }}" class="text-decoration-none">
                                        <h6><b>{{ $mem->firstname . ' ' . $mem->name }}</b></h6>
                                    </a>
                                </div>
                                <div class="col-md-4 mt-1">
                                    <?php
                                    if ($mem->user_id == Auth::user()->user_id) {
                                        $cont = '<button class="btn  w-100 text-muted disabled">Tôi</button>';
                                    } else {
                                        $cont = '<a href="http://localhost/mangxh/profile/' . $mem->user_id . '" class="btn btn-lighter w-100" ><i class="fa fa-user-o" aria-hidden="true"></i>&ensp;Xem trang cá nhân</a>';
                                        foreach ($friends as $ban):
                                            if ($mem->user_id == $ban->user_id) {
                                                $cont = '<a href="http://localhost/mangxh/conversation/' . $mem->user_id . '" class="btn btn-lighter w-100" ><i class="fa fa-comment" aria-hidden="true"></i>&ensp;Nhắn tin</a>';
                                            }
                                        endforeach;
                                    }
                                    echo $cont;
                                    ?>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <hr>
                        @endforeach
                        @else 
                        <center>

                            <h5 class="text-muted">Bạn chưa phải là thành viên trong nhóm nên không thể xem được <br>
                            Hãy yêu cầu tham gia và chờ trưởng nhóm xét duyệt nhá.</h5>
                        </center>
                        @endif 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('header_groups_js')
    <script>
        $(document).ready(function() {
            $('#gmember').addClass('btn-active');
          
        });
    </script>
@endsection
