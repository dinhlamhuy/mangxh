@extends('layouts.layoutadmin')
@section('right_content_title')
<title>Quản lý danh sách người dùng (sinh viên)</title>

@endsection
@section('right_content_css')
<style>
    #qluser{
        color:black;
    }
</style>
@endsection
@section('right_content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <table id="qluser" class="text-dark">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã</th>
                            <th>Họ</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Giới tính</th>
                            <th>Ngày sinh</th>
                            <th>Nghề</th>
                            <th>Trường</th>
                            <th>Địa chỉ</th>
                            <th>Ngày tham gia</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach($listusr as $usr)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ 'USR' . sprintf('%05d', $usr->user_id) }}</td>
                            <td>{{ $usr->firstname }}</td>
                            <td>{{ $usr->name }}</td>
                            <td>{{ $usr->email }}</td>
                            <td>{{ $usr->sex }}</td>
                            <td>{{ date('d/m/Y',strtotime($usr->birthday)) }}</td>
                            <td>{{ $usr->job }}</td>
                            <td>{{ $usr->school_name }}</td>
                            <td>{{ $usr->address }}</td>
                            <td>{{ date('d/m/Y',strtotime($usr->ngaythamgia)) }}</td>
                            <td><i class="fa fa-trash"></i></td>
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
            $('#qluser').DataTable({
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
