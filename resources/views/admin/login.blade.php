<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập Admin</title>
    <link rel="shortcut icon" href="{{ asset('/storage/app/assets/img/nen/logo1.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('public/vendor/bootstrap/css/bootstrap.min.css') }}">
    <style>
        .bg {
            background: url('{{ asset('storage/app/assets/img/nen/admin-login.jpg') }}');
            height: 100vh;
            background-position: center;
            /* background-repeat: no-repeat; */
            background-size: cover;
        }
        .title {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 50px;
            /* color: white; */
            text-shadow: 1px 1px 2px rgb(187, 71, 88);
        }
        .logo {
            width: 80px;
            height: 80px;
            border-radius: 50px;
            background: rgba(1, 1, 56, 0.377);
            padding: 0px;
            pointer-events: none;
            cursor: default;
        }
    </style>
</head>

<body>


    <div class="container-fluid bg">
        <div class="row ">
            <div class="col-md-4 mx-auto ">
                <div style="margin-top: 20vh;">
                    {{-- <div class="card-body"> --}}
                    <center>
                        <h3 class="title">Đăng nhập ADMIN</h3>
                        <img src="{{ asset('storage/app/assets/img/icon/iconadmin.png') }}" class="logo">
                    </center>

                    <form action="{{ url('admin/dangnhapadmin') }}" method="post">
                        @csrf
                        <label for="" class="font-weight-bold mt-3">Tên Tài Khoản</label>
                        <input type="text" class="form-control" name="ad_acc">
                        <label for="" class="font-weight-bold mt-3">Mật Khẩu</label>
                        <input type="password" class="form-control" name="ad_pass">
                        <center>
                            <button type="submit" class="btn btn-success mt-3 ">Đăng nhập</button>
                        </center>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('public/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

</body>

</html>
