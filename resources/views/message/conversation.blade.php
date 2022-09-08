@extends('layouts.layout')
@section('content-title')
    <title>{{ $friendInfo->firstname . ' ' . $friendInfo->name }} | Trò chuyện</title>
@endsection
@section('content-css')
    <link rel="stylesheet" href="{{ asset('public/css/chat.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.css"
        integrity="sha512-0Nyh7Nf4sn+T48aTb6VFkhJe0FzzcOlqqZMahy/rhZ8Ii5Q9ZXG/1CbunUuEbfgxqsQfWXjnErKZosDSHVKQhQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .msg_history {
            background: url("{{ asset('storage/app/assets/img/nen/nentrochuyen.jpg') }}");
            margin-left: 0px;
            
        }

    </style>
@endsection
@section('content')

    <div class="messaging container-fluid mt-1  px-0 mb-0 ">
        <div class="inbox_msg row">
            <div class="inbox_people col-md-3 mx-0 pr-0">
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
                            <?php $usr_avatar='noteimg.png';
                            if($usr->avatar){
                               $usr_avatar=$usr->avatar;
                                
                            }
                            ?>
                            <div class="chat_list 
		                    @if ($usr->user_id == $friendInfo->user_id) active_chat @endif">
                                <a href="{{ route('message.conversation', $usr->user_id) }}" class="text-decoration-none">
                                    <div class="chat_people">
                                        <img src="{{ asset('storage/app/assets/img/avatar/' . $usr_avatar) }}">
                                        <i class="fa fa-circle  status-user-icon user-icon-{{ $usr->user_id }}"
                                            aria-hidden="true" title="Offline"></i>
                                        <div class="chat_ib">
                                            <h5>{{ $usr->firstname . ' ' . $usr->name }}
                                                {{-- <span class="chat_date">Dec 25</span> --}}
                                            </h5>

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
                                                ?><span class="chat_date"></span></h5>
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
            <div class="col-md-9 px-0 ml-0 messs w-100 mr-0">
                <div class="header-msg bg-light w-100 border mb-0">
                    <a href="{{ url('/profile/'.$friendInfo->user_id) }}" class="text-decoration-none text-dark">

                    <div class="chat-img-user pt-1">
                        <?php if ($friendInfo->avatar) {?>

                        <img src="{{ asset('storage/app/assets/img/avatar/' . $friendInfo->avatar) }}"
                            class="avt_user">
                        <?php } else {?>
                        <img src="{{ asset('storage/app/assets/img/avatar/noteimg.png') }}" class="avt_user">
                        <?php } ?>

                        <i class="fa fa-circle  status-user-icon user-icon-{{ $friendInfo->user_id }}" aria-hidden="true"
                            id="userStatusHead{{ $friendInfo->user_id }}"></i>
                    </div>
                        <div class="chat-name-user font-weight-bold">
                            <h5>{{ $friendInfo->firstname . ' ' . $friendInfo->name }} </h5>
                        </div>

                    </a>
                </div>

                <div class="mesgs mt-0 w-100 pt-0 pl-0" id="app">
                    <div class="msg_history" id="messageWrapper">
                        @if ($mess->count())
                            <?php $rutgontn = ''; ?>
                            @foreach ($mess as $msg)
                                @if ($msg->sender_id == Auth::user()->user_id && $msg->receiver_id != Auth::user()->user_id)
                                    <div class="outgoing_msg">
                                        <div class="sent_msg w-auto">
                                            <div class="text-right">
                                                <p>  <?php if($msg->theloaifile=='2'){ ?>
                                                    <object
                                                        data={{ asset('storage/app/assets/img/mess/' . $msg->message) }}"
                                                        width="300" height="200">
                                                        <a href="{{ asset('storage/app/assets/img/mess/' . $msg->message) }}"
                                                            target="blank" class="text-light  mt-3 text-decoration-none">
                                                            <i class="fa fa-file text-light"
                                                                aria-hidden="true"></i>&ensp;{{ $msg->message }}</a>
                                                    </object>
                                                    <?php } else {
                                                        
                                                        ?>
                                                    {!! $msg->message !!}
                                                    <?php } ?></p>
                                                {{-- <img src="{{ asset('storage/app/assets/img/avatar/noteimg.png') }}" style="height: 200px; " alt=""> --}}

                                            </div>
                                            <span class="time_date" style="float: right; margin-right:15px;">
                                                {{ date('h:i A', strtotime($msg->ngaynhan)) }} |
                                                {{ date('d/m/Y', strtotime($msg->ngaynhan)) }}</span>
                                        </div>
                                    </div>
                                @endif

                                @if ($msg->sender_id != Auth::user()->user_id && $msg->receiver_id == Auth::user()->user_id)
                                    <div class="incoming_msg mt-1">
                                        @if ($rutgontn != $msg->sender_id)
                                            <div class="incoming_msg_img">
                                                <?php if ($friendInfo->avatar) {?>
                                                <img src="{{ asset('storage/app/assets/img/avatar/' . $friendInfo->avatar) }}"
                                                    class="avt_user">
                                                <?php } else {?>
                                                <img src="{{ asset('storage/app/assets/img/avatar/noteimg.png') }}"
                                                    class="avt_user">
                                                <?php } ?>
                                            </div>
                                            <div class="received_msg">
                                                <div class="received_withd_msg ">
                                                    <div class="text-left ">

                                                        <p style="color:black;"> 
                                                            <b class="w-auto"  style="font-size:18px; margin-top:0px;margin-bottom:10px;">{{ $friendInfo->firstname . ' ' . $friendInfo->name }}</b>
                                                            <br>
                                                            <?php if($msg->theloaifile=='2'){ ?>
                                                                <object
                                                                    data={{ asset('storage/app/assets/img/mess/' . $msg->message) }}"
                                                                    width="300" height="200">
                                                                    <a href="{{ asset('storage/app/assets/img/mess/' . $msg->message) }}"
                                                                        target="blank" class="text-primary  mt-3 text-decoration-none">
                                                                        <i class="fa fa-file text-light"
                                                                            aria-hidden="true"></i>&ensp;{{ $msg->message }}</a>
                                                                </object>
                                                                <?php } else {
                                                                    
                                                                    ?>
                                                                {!! $msg->message !!}
                                                                <?php } ?>
                                                        </p>
                                                    </div>
                                                    <span
                                                        class="time_date">{{ date('h:i A', strtotime($msg->ngaynhan)) }}
                                                        | {{ date('d/m/Y', strtotime($msg->ngaynhan)) }}</span>
                                                </div>
                                            </div>
                                        @else
                                            <span style="margin-left:60px;"></span>
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
                                                        <?php } ?></p>
                                                    <span
                                                        class="time_date">{{ date('h:i A', strtotime($msg->ngaynhan)) }}
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
                    <div class="type_msg">
                        <div class="input_msg_write">
                            <label for="file-upload" class="custom-file-upload">
                                <i class="fa fa-paperclip" aria-hidden="true" title="Upload File"></i>
                                <input id="file-upload" type="file" name="messfile" />

                                <input type="hidden" id="messtype" name="type" value="1">
                            </label>

                            <div class="chat-input bg-white write_msg "
                                style="max-height:85px; height: 30px; padding-top:10px; overflow: auto;" id="chatInput"
                                placeholder="Tin nhắn tới {{ $friendInfo->firstname . ' ' . $friendInfo->name }}"
                                maxlength="12"></div>
                            <span id="gioihansl" class="text-muted float-right" style="font-size:8px; ">0/1000</span>
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

