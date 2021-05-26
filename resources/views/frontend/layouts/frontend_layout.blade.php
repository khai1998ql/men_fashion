@php

    $category = DB::table('categories')->where('menu_id', 2)->get();
@endphp



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce</title>
    <link rel="icon" href="{{ asset('public/frontend/images/logo_icon.png')}}">
    <!-- Dùn lấy icon -->
    <link rel="stylesheet" href="{{ asset('public/frontend/font/fontawesome-free-5.15.1-web/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/frontend/font/fontawesome-free-5.15.1-web/css/fontawesome.min.css')}}">
    <!-- Dùn lấy icon -->
    <link rel="stylesheet" href="{{ asset('public/frontend/themify-icons/themify-icons.css')}}">

    <!-- css trang -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/main.css')}}">
    @yield('frontend_css')

    <link rel="stylesheet" href="{{ asset('public/frontend/css/reponsive_main.css')}}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <!-- Font ngoài -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/> -->
</head>
<body>
<div class="app">
    <header class="header">
        <div class="container-fluid header_topbar">
            <ul class="header_topbar_list header_topbar_list_left">
                <li class="header_topbar_item">
                    <!-- <i class="fa fa-phone header_topbar-icon" aria-hidden="true"></i> -->
                    <i class="fas fa-phone-alt header_topbar-icon"></i>
                    <span class="header_topbar_item_phone">
                            0355123450
                        </span>
                </li>
            </ul>
            <ul class="header_topbar_list header_topbar_list_right">
                <li class="header_topbar_item"  title="Tìm kiếm">
                    <!-- <i class="fa fa-search header_topbar-icon" aria-hidden="true"></i> -->
                    <label for="input_checkbox_search">
                        <span class="ti-search header_topbar-icon"></span>
                    </label>

                </li>
                <li class="header_topbar_item header_topbar_item_cart" title="Giỏ hàng">
                    <label for="input_checkbox__cart"  onclick="modalCheckboxCart()">
                        <i class="fa fa-shopping-cart header_topbar-icon " aria-hidden="true"></i>
                        <span class="header_topbar_item_cart_number">3</span>
                    </label>
                </li>
                <!-- Nếu chưa đăng nhập -->
                <!-- <li class="header_topbar_item" title="Đăng nhập/Đăng xuất">
                    <a href="">
                        <i class="fa fa-user header_topbar-icon" aria-hidden="true"></i>
                    </a>
                </li> -->
                <!-- Nếu đã đăng nhập -->
                <li class="header_topbar_item header_topbar_account">
                    <div class="header_topbar_user">
                        <img src="{{ asset('public/frontend/images/avatar.jpg')}}" alt="" class="header_topbar_item_avatar">
                    </div>
                    <!-- <a href="" class="header_topbar_user">
                        <img src="./public/images/avatar.jpg" alt="" class="header_topbar_item_avatar">
                    </a> -->
                    <div class="header_topbar_user_menu">
                        <ul class="header_topbar_user_list">
                            <li class="header_topbar_user_item">
                                <span style="color: #26a998;">Xin chào: </span><span style="color: red;">Khải</span>
                            </li>
                            <li class="header_topbar_user_item">
                                <a href="">Thông tin tài khoản</a>
                            </li>
                            <li class="header_topbar_user_item">
                                <a href="">Đơn mua</a>
                            </li>
                            <li class="header_topbar_user_item">
                                <a href="">Đăng xuất</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="header_topbar_item header_topbar_bars"  title="Danh mục">
                    <label for="app_modal_category_input">
                        <i class="fas fa-bars header_topbar-icon"></i>
                    </label>

                </li>
            </ul>
        </div>
        <!-- <div class="container-fluid header_navbar app_header_navbar" id="header_navbar"> -->
        <div class="container-fluid header_navbar" id="header_navbar">

            <ul class="header_navbar_list">
                <li class="header_navbar_item">
                    <a href="./index.html" class="header_navbar_item_kw">Trang chủ</a>
                </li>
                <li class="header_navbar_item header_navbar_item_product">
                    <span class="header_navbar_item_kw">Sản phẩm</span>
                    <!-- Hover Sản Phẩm -->
                    <div class="header_navbar_item_product_modal" id="item_product">
                        <div class="header_navbar_item_product_list">
                            @foreach($category as $item)
                                <ul class="header_navbar_item_product_list_ul">
                                    <li class="header_navbar_item_product_list_ul_key"><a href="{{ URL::to(to_slug($item->category_name)) }}">{{ $item->category_name }}</a></li>
                                    @php
                                        $subcategory = DB::table('subcategories')->where('category_id', $item->id)->get();
                                    @endphp
                                    @foreach($subcategory as $itemSub)
                                        <li><a href="{{ URL::to(to_slug($item->category_name).'/'.to_slug($itemSub->subcategory_name)) }}">{{ $itemSub->subcategory_name }}</a></li>
                                    @endforeach
                                </ul>
                            @endforeach
                        </div>

                    </div>
                </li>
                <li class="header_navbar_item">
                    <span class="header_navbar_item_kw">Bộ sưu tập</span>
                </li>
                <li class="header_navbar_item header_navbar_item_logo">
                    <a href="./index.html"><img src="{{ asset('public/frontend/images/logo-typo.png')}}" alt=""></a>
                </li>
                <li class="header_navbar_item">
                    <a href="" class="header_navbar_item_kw"><span>Tin tức</span></a>
                </li>
                <li class="header_navbar_item">
                    <span class="header_navbar_item_kw">Đồng phục</span>
                </li>
                <li class="header_navbar_item">
                    <a href="" class="header_navbar_item_kw"><span>Liên hệ</span></a>
                </li>
            </ul>
        </div>
        @yield('frontend_slide');
    </header>
    <!-- END HEADER -->

    <!-- CONTAINER -->

    @yield('frontend_content')

    <!-- END CONTAINER -->

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer_hr"></div>
        <div class=" app_footer">
            <div class="container app_footer_sectionInfo">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                        <div class="app_footer_sectionInfo_top">
                            Gọi mua hàng (8:30-21:30)
                        </div>
                        <div class="app_footer_sectionInfo_between">
                            <div class="app_footer_sectionInfo_icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="app_footer_sectionInfo_number">
                                0355123450
                            </div>
                        </div>
                        <div class="app_footer_sectionInfo_bot">
                            Tất cả các ngày trong tuần
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                        <div class="app_footer_sectionInfo_top">
                            Góp ý, Khiếu nại (8:30-21:30)
                        </div>
                        <div class="app_footer_sectionInfo_between">
                            <div class="app_footer_sectionInfo_icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="app_footer_sectionInfo_number">
                                0355123450
                            </div>
                        </div>
                        <div class="app_footer_sectionInfo_bot">
                            Các ngày trong tuần ( trừ ngày lễ)
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                        <div class="app_footer_sectionInfo_top">
                            Đăng ký nhận thông tin mới
                        </div>
                        <form action="">
                            <div class="app_footer_sectionInfo_mail">
                                <input type="email" class="app_footer_sectionInfo_input" placeholder="Nhập email của bạn tại đây" >
                                <button class="app_footer_sectionInfo_button">Đăng ký</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                        <div class="app_footer_sectionInfo_top">
                            Theo dõi chúng tôi
                        </div>
                        <div class="app_footer_sectionInfo_between">
                            <a href="./product.html" class="app_footer_sectionInfo_face"><i class="fab fa-facebook-f"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app_footer_contactInfo">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                            <div class="app_footer_contactInfo_title">Học viện Công nghệ Bưu chính Viễn thông</div>
                            <div class="app_footer_contactInfo_list">
                                <ul class="app_footer_contactInfo_list_ul">
                                    <li class="app_footer_contactInfo_list_li">Khoa: CNTT</li>
                                    <li class="app_footer_contactInfo_list_li">Lớp: HTTT2</li>
                                    <li class="app_footer_contactInfo_list_li">Khóa: D16CN3</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                            <div class="app_footer_contactInfo_title">Về chúng tôi</div>
                            <div class="app_footer_contactInfo_list">
                                <ul class="app_footer_contactInfo_list_ul">
                                    <li class="app_footer_contactInfo_list_li"><a href="" class="app_footer_contactInfo_list_link">Giới thiệu</a></li>
                                    <li class="app_footer_contactInfo_list_li"><a href="" class="app_footer_contactInfo_list_link">Liên hệ</a></li>
                                    <li class="app_footer_contactInfo_list_li"><a href="" class="app_footer_contactInfo_list_link">Tìm đại lý</a></li>
                                    <li class="app_footer_contactInfo_list_li"><a href="" class="app_footer_contactInfo_list_link">Tuyển dụng</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                            <div class="app_footer_contactInfo_title">Hộ trợ khách hàng</div>
                            <div class="app_footer_contactInfo_list">
                                <ul class="app_footer_contactInfo_list_ul">
                                    <li class="app_footer_contactInfo_list_li"><a href="" class="app_footer_contactInfo_list_link">Hướng dẫn chọn size</a></li>
                                    <li class="app_footer_contactInfo_list_li"><a href="" class="app_footer_contactInfo_list_link">Chính sách khách hàng thân thiết</a></li>
                                    <li class="app_footer_contactInfo_list_li"><a href="" class="app_footer_contactInfo_list_link">Chính sách đổi/Trả</a></li>
                                    <li class="app_footer_contactInfo_list_li"><a href="" class="app_footer_contactInfo_list_link">Chính sách bảo mật</a></li>
                                    <li class="app_footer_contactInfo_list_li"><a href="" class="app_footer_contactInfo_list_link">Thanh toán Giao nhận</a></li>
                                    <li class="app_footer_contactInfo_list_li"><a href="" class="app_footer_contactInfo_list_link">Câu hỏi thường gặp</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                            <div class="app_footer_contactInfo_title">Fanpage chúng tôi</div>
                            <div class="app_footer_contactInfo_list">
                                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FB%25C3%25A1o-m%25C6%25A1i-109474123773837&tabs=timeline&width=320&height=200&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=3013235002026545" width="auto" height="auto" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app_footer_bottom">Design by Nguyễn Sỹ Khải-B16DCCN187</div>
        </div>
    </footer>
    <!-- eND FOOTER -->
