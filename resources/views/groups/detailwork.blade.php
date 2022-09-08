@extends('groups.header')
@section('header_groups_css')
    <style>
        .formwork label {
            font-weight: bold;
        }

        /* .gw_noidung {
                                    text-overflow: ellipsis;
                                    overflow: hidden;
                                    -webkit-line-clamp: 1;
                                    -webkit-box-orient: vertical;
                                    display: -webkit-box;
                                    font-size: 15px;
                            } */

        .gw_file {
            text-overflow: ellipsis;
            overflow: hidden;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            display: -webkit-box;
            font-size: 15px;

        }

    </style>
@endsection
@section('header_groups')
    <?php $avatarnopbai = 'noteimg.png';
    if (!empty($mysmission->avatar)) {
        $avatarnopbai = $mysmission->avatar;
    } ?>

    @if (session('messgw'))
        <div class="alert alert-success">
            {{ session('messgw') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-10 mx-auto my-2">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-2 px-0">
                                <time datetime="{{ date('Y-m-d', strtotime($group_work->gw_hannop)) }}"
                                    class="lich mx-auto">
                                    {{-- <em>Thứ 7</em> --}}
                                    <strong>Tháng {{ date('m', strtotime($group_work->gw_hannop)) }}</strong>
                                    <span>{{ date('d', strtotime($group_work->gw_hannop)) }}</span>
                                </time>
                            </div>
                            <div class="col-md-10 pl-0">
                                <div id="form1">
                                    <h4 class="font-weight-bold">{{ $group_work->gw_tieude }}</h4>
                                    <div class="text-muted ml-2  gw_noidung">
                                        {!! nl2br($group_work->gw_noidung) !!}</div>
                                    @if (!empty($group_work->gw_file))
                                        <object data={{ asset('storage/app/assets/bainop/' . $group_work->gw_file) }}"
                                            type="{{ $group_work->gw_typefile }}" width="300" height="200">
                                            <a href="{{ asset('storage/app/assets/bainop/' . $group_work->gw_file) }}"
                                                target="blank" class="gw_file mt-3 text-decoration-none">
                                                <i class="fa fa-file text-primary"
                                                    aria-hidden="true"></i>&ensp;{{ $group_work->gw_file }}</a>
                                        </object>
                                    @endif
                                    <div class="row align-items-end  text-muted">
                                        <div class="col">
                                            Người đăng: {{ $group_work->firstname . ' ' . $group_work->name }}
                                        </div>
                                        <div class="col text-right">
                                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                                            {{ date('\H\ế\t\ \h\ạ\n\ \l\ú\c\ H:i A', strtotime($group_work->gw_hannop)) }}
                                            |
                                            {{ date('d-m-Y', strtotime($group_work->gw_hannop)) }}
                                        </div>

                                    </div>

                                </div>
                                @if (Auth::user()->user_id == $group_work->nguoitao_id)
                                    <div class="modal fade" id="editcv" data-backdrop="static" data-keyboard="false"
                                        tabindex="-1" aria-labelledby="editcvLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header px-0">
                                                    <div class="row w-100 ">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-10 text-center">
                                                            <h4 class="modal-title " id="editcvLabel">Chỉnh sửa công việc
                                                            </h4>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button type="button" class="close float-right"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <form method="post" action="{{ url('/groups/edit_work') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row formwork">
                                                            <input type="text" class="form-control" name="group_id"
                                                                value="{{ $group->group_id }}">
                                                            <input type="text" class="form-control" name="gw_id"
                                                                value="{{ $group_work->gw_id }}">
                                                            <div class="col-md-12">
                                                                <label for="">Tiêu đề <sup>(*)</sup></label>
                                                                <input type="text" class="form-control" name="gw_tieude"
                                                                    placeholder="Tiêu đề công việc"
                                                                    value="{{ $group_work->gw_tieude }}" required>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="">Nội dung</label>
                                                                <textarea name="gw_noidung" id="gw_noidung" rows="6" class="form-control"
                                                                    placeholder="Nội dung công việc">{{ $group_work->gw_noidung }}</textarea>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="">Thời gian hết hạn <sup>(*)</sup></label>
                                                                <input type="time" name="gw_time" id="gw_time"
                                                                    class="form-control"
                                                                    value="{{ date('H:i', strtotime($group_work->gw_hannop)) }}"
                                                                    min="{{ date('H:i') }}" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="">Ngày hết hạn <sup>(*)</sup></label>
                                                                <input type="date" name="gw_date" id="gw_date"
                                                                    class="form-control"
                                                                    value="{{ date('Y-m-d', strtotime($group_work->gw_hannop)) }}"
                                                                    min="{{ date('Y-m-d') }}" required>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="">Upload file (giới hạn 10MB)</label>
                                                                <input type="file" name="gw_file" id="gw_file"
                                                                    class="form-control">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Hủy</button>
                                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class=" text-muted">
                                        <sub>
                                            <button type="button" data-toggle="modal" data-target="#editcv"
                                                class="btn float-right text-muted border-right border-left">Chỉnh
                                                sửa</button>

                                            <form action="{{ url('/groups/delete_work') }}" method="post"
                                                onsubmit="return confirm('Bạn có chắc muốn xóa hay không?')">
                                                @csrf
                                                <input type="hidden" name="gw_id" value="{{ $group_work->gw_id }}">
                                                <input type="hidden" name="group_id" value="{{ $group->group_id }}">
                                                <button type="submit"
                                                    class="float-right border-right border-left btn text-muted">Xóa</button>
                                            </form>
                                        </sub>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                @if (Auth::user()->user_id != $group_work->nguoitao_id)
                    @if (empty($mysmission))
                        <div class="card">
                            <div class="card-body">
                                <form method="post" class="upformsubmissions">
                                    @csrf
                                    <div class="row formwork">
                                        <input type="hidden" class="form-control" name="group_id" id="group_id"
                                            value="{{ $group->group_id }}">
                                        <input type="hidden" class="form-control" name="gw_id" id="gw_id"
                                            value="{{ $group_work->gw_id }}">
                                        <div class="col-md-12">
                                            <label for="">Nội dung</label>
                                            <textarea name="sm_noidung" id="sm_noidung" rows="2" class="form-control" placeholder="Nội dung công việc"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Upload file (giới hạn 10MB)</label>
                                            <input type="file" name="sm_file" id="sm_file" class="form-control">
                                        </div>
                                    </div>
                                    <div class="text-right mt-2">
                                        <button type="submit" class="btn btn-primary">Nộp bài</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
               
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>
                                            <img src="{{ asset('storage/app/assets/img/avatar/' . $avatarnopbai) }}"
                                                class="m-0 mr-2 cap_avt">
                                            {{ $mysmission->firstname . ' ' . $mysmission->name }}   <?php 
                                            if(strtotime($mysmission->sm_ngaynop) > strtotime($group_work->gw_hannop)){
                                                echo '|<button class="btn py-0 btn-danger"> Trễ hạn</button>';
                                            } 
                                            ?>
<span class="float-right" style="font-size: 14px; height:20px;">{{ $mysmission->sm_diem }}/100</span>

                                        </h4>
                                        
                                        <div class="ml-5" id="bainop">
                                          
                                            <span class="mt-3">{!! nl2br($mysmission->sm_noidung) !!}</span>
                                            @if (!empty($mysmission->sm_file))
                                                <object
                                                    data={{ asset('storage/app/assets/bainop/' . $mysmission->sm_file) }}"
                                                    type="{{ $mysmission->sm_typefile }}" width="300" height="200">
                                                    <a href="{{ asset('storage/app/assets/bainop/' . $mysmission->sm_file) }}"
                                                        target="blank" class="gw_file mt-3 text-decoration-none">
                                                        <i class="fa fa-file text-primary"
                                                            aria-hidden="true"></i>&ensp;{{ $mysmission->sm_file }}</a>
                                                </object>
                                            @endif

                                        </div>
                                        <div class="d-none w-100 " id="formedit">
                                            <form method="post" class="upformsubmissions">
                                                @csrf
                                                <div class="row formwork">
                                                    <input type="hidden" name="group_id" id="group_id"
                                                        value="{{ $group->group_id }}">
                                                    <input type="hidden" name="gw_id" id="gw_id"
                                                        value="{{ $group_work->gw_id }}">
                                                    <input type="hidden" name="idbainop"
                                                        value="{{ $mysmission->sm_id }}">
                                                    <div class="col-md-12">
                                                        <label for="">Nội dung</label>
                                                        <textarea name="sm_noidung" id="sm_noidung" rows="2" class="form-control"
                                                            placeholder="Nội dung công việc">{!! nl2br($mysmission->sm_noidung) !!}</textarea>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">Upload file (giới hạn 10MB)</label>
                                                        <input type="file" name="sm_file" id="sm_file"
                                                            class="form-control" value="">
                                                    </div>
                                                </div>
                                                <div class="text-center mt-2 mb-3">
                                                    <button type="submit" class="btn btn-primary">Nộp bài</button>
                                                    <button class="btn-huy btn btn-primary">Hủy</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class=" text-muted">
                                            <sub>
                                                <span
                                                    class="text-muted float-left btn">{{ date('\Đ\ã\ \N\ộ\p\:\ H:i A \N\g\à\y\ d \T\h\á\n\g\ m \N\ă\m Y', strtotime($mysmission->ngaynop)) }}</span>

                                                <button id="chinhsua"
                                                    class="btn float-right text-muted border-right border-left">Chỉnh
                                                    sửa</button>

                                                <form action="{{ url('/groups/delete_submissions') }}" method="post"
                                                    onsubmit="return confirm('Bạn có chắc muốn xóa hay không?')">
                                                    @csrf
                                                    <input type="hidden" name="idbainop"
                                                        value="{{ $mysmission->sm_id }}">
                                                    <button type="submit"
                                                        class="float-right border-right border-left btn text-muted">Xóa</button>
                                                </form>
                                            </sub>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @elseif(Auth::user()->user_id == $group_work->nguoitao_id)


{{-- Này của người tạo công việc --}}


                    @foreach ($smission as $submiss)
                        <?php $avatarnguoinop = 'noteimg.png';
                        if (!empty($submiss->avatar)) {
                            $avatarnguoinop = $submiss->avatar;
                        } ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mx-auto">
                                        <h4 class="font-weight-bold">
                                            <img src="{{ asset('storage/app/assets/img/avatar/' . $avatarnguoinop) }}"
                                                class="m-0 mr-2 cap_avt">
                                            {{ $submiss->firstname . ' ' . $submiss->name }}<?php 
                                            if(strtotime($submiss->sm_ngaynop) > strtotime($group_work->gw_hannop)){
                                                echo '|<button class="btn py-0 btn-danger"> Trễ hạn</button>';
                                            } 
                                            ?>


<span class="float-right" style="font-size: 14px; height:20px;"><label for=""><input type="number" min="0" max="100" name="chamdiem" id="diemso{{ $submiss->sm_id }}" class="chamdiem" data-submiss="{{ $submiss->sm_id }}" style="width:50px;" value="{{ $submiss->sm_diem }}">/100</label></span>
                                        </h4>
                                        <div class="ml-5">
                                            <p class="">{!! nl2br($submiss->sm_noidung) !!}</p>
                                            @if (!empty($submiss->sm_file))
                                                <object
                                                    data={{ asset('storage/app/assets/bainop/' . $submiss->sm_file) }}"
                                                    type="{{ $submiss->sm_typefile }}" width="300" height="200">
                                                    <a href="{{ asset('storage/app/assets/bainop/' . $submiss->sm_file) }}"
                                                        target="blank" class="gw_file mt-3 text-decoration-none">
                                                        <i class="fa fa-file text-primary"
                                                            aria-hidden="true"></i>&ensp;{{ $submiss->sm_file }}</a>
                                                </object>
                                            @endif
                                            <sub>
                                                <span
                                                    class="text-muted float-left btn">{{ date('\Đ\ã\ \N\ộ\p\:\ H:i A \N\g\à\y\ d \T\h\á\n\g\ m \N\ă\m Y', strtotime($submiss->sm_ngaynop)) }}</span>
                                            </sub>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
@section('header_groups_js')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#chinhsua', function(e) {

                $('#formedit').removeClass('d-none');
                $('#bainop').addClass('d-none');
            });
            $(document).on('click', '#chinhsuacv', function(e) {

                $('#form2').removeClass('d-none');
                $('#form1').addClass('d-none');
            });
            $(document).on('click', '.btn-huy', function(e) {
                e.preventDefault();

                $('#bainop').removeClass('d-none');
                $('#formedit').addClass('d-none');
            });
            // $('#work').addClass('btn-active');
            $(document).on('blur', '.chamdiem', function(e) {
                e.preventDefault();
                // alert($(this).data('submiss'));

                // alert($('#diemso'+$(this).data('submiss')).val());

                $.ajax({
                url: "{{ url('/groups/chamdiem') }}",
                method: "POST",
                data: {
                    "_token": '{{ csrf_token() }}',
                    "idbainop": $(this).data('submiss'),
                    "diem": $('#diemso'+$(this).data('submiss')).val(),
                },
                dataType: 'json',
                success: function(data) {
                  alert(data.mess);

                }
            });

            });
            $(document).on('submit', '.upformsubmissions', function(e) {
                e.preventDefault();
                var data = new FormData(this);

                data.append('sm_noidung', $('#sm_noidung').val());
                if ($('#sm_file')[0].files.length > 0) {
                    var fsize = $('#sm_file')[0].files[0].size;
                    var ftype = $('#sm_file')[0].files[0].type;
                    var fname = $('#sm_file')[0].files[0].name;
                    data.append('sm_file', $('#sm_file')[0].files[0]);
                    data.append('sm_typefile', ftype);
                    if (fsize > 10485760) {
                        alert("file quá lớn không thể upload");
                        $('#sm_file').val('');
                    }
                }
                $.ajax({
                    url: "{{ url('groups/upload_submissions') }}",
                    method: "POST",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        // console.log(data);
                        // $('.upformsubmissions')[0].reset();
                        // $('#bainop').removeClass('d-none');
                        // $('#formedit').addClass('d-none');
                        location.reload();

                    }



                });

            });
        });
    </script>
@endsection
