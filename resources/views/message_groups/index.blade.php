@extends('layouts.layout')
@section('content-title')
    <title>{{ $currentGroup->name }} | Group</title>
@endsection
@section('content-css')
    <link rel="stylesheet" href="{{ asset('public/css/chat.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .msg_history {
            background: url("{{ asset('storage/app/assets/img/nen/nentrochuyen.jpg') }}");
            object-fit: cover !important;
        }

    </style>
@endsection
@section('content')
    <div class="messaging container-fluid mt-1 mx-1 px-0 mb-0">
        <div class="inbox_msg row">
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
                    @if (!$users->isEmpty())
                        @foreach ($users as $usr)
                            <div class="chat_list ">
                                {{-- @if ($usr->user_id == $friendInfo->user_id) active_chat @endif --}}
                                <a href="{{ route('message.conversation', $usr->user_id) }}" class="text-decoration-none">
                                    <div class="chat_people">
                                        <?php if ($usr->avatar) {?>
                                        <img src="{{ asset('storage/app/assets/img/avatar/' . $usr->avatar) }}"
                                            class="avt_user">
                                        <?php } else {?>
                                        <img src="{{ asset('storage/app/assets/img/avatar/noteimg.png') }}"
                                            class="avt_user">
                                        <?php } ?>
                                        <div class="chat_ib">
                                            <i class="fa fa-circle  status-user-icon user-icon-{{ $usr->user_id }}"
                                                style="position: relative; float:left; margin-left:-30px;"
                                                aria-hidden="true" title="Offline"></i>
                                            <h5 style="width:250px;">{{ $usr->firstname . ' ' . $usr->name }}
                                                {{-- <span class="chat_date">Dec 25</span> --}}
                                            </h5>

                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif

                    <h5 class="ml-3 mt-4"><b>Group <i class="fa fa-plus btn-add-group ml-3"></i></b></h5>
                    @if ($groups->count())
                        @foreach ($groups as $group)
                            <div class="chat_list @if ($group->id == $currentGroup->id) active_chat @endif">

                                <a href="{{ route('message-group.show', $group->id) }}" class="text-decoration-none ">
                                    <div class="chat_people">
                                        {!! makeImageFromName($group->groupname) !!}

                                        <div class="chat_ib">
                                            <h5> <?php
                                            if (strlen($group->groupname) > 30) {
                                                echo trim(substr($group->groupname, 0, 30)) . '...';
                                            } else {
                                                echo $group->groupname;
                                            }
                                            ?> <span class="chat_date"></span></h5>
                                            {{-- <p>Test, which is a new approach to have all solutions 
				astrology under one roof.</p> --}}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-6 border px-0 w-100 mx-0">
                <div class="header-msg bg-light border">
                    <div class="chat-img-user pt-1">
                        {!! makeImageFromName($currentGroup->name) !!}
                        {{-- <i class="fa fa-circle  status-user-icon user-icon-{{ $usr->user_id }}" aria-hidden="true" id="userStatusHead{{ $friendInfo->user_id }}"></i> --}}
                    </div>
                    <div class="chat-name-user font-weight-bold">
                        <h5>{{ $currentGroup->name }} </h5>
                    </div>
                </div>
                <div class="mesgs-group  w-100 px-0 mx-0" id="app">
                    <div class="msg_history " id="messageWrapper">
                        @if ($mess->count())
                            <?php $rutgontn = ''; ?>
                            @foreach ($mess as $msg)
                                @if ($msg->sender_id == Auth::user()->user_id)
                                    <div class="outgoing_msg mr-1 ">
                                        <div class="sent_msg">

                                            <p> <?php if($msg->theloaifile == '2'){ ?>
                                                <object data={{ asset('storage/app/assets/img/mess/' . $msg->message) }}"
                                                    width="300" height="200">
                                                    <a href="{{ asset('storage/app/assets/img/mess/' . $msg->message) }}"
                                                        target="blank" class="text-light mt-3 text-decoration-none">
                                                        <i class="fa fa-file text-light"
                                                            aria-hidden="true"></i>&ensp;{{ $msg->message }}</a>
                                                </object>
                                                <?php } else {
                                                    
                                                    ?>
                                                {!! $msg->message !!}
                                                <?php } ?>
                                            </p>
                                            <span class="time_date"
                                                style="float: right">{{ date('h:i A', strtotime($msg->ngaynhan)) }} |
                                                {{ date('d/m/Y', strtotime($msg->ngaynhan)) }}</span>
                                        </div>
                                    </div>
                                @elseif ($msg->sender_id != Auth::user()->user_id)
                                    <div class="incoming_msg  ml-1" style="margin-top:1px; ">
                                        @if ($rutgontn != $msg->sender_id)
                                            <div class="incoming_msg_img">
                                                <?php if ($msg->avatar) {?>
                                                <img src="{{ asset('storage/app/assets/img/avatar/' . $msg->avatar) }}"
                                                    class="avt_user">
                                                <?php } else {?>
                                                <img src="{{ asset('storage/app/assets/img/avatar/noteimg.png') }}"
                                                    class="avt_user">
                                                <?php } ?>
                                            </div>
                                            <div class="received_msg">
                                                <div class="received_withd_msg">
                                                    <p style="color:black;"> <b
                                                            style="font-size:18px; margin-top:0px;margin-bottom:10px;">{{ $msg->firstname . ' ' . $msg->name }}</b><br>
                                                        <?php if($msg->theloaifile=='2'){ ?>
                                                        <object
                                                            data={{ asset('storage/app/assets/img/mess/' . $msg->message) }}"
                                                            width="300" height="200">
                                                            <a href="{{ asset('storage/app/assets/img/mess/' . $msg->message) }}"
                                                                target="blank"
                                                                class="text-light  mt-3 text-decoration-none">
                                                                <i class="fa fa-file text-light"
                                                                    aria-hidden="true"></i>&ensp;{{ $msg->message }}</a>
                                                        </object>
                                                        <?php } else {
                                                            
                                                            ?>
                                                        {!! $msg->message !!}
                                                        <?php } ?>
                                                    </p>
                                                    <span class="time_date"
                                                        style="float: left">{{ date('h:i A', strtotime($msg->ngaynhan)) }}
                                                        | {{ date('d/m/Y', strtotime($msg->ngaynhan)) }}</span>
                                                </div>
                                            </div>
                                        @else
                                            <span style="margin-left:42px;"></span>
                                            <div class="received_msg">
                                                <div class="received_withd_msg">
                                                    <p style="color:black;"> <?php if($msg->theloaifile=='2'){ ?>
                                                        <object
                                                            data={{ asset('storage/app/assets/img/mess/' . $msg->message) }}"
                                                            width="300" height="200">
                                                            <a href="{{ asset('storage/app/assets/img/mess/' . $msg->message) }}"
                                                                target="blank" class="text-dark  mt-3 text-decoration-none">
                                                                <i class="fa fa-file text-primary"
                                                                    aria-hidden="true"></i>&ensp;{{ $msg->message }}</a>
                                                        </object>
                                                        <?php } else {
                                                            
                                                            ?>
                                                        {!! $msg->message !!}
                                                        <?php } ?>
                                                    </p>
                                                    <span class="time_date"
                                                        style="float: left">{{ date('h:i A', strtotime($msg->ngaynhan)) }}
                                                        | {{ date('d/m/Y', strtotime($msg->ngaynhan)) }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                <?php $rutgontn = $msg->sender_id; ?>
                            @endforeach
                        @endif
                    </div>

                    {{-- Soạn tin nhắn --}}
                    <div class="type_msg">

                        <div class="input_msg_write">
                            <label for="file-upload" class="custom-file-upload">
                                <i class="fa fa-paperclip" aria-hidden="true" title="Upload File"></i>
                                <input id="file-upload" type="file" name="messfile" />

                                <input type="hidden" id="messtype" name="type" value="1">
                            </label>
                            <div class="chat-input bg-white write_msg "
                                style="max-height:85px; padding-top:10px; overflow: auto; " id="chatInput"
                                contenteditable="" placeholder="Tin nhắn tới {{ $currentGroup->name }}"></div>
                            {{-- <button  class="msg_send_btn" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button> --}}
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-3 p-0 border mx-0 ">
                <div class="membergroup w-100 m-0 py-0 ">
                    <div class="header-msg bg-light border-bottom my-0 py-0">
                        <div class="chat-img-user mt-3 h5">
                            Thành viên trong nhóm
                        </div>
                    </div>

                    <button type="button" class="btn btn-light w-100 text-primary" data-toggle="modal"
                        data-target="#addusrmess">+ Thêm thành viên mới</button>

                    <div class="modal fade" id="addusrmess" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="addusrmessLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addusrmessdropLabel">Thêm thành viên mới</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="{{ route('message-group.update', $currentGroup->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="selectMember2">Chọn thành viên</label>
                                            <select name="user_id[]" id="selectMember2" class="form-control w-100"
                                                style="width: 100%;" multiple="multiple">
                                                @foreach ($friends as $user)
                                                    <option value="{{ $user->user_id }}">
                                                        {{ $user->firstname . ' ' . $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Thêm thành viên</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                    </div>
                                    @method('PUT')
                                </form>

                            </div>
                        </div>
                    </div>

                    @if (isset($currentGroup->message_group_members) && !empty($currentGroup->message_group_members))
                        <ul class="list-group list-group-flush mx-0 bg-transparent">
                            @foreach ($currentGroup->message_group_members as $member)
                                <?php
                                
                                $usr_avatar = 'noteimg.png';
                                if ($member->user->avatar) {
                                    $usr_avatar = $member->user->avatar;
                                }
                                ?>
                                @if (isset($member->user))
                                    <li class="list-group-item mx-3 bg-transparent" style="border-radius:0px; ">
                                        <a href="{{ url('profile/' . $member->user->user_id) }}"
                                            class="text-decoration-none text-dark">

                                            <img src="{{ asset('storage/app/assets/img/avatar/' . $usr_avatar) }}"
                                                class="img_membergroup avt_user">
                                            <h6 class="mt-2 ml-5">
                                                {{ $member->user->firstname . ' ' . $member->user->name }}</h6>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        scrollSmoothToBottom('messageWrapper');

        function scrollSmoothToBottom(id) {
            var div = document.getElementById(id);
            $('#' + id).animate({
                scrollTop: div.scrollHeight - div.clientHeight
            }, 0);
        }
        $(function() {
            // let $chatInput = $(".chat-input");
            let $chatInput = $(".emojionearea-editor");
            let $chatBody = $(".chat-body");
            let $messageWrapper = $("#messageWrapper");

            let user_id = "{{ Auth::user()->user_id }}";
            let ip_address = '127.0.0.1';
            let socket_port = '8005';
            let socket = io(ip_address + ':' + socket_port);
            let groupId = "{!! $currentGroup->id !!}";
            let groupName = "{!! $currentGroup->name !!}";

            $(".chat-input").emojioneArea({
                pickerPosition: "top",
                filtersPosition: "bottom",
                events: {
                    keypress: function(editor, event) {
                        if (event.which === 13 && !event.shiftKey) {
                            event.preventDefault();
                            $('#messtype').val('1');
                            let message = $('.emojionearea-editor').html();
                            $('.emojionearea-editor').html('');
                            sendMessage(message);

                        }
                    }
                }
            });

            socket.on('connect', function() {
                let data = {
                    group_id: groupId,
                    user_id: user_id,
                    room: "group" + groupId
                };
                socket.emit('User_connected', user_id)
                socket.emit('joinGroup', data);
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

            $('#file-upload').on('change', function() {
                //    message= $("#file-upload")[0].files[0];

                // data.append('imgpost_type', $("#imgpost")[0].files[0].type);

                $('#messtype').val('2');
                sendMessage($("#file-upload")[0].files[0]);


            });

            function sendMessage(message) {
                let url = "{{ route('message.send-group-message') }}";
                let form = $(this);
                let formData = new FormData();
                let token = "{{ csrf_token() }}";
                formData.append('_token', token);
                formData.append('message_group_id', groupId);
                formData.append('messtype', $('#messtype').val());
                if ($('#messtype').val() == '1') {
                    formData.append('message', message);
                    appendMessageToSender(message);
                } else if ($('#messtype').val() == '2') {
                    formData.append('message', '1');
                    formData.append('messfile', message);
                }

                $.ajax({
                    url: "{{ route('message.send-group-message') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.success) {
                            console.log(response.data);
                        }
                        if ($('#messtype').val() == '2') {
                            appendImgMessageToSender(response.tenimg);
                        }
                        scrollSmoothToBottom('messageWrapper');

                    }
                });
            }




            function appendMessageToSender(message) {
                let name = '{{ $myInfo->name }}';
                let image = '{!! makeImageFromName($myInfo->name) !!}';
                let messageContent = '<div class="outgoing_msg">\n' +
                    '<div class="sent_msg">\n' +
                    '<p>' + message + '</p>\n' +
                    '	<span class="time_date" style="float: right" title="' + getCurrentDateTime() + '">' +
                    getCurrentTime() + ' | ' + getDateTime() +
                    '</span> </div>\n' +
                    '</div>';

                let newMessage = messageContent;
                $messageWrapper.append(newMessage);
            }

            function appendImgMessageToSender(message) {
                let name = '{{ $myInfo->name }}';
                let image = '{!! makeImageFromName($myInfo->name) !!}';
                let messageContent = '<div class="outgoing_msg">\n' +
                    '<div class="sent_msg">\n' +
                    '<p> <object data=http://localhost/mangxh/storage/app/assets/img/mess/' + message + '">\n' +
                    '<a href="http://localhost/mangxh/storage/app/assets/img/mess/' + message +
                    '"  target="blank" class="text-light text-light mt-3 text-decoration-none">\n' +
                    '<i class="fa fa-file text-light" aria-hidden="true"></i>&ensp;' + message + '</a>\n' +
                    '</object></p>\n' +
                    '	<span class="time_date" style="float: right" title="' + getCurrentDateTime() + '">' +
                    getCurrentTime() + ' | ' + getDateTime() +
                    '</span> </div>\n' +
                    '</div>';

                let newMessage = messageContent;
                $messageWrapper.append(newMessage);
            }

            function appendMessageToReceiver(message) {
                let firstname = message.sender_firstname;
                let name = message.sender_name;
                let avatar = message.sender_avatar;
                let image = 'noteimg.png';
                if (avatar !== '') {
                    image = avatar;
                }
                let messageContent = '<div class="incoming_msg mt-1">' +
                    '<div class="incoming_msg_img"><img src="http://localhost/mangxh/storage/app/assets/img/avatar/' +
                    image + '" class="avt_user"></div>\n' +
                    '<div class="received_msg">\n' +
                    '<div class="received_withd_msg">\n' +
                    '<p><b style="font-size:18px;">' + firstname + ' ' + name + '</b><br />' + message.content +
                    '</p>\n' +
                    '<span class="time_date" title="' + dateFormat(message.created_at) + '">' + timeFormat(message
                        .created_at) + ' | ' + getdate(message.created_at) + '</span> </div>\n' +
                    '</div>\n' +
                    '</div>\n';

                let newMessage = messageContent;
                $messageWrapper.append(newMessage);
                scrollSmoothToBottom('messageWrapper');

            }
            // socket.on("private-channel:App\\Events\\PrivateMessageEvent", function(message) {
            //     appendMessageToReceiver(message);
            // });
            let $addGroupModal = $("#addGroupModal");
            $(document).on('click', '.btn-add-group', function() {

                // $addGroupModal = $("#addGroupModal");
                $addGroupModal.modal();

            });
            $('#selectMember').select2();
            $('#selectMember2').select2();

            socket.on("groupMessage", function(message) {
                appendMessageToReceiver(message);
            });
        });
    </script>
@endpush
@section('content-js')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"
        integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>

    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
