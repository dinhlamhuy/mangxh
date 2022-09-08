@extends('layouts.layoutadmin')
@section('right_content_title')
<title>Quản lý danh sách trang vi phạm</title>

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
                <table id="qlusr" class="text-dark">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã người tố cáo</th>
                            <th>Người tố cáo</th>
                            <th>Tiêu đề</th>
                            <th>Nội dung</th>
                            <th>Mã người dùng</th>
                            <th>Ngày tố cáo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($list as $usr)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ 'USR' . sprintf('%05d', $usr->user_tocao) }}</td>
                                <td style="height: 70px; overflow: auto;">{{ $usr->firstname.' '.$usr->name }}</td>
                                <td>{{ $usr->bcvp_tieude }}</td>
                                <td>{{ $usr->bcvp_noidung }}</td>
                                <td>{{ 'SC' . sprintf('%05d', $usr->school_id) }}</td>
                       

                                <td>{{ date('H:i d/m/Y', strtotime($usr->ngaytocao)) }}</td>
                                <td>
                                    <a href="{{ url('/fanpage/'.$usr->school_id) }}" class="btn btn-light"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    {{-- <i class="fa fa-trash"></i> --}}
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
            $('#qlusr').DataTable({
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
