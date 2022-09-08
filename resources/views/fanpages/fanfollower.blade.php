@extends('fanpages.manaheader')
@section('header_fanpage_title')
    <title>{{ $school->school_name }} | Mạng xã hội Halo</title>
@endsection
@section('header_fanpage_css')
    <style>
        #previewbg img {
            width: 100%;
        }
        .bg-lighter{

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
            {{-- <div class="col-md-1"></div> --}}
            <div class="col-md-12  ">
            
                  
                   <div class="row">
                    @if(!$followers->isEmpty())
                    @foreach ($followers as $follow)
                    <?php
                    if(empty($follow->avatar)){
                        $avatar='noteimg.png';
                    }else {
                        $avatar=$follow->avatar;
                    }
                    ?>
                        <div class="col-md-4 mx-auto border p-2 bg-light " style="border-radius: 12px;">
                            <div class="row  pt-2">
                                <div class="col-md-3">
                                    <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"
                                        class="m-0 cap_avt" alt="">
                                </div>
                                <div class="col-md-9">
                                    <h6 class="  mt-2">
                                        <a href="{{ url('profile/'.$follow->user_id) }}" class="text-decoration-none text-muted">
                                            {{ $follow->firstname.' '.$follow->name }}
                                        </a>
                                        
                                    </h6>
                                   
                                    
                                </div>
                              
                            </div>
                            
                        </div>
                    @endforeach
                    @else 
                    <div class="col-md-12">
                        <center>
                            <h5 class="text-muted">Không có ai theo dõi</h5>
                        </center>

                    </div>
                    @endif
                </div>

            
            </div>

            {{-- <div class="col-md-1"></div> --}}

        </div>
    </div>
@endsection
@section('header_fanpage_js')
    <script>
        $(document).ready(function() {
            $('#people').addClass('btn-active');

          


         
        });
    </script>
@endsection
