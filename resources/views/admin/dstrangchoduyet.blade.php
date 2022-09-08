@extends('layouts.layoutadmin')
@section('right_content_title')
<title>Quản lý danh sách trang chờ duyệt</title>

@endsection
@section('right_content_css')
@endsection
@section('right_content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <table id="qluser">
                    <thead>
                        @if (session('tbaoprofile'))
                            <div class="alert alert-success">
                                {{ session('tbaoprofile') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <tr>
                            <th>STT</th>
                            <th>Mã</th>
                            <th>Phân loại</th>
                            <th>Tên</th>
                            <th>SDT</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Đường dẫn</th>
                            <th>Giới thiệu</th>
                            <th>Người quản lý</th>
                            <th>Ngày tham gia</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($listschool as $school)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ 'SC' . sprintf('%05d', $school->school_id) }}</td>
                                <td>{{ $school->school_category }}</td>
                                <td>{{ $school->school_name }}</td>
                                <td>{{ $school->school_phone }}</td>
                                <td>{{ $school->school_email }}</td>
                                <td>{{ $school->school_address }}</td>
                                <td>{{ $school->school_link }}</td>
                                <td>{!! $school->school_about !!}</td>
                                <td>{{ $school->firstname . ' ' . $school->name }}</td>
                                <td>{{ date('d/m/Y', strtotime($school->ngaythanhlap)) }}</td>
                                <td>
                                    <form action="{{ url('admin/duyettrang') }}" method="post"
                                        onsubmit="return confirm('Bạn có chắc duyệt trang này?')">
                                        @csrf
                                        <input type="hidden" name="school_id" value="{{ $school->school_id }}">
                                        <button class="btn float-left" type="submit"><i
                                                class="fa fa-check"></i>&ensp;Duyệt</button>
                                    </form>
                                    <form action="{{ url('admin/huyduyettrang') }}" method="post"
                                        onsubmit="return confirm('Bạn không chấp nhận duyệt trang?')">
                                        @csrf
                                        <input type="hidden" name="school_id" value="{{ $school->school_id }}">
                                        <button class="btn float-right" type="submit">Hủy</button>
                                    </form>


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
