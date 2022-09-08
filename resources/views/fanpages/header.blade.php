@extends('layouts.layout')

@yield('header_fanpage_title')


@section('content-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.css"
        integrity="sha512-0Nyh7Nf4sn+T48aTb6VFkhJe0FzzcOlqqZMahy/rhZ8Ii5Q9ZXG/1CbunUuEbfgxqsQfWXjnErKZosDSHVKQhQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('resources/css/fanpages.css') }}">
    <style>
        .tieude {
            background-color: white;
            border: none;
        }

        .acc_card {
            border: none;
        }

        .btn-acco {
            width: 100%;
            text-align: left;
        }

        .cap_post {
            border: none !important;
            box-shadow: none !important;
        }

        .emojionearea-editor {
            outline: none !important;
            box-shadow: none !important;
            max-height: 10em !important;
            min-height: 2.5em !important;
            border-radius: 24px !important;
        }

        .emojionearea {
            border-radius: 24px !important;
        }

        .emojionearea-editor:focus,
        .emojionearea-editor:active {
            outline: none !important;
            box-shadow: none !important;
        }

        .emojioneemoji {
            height: 18px !important;
            width: 18px !important;
        }

        .emojibtn .emojioneemoji {
            height: 25px !important;
            width: 25px !important;
        }

    </style>
    @yield('header_fanpage_css')
@endsection
@section('content')
    <?php
    $anhbia = 'backgroundschool.jpg';
    if (!empty($school->school_background)) {
        $anhbia = $school->school_background;
    }
    $anhdaidien = 'noteimgschool.png';
    if (!empty($school->school_avatar)) {
        $anhdaidien = $school->school_avatar;
    }
    ?>
    <div class="container-fluid" style="margin-top: -10px">
        <div class="row">
            <div class="col-md-12 mx-0 px-0">
                <div class="card">
                    <div class="card-body pb-0 pt-0">
                        <div class="row">
                            <div class="col-md-10 mx-auto">
                                <img src="{{ asset('storage/app/assets/img/anhbia/' . $anhbia) }}"
                                    class="w-100 f-background">
                            </div>
                        </div>
                        <div class="row mt-3 mb-0">
                            <div class="col-md-1">

                            </div>
                            <div class="col-md-10 mx-auto mb-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            <img src="{{ asset('storage/app/assets/img/school/' . $anhdaidien) }}"
                                                class=" f-avatar">
                                        </center>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h2 class=" font-weight-bold">{{ $school->school_name }}</h2>
                                    </div>
                                    <div class="col-md-12">
                                        <a class="nav-link dropdown-toggle btn  btn-lighter text-dark text-muted  ml-3 float-right "
                                            href="#" id="tuychon" role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="true">
                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu mr-0 dropdown-menu-right" aria-labelledby="tuychon">
                                            <button class="dropdown-item baocaoschool"
                                                data-schoolid="{{ $school->school_id }}" type="button" data-toggle="modal"
                                                data-target="#reportschool">Báo cáo vi phạm</button>
                                            {{-- <button type="button" class="btn  w-100 dropdown-item" data-toggle="modal"
                                        data-target="#moibanbe">Mời bạn bè</button>
                                        <div class="dropdown-divider"></div> --}}
                                        </div>
                                        <button type="button" class="btn btn-primary float-right font-weight-bold px-4" data-toggle="modal"
                                        data-target="#moibanbe" >+ Mời</button>

                                        <div class="modal fade" id="moibanbe" data-backdrop="static"
                                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Mời bạn bè</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid px-0 mx-0">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <form method="post" id="dsmoiban">
                                                                        @csrf
                                                                        <table id="dsbanbe" class="w-100">
                                                                            <thead>
                                                                                <tr>
                                                                                    <td style="width: 15%;"></td>
                                                                                    <td style="width: 70%;"></td>
                                                                                    <td style="width: 15%;"></td>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php $arrtv = []; 
                                                                                $arrtv[] = $school->userql; 
                                                                                ?>
                                                                                @foreach ($followers as $tv)
                                                                                    <?php
                                                                             
                                                                                        $arrtv[]=$tv->user_id; 
                                                                                        
                                                                                        
                                                                                        ?>
                                                                                    @endforeach
                                                                   
                                                                               
                                                                                @foreach ($friends as $friend)
                                                                                    @if (in_array($friend->user_id, $arrtv))
                                                                                    
                                                                                    @else
                                                                                        <?php
                                                                                        if (empty($friend->avatar)) {
                                                                                            $avatar = 'noteimg.png';
                                                                                        } else {
                                                                                            $avatar = $friend->avatar;
                                                                                        }
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="width: 15%; text-align:right;">
                                                                                                <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"
                                                                                                    class="m-0 cap_avt">
                                                                                            </td>
                                                                                            <td style="width: 70%;">
                                                                                                {{ $friend->firstname . ' ' . $friend->name }}
                                                                                            </td>
                                                                                            <td style="width: 15%;">
                                                                                                <input type="checkbox"
                                                                                                    name="danhsachmoiban[]"
                                                                                                    multiple="multiple"
                                                                                                    value="{{ $friend->user_id }}">
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        <button class="btn btn-primary float-right mt-5">Mời
                                                                            bạn</button>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        @if ($myfollow)
                                            <button data-fanpage="{{ $school->school_id }}"
                                                class="theodoifanpage btn btn-light float-right mr-3 font-weight-bold">
                                                Đã theo dõi</button>
                                        @else
                                            <button data-fanpage="{{ $school->school_id }}"
                                                class="theodoifanpage btn btn-light float-right mr-3 font-weight-bold">
                                                <i class="fa fa-rss" aria-hidden="true"></i>&ensp;Theo dõi</button>
                                        @endif

                                    </div>
                                </div>
                                <hr class="mb-0">
                                <div class="row mt-0">
                                    <a id="index" href="{{ url('fanpage/' . $school->school_id) }}"
                                        class="btn btn-bg ">Trang chủ</a>
                                    <a id="discussion" href="{{ url('fanpage/' . $school->school_id . '/about') }}"
                                        class="btn btn-bg ">Giới thiệu</a>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    @yield('header_fanpage')
@endsection
@section('content-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"
        integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // $(document).ready(function() {
        // });
    </script>
    @yield('header_fanpage_js')
    <script>
        $(document).on('click', '.theodoifanpage', function(e) {
            e.preventDefault();
            // alert($(this).data('fanpage'));
            $.ajax({
                url: "{{ url('/fanpages/follow') }}",
                method: "POST",
                data: {
                    "_token": '{{ csrf_token() }}',
                    "school_id": $(this).data('fanpage'),
                    "user_id": {{ Auth::user()->user_id }}
                },
                dataType: 'json',
                success: function(data) {
                    // console.log(postid + icon + comment + userid);
                    // load_comment();
                    $('.theodoifanpage').html(data.nd);
                }
            });
        });

        $(document).on('submit', '#dsmoiban', function(e) {
            e.preventDefault();
            var data = new FormData(this);
            data.append('school_id', {{ $school->school_id }} );

            $.ajax({
                url: "{{ url('/fanpages/moitheodoitrang') }}",
                method: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                
                    alert(data.nd);
                }
            });
        });

        $('#dsbanbe').DataTable({
            // "language": {
            //     // "url": "http://cdn.datatables.net/plug-ins/1.11.5/i18n/vi.json"
            // }
        });



    </script>
@endsection
