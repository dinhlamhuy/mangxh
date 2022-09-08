@extends('groups.header')
@section('header_groups_css')
    <style>
        .formwork label {
            font-weight: bold;
        }

        .gw_noidung {
            text-overflow: ellipsis;
            overflow: hidden;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            display: -webkit-box;
            font-size: 15px;
        }

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

    @if (Auth::user()->user_id == $group->group_founder)
        <div class="container-fluid" style="margin-top: -60px;">
            <div class="row mt-3">
                <div class="col-md-3 mr-0 ml-auto">
                    <!-- Button trigger modal -->
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#themcv">
                        + Thêm công việc mới
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="themcv" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="themcvLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header px-0">
                                    <div class="row w-100 ">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10 text-center">
                                            <h4 class="modal-title " id="themcvLabel">Thêm công việc</h4>

                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="close float-right" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                        </div>
                                    </div>
                                </div>
                                <form method="post" id="upformwork">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row formwork">
                                            <input type="hidden" class="form-control" name="group_id" id="group_id"
                                                value="{{ $group->group_id }}">
                                            <div class="col-md-12">
                                                <label for="">Tiêu đề <sup>(*)</sup></label>
                                                <input type="text" class="form-control" name="gw_tieude" id="gw_tieude"
                                                    placeholder="Tiêu đề công việc" required>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Nội dung</label>
                                                <textarea name="gw_noidung" id="gw_noidung" rows="6" class="form-control" placeholder="Nội dung công việc"></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Thời gian hết hạn <sup>(*)</sup></label>
                                                <input type="time" name="gw_time" id="gw_time" class="form-control"
                                                    value="{{ date('H:i') }}" min="{{ date('H:i') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Ngày hết hạn <sup>(*)</sup></label>
                                                <input type="date" name="gw_date" id="gw_date" class="form-control"
                                                    value="{{ date('Y-m-d') }}"  required>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Upload file (giới hạn 10MB)</label>
                                                <input type="file" name="gw_file" id="gw_file" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @if (session('messgw'))
            <div class="alert alert-success">
                {{ session('messgw') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    @endif
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-8 mx-auto my-2">
                @foreach ($group_work as $gw)
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ url('/groups/' . $gw->group_id . '/work/' . $gw->gw_id . '') }}"
                                class="text-decoration-none text-dark">
                                <div class="row">
                                    <div class="col-md-2 px-0">
                                        <time datetime="{{ date('Y-m-d', strtotime($gw->gw_hannop)) }}"
                                            class="lich mx-auto">
                                            {{-- <em>Thứ 7</em> --}}
                                            <strong>Tháng {{ date('m', strtotime($gw->gw_hannop)) }}</strong>
                                            <span>{{ date('d', strtotime($gw->gw_hannop)) }}</span>
                                        </time>
                                    </div>
                                    <div class="col-md-10 pl-0">
                                        <h4 class="font-weight-bold">{{ $gw->gw_tieude }}</h4>
                                        <div class="text-muted ml-2 gw_noidung">
                                            {!! $gw->gw_noidung !!}</div>
                                        @if (!empty($gw->gw_file))
                                            <object data={{ asset('storage/app/assets/bainop/' . $gw->gw_file) }}"
                                                type="{{ $gw->gw_typefile }}" width="300" height="200">
                                                <a href="{{ asset('storage/app/assets/bainop/' . $gw->gw_file) }}"
                                                    target="blank" class="gw_file mt-3 text-decoration-none">
                                                    <i class="fa fa-file text-primary"
                                                        aria-hidden="true"></i>&ensp;{{ $gw->gw_file }}</a>
                                            </object>
                                        @endif
                                        <div class="row align-items-end  text-muted">
                                            <div class="col">
                                                Người đăng: {{ $gw->firstname . ' ' . $gw->name }}
                                            </div>
                                            <div class="col text-right">
                                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                {{ date('\H\ạ\n\ \n\ộ\p\ H:i A', strtotime($gw->gw_hannop)) }} |
                                                {{ date('d-m-Y', strtotime($gw->gw_hannop)) }}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('header_groups_js')
    <script>
        $(document).ready(function() {

            $('#work').addClass('btn-active');
            $(document).on('submit', '#upformwork', function(e) {
                e.preventDefault();
                var data = new FormData(this);
                data.append('user_id', {{ Auth::user()->user_id }});
                data.append('group_id', $('#group_id').val());
                data.append('gw_tieude', $('#gw_tieude').val());
                data.append('gw_noidung', $('#gw_noidung').val());
                data.append('gw_time', $('#gw_time').val());
                data.append('gw_date', $('#gw_date').val());
                if ($('#gw_file').val() !== '') {
                    var fsize = $('#gw_file')[0].files[0].size;
                    var ftype = $('#gw_file')[0].files[0].type;
                    var fname = $('#gw_file')[0].files[0].name;
                    data.append('gw_file', $('#gw_file')[0].files[0]);
                    data.append('gw_typefile', ftype);
                    if (fsize > 10485760) {
                        alert("file quá lớn không thể upload");
                        $('#gw_file').val('');
                    }

                }
                $.ajax({
                    url: "{{ url('groups/add_work') }}",
                    method: "POST",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        // console.log(data.datawork.group_id);

                        $('#upformwork')[0].reset();
                        $('#themcv').modal('hide');
                        location.reload();
                    }
                });
            });
        });
    </script>
@endsection
