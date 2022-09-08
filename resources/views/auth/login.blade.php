@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
<div class="div mt-5 text-center">
<br>
    <h1 style="font-size:70px; vertical-align: middle">
        <b><img src="{{ asset('storage/app/assets/img/nen/logo1.png') }}" style="height: 100px; margin-right:-5px; margin-top:-10px;" alt=""><span class="logo">Halo</span></b></h1>

    <br>
    <h5 style="color: blue;">Học hỏi kiến thức, nâng cao tinh thần.</h5>
    <h5 style="color: blue;">Cùng nhau, chúng ta đạt được những điều tuyệt vời.</h5>
</div>
        </div>
        <div class="col-md-6">
            <div class="card">
                

                <div class="card-body">
                    <h2 class="text-center">Đăng nhập</h2><br>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                            <label for="email" class="col-form-label ">{{ __('Email') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                            <label for="password" class="col-form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label" for="remember">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        {{ __('Ghi nhớ đăng nhập') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Đăng nhập') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Quên mật khẩu?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    <hr>
                    <center>
                        <a href="{{url('/register')}}" class="btn btn-success">Bạn chưa có tài khoản?</a>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
