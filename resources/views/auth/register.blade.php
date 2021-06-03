@extends('frontend.layouts.frontend_layout')
@section('frontend_title')

    <title>Đăng ký tài khoản</title>

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
                <div class="app_container_content_top">Đăng ký</div>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="app_container_content_list">
                        <div class="app_container_content_list_text">Họ và tên</div>
                        <input type="text" name="name" value="{{ old('name') }}" @error('name') is-invalid @enderror" class="app_container_content_list_input" placeholder="Nhập họ và tên của bạn" required autocomplete="name">
                    </div>
                    <div class="app_container_content_list">
                        <div class="app_container_content_list_text">Email</div>
                        <input type="email" name="email" @error('email') is-invalid @enderror" class="app_container_content_list_input" placeholder="Nhập email của bạn" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="app_container_content_list">
                        <div class="app_container_content_list_text">Số điện thoại</div>
                        <input type="text" name="phone" @error('phone') is-invalid @enderror" class="app_container_content_list_input" placeholder="Nhập số điện thoại của bạn" required autocomplete="phone">
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="app_container_content_list">
                        <div class="app_container_content_list_text">Mật khẩu</div>
                        <input type="password" name="password" @error('password') is-invalid @enderror" class="app_container_content_list_input" placeholder="Nhập mật khẩu" required autocomplete="off">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="app_container_content_list">
                        <div class="app_container_content_list_text">Xác nhận</div>
                        <input type="password" name="password_confirmation" @error('password_confirmation') is-invalid @enderror" class="app_container_content_list_input" placeholder="Nhập lại mật khẩu" required autocomplete="off">
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
{{--                    <div class="app_container_content_list">--}}
{{--                        <div class="app_container_content_list_text">Giới tính</div>--}}
{{--                        <input type="radio" class="app_container_content_list_radio" name="gioitinh" value="Nam" required><span class="app_container_content_list_radio_text">Nam</span>--}}
{{--                        <input type="radio" class="app_container_content_list_radio" name="gioitinh" value="Nữ" required><span class="app_container_content_list_radio_text">Nữ</span>--}}
{{--                    </div>--}}
                    <button type="submit" class="app_container_content_submit">Đăng ký</button>
                    <div class="app_container_content_bottom">Đã có tài khoản? Nhấn vào <a href="{{ route('login') }}" class="app_container_content_bottom_link">đây</a> để đăng nhập!</div>
                </form>
            </div>
        </div>

    </div>

    <!-- END CONTAINER -->


@endsection
