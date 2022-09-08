@extends('layouts.layout')
@section('content-title')
    <title>Halo | Bạn bè</title>
@endsection
@section('content-css')
    <style>

    </style>
@endsection
@section('content')
    <?php
    if (Auth::user()->avatar) {
        $avatar = Auth::user()->avatar;
    } else {
        $avatar = 'avatar.png';
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12 text-right">
                <a href="{{ url('/friends_around') }}" class="text-decoration-none text-dark">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>&ensp;Tìm quanh đây
                </a>
                </div>
        </div>
        <div class="row" id="bb">
        </div>
        <hr>
        <h3 class="my-3"><b>Có thể bạn đã quen </b></h3>
        <div class="row" id="cothequen">
        </div>
    </div>
@endsection
@section('content-js')
    <script>
        $(document).ready(function() {
            $('#friends').addClass('indam');

            function load_friends() {
                $.ajax({
                    url: "{{ url('load_friend') }}",
                    method: "POST",
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "user_id": {{ Auth::user()->user_id }},
                    },
                    dataType: 'json',
                    // contentType: false,
                    // cache: false,
                    // processData: false,
                    success: function(data) {
                        $('#bb').html(data.output);
                        $('#cothequen').html(data.chuaquen);
                    }
                });
            };
            load_friends();
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
                    // contentType: false,
                    // cache: false,
                    // processData: false,
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
                    // contentType: false,
                    // cache: false,
                    // processData: false,
                    success: function(data) {
                        btn.html(data.ghichu);
                    }
                });
            });
        });
    </script>
@endsection
