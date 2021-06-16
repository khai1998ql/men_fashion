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
        <div class="app_container_titile">Thông tin tài khoản</div>
        <div class="app_container_navbar">
            <a href="{{ route('fe.profile.info') }}" class="app_container_navbar_list app_container_navbar_active">Thông tin cá nhân</a>
            <a href="{{ route('fe.profile.password') }}" class="app_container_navbar_list">Thay đổi mật khẩu</a>
            <a href="{{ route('fe.profile.order') }}" class="app_container_navbar_list">Đơn hàng</a>
            <a href="{{ route('fe.profile.wishlist') }}" class="app_container_navbar_list">Sản phẩm yêu thích</a>
        </div>
        <form action="{{ route('fe.profile.info.update') }}" method="POST">
            @csrf
            <div class="app_container_content">
                <div class="app_container_content_list">
                    <div class="app_container_content_list_text">Email</div>
                    <input type="text" name="email" value="{{ $info->email }}" readonly class="app_container_content_list_input input_readonly">
{{--                    <p style="color: red; text-align: left;font-size: 1.2rem;">Ngày sinh không hợp lệ!</p>--}}
                </div>
                <div class="app_container_content_list">
                    <div class="app_container_content_list_text">Họ và tên <span style="color: red;">*</span></div>
                    <input type="text" name="name" value="{{ $info->name ?? old('name') }}"  class="app_container_content_list_input" required>
                    @error('name')
                        <p style="color: red; text-align: left;font-size: 1.2rem;">{{ $message }}</p>
                    @enderror
                </div>
                <div class="app_container_content_list">
                    <div class="app_container_content_list_text">Số điện thoại <span style="color: red;">*</span</div>
                    <input type="text" name="phone" value="{{ $info->phone ?? old('phone') }}"  class="app_container_content_list_input" required>
                    @error('phone')
                    <p style="color: red; text-align: left;font-size: 1.2rem;">{{ $message }}</p>
                    @enderror
                </div>
                <div class="app_container_content_list app_container_list_flex">
                    <div class="app_container_content_list_past">
                        <div class="app_container_content_list_text">Ngày sinh <span style="color: red;">*</span></div>
                        <input type="date" name="birth" value="{{ $info->birth ?? old('birth') }}"  class="app_container_content_list_input" required>
                        @error('birth')
                        <p style="color: red; text-align: left;font-size: 1.2rem;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="app_container_content_list_past">
                        <div class="app_container_content_list_text">Giới tính <span style="color: red;">*</span></div>
                        <div class="app_container_list_flex">
                            <div class="app_container_content_list_past_list">
                                <input type="radio" name="gender" class="app_container_content_list_past_input" value="0" required><span class="app_container_content_list_past_text">Nữ</span>

                            </div>
                            <div class="app_container_content_list_past_list">
                                <input type="radio" name="gender" class="app_container_content_list_past_input" value="1" required><span class="app_container_content_list_past_text">Nam</span>

                            </div>
                        </div>
                        @error('gender')
                        <p style="color: red; text-align: left;font-size: 1.2rem;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <input type="submit" value="Submit" class="btn btn-dark app_container_content_submit">
            </div>
        </form>
    </div>

    <!-- END CONTAINER -->

@endsection
