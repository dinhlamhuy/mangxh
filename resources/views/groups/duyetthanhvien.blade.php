@extends('groups.header')
@section('header_groups')
    <div class="container-fluid" style="margin-top: -10px">

        <div class="row">
            <div class="col-md-7 mx-auto">
                <div class="card mt-3">
                    <div class="card-body">
                        <h5><b>Duyệt thành viên</b></h5>
                        <hr class="netngang">
                        <div class="row">
                            @if(!$members->isEmpty())
                            @foreach ($members as $mem)
                            <?php
                            if(empty($mem->avatar)){
                                $avatar='noteimg.png';
                            }else {
                                $avatar=$mem->avatar;
                            }
                            ?>
                                <div class="col-md-5 mx-auto border">
                                    <div class="row  pt-2">
                                        <div class="col-md-4">
                                            <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"
                                                class="m-0 cap_avt" alt="">
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="  mt-2">
                                                <a href="{{ url('profile/'.$mem->user_id) }}" class="text-decoration-none text-muted">
                                                    {{ $mem->firstname.' '.$mem->name }}
                                                </a>
                                                
                                            </h6>
                                            <center>

                                                <button class="btn btn-light w-100 py-0 duyettv usr{{$mem->user_id}}" data-user="{{$mem->user_id}}" data-group="{{$mem->group_id}}">
                                                    <i class="fa fa-check"></i>Duyệt
                                                </button>
                                            </center>
                                            
                                        </div>
                                      
                                    </div>
                                    
                                </div>
                            @endforeach
                            @else 
                            <div class="col-md-12">
                                <center>
                                    <h5 class="text-muted">Không có người dùng gửi yêu cầu</h5>
                                </center>

                            </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
@section('header_groups_js')
    <script>
        $(document).ready(function() {
            $('#kiemduyet').addClass('btn-active');

            $(document).on('click','.duyettv', function(e){
                e.preventDefault();
                var user_id = $(this).data('user');
                var group_id = $(this).data('group');
                $.ajax({
                    url: "{{ url('/groups/duyettv') }}",
                    method: "POST",
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "group_id":group_id,
                        "user_id": user_id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('.usr'+user_id).html(data.nd);
                      

                    }
                });

            }); 
        });
    </script>
@endsection
