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
                    <div class="app_container_content_list">
                        <div class="app_container_content_list_text">Họ và tên</div>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="app_container_content_list_input" placeholder="Nhập họ và tên của bạn" required autocomplete="off">
                    </div>
                    <div class="app_container_content_list">
                        <div class="app_container_content_list_text">Email</div>
                        <input type="email" name="email" id="email" class="app_container_content_list_input" placeholder="Nhập email của bạn" required autocomplete="off">
                    </div>
                    <div class="app_container_content_list">
                        <div class="app_container_content_list_text">Số điện thoại</div>
                        <input type="text" name="phone" id="phone" class="app_container_content_list_input" placeholder="Nhập số điện thoại của bạn" required autocomplete="off">
                    </div>
                    <div class="app_container_content_list">
                        <div class="app_container_content_list_text">Mật khẩu</div>
                        <input type="password" name="password" id="password" class="app_container_content_list_input" placeholder="Nhập mật khẩu" required autocomplete="off">
                    </div>
                    <div class="app_container_content_list">
                        <div class="app_container_content_list_text">Xác nhận</div>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="app_container_content_list_input" placeholder="Nhập lại mật khẩu" required autocomplete="off">
                    </div>
{{--                    <div class="app_container_content_list">--}}
{{--                        <div class="app_container_content_list_text">Giới tính</div>--}}
{{--                        <input type="radio" class="app_container_content_list_radio" name="gioitinh" value="Nam" required><span class="app_container_content_list_radio_text">Nam</span>--}}
{{--                        <input type="radio" class="app_container_content_list_radio" name="gioitinh" value="Nữ" required><span class="app_container_content_list_radio_text">Nữ</span>--}}
{{--                    </div>--}}
                    <button type="submit" class="app_container_content_submit">Đăng ký</button>
                    <div class="app_container_content_bottom">Đã có tài khoản? Nhấn vào <a href="./login.html" class="app_container_content_bottom_link">đây</a> để đăng nhập!</div>
                </form>
            </div>
        </div>

    </div>

    <!-- END CONTAINER -->


@endsection
