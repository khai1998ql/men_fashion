{{--@extends('frontend.layouts.frontend_layout')--}}
{{--@section('frontend_title')--}}

{{--    <title>Đăng nhập</title>--}}

{{--@endsection--}}
{{--@section('frontend_css')--}}
{{--    <link rel="stylesheet" href="{{ asset('public/frontend/css/signin.css')}}">--}}
{{--@endsection--}}

{{--@section('frontend_content')--}}
{{--<div class="container" style="margin-top: 70px; margin-bottom: 40px; font-size: 1.8rem">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Reset Password') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    <form method="POST" action="{{ route('password.email') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Send Password Reset Link') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}


@extends('frontend.layouts.frontend_layout')
@section('frontend_title')

    <title>Quên mật khẩu</title>

@endsection
@section('frontend_css')
    <link rel="stylesheet" href="{{ asset('public/frontend/css/signin.css')}}">
@endsection

@section('frontend_content')

    <!-- CONTAINER -->

    <div class="container_fluid">
        <div class="app_container">
            <!-- <div class="app_container_title">Chào mừng bạn đến với Ecommerce</div> -->
            <div class="app_container_content">
                <div class="app_container_content_top">Quên mật khẩu</div>
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf

                    @if (session('status'))
                        <p style="color: red; font-size: 1.8rem; font-weight: 700;">
                            {{ session('status') }}
                        </p>
                    @endif
                    <div class="app_container_content_list">
                        <div class="app_container_content_list_text">Email</div>
                        <input type="email" name="email" id="email" @error('email') is-invalid @enderror value="{{ old('email') }}" class="app_container_content_list_input" placeholder="Nhập email của bạn" autocomplete="off">
                        @error('email')
                            <p class="" style="color: red;font-size: 1.4rem; margin-top: 5px;">
                                <strong>{{ $message }}</strong>
                            </p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-info">Lấy lại mật khẩu</button>
                </form>
            </div>
        </div>

    </div>

    <!-- END CONTAINER -->


@endsection
