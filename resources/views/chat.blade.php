@extends('layouts.layout')
@section('content-title')
    <title>Halo | Trò chuyện trực tuyến</title>
@endsection
@section('content-css')
    <link rel="stylesheet" href="{{ asset('public/css/chat.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
    integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            overflow-x: hidden;
        }

        .messaging {
            height: 100%;
        }

        .textImage {
            font-family: 'Quicksand', sans-serif;
            vertical-align: middle;
            text-align: center;
            margin-left: 8px;
            font-size: 20px;
            font-weight: bold;
        }

        .status-user-icon {
            position: absolute;
            margin-left: -10px;
            /* color: goldenrod; */
            margin-top: 25px;
        }

        .chat-img-user {
            margin-left: 30px;
        }

        .header-msg {
            height: 52px;
            margin-left: 300px;
            padding-left: 150px;
            padding-top: 5px;
        }

        .chat-name-user {
            margin-left: 80px;
            vertical-align: middle;
            margin-top: 10px;
        }

        .avt-chat {
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            font-size: 60px;
            color: slateblue;
        }

        .nen-chat {
            display: block;
            height: 500px;
            text-align: center;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .batdauchat:active,
        .batdauchat:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        .lishfriend {
            height: 40px !important;
            width: 40px !important;
            border-radius: 50% !important;
        }

    </style>
@endsection
@section('content')
    <div class="messaging container-fluid mt-1 mx-1 px-0 mb-0 ">
        <div class="inbox_msg row overflow-hidden">
            <div class="inbox_people col-md-3 pr-0">
                <div class="headind_srch">
                    <div class="recent_heading">
                        <h4>Trò chuyện</h4>
                    </div>
                    <div class="srch_bar">
                        <div class="stylish-input-group">
                            <input type="text" class="search-bar" placeholder="Search">
                        </div>
                    </div>
                </div>
                <div class="inbox_chat scroll ml-2">
                    @if ($users->count())
                        @foreach ($users as $usr)
                            <?php $usr_avatar = 'noteimg.png';
                            if ($usr->avatar) {
                                $usr_avatar = $usr->avatar;
                            }
                            ?>
                            <div class="chat_list">
                                <a href="{{ route('message.conversation', $usr->user_id) }}" class="text-decoration-none">
                                    <div class="chat_people">
                                        <img src="{{ asset('storage/app/assets/img/avatar/' . $usr_avatar) }}">
                                        <i class="fa fa-circle  status-user-icon user-icon-{{ $usr->user_id }}"
                                            aria-hidden="true" title="Offline"></i>
                                        <div class="chat_ib">
                                            <h5>{{ $usr->firstname . ' ' . $usr->name }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                    <h5 class="ml-3 mt-4"><b>Group <button type="button" class="btn p-0 " data-toggle="modal"
                                data-target="#addGroupModal">
                                <i class="fa fa-plus btn-add-group ml-3"></i></button></b></h5>
                    @if ($groups->count())
                        @foreach ($groups as $group)
                            <div class="chat_list ">
                                <a href="{{ route('message-group.show', $group->id) }}" class="text-decoration-none">
                                    <div class="chat_people">
                                        {!! makeImageFromName($group->groupname) !!}
                                        <div class="chat_ib">
                                            <h5><?php
                                                if (strlen($group->groupname) > 30) {
                                                    echo trim(substr($group->groupname, 0, 30)) . '...';
                                                } else {
                                                    echo $group->groupname;
                                                }
                                                ?> <span class="chat_date"></span></h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-9 px-0 w-100 mx-0">
                <center>
                    <button type="button" class="btn batdauchat" style="outline: none;" data-toggle="modal"
                        data-target="#timbanchat">
                        <img src="{{ asset('storage/app/assets/img/nen/nenchat.jpg') }}" class="nen-chat"
                            title="Bắt đầu trò chuyện thôi nào!">
                    </button>
                </center>
                <div class="modal fade" id="timbanchat" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm cuộc trò chuyện</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">Tìm kiếm:</label>
                                            <input type="text" class="form-control" id="tkuser">
                                        </div>
                                    </div>
                                    <div class="row overflow-auto " style="height: 400px; ">
                                        <div class="col-md-12">
                                            <ul class="list-group list-group-flush w-100 mr-0 " id="listusr">
                                                @foreach ($friends as $friend)
                                                    <?php $friend_avatar = 'noteimg.png';
                                                    if ($friend->avatar) {
                                                        $friend_avatar = $friend->avatar;
                                                    }
                                                    ?>
                                                    <li class="list-group-item">
                                                        <a href="{{ url('conversation/' . $friend->user_id) }}"
                                                            class="text-decoration-none">
                                                            <img src="{{ asset('storage/app/assets/img/avatar/' . $friend_avatar) }}"
                                                                class="lishfriend">
                                                            <span
                                                                class="text-muted h6">{{ $friend->firstname . ' ' . $friend->name }}</span>
                                                        </a>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 <!-- Modal add group friend-->
 <div class="modal fade" id="addGroupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm nhóm mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('message-group.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="groupname">Tên nhóm</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="selectMember">Chọn thành viên</label>
                        <select name="user_id[]" id="selectMember" class="form-control w-100" style="width: 100%;"
                            multiple="multiple">
                            @foreach ($users as $user)
                                <option value="{{ $user->user_id }}">{{ $user->firstname . ' ' . $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tạo nhóm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
@push('scripts')

    <script>
        $(function() {
            let user_id = "{{ Auth::user()->user_id }}";
            let ip_address = '127.0.0.1';
            let socket_port = '8005';
            let socket = io(ip_address + ':' + socket_port);
            socket.on('connect', function() {
                socket.emit('User_connected', user_id)
            });
            socket.on('updateUserStatus', (data) => {
                let $userStatusIcon = $('.user-status-icon');
                $userStatusIcon.removeClass('text-success');
                $userStatusIcon.attr('title', 'Offline');
                console.log(data);
                $.each(data, function(key, val) {
                    if (val !== null && val !== 0) {
                        let $userIcon = $(".user-icon-" + key);
                        $userIcon.addClass('text-success');
                        $userIcon.attr('title', 'Online');
                    }
                });

            });

        });
    </script>
@endpush
@section('content-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>

    <script>
        $(document).ready(function() {
            $('#selectMember').select2();
            $('#tkuser').on('keyup', function() {
                $value = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: '{{ URL::to('search-chat') }}',
                    data: {
                        'search': $value
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#listusr').html(data.data);
                    }
                });
            });
        });

        
    </script>
@endsection