</div>
<!-- END APP -->


<!-- modal Cart -->
<div class="app_modal_cart" >
    <!-- <div class="app_modal_over"></div> -->
    <input type="checkbox" name="input_checkbox__cart" class="checkbox__cart" id="input_checkbox__cart" style="display: none;">
    <label for="input_checkbox__cart" class="app_modal_over" id="app_modal_over" onclick="modalCheckboxCart()"></label>

    <div class="shopping_cart">
        <div class="shopping_cart_top">
            <div class="">GIỎ HÀNG</div>
            <div>
                <label for="input_checkbox__cart" class="ti-close shopping_cart_top_icon" onclick="modalCheckboxCart()"></label>
            </div>
        </div>
        <span class="">Bạn đang  có <span style="font-weight: 800;font-family: 'Quicksand',sans-serif;font-size: 1.6rem;">0</span> sản phẩm trong giỏ hàng</span>

        <div class="shopping_cart_product">
            <!-- Nếu không có sản phẩm trong giỏ hàng -->
            <!-- <hr style="margin-top: 20px;margin-bottom: 20px;">
            <span>Hiện chưa có sản phẩm trong giỏ hàng.</span> -->

            <!-- Nếu có sản phẩm trong giỏ hàng -->
            <hr style="margin-top: 20px;margin-bottom: 20px;">
            <div class="shopping_cart_product_list">
                <div class="shopping_cart_product_list_img">
                    <a href=""><img src="{{ asset('public/frontend/images/product/product1.jpg')}}" alt=""></a>
                </div>
                <div class="shopping_cart_product_list_content">
                    <a href="" class="shopping_cart_product_list_content_link">Áo thun in hình Capacabana TS 600 - Xanh Navy - XLÁo thun in hình Capacabana TS 600 - Xanh Navy - XL</a>
                    <div class="shopping_cart_product_list_price">
                        <span>250,000</span> đ <span style="font-weight: 800;">x</span> 1
                    </div>
                    <a href="" class="shopping_cart_product_list_content_remove">Xóa</a>
                </div>
            </div>
            <hr style="margin-top: 20px;margin-bottom: 20px;">
            <div class="shopping_cart_product_list">
                <div class="shopping_cart_product_list_img">
                    <a href=""><img src="{{ asset('public/frontend/images/product/product1.jpg')}}" alt=""></a>
                </div>
                <div class="shopping_cart_product_list_content">
                    <a href="" class="shopping_cart_product_list_content_link">Áo thun in hình Capacabana TS 600 - Xanh Navy - XL</a>
                    <div class="shopping_cart_product_list_price">
                        <span>250,000</span> đ <span style="font-weight: 800;">x</span> 1
                    </div>
                    <a href="" class="shopping_cart_product_list_content_remove">Xóa</a>
                </div>
            </div>
            <hr style="margin-top: 20px;margin-bottom: 20px;">
            <div class="shopping_cart_product_list">
                <div class="shopping_cart_product_list_img">
                    <a href=""><img src="{{ asset('public/frontend/images/product/product1.jpg')}}" alt=""></a>
                </div>
                <div class="shopping_cart_product_list_content">
                    <a href="" class="shopping_cart_product_list_content_link">Áo thun in hình Capacabana TS 600 - Xanh Navy - XL</a>
                    <div class="shopping_cart_product_list_price">
                        <span>250,000</span> đ <span style="font-weight: 800;">x</span> 1
                    </div>
                    <a href="" class="shopping_cart_product_list_content_remove">Xóa</a>
                </div>
            </div>
            <hr style="margin-top: 20px;margin-bottom: 20px;">
            <div class="shopping_cart_product_list">
                <div class="shopping_cart_product_list_img">
                    <a href=""><img src="{{ asset('public/frontend/images/product/product1.jpg')}}" alt=""></a>
                </div>
                <div class="shopping_cart_product_list_content">
                    <a href="" class="shopping_cart_product_list_content_link">Áo thun in hình Capacabana TS 600 - Xanh Navy - XL</a>
                    <div class="shopping_cart_product_list_price">
                        <span>250,000</span> đ <span style="font-weight: 800;">x</span> 1
                    </div>
                    <a href="" class="shopping_cart_product_list_content_remove">Xóa</a>
                </div>
            </div>
            <hr style="margin-top: 20px;margin-bottom: 20px;">
            <div class="shopping_cart_product_list">
                <div class="shopping_cart_product_list_img">
                    <a href=""><img src="{{ asset('public/frontend/images/product/product1.jpg')}}" alt=""></a>
                </div>
                <div class="shopping_cart_product_list_content">
                    <a href="" class="shopping_cart_product_list_content_link">Áo thun in hình Capacabana TS 600 - Xanh Navy - XL</a>
                    <div class="shopping_cart_product_list_price">
                        <span>250,000</span> đ <span style="font-weight: 800;">x</span> 1
                    </div>
                    <a href="" class="shopping_cart_product_list_content_remove">Xóa</a>
                </div>
            </div>
        </div>
        <span class="span_hr_big"></span>
        <div class="shopping_cart_total">
            <span>Tổng tiền tạm tính:</span>
            <span class="shopping_cart_total_price">520,000 đ</span>
        </div>
        <div class="shopping_cart_checkout">
            <a href="" class="shopping_cart_checkout_link">Tiến hành đặt hàng</a>
        </div>
        <div class="shopping_cart_viewcart">
            <a href="">Xem chi tiết giỏ hàng <span class="ti-arrow-right"></span></a>
        </div>
    </div>
