@extends('frontend.layouts.frontend_layout')
@section('frontend_title')

    <title>Giỏ hàng</title>

@endsection
@section('frontend_css')
    <link rel="stylesheet" href="{{ asset('public/frontend/css/confirm.css')}}">
@endsection
@section('frontend_js')
    <script src="{{ asset('public/frontend/js/checkout.js')}}"></script>

@endsection

@section('frontend_content')

    <!-- CONTAINER -->

    <div class="container_fluid app_container">
        <div class="app_container_top">
            <ul class="app_container_top_ul">
                <li class="app_container_top_list"><span class="app_container_top_link">Giỏ hàng</span></li>
                <li class="app_container_top_list_icon"><span class="ti-angle-right"></span></li>
                <li class="app_container_top_list"><span class="app_container_top_link">Giao hàng & thanh toán</span></li>
                <li class="app_container_top_list_icon"><span class="ti-angle-right"></span></li>
                <li class="app_container_top_list app_container_top_list_active"><a href="" class="app_container_top_link">Xác nhận</a></li>
            </ul>
        </div>
        <div class="container">
            <div class="app_container_content">
                <div class="app_container_content_icon">
                    <span class="ti-check app_container_content_icon_check"></span>
                    <!-- <i class="fas fa-check app_container_content_icon_check"></i> -->
                </div>
                <div class="app_container_content_h5">Đơn hàng được khởi tạo thành công</div>
                <div class="app_container_content_p">Đơn hàng đang trong quá trình thầm định, chúng tôi sẽ gửi thông tin đơn hàng vào email của bạn. Vui lòng kiếm tra email hoặc ấn vào đường dẫn bên dưới để kiểm tra đơn hàng.</div>
                <a href="" class="app_container_content_link">Kiểm tra đơn hàng</a>
            </div>
        </div>

    </div>

    <!-- END CONTAINER -->

@endsection