<?php if ($friendInfo->avatar) {
    $avatar = $friendInfo->avatar;
} else {
    $avatar = 'noteimg.png';
} ?>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"
        integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
            let $chatInput = $(".emojionearea-editor");
            // let $chatInput=$(".chat-input");
            let $btn_send = $(".msg_send_btn");
            let $chatBody = $(".chat-body");
            let $messageWrapper = $("#messageWrapper");
            let user_id = "{{ Auth::user()->user_id }}";
            let ip_address = '127.0.0.1';
            let socket_port = '8005';
            let socket = io(ip_address + ':' + socket_port);
            let friendId = "{{ $friendInfo->user_id }}";
            $(".chat-input").emojioneArea({
                pickerPosition: "top",
                filtersPosition: "bottom",
                events: {
                    keypress: function(editor, event) {
                        $('#gioihansl').text($('.emojionearea-editor').text().length + '/1000');
                        if (event.which === 13 && !event.shiftKey) {
                            if ($('.emojionearea-editor').text().length > 1000) {
                                alert('Không được lớn hơn 1000 ký tự nha');
                                event.preventDefault();
                            } else {
                                event.preventDefault();
                                let message = $('.emojionearea-editor').html();
                                $('.emojionearea-editor').html('');
                                sendMessage(message);
                            }
                        }
                    }
                }
            });
            socket.on('connect', function() {
                socket.emit('User_connected', user_id)
            });
            socket.on('updateUserStatus', (data) => {
                let $userStatusIcon = $('.user-status-icon');
                $userStatusIcon.removeClass('text-success');
                $userStatusIcon.attr('title', 'Offline');
                $.each(data, function(key, val) {
                    if (val !== null && val !== 0) {
                        let $userIcon = $(".user-icon-" + key);
                        $userIcon.addClass('text-success');
                        $userIcon.attr('title', 'Online');
                    }
                });
            });
      
            $('#file-upload').on('change', function() {
                $('#messtype').val('2');
                sendMessage($("#file-upload")[0].files[0]);


            });

            function sendMessage(message) {
                let url = "{{ route('message.send-message') }}";
                let form = $(this);
                let formData = new FormData();
                let token = "{{ csrf_token() }}";
                // formData.append('message', message);
                formData.append('_token', token);
                formData.append('receiver_id', friendId);

                formData.append('messtype', $('#messtype').val());
                if ($('#messtype').val() == '1') {
                    formData.append('message', message);
                    appendMessageToSender(message);
                } else if ($('#messtype').val() == '2') {
                    formData.append('message', '1');
                    formData.append('messfile', message);
                }

                $.ajax({
                    url: "{{ route('message.send-message') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.success) {
                            // console.log(response.data);
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
                // let image='{!! makeImageFromName($myInfo->name) !!}';
                let messageContent = '<div class="outgoing_msg">\n' +
                    '<div class="sent_msg">\n' +
                    '<p>' + message + '</p>\n' +
                    '	<span class="time_date" title="' + getCurrentDateTime() + '">' + getCurrentTime() + ' | ' +
                    getDateTime() + '</span> </div>\n' +
                    '</div>';
                let newMessage = messageContent;
                $messageWrapper.append(newMessage);
            }

            function appendImgMessageToSender(message) {
                let name = '{{ $myInfo->name }}';
                // let image = '{!! makeImageFromName($myInfo->name) !!}';
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
                let name = '{{ $friendInfo->name }}';
                let firstname = '{{ $friendInfo->firstname }}';
                let image =
                    '<img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"  class="avt_user">';
                let messageContent = '<div class="incoming_msg mt-1">' +
                    '<div class="incoming_msg_img">' + image + '</div>\n' +
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
            socket.on("private-channel:App\\Events\\PrivateMessageEvent", function(message) {
                appendMessageToReceiver(message);
            });
        });
    </script>
@endpush
@section('content-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    {{-- <script src="{{ asset('./public/vendor/ckeditorchat/ckeditor.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            $('#selectMember').select2();
            $('.emojionearea-editor').each(function() {
                this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;');
            }).on('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        });
    </script>
@endsection