</div>

<!-- modal search -->
<input type="checkbox" id="input_checkbox_search" class="input_checkbox_search" hidden>
<div class="app_modal_search">
    <div class="app_modal_search_top">
        <form action="" class="app_modal_search_content">
            <input type="text" class="app_modal_search_input">
            <div class="app_modal_search_search">
                <button type="submit" class="ti-search app_modal_search_search_btn"></button>
            </div>
        </form>
        <div class="app_modal_search_cl">
            <label for="input_checkbox_search" class="input_checkbox_search_close">
                <span class="ti-close"></span>
            </label>
        </div>
    </div>

    <!-- Khi có sản phẩm -->
    <div class="app_modal_search_product">
        <div class="app_modal_search_product_list">
            <div class="app_modal_search_product_list_img">
                <a href="./seach.html"><img src="{{ asset('public/frontend/images/product/saerch.jpg')}}" alt=""></a>
            </div>
            <div class="app_modal_search_product_list_content">
                <a href="./seach.html" class="app_modal_search_product_list_content_name">Quần lót boxer kidman DBX008</a>
                <span class="app_modal_search_product_list_content_price">79,000</span>
            </div>

        </div>
        <hr>
        <div class="app_modal_search_product_list">
            <div class="app_modal_search_product_list_img">
                <a href="./seach.html"><img src="{{ asset('public/frontend/images/product/saerch.jpg')}}" alt=""></a>
            </div>
            <div class="app_modal_search_product_list_content">
                <a href="./seach.html" class="app_modal_search_product_list_content_name">Quần lót boxer kidman DBX008</a>
                <span class="app_modal_search_product_list_content_price">79,000</span>
            </div>

        </div>
    </div>
