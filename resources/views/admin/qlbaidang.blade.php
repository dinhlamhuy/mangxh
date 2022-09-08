@extends('layouts.layoutadmin')
@section('right_content_title')
<title>Quản lý danh sách bài đăng</title>

@endsection
@section('right_content_css')
    <style>
        #qlbaidang {
            color: black;
        }
        .emojioneemoji{
            height:20px !important; 
        }

    </style>
@endsection
@section('right_content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                function truncateString($str, $maxChars, $holder = '...')
                {
                    if (strlen($str) > $maxChars) {
                        return trim(substr($str, 0, $maxChars)) . $holder;
                    } else {
                        return $str;
                    }
                }
                ?>
                <table id="qlbaidang" class="text-dark">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã bài đăng</th>
                            <th>Nội dung</th>
                            <th>Người đăng</th>
                            <th>Loại bài đăng</th>
                            <th>Công khai</th>
                            {{-- <th>Ngày sinh</th>
                            <th>Nghề</th>
                            <th>Trường</th>
                            <th>Địa chỉ</th> --}}
                            <th>Ngày đăng</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($listpost as $post)
                            <tr>
                                <td style="width: 5%;">{{ $i++ }}</td>
                                <td style="width: 10%;">{{ 'BD' . sprintf('%05d', $post->post_id) }}</td>
                                <td style="width: 35%;">{!! $post->caption !!}</td>
                                <td style="width: 15%;" style="height: 70px; overflow: auto;">{{ $post->firstname.' '.$post->name }}</td>
                                <td style="width: 6%;">
                                    @if($post->type_post=='1')
                                    Cá nhân
                                    @elseif($post->type_post=='2')
                                    Nhóm
                                    @elseif($post->type_post=='3')
Trang 
                                    @endif </td>
                                <td style="width: 10%;" >{{ $post->status }}</td>

                                <td style="width: 10%;">{{ date('H:i d/m/Y', strtotime($post->ngaydang)) }}</td>
                                <td style="width: 9%;">
                                    <a href="{{ url('/posts/'.$post->post_id) }}" class="btn btn-info float-left"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    
                                    <button class="btn btn-danger xoabaidang float-left " data-post="{{ $post->post_id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
@section('right_content_js')
    <script>
        $(document).ready(function() {
            $('#qlbaidang').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "language": {
                    "url": "http://cdn.datatables.net/plug-ins/1.11.5/i18n/vi.json"
                }
            });
        });
    </script>
@endsection
