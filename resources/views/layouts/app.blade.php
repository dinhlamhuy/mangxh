<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('/storage/app/assets/img/nen/logo1.png') }}" type="image/png">

    <title>Halo - Mạng xã hội</title>
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->


    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('public/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendor/font-awesome-4/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendor/grid_img/images-grid.css') }}">

    <style>
        .logo {
            background: linear-gradient(315deg, #f5d020 0%, #f53803 74%);
            /* background: linear-gradient(315deg, #f0cd1f 0%, #f53803 74%); */
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-style: italic;
        }

        .dropdown-toggle::after {
            display: none;
        }

        body {
            min-width: 700px !important;
        }

        .dropup:hover>.dropdown-menu {
            */ display: block;
        }

        .dropup>.dropdown-toggle:active {

            pointer-events: none;
        }

        .hovericon:hover {
            margin-top: -20px;
        }

    </style>
    @yield('custom_css')
</head>


<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Halo') }} --}}<img src="{{ asset('storage/app/assets/img/nen/logo1.png') }}"
                        style="height: 30px; margin-right:-5px; margin-top:-10px;" alt=""> <b
                        class="logo"><i>Halo</i></b>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                    <?php
                                    
                                    if (Auth::user()->avatar) {
                                        $avatar = Auth::user()->avatar;
                                    } else {
                                        $avatar = 'noteimg.png';
                                    }
                                    ?>

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"
                                        class="m-0" style=" height: 40px; width: 40px; border-radius: 50%;"
                                        alt="">&ensp;{{ Auth::user()->firtsname . ' ' . Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="nav-link btn btn-light p-0 font-weight-bold" style="  font-size: 15px;  "
                                        href="{{ url('/profile/' . Auth::user()->user_id) }}">
                                        <img src="{{ asset('storage/app/assets/img/avatar/' . $avatar) }}"
                                            class="m-0" style=" height: 40px; width: 40px; border-radius: 50%;"
                                            alt="">
                                        <span
                                            class="mx-2">{{ Auth::user()->firtsname . ' ' . Auth::user()->name }}</span>
                                    </a>
                                    <a class="dropdown-item btn btn-light pl-4" href="{{ url('/changePassword') }}">
                                        Đổi mật khẩu
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>


    <script src="{{ asset('public/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/vendor/popper/popper.min.js') }}"></script>
    <script src="{{ asset('public/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/vendor/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('public/vendor/grid_img/images-grid.js') }}"></script>


    <script>
        $('.dropdownhover').hover(function() {
            $('.dropdown-toggle', this).trigger('click');
        });
        $('.dropuphover').hover(function() {
            $('.dropdown-toggle', this).trigger('click');
        });
    </script>
</body>

</html>