</div>

<!-- Modal sản phẩm -->

<div class="app_modal_product">
    <input type="checkbox" id="input_checkbox_product" class="input_checkbox_product" onclick="checkboxProduct(this.id)" hidden>
    <label for="input_checkbox_product" class="app_modal_product_overplay"></label>

    <div class="app_modal_product_content">
        <div class="app_modal_product_content_top carousel slide" id="carouselProduct" data-bs-interval="false"  data-bs-ride="carousel">
            <div class="app_modal_product_content_l">
                <img src="{{ asset('public/frontend/images/product/product_small/p1.jpg')}}" alt="" data-bs-target="#carouselProduct" data-bs-slide-to="0" class="active app_modal_product_images_small" aria-current="true" aria-label="Slide 1">
                <img src="{{ asset('public/frontend/images/product/product_small/p2.jpg')}}" alt="" data-bs-target="#carouselProduct" data-bs-slide-to="1" class="app_modal_product_images_small" aria-label="Slide 2">
                <img src="{{ asset('public/frontend/images/product/product_small/p3.jpg')}}" alt="" data-bs-target="#carouselProduct" data-bs-slide-to="2" class="app_modal_product_images_small" aria-label="Slide 3">
                <img src="{{ asset('public/frontend/images/product/product_small/p4.jpg')}}" alt="" data-bs-target="#carouselProduct" data-bs-slide-to="3" class="app_modal_product_images_small" aria-label="Slide 4">
            </div>
            <div class="app_modal_product_content_b carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('public/frontend/images/product/product_small/p1.jpg')}}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('public/frontend/images/product/product_small/p2.jpg')}}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('public/frontend/images/product/product_small/p3.jpg')}}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('public/frontend/images/product/product_small/p4.jpg')}}" class="d-block w-100" alt="...">
                </div>
            </div>
            <div class="app_modal_product_content_r">
                <label for="input_checkbox_product" class="app_modal_product_content_r_close"  onclick="checkboxProduct(this.id)">
                    <span class="ti-close"></span>
                </label>
                <div class="app_modal_product_name">Áo polo nam aristino ÁP014S9</div>
                <!-- Khi không có giảm giá -->
                <!-- <div class="app_modal_product_price">
                    <span>900,000 <span>đ</span></span>
                </div> -->
                <!-- Khi có giảm giá -->
                <div class="app_modal_product_price_sale">
                    <div class="app_modal_product_price_new">
                        <span>270,000 <soan>đ</soan></span>
                    </div>
                    <div class="app_modal_product_price_old">
                        <span>450,000 <span>đ</span></span>
                    </div>
                </div>
                <form action="">
                    <div class="app_modal_product_color">
                        <ul>
                            <li class="app_modal_product_color_list" data-id="1" data-name="modal_product_color_" id="modal_product_color_1" onclick="modalChangeBorderColor(this.id)" onmouseover="modalHoverBorderColor(this.id)" onmouseout="modalOutBorderColor(this.id)">
                                <div class="app_modal_product_color_radio">
                                    <input type="radio" name="modalColorID" value="1" class="app_modal_product_color_radio_input">
                                    <div class="app_modal_product_color_radio_btn" style="background: url({{ asset('public/frontend/images/product/product_nano/p1.jpg')}}) no-repeat center center;width: 25px;height: 30px;"
                                         data-bs-target="#carouselProduct" data-bs-slide-to="0" class="active app_modal_product_images_small" aria-current="true" aria-label="Slide 1"></div>
                                </div>
                                <div class="app_modal_product_color_list_title">
                                    Màu đen vàng
                                </div>
                            </li>
                            <!-- Nếu hết màu sản phầm -->
                            <li class="app_modal_product_color_list" data-id="2" data-name="modal_product_color_" id="modal_product_color_2" onclick="modalChangeBorderColor(this.id)" onmouseover="modalHoverBorderColor(this.id)" onmouseout="modalOutBorderColor(this.id)">
                                <div class="app_modal_product_color_radio" style="background: url({{ asset('public/frontend/images/product/product_nano/soldout.png')}}) no-repeat center center;background-size: contain;">
                                    <input type="radio" name="modalColorID" value="2" class="app_modal_product_color_radio_input">
                                    <div class="app_modal_product_color_radio_btn app_modal_product_soldout" style="background: url({{ asset('public/frontend/images/product/product_nano/p2.jpg')}}) no-repeat center center;width: 25px;height: 30px;"
                                         data-bs-target="#carouselProduct" data-bs-slide-to="1" class="active app_modal_product_images_small" aria-current="true" aria-label="Slide 2"></div>
                                </div>
                                <div class="app_modal_product_color_list_title">
                                    Màu đen vàng
                                </div>
                            </li>
                            <li class="app_modal_product_color_list" data-id="3" data-name="modal_product_color_" id="modal_product_color_3" onclick="modalChangeBorderColor(this.id)" onmouseover="modalHoverBorderColor(this.id)" onmouseout="modalOutBorderColor(this.id)">
                                <div class="app_modal_product_color_radio">
                                    <input type="radio" name="modalColorID" value="3" class="app_modal_product_color_radio_input">
                                    <div class="app_modal_product_color_radio_btn" style="background: url({{ asset('public/frontend/images/product/product_nano/p3.jpg')}}) no-repeat center center;width: 25px;height: 30px;"
                                         data-bs-target="#carouselProduct" data-bs-slide-to="2" class="active app_modal_product_images_small" aria-current="true" aria-label="Slide 3"></div>
                                </div>
                                <div class="app_modal_product_color_list_title">
                                    Màu đen vàng
                                </div>
                            </li>
                            <li class="app_modal_product_color_list" data-id="4" data-name="modal_product_color_" id="modal_product_color_4" onclick="modalChangeBorderColor(this.id)" onmouseover="modalHoverBorderColor(this.id)" onmouseout="modalOutBorderColor(this.id)">
                                <div class="app_modal_product_color_radio">
                                    <input type="radio" name="modalColorID" value="4" class="app_modal_product_color_radio_input">
                                    <div class="app_modal_product_color_radio_btn" style="background: url({{ asset('public/frontend/images/product/product_nano/p4.jpg')}}) no-repeat center center;width: 25px;height: 30px;"
                                         data-bs-target="#carouselProduct" data-bs-slide-to="3" class="active app_modal_product_images_small" aria-current="true" aria-label="Slide 4"></div>
                                </div>
                                <div class="app_modal_product_color_list_title">
                                    Màu đen vàng
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="app_modal_product_size">
                        <ul>
                            <li class="app_modal_product_size_list" data-id="S" data-name="modal_product_size_" id="modal_product_size_S" onclick="modalChangeBorderSize(this.id)" onmouseover="modalHoverBorderSize(this.id)" onmouseout="modalOutBorderSize(this.id)">
                                <div class="app_modal_product_size_radio">
                                    <input type="radio" name="modalSizeID" value="S" class="app_modal_product_size_radio_input">
                                    <div class="app_modal_product_size_radio_btn">S</div>
                                </div>
                            </li>
                            <!-- Nếu kích thước hết -->
                            <li class="app_modal_product_size_list" data-id="M" data-name="modal_product_size_" id="modal_product_size_M" onclick="modalChangeBorderSize(this.id)" onmouseover="modalHoverBorderSize(this.id)" onmouseout="modalOutBorderSize(this.id)">
                                <div class="app_modal_product_size_radio" style="background: url('./public/images/product/product_nano/soldout.png') no-repeat center center;background-size: contain;">
                                    <input type="radio" name="modalSizeID" value="M" class="app_modal_product_size_radio_input">
                                    <div class="app_modal_product_size_radio_btn">M</div>
                                </div>
                            </li>
                            <li class="app_modal_product_size_list" data-id="L" data-name="modal_product_size_" id="modal_product_size_L" onclick="modalChangeBorderSize(this.id)" onmouseover="modalHoverBorderSize(this.id)" onmouseout="modalOutBorderSize(this.id)">
                                <div class="app_modal_product_size_radio">
                                    <input type="radio" name="modalSizeID" value="L" class="app_modal_product_size_radio_input">
                                    <div class="app_modal_product_size_radio_btn">L</div>
                                </div>
                            </li>
                            <li class="app_modal_product_size_list" data-id="XL" data-name="modal_product_size_" id="modal_product_size_XL" onclick="modalChangeBorderSize(this.id)" onmouseover="modalHoverBorderSize(this.id)" onmouseout="modalOutBorderSize(this.id)">
                                <div class="app_modal_product_size_radio">
                                    <input type="radio" name="modalSizeID" value="XL" class="app_modal_product_size_radio_input">
                                    <div class="app_modal_product_size_radio_btn">XL</div>
                                </div>
                            </li>
                            <li class="app_modal_product_size_list" data-id="XXL" data-name="modal_product_size_" id="modal_product_size_XXL" onclick="modalChangeBorderSize(this.id)" onmouseover="modalHoverBorderSize(this.id)" onmouseout="modalOutBorderSize(this.id)">
                                <div class="app_modal_product_size_radio">
                                    <input type="radio" name="modalSizeID" value="XXL" class="app_modal_product_size_radio_input">
                                    <div class="app_modal_product_size_radio_btn">XXL</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="app_modal_product_number">
                        <input type="button" onclick="modalMinusQty()" class="app_modal_product_number_btn" value="-">
                        <input type="text" oninput="modalInputQty()" name="modalQty" id="modalQty" value="1" min="1" max="" class="app_modal_product_number_qty">
                        <input type="button" onclick="modalPlusQty()" class="app_modal_product_number_btn" value="+">
                    </div>
                    <div class="app_modal_product_button">
                        <button type="submit" class="app_modal_product_submit">Thêm vào giỏ hàng</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="app_modal_product_content_bottom">
            <a href="" class="app_modal_product_content_bottom_link">Xem chi tiết</a>
        </div>
    </div>

