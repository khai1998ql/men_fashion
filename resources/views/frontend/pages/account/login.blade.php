@extends('frontend.layouts.frontend_layout')
@section('frontend_title')

    <title>Đăng nhập</title>

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
                <div class="app_container_content_top">Đăng nhập</div>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="app_container_content_list">
                        <div class="app_container_content_list_text">Email</div>
                        <input type="email" name="email" id="email" {{ old('email') }} class="app_container_content_list_input" placeholder="Nhập email của bạn">
                    </div>
                    <div class="app_container_content_list">
                        <div class="app_container_content_list_text">Mật khẩu</div>
                        <input type="password" name="password" id="password" class="app_container_content_list_input" placeholder="Nhập mật khẩu">
                    </div>
                    <button type="submit" class="app_container_content_submit">Đăng ký</button>
                    <div class="app_container_content_bottom">Chưa có tài khoản? Nhấn vào <a href="./signin.html" class="app_container_content_bottom_link">đây</a> để đăng ký!</div>
                </form>
            </div>
        </div>

    </div>

    <!-- END CONTAINER -->


@endsection
