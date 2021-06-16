@extends('frontend.layouts.frontend_layout')
@section('frontend_title')

    <title>Thông tin tài khoản</title>

@endsection
@section('frontend_css')
    <link rel="stylesheet" href="{{ asset('public/frontend/css/wishlist.css')}}">
@endsection

@section('frontend_content')

    <!-- CONTAINER -->

    <div class="container app_container">
        <div class="app_container_titile">Sản phẩm yêu thích</div>
        <div class="app_container_navbar">
            <a href="{{ route('fe.profile.info') }}" class="app_container_navbar_list">Thông tin cá nhân</a>
            <a href="{{ route('fe.profile.password') }}" class="app_container_navbar_list">Thay đổi mật khẩu</a>
            <a href="{{ route('fe.profile.order') }}" class="app_container_navbar_list">Đơn hàng</a>
            <a href="{{ route('fe.profile.wishlist') }}" class="app_container_navbar_list app_container_navbar_active">Sản phẩm yêu thích</a>
        </div>
        <div class="app_container_title">
            <div class="app_container_title_text">Sản phẩm (<span>0</span>)</div>
        </div>
        <div class="app_container_content">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Ngày</th>
                    <th scope="col">Hành động</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><a href="" class="app_container_content_product_image app_container_content_product_link"></a></td>
                    <td><a href="" class="app_container_content_product_link"></a></td>
                    <td>123.123 đ</td>
                    <td>12-12-2021</td>
                    <td>
                        <a href="" class="btn btn-success">Mua ngay</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- END CONTAINER -->

@endsection
