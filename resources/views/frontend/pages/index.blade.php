@extends('frontend.layouts.frontend_layout')

@section('frontend_title')

    <title>Ecommerce Shop</title>

@endsection
@section('frontend_css')

    <link rel="stylesheet" href="{{ asset('public/frontend/css/index.css')}}">

@endsection

@section('frontend_js')

    <script src="{{ asset('public/frontend/js/index.js')}}"></script>

@endsection

@section('frontend_slide')
    <div class="abc" id="abc" style="color: white;z-index: 1;"></div>
    <div class="app_slider" id="app_slider">
        <!--  style="top: 195px; z-index: 0;" -->
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="{{ asset('public/frontend/images/slider/slider1.jpg')}}" class="d-block w-100" alt="..." id="heightImage">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="{{ asset('public/frontend/images/slider/slider2.jpg')}}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('public/frontend/images/slider/slider3.jpg')}}" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
@endsection

@section('frontend_content')

    <div class="container app_container" id="app_container">
        <!-- S???n ph???m m???i -->
        <div class="app_container_title">
            <span class="app_container_title_link">S???N PH???M M???I</span>
            <!-- <a href="" class="app_container_title_link">S???N PH???M M???I</a> -->
            <div class="app_container_heading">
                <div class="row">
                    @foreach($productNew as $key => $item)
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6">
                        <!-- C???n thay ?????i data-name t??y thu???c v??o t??n list s???n ph???m -->
                        <!-- id = 'data-name' + 'data-id' -->
                        <div class="product_item" data-id="{{ $item->id }}" data-name="product_item_new_" data-nameBot="product_item_new_bot_" id="product_item_new_{{ $item->id }}" onmouseover="Hoverevent(this.id)" onmouseout="Outevent(this.id)">
                            <div class="product_item_top">
                                <a href="{{ URL::to(to_slug($item->category_name).'/'.to_slug($item->subcategory_name).'/'.to_slug($item->product_name)) }}"><img src="{{ asset($item->product_avatar)}}" alt=""></a>
                                <a href="{{ URL::to(to_slug($item->category_name).'/'.to_slug($item->subcategory_name).'/'.to_slug($item->product_name)) }}" class="product_item_name">{{ $item->product_name }}</a>
                                @if($item->discount_price == 0)
                                <!-- Kh??ng gi???m gi?? -->
                                <div class="product_item_price">
                                    {{ formatPrice($item->product_price)}}
                                </div>
                                @else
                                <!-- Gi???m gi?? -->
                                <div class="product_item_price product_item_price_flex">
                                    <div class="product_item_price_new">{{ formatPriceSale($item->product_price,$item->discount_price)}}</div>
                                    <div class="product_item_price_old">{{ formatPrice($item->product_price)}}</div>
                                </div>
                                @endif
                            </div>
                            <!-- id = 'data-nameBot' + 'data-id' -->
                            <div class="product_item_bot" id="product_item_new_bot_{{ $item->id }}">
                                <div class="product_item_bot_l">
                                    <label for="input_checkbox_product" class="ti-shopping-cart product_item_bot_link" id="{{ $item->id }}"  onclick="checkboxProduct(this.id)"> <span>Mua nhanh</span></label>
                                </div>
                                <div class="product_item_bot_r">
                                    <a href="{{ URL::to(to_slug($item->category_name).'/'.to_slug($item->subcategory_name).'/'.to_slug($item->product_name)) }}" class="product_item_bot_link"><span class="ti-eye"></span>  <span>Xem chi ti???t</span></a>
                                </div>
                            </div>
                            <!-- Y??u th??ch -->
                            <div class="product_item_favourite">
                                <!-- Ch??a y??u th??ch -->
                                <span class="product_item_favourite_link"><span class="ti-heart product_item_favourite_noheart" data-id="{{ $item->id }}" data-name-no="new_noFavourite_" data-name-have="new_haveFavourite_" id="new_noFavourite_{{ $item->id }}" onclick="addFavourite(this.id)"></span></span>
                                <!-- <span class="product_item_favourite_link"><i class="far fa-heart product_item_favourite_heart" aria-hidden="true" id="Favourite_1" onclick="Favourite(this.id)"></i></span> -->
                                <!-- ???? y??u th??ch -->
                                <span class="product_item_favourite_link"><i class="fas fa-heart product_item_favourite_heart hidden_heart" aria-hidden="true" data-id="{{ $item->id }}" data-name-no="new_noFavourite_" data-name-have="new_haveFavourite_" id="new_haveFavourite_{{ $item->id }}" onclick="removeFavourite(this.id)"></i></span>

                            </div>
                            @if($item->discount_price == '0' || $item->discount_price == null)
                            @else
                            <!-- Gi???m gi?? -->
                            <div class="product_item_sale">
                                <div class="product_item_sale_percent">
                                    {{ $item->discount_price }}%
                                </div>
                                <div class="product_item_sale_percent_text">
                                    GI???M
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- S???n ph???m b??n ch???y -->
        <div class="app_container_title">
            <span class="app_container_title_link">S???N PH???M B??N CH???Y</span>
            <!-- <a href="" class="app_container_title_link">S???N PH???M B??N CH???Y</a> -->
            <div class="app_container_heading">
                <div class="row">
                    @foreach($productHot as $item)
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6">
                        <!-- C???n thay ?????i data-name t??y thu???c v??o t??n list s???n ph???m -->
                        <!-- id = 'data-name' + 'data-id' -->
                        <div class="product_item" data-id="{{ $item->id }}" data-name="product_item_hot_" data-nameBot="product_item_hot_bot_" id="product_item_hot_{{ $item->id }}" onmouseover="Hoverevent(this.id)" onmouseout="Outevent(this.id)">
                            <div class="product_item_top">
                                <a href="{{ URL::to(to_slug($item->category_name).'/'.to_slug($item->subcategory_name).'/'.to_slug($item->product_name)) }}"><img src="{{ asset($item->product_avatar)}}" alt=""></a>
                                <a href="{{ URL::to(to_slug($item->category_name).'/'.to_slug($item->subcategory_name).'/'.to_slug($item->product_name)) }}" class="product_item_name">{{ $item->product_name }}</a>
                                @if($item->discount_price == 0)
                                    <!-- Kh??ng gi???m gi?? -->
                                        <div class="product_item_price">
                                            {{ formatPrice($item->product_price)}}
                                        </div>
                                @else
                                <!-- Gi???m gi?? -->
                                    <div class="product_item_price product_item_price_flex">
                                        <div class="product_item_price_new">{{ formatPriceSale($item->product_price,$item->discount_price)}}</div>
                                        <div class="product_item_price_old">{{ formatPrice($item->product_price)}}</div>
                                    </div>
                                @endif
                            </div>
                            <!-- id = 'data-nameBot' + 'data-id' -->
                            <div class="product_item_bot" id="product_item_hot_bot_{{ $item->id }}">
                                <div class="product_item_bot_l">
                                    <label for="input_checkbox_product" class="ti-shopping-cart product_item_bot_link" id="{{ $item->id }}"  onclick="checkboxProduct(this.id)"> <span>Mua nhanh</span></label>
                                </div>
                                <div class="product_item_bot_r">
                                    <a href="{{ URL::to(to_slug($item->category_name).'/'.to_slug($item->subcategory_name).'/'.to_slug($item->product_name)) }}" class="product_item_bot_link"><span class="ti-eye"></span>  <span>Xem chi ti???t</span></a>
                                </div>
                            </div>
                            <!-- Y??u th??ch -->
                            <div class="product_item_favourite">
                                <!-- Ch??a y??u th??ch -->
                                <span class="product_item_favourite_link"><span class="ti-heart product_item_favourite_noheart" data-id="{{ $item->id }}" data-name-no="hot_noFavourite_" data-name-have="hot_haveFavourite_" id="hot_noFavourite_{{ $item->id }}" onclick="addFavourite(this.id)"></span></span>
                                <!-- <span class="product_item_favourite_link"><i class="far fa-heart product_item_favourite_heart" aria-hidden="true" id="Favourite_1" onclick="Favourite(this.id)"></i></span> -->
                                <!-- ???? y??u th??ch -->
                                <span class="product_item_favourite_link"><i class="fas fa-heart product_item_favourite_heart hidden_heart" aria-hidden="true" data-id="{{ $item->id }}" data-name-no="hot_noFavourite_" data-name-have="hot_haveFavourite_" id="hot_haveFavourite_{{ $item->id }}" onclick="removeFavourite(this.id)"></i></span>

                            </div>
                            @if($item->discount_price == '0' || $item->discount_price == null)
                            @else
                            <!-- Gi???m gi?? -->
                                <div class="product_item_sale">
                                    <div class="product_item_sale_percent">
                                        {{ $item->discount_price }}%
                                    </div>
                                    <div class="product_item_sale_percent_text">
                                        GI???M
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Set ????? c???a tu???n -->
        <div class="row app_container_outfit">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="app_container_outfit_l">
                    <img src="{{ asset('public/frontend/images/outfit/week.jpg')}}" alt="" class="app_container_outfit_img">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="app_container_outfit_r">
                    <div class="app_container_outfit_title">Set ????? c???a tu???n</div>
                    <div class="app_container_outfit_text">
                        L???a ch???n c???a Stylist TORANO gi??p b???n c?? m???t Outfit nam t??nh, ?????y l???ch l??m. Tham kh???o ngay!
                    </div>
                    <div class="app_container_outfit_product">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                <!-- C???n thay ?????i data-name t??y thu???c v??o t??n list s???n ph???m -->
                                <!-- id = 'data-name' + 'data-id' -->
                                <div class="product_item" data-id="1" data-name="product_item_outfit_" data-nameBot="product_item_outfit_bot_" id="product_item_outfit_1" onmouseover="Hoverevent(this.id)" onmouseout="Outevent(this.id)">
                                    <div class="product_item_top">
                                        <a href="./product.html"><img src="{{ asset('public/frontend/images/product/avatar_b/p1.jpg')}}" alt=""></a>
                                        <a href="./product.html" class="product_item_name">??o polo coolmax Germany TP065</a>
                                        <!-- Kh??ng gi???m gi?? -->
                                        <div class="product_item_price">
                                            <!-- 380,000 <span class="price_d">??</span> -->
                                        </div>
                                        <!-- Gi???m gi?? -->
                                        <div class="product_item_price product_item_price_flex">
                                            <div class="product_item_price_new">200,000 <span class="price_d">??</span></div>
                                            <div class="product_item_price_old">380,000 <span class="price_d">??</span></div>
                                        </div>
                                    </div>
                                    <!-- id = 'data-nameBot' + 'data-id' -->
                                    <div class="product_item_bot" id="product_item_outfit_bot_1">
                                        <div class="product_item_bot_l">
                                            <label for="input_checkbox_product" class="ti-shopping-cart product_item_bot_link" onclick="checkboxProduct(this.id)"> <span>Mua nhanh</span></label>
                                        </div>
                                        <div class="product_item_bot_r">
                                            <a href="./product.html" class="product_item_bot_link"><span class="ti-eye"></span>  <span>Xem chi ti???t</span></a>
                                        </div>
                                    </div>
                                    <!-- Y??u th??ch -->
                                    <div class="product_item_favourite">
                                        <!-- Ch??a y??u th??ch -->
                                        <span class="product_item_favourite_link"><span class="ti-heart product_item_favourite_noheart" data-id="1" data-name-no="outfit_noFavourite_" data-name-have="outfit_haveFavourite_" id="outfit_noFavourite_1" onclick="addFavourite(this.id)"></span></span>
                                        <!-- <span class="product_item_favourite_link"><i class="far fa-heart product_item_favourite_heart" aria-hidden="true" id="Favourite_1" onclick="Favourite(this.id)"></i></span> -->
                                        <!-- ???? y??u th??ch -->
                                        <span class="product_item_favourite_link"><i class="fas fa-heart product_item_favourite_heart hidden_heart" aria-hidden="true" data-id="1" data-name-no="outfit_noFavourite_" data-name-have="outfit_haveFavourite_" id="outfit_haveFavourite_1" onclick="removeFavourite(this.id)"></i></span>

                                    </div>
                                    <!-- Gi???m gi?? -->
                                    <div class="product_item_sale">
                                        <div class="product_item_sale_percent">
                                            10%
                                        </div>
                                        <div class="product_item_sale_percent_text">
                                            GI???M
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                <!-- C???n thay ?????i data-name t??y thu???c v??o t??n list s???n ph???m -->
                                <!-- id = 'data-name' + 'data-id' -->
                                <div class="product_item" data-id="2" data-name="product_item_outfit_" data-nameBot="product_item_outfit_bot_" id="product_item_outfit_2" onmouseover="Hoverevent(this.id)" onmouseout="Outevent(this.id)">
                                    <div class="product_item_top">
                                        <a href="./product.html"><img src="{{ asset('public/frontend/images/product/avatar_b/p2.jpg')}}" alt=""></a>
                                        <a href="./product.html" class="product_item_name">??o polo coolmax Germany TP065</a>
                                        <!-- Kh??ng gi???m gi?? -->
                                        <div class="product_item_price">
                                            <!-- 380,000 <span class="price_d">??</span> -->
                                        </div>
                                        <!-- Gi???m gi?? -->
                                        <div class="product_item_price product_item_price_flex">
                                            <div class="product_item_price_new">200,000 <span class="price_d">??</span></div>
                                            <div class="product_item_price_old">380,000 <span class="price_d">??</span></div>
                                        </div>
                                    </div>
                                    <!-- id = 'data-nameBot' + 'data-id' -->
                                    <div class="product_item_bot" id="product_item_outfit_bot_2">
                                        <div class="product_item_bot_l">
                                            <label for="input_checkbox_product" class="ti-shopping-cart product_item_bot_link"  onclick="checkboxProduct(this.id)"> <span>Mua nhanh</span></label>
                                        </div>
                                        <div class="product_item_bot_r">
                                            <a href="./product.html" class="product_item_bot_link"><span class="ti-eye"></span>  <span>Xem chi ti???t</span></a>
                                        </div>
                                    </div>
                                    <!-- Y??u th??ch -->
                                    <div class="product_item_favourite">
                                        <!-- Ch??a y??u th??ch -->
                                        <span class="product_item_favourite_link"><span class="ti-heart product_item_favourite_noheart" data-id="2" data-name-no="outfit_noFavourite_" data-name-have="outfit_haveFavourite_" id="outfit_noFavourite_2" onclick="addFavourite(this.id)"></span></span>
                                        <!-- <span class="product_item_favourite_link"><i class="far fa-heart product_item_favourite_heart" aria-hidden="true" id="Favourite_1" onclick="Favourite(this.id)"></i></span> -->
                                        <!-- ???? y??u th??ch -->
                                        <span class="product_item_favourite_link"><i class="fas fa-heart product_item_favourite_heart hidden_heart" aria-hidden="true" data-id="2" data-name-no="outfit_noFavourite_" data-name-have="outfit_haveFavourite_" id="outfit_haveFavourite_2" onclick="removeFavourite(this.id)"></i></span>

                                    </div>
                                    <!-- Gi???m gi?? -->
                                    <div class="product_item_sale">
                                        <div class="product_item_sale_percent">
                                            10%
                                        </div>
                                        <div class="product_item_sale_percent_text">
                                            GI???M
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
        <!-- Tin t???c -->
        <div class="app_container_news">
            <div class="app_container_news_title">
                Tin t???c
            </div>
            <div class="row app_container_news_list">
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="app_container_news_list_content">
                        <a href="" class="">
                            <img src="{{ asset('public/frontend/images/news/news1.jpg')}}" alt="" class="app_container_news_list_content_img">
                        </a>
                        <div class="app_container_news_list_content_title">
                            <a href="" class="app_container_news_list_content_title_link">T???i sao ??o Polo l?? v?? kh?? l???i h???i c???a ph??i m???nh?</a>
                        </div>
                        <div class="app_container_news_list_content_text">
                            ??o Polo ch???p t???t m???i th???i ti???t t??? ????ng hay thu, xu??n hay h??, ??i ch??i hay ??i l??m ?????u r???t ph?? h???p. ???? l?? nguy??n nh??n v?? sao s???c h??t c???a ph??i m???nh. ???? l?? m???t ??i???u th???n k?? c???a t???o h??a.
                        </div>
                        <div class="app_container_news_list_content_continue">
                            <a href="" class="app_container_news_list_content_continue_link">Xem th??m</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="app_container_news_list_content">
                        <a href="" class="">
                            <img src="{{ asset('public/frontend/images/news/news1.jpg')}}" alt="" class="app_container_news_list_content_img">
                        </a>
                        <div class="app_container_news_list_content_title">
                            <a href="" class="app_container_news_list_content_title_link">T???i sao ??o Polo l?? v?? kh?? l???i h???i c???a ph??i m???nh?T???i sao ??o Polo l?? v?? kh?? l???i h???i c???a ph??i m???nh?</a>
                        </div>
                        <div class="app_container_news_list_content_text">
                            ??o Polo ch???p t???t m???i th???i ti???t t??? ????ng hay thu, xu??n hay h??, ??i ch??i hay ??i l??m ?????u r???t ph?? h???p. ???? l?? nguy??n nh??n v?? sao s???c h??t c???a ph??i m???nh. ???? l?? m???t ??i???u th???n k?? c???a t???o h??a.
                        </div>
                        <div class="app_container_news_list_content_continue">
                            <a href="" class="app_container_news_list_content_continue_link">Xem th??m</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="app_container_news_list_content">
                        <a href="" class="">
                            <img src="{{ asset('public/frontend/images/news/news1.jpg')}}" alt="" class="app_container_news_list_content_img">
                        </a>
                        <div class="app_container_news_list_content_title">
                            <a href="" class="app_container_news_list_content_title_link">T???i sao ??o Polo l?? v?? kh?? l???i h???i c???a ph??i m???nh?</a>
                        </div>
                        <div class="app_container_news_list_content_text">
                            ??o Polo ch???p t???t m???i th???i ti???t t??? ????ng hay thu, xu??n hay h??, ??i ch??i hay ??i l??m ?????u r???t ph?? h???p. ???? l?? nguy??n nh??n v?? sao s???c h??t c???a ph??i m???nh. ???? l?? m???t ??i???u th???n k?? c???a t???o h??a.
                        </div>
                        <div class="app_container_news_list_content_continue">
                            <a href="" class="app_container_news_list_content_continue_link">Xem th??m</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="app_container_news_list_content">
                        <a href="" class="">
                            <img src="{{ asset('public/frontend/images/news/news1.jpg')}}" alt="" class="app_container_news_list_content_img">
                        </a>
                        <div class="app_container_news_list_content_title">
                            <a href="" class="app_container_news_list_content_title_link">T???i sao ??o Polo l?? v?? kh?? l???i h???i c???a ph??i m???nh?</a>
                        </div>
                        <div class="app_container_news_list_content_text">
                            ??o Polo ch???p t???t m???i th???i ti???t t??? ????ng hay thu, xu??n hay h??, ??i ch??i hay ??i l??m ?????u r???t ph?? h???p. ???? l?? nguy??n nh??n v?? sao s???c h??t c???a ph??i m???nh. ???? l?? m???t ??i???u th???n k?? c???a t???o h??a.
                        </div>
                        <div class="app_container_news_list_content_continue">
                            <a href="" class="app_container_news_list_content_continue_link">Xem th??m</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
