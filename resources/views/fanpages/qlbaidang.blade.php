@extends('fanpages.manaheader')
@section('header_fanpage_title')
    <title>{{ $school->school_name }} | Mạng xã hội EDuck</title>
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
            <div class="col-md-4">
                <div class="card" style="border-radius:12px; ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Giới thiệu</h4>
                                <div>{!! $school->school_about !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mx-auto">
               
                <div id="post-data">
                    @include('fanpages.fanpage_postchoduyet')
                </div>
            </div>

            <div class="col-md-1"></div>

        </div>
    </div>
@endsection
@section('header_fanpage_js')
    <script>
        $(document).ready(function() {
            $('#index').addClass('btn-active');
            $(".cap_post").emojioneArea({
                pickerPosition: "top",
                filtersPosition: "bottom",
            });

            function loadimg(id) {
                var str = $('#mangimg' + id).text().toString();
                var images = str.split(',');
                $('#postimg' + id).imagesGrid({
                    images: images
                });
            }

            @foreach ($baidang as $post)
                loadimg({{ $post->post_id }});
            @endforeach

            $(document).on('click', '.duyetbaidang', function(e) {
                e.preventDefault();
                var post_id = $(this).data('post');
                // alert(post_id);
                $.ajax({
                    url: "{{ url('fanpages/duyetbai') }}",
                    method: "POST",
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "post_id": post_id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        if(data.kq=='1'){
                            $('.post'+post_id).addClass('d-none');
                        }
                    }
                });

            });
            $('#imgpost').on("change", previewImages);
        });
    </script>
@endsection