</div>

<!-- Modal danh mục -->

<div class="app_modal_category">
    <input type="checkbox" name="" id="app_modal_category_input" class="app_modal_category_input" hidden>
    <label for="app_modal_category_input" class="app_modal_category_overlay"></label>
    <div class="app_modal_category_content">
        <div class="app_modal_category_content_title">
            <div class="app_modal_category_content_title_text">
                Menu
            </div>
            <label for="app_modal_category_input" class="app_modal_category_content_title_icon">
                <span class="ti-close"></span>
            </label>
        </div>
        <div class="app_modal_category_container">
            <div class="app_modal_category_content_list">
                <a href="./index.html" class="app_modal_category_content_link">Trang chủ</a>
            </div>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button accordion-button_modal collapsed app_modal_category_content_list" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Sản phẩm
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <!-- Content -->
                        <!-- Có list sau -->
                        <ul class="app_modal_category_ul">
                            <li class="app_modal_category_hasChildren">
                                <div class="app_modal_category_hasChildren_content">Áo</div>
                                <div class="app_modal_category_hasChildren_next" id="modalCategory_Ao" data-id="Ao" data-name="modalCategory_" onclick="hasChildrenCategory(this.id)">
                                    <div class=""><span class="ti-angle-right"></span></div>
                                </div>
                            </li>
                            <li class="app_modal_category_hasChildren">
                                <div class="app_modal_category_hasChildren_content">Quần</div>
                                <div class="app_modal_category_hasChildren_next" id="modalCategory_Quan" data-id="Quan" data-name="modalCategory_" onclick="hasChildrenCategory(this.id)">
                                    <div class=""><span class="ti-angle-right"></span></div>
                                </div>
                            </li>
                            <li class="app_modal_category_hasChildren">
                                <div class="app_modal_category_hasChildren_content">Đồ lót</div>
                                <div class="app_modal_category_hasChildren_next">
                                    <div class=""><span class="ti-angle-right"></span></div>
                                </div>
                            </li>
                            <li class="app_modal_category_hasChildren">
                                <div class="app_modal_category_hasChildren_content">Combo</div>
                                <div class="app_modal_category_hasChildren_next">
                                    <div class=""><span class="ti-angle-right"></span></div>
                                </div>
                            </li>
                            <li class="app_modal_category_hasChildren">
                                <div class="app_modal_category_hasChildren_content">Phụ kiện</div>
                                <div class="app_modal_category_hasChildren_next">
                                    <div class=""><span class="ti-angle-right"></span></div>
                                </div>
                            </li>
                            <li class="app_modal_category_hasChildren">
                                <div class="app_modal_category_hasChildren_content">Kidman</div>
                                <div class="app_modal_category_hasChildren_next">
                                    <div class=""><span class="ti-angle-right"></span></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed app_modal_category_content_list" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Bộ sưu tập
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <ul class="app_modal_category_ul">
                            <li class="app_modal_category_hasChildren">
                                <div class="app_modal_category_hasChildren_content">Xuân hè</div>
                                <div class="app_modal_category_hasChildren_next">
                                    <div class=""><span class="ti-angle-right"></span></div>
                                </div>
                            </li>
                            <li class="app_modal_category_hasChildren">
                                <div class="app_modal_category_hasChildren_content">Thu đông</div>
                                <div class="app_modal_category_hasChildren_next">
                                    <div class=""><span class="ti-angle-right"></span></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed app_modal_category_content_list" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            Đồng phục
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <ul class="app_modal_category_ul">
                            <li class="app_modal_category_hasChildren">
                                <div class="app_modal_category_hasChildren_content">Nam công sở</div>
                            </li>
                            <li class="app_modal_category_hasChildren">
                                <div class="app_modal_category_hasChildren_content">Nữ công sở</div>
                            </li>
                            <li class="app_modal_category_hasChildren">
                                <div class="app_modal_category_hasChildren_content">Bảo hộ lao động</div>
                            </li>
                            <li class="app_modal_category_hasChildren">
                                <div class="app_modal_category_hasChildren_content">Thể thao</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="app_modal_category_content_list">
                <a href="" class="app_modal_category_content_link">Liên hệ</a>
            </div>
        </div>
    </div>

