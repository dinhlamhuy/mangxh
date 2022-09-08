@extends('layouts.layout')

@section('content-title')
    <title>Tìm quanh đây | Halo - Mạng xã hội</title>
@endsection

@section('content-css')
@endsection
@section('content')
    <?php
    // var_dump($listuser);
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <button id="demo" class="btn btn-primary" onclick="getLocation()">Click vào để xác định vị trí</button>
            </div>
        </div>
        <div class="row" id="showfriend"></div>
    </div>
@endsection
@section('content-js')
    <script>
        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                x.innerHTML = "Trình duyệt của bạn không hỗ trợ Geolocation.";
            }
        }

        function showPosition(position) {
            var lat=position.coords.latitude;
            var long=position.coords.longitude;
            $.ajax({
                url: "{{ url('nearby_friends') }}",
                method: "POST",
                data: {
                    "_token": '{{ csrf_token() }}',
                    "latitude": lat,
                    "longitude": long
                },
                success: function(data) {
                    $('#showfriend').html(data.output);
                }
            });
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    x.innerHTML = "Người dùng từ chối cấp quyền định vị."
                    $('#demo').addClass('btn-secondary');
                    $('#demo').addClass('btn-primary');
                    break;
                case error.POSITION_UNAVAILABLE:
                    x.innerHTML = "Không có thông tin vị trí."
                    $('#demo').addClass('btn-secondary');
                    $('#demo').addClass('btn-primary');
                    break;
                case error.TIMEOUT:
                    x.innerHTML = "Hết thời gian gửi yêu cầu định vị."
                    $('#demo').addClass('btn-secondary');
                    $('#demo').addClass('btn-primary');
                    break;
                case error.UNKNOWN_ERROR:
                    x.innerHTML = "Lỗi chưa xác định."
                    $('#demo').addClass('btn-secondary');
                    $('#demo').addClass('btn-primary');
                    break;
            }
        }

        $(document).on('click', '.fromxacnhan .btnxacnhan', function(e) {
                e.preventDefault();
                var xacnhan = $(this).data('xacnhan');
                var user_from = $(this).data('userid');
                var btn = $(this);
                $.ajax({
                    url: "{{ url('invitations') }}",
                    method: "POST",
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "user_id": {{ Auth::user()->user_id }},
                        "user_from": user_from,
                        "xacnhan": xacnhan
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#formxn' + user_from).html(
                            '<br><button class="btn btn-light w-100" disabled>' + data
                            .output + '</button>');
                    }
                });
            });
            $(document).on('click', '.fromxacnhan .btnketban', function(e) {
                e.preventDefault();
                var user_to = $(this).data('userid');
                var btn = $(this);
                $.ajax({
                    url: "{{ url('send_invitations') }}",
                    method: "POST",
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "user_from": {{ Auth::user()->user_id }},
                        "user_to": user_to,
                    },
                    dataType: 'json',
                    success: function(data) {
                        btn.html(data.ghichu);
                    }
                });
            });
    </script>
@endsection
