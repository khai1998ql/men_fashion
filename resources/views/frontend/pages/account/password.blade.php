@extends('frontend.layouts.frontend_layout')
@section('frontend_title')

    <title>Thông tin tài khoản</title>

@endsection
@section('frontend_css')
    <link rel="stylesheet" href="{{ asset('public/frontend/css/info.css')}}">
@endsection

@section('frontend_content')

    <!-- CONTAINER -->

    <div class="container app_container">
        <div class="app_container_titile">Thay đổi mật khẩu</div>
        <div class="app_container_navbar">
            <a href="{{ route('fe.profile.info') }}" class="app_container_navbar_list">Thông tin cá nhân</a>
            <a href="{{ route('fe.profile.password') }}" class="app_container_navbar_list app_container_navbar_active">Thay đổi mật khẩu</a>
            <a href="{{ route('fe.profile.order') }}" class="app_container_navbar_list">Đơn hàng</a>
            <a href="{{ route('fe.profile.wishlist') }}" class="app_container_navbar_list">Sản phẩm yêu thích</a>
        </div>
        <form action="{{ route('fe.profile.password.update') }}" method="POST">
            @csrf
            <div class="app_container_content">
                <div class="app_container_content_list">
                    <div class="app_container_content_list_text">Mật khẩu hiện tại</div>
                    <input type="password" name="password_old" value=""  class="app_container_content_list_input" required>
                </div>
                <div class="app_container_content_list">
                    <div class="app_container_content_list_text">Mật khẩu mới <span style="color: red;">*</span></div>
                    <input type="password" name="password" value=""  class="app_container_content_list_input" required>
                    @error('password')
                    <p style="color: red; text-align: left;font-size: 1.2rem;">{{ $message }}</p>
                    @enderror
                </div>
                <div class="app_container_content_list">
                    <div class="app_container_content_list_text">Nhập lại mật khẩu mới <span style="color: red;">*</span></div>
                    <input type="password" name="password_confirmation" value=""  class="app_container_content_list_input" required>
                    @error('password_confirmation')
                    <p style="color: red; text-align: left;font-size: 1.2rem;">{{ $message }}</p>
                    @enderror
                </div>
                <input type="submit" value="Submit" class="btn btn-dark app_container_content_submit">
            </div>
        </form>
    </div>

    <!-- END CONTAINER -->

@endsection