</div>
<div class="modal_children">
    <input type="checkbox" name="app_modal_category_children_input" id="app_modal_category_children_input" class="app_modal_category_children_input" hidden>
    <label for="app_modal_category_children_input" class="app_modal_category_chidren_overlay"  onclick="modalChildrenCategory()"></label>
    <!-- Children áo -->
    <div class="app_modal_category_children" id="modalCategoryChildren_Ao" data-name="modalCategoryChildren_">
        <div class="app_modal_category_children_title">
            <div class="app_modal_category_children_title_icon"  onclick="backModalCategory()">
                <span class="ti-angle-left"></span>
            </div>
            <div class="app_modal_category_children_title_text">
                ÁO
            </div>
            <div class="app_modal_category_children_title_icon" onclick="modalChildrenCategory()">
                <span class="ti-close"></span>
            </div>
        </div>
        <div class="app_modal_category_container">
            <div class="app_modal_category_content_list">
                <a href="" class="app_modal_category_content_link">Áo sơ mi</a>
            </div>
            <div class="app_modal_category_content_list">
                <a href="" class="app_modal_category_content_link">Áo polo</a>
            </div>
            <div class="app_modal_category_content_list">
                <a href="" class="app_modal_category_content_link">Áo T-Shirt</a>
            </div>
            <div class="app_modal_category_content_list">
                <a href="" class="app_modal_category_content_link">Áo Tank-top</a>
            </div>
            <div class="app_modal_category_content_list">
                <a href="" class="app_modal_category_content_link">Áo len</a>
            </div>
            <div class="app_modal_category_content_list">
                <a href="" class="app_modal_category_content_link">Áo khoác</a>
            </div>
            <div class="app_modal_category_content_list">
                <a href="" class="app_modal_category_content_link">Áo thun dài tay</a>
            </div>
            <div class="app_modal_category_content_list">
                <a href="" class="app_modal_category_content_link">Áo plazer</a>
            </div>
        </div>
    </div>
    <!-- Children Quần -->
    <div class="app_modal_category_children" id="modalCategoryChildren_Quan" data-name="modalCategoryChildren_">
        <div class="app_modal_category_children_title">
            <div class="app_modal_category_children_title_icon"  onclick="backModalCategory()">
                <span class="ti-angle-left"></span>
            </div>
            <div class="app_modal_category_children_title_text">
                Quần
            </div>
            <div class="app_modal_category_children_title_icon" onclick="modalChildrenCategory()">
                <span class="ti-close"></span>
            </div>
        </div>
        <div class="app_modal_category_container">
            <div class="app_modal_category_content_list">
                <a href="" class="app_modal_category_content_link">Quần âu</a>
            </div>
            <div class="app_modal_category_content_list">
                <a href="" class="app_modal_category_content_link">Quần kaki</a>
            </div>
            <div class="app_modal_category_content_list">
                <a href="" class="app_modal_category_content_link">Quần thể thao</a>
            </div>
            <div class="app_modal_category_content_list">
                <a href="" class="app_modal_category_content_link">Quần jeans</a>
            </div>
            <div class="app_modal_category_content_list">
                <a href="" class="app_modal_category_content_link">Quần short</a>
            </div>
        </div>
    </div>
</div>

</body>
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Ajjax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<!-- css trang -->
<script src="{{ asset('public/frontend/js/main.js') }}"></script>
@yield('frontend_js')

</html>
