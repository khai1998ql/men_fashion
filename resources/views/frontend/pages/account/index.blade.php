@extends('frontend.layouts.frontend_layout')
@section('frontend_title')

    <title>Đăng nhập</title>

@endsection
@section('frontend_css')
    <link rel="stylesheet" href="{{ asset('public/frontend/css/signin.css')}}">
@endsection

@section('frontend_content')

    <!-- CONTAINER -->

    <div class="container app_container">
        <div class="app_container_titile">Tài khoản</div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="app_container_group">
                    <div class="app_container_group_title">Thông tin tài khoản</div>
                    <div class="app_container_group_hr"></div>
                    <div class="app_container_group_list">
                        <div class="app_container_group_list_icon"><span class="ti-star"></span></div>
                        <div class="app_container_group_list_name">Điểm tích lũy của bạn:</div>
                    </div>
                    <div class="app_container_group_list">
                        <div class="app_container_group_list_icon"><i class="fas fa-users"></i></div>
                        <div class="app_container_group_list_name">Cấp độ khách hàng: <span class="app_container_group_mem_bold">MEMBERSHIP CARD</span></div>
                    </div>
                    <div class="app_container_group_list">
                        <div class="app_container_group_list_icon"><span class="ti-reload"></span></div>
                        <a href="" class="app_container_group_list_name">Thay đổi thông tin tài khoản:</a>
                    </div>
                    <div class="app_container_group_list">
                        <div class="app_container_group_list_icon"><span class="ti-lock"></span></div>
                        <a href="" class="app_container_group_list_name">Thay đổi mật khẩu</a>
                    </div>
                    <div class="app_container_group_list">
                        <div class="app_container_group_list_icon"><i class="fas fa-sign-out-alt"></i></div>
                        <a href="" class="app_container_group_list_name">Đăng xuất</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="app_container_group">
                    <div class="app_container_group_title">Sản phẩm yêu thích</div>
                    <div class="app_container_group_hr"></div>
                    <div class="app_container_group_list">
                        <div class="app_container_group_list_icon"><i class="fas fa-thumbs-up"></i></div>
                        <a href="./wishlist.html" class="app_container_group_list_name">Sản phẩm yêu thích</a>
                    </div>
                    <div class="app_container_group_list">
                        <div class="app_container_group_list_icon"><span class="ti-eye"></span></div>
                        <a href="./order.html" class="app_container_group_list_name">Lịch sử order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END CONTAINER -->

@endsection
