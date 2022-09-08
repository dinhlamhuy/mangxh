@extends('layouts.layoutadmin')
@section('right_content_title')
<title>Quản lý danh sách nhóm</title>

@endsection
@section('right_content_css')
@endsection
@section('right_content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <table id="dsnhom">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã</th>
                            <th>Tên nhóm</th>
                            <th>Người lập</th>
                            <th>Quyền</th>
                            {{-- <th>Giới tính</th>
                            <th>Ngày sinh</th>
                            <th>Nghề</th>
                            <th>Trường</th>
                            <th>Địa chỉ</th> --}}
                            <th>Ngày lập</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach($listgroup as $group)
                        <tr >
                            <td>{{ $i++ }}</td>
                            <td>{{ 'GR' . sprintf('%05d', $group->group_id) }}</td>
                            <td>{{ $group->group_name }}</td>
                            <td>{{ $group->firstname.' '.$group->name }}</td>
                            <td>@if($group->group_privacy =='1')
                                Công khai
                                @else
                                Riêng tư
                                @endif
                            </td>
                            <td>{{ date('d/m/Y',strtotime($group->ngaylap)) }}</td>
                            <td>
                                <button class="bt btn-danger xoanhom  " data-group="{{ $group->group_id }}"">
                                    {{-- <form action="" method="post"></form> --}}
                                    <i class="fa fa-trash"></i></button></td>
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
            $('#dsnhom').DataTable({
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
