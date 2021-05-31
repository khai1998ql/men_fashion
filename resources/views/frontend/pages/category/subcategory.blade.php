@extends('frontend.layouts.frontend_layout')
@section('frontend_title')

    <title>{{ $subcategory->subcategory_name }} Nam - Thời Trang Nam</title>

@endsection
@section('frontend_css')
    <link rel="stylesheet" href="{{ asset('public/frontend/css/category.css')}}">
@endsection
@section('frontend_js')
    <script src="{{ asset('public/frontend/js/category.js')}}"></script>
@endsection

@section('frontend_content')

    <!-- CONTAINER -->
    <div class="container app_container">
        <div class="app_container_top">
            <a href="{{ route('fe.index') }}" class="app_container_top_to"><i class="fas fa-home"></i> Trang chủ</a>
            <a href="{{ URL::to(to_slug($category->category_name)) }}" class="app_container_top_to" style="margin-left: 5px"> {{ $category->category_name }}</a>
            <span class="app_container_top_from">{{ $subcategory->subcategory_name }}</span>
        </div>
        <div class="app_container_title">
            {{ $category->category_name }}
        </div>
        <div class="app_container_filter">
            <div class="app_container_filter_l">
                <div class="app_container_filter_l_title">Bộ lọc:</div>
                <div class="app_container_filter_l_list">
                    <ul>
                        <li class="app_container_filter_l_list_item">Màu sách <i class="fas fa-sort-down app_container_filter_l_list_icon"></i></li>
                        <li class="app_container_filter_l_list_item">Kích cỡ <i class="fas fa-sort-down app_container_filter_l_list_icon"></i></li>
                        <li class="app_container_filter_l_list_item">Khoảng giá <i class="fas fa-sort-down app_container_filter_l_list_icon"></i></li>
                    </ul>
                    <div class="app_container_filter_hover">
                        <form action="">
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3">
                                    <!-- Phần màu -->
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-4  col-sm-6 col-6">
                                            <input type="checkbox" name="color_1" id="color_1" value="color_1" class="hover_checkbox">
                                            <div class="app_container_filter_hover_color hover_color_checked" data-name="div_color_" data-id="1" id="div_color_1" onclick="checkboxHoverCategory(this.id)" style="background: red;" title="Màu đỏ"></div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4  col-sm-6 col-6">
                                            <input type="checkbox" name="color_2" id="color_2" value="color_2" class="hover_checkbox">
                                            <div class="app_container_filter_hover_color" data-name="div_color_" data-id="2" id="div_color_2" onclick="checkboxHoverCategory(this.id)" style="background: whitesmoke;" title="Màu Be"></div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4  col-sm-6 col-6">
                                            <input type="checkbox" name="color_3" id="color_3" value="color_3" class="hover_checkbox">
                                            <div class="app_container_filter_hover_color" data-name="div_color_" data-id="3" id="div_color_3" onclick="checkboxHoverCategory(this.id)" style="background: white;" title="Màu trắng"></div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4  col-sm-6 col-6">
                                            <input type="checkbox" name="color_4" id="color_4" value="color_4" class="hover_checkbox">
                                            <div class="app_container_filter_hover_color" data-name="div_color_" data-id="4" id="div_color_4" onclick="checkboxHoverCategory(this.id)" style="background: purple;" title="Màu tím"></div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4  col-sm-6 col-6">
                                            <input type="checkbox" name="color_5" id="color_5" value="color_5" class="hover_checkbox">
                                            <div class="app_container_filter_hover_color" data-name="div_color_" data-id="5" id="div_color_5" onclick="checkboxHoverCategory(this.id)" style="background: black;" title="Màu đen"></div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4  col-sm-6 col-6">
                                            <input type="checkbox" name="color_6" id="color_6" value="color_6" class="hover_checkbox">
                                            <div class="app_container_filter_hover_color" data-name="div_color_" data-id="6" id="div_color_6" onclick="checkboxHoverCategory(this.id)" style="background: yellow;" title="Màu vàng"></div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4  col-sm-6 col-6">
                                            <input type="checkbox" name="color_7" id="color_7" value="color_7" class="hover_checkbox">
                                            <div class="app_container_filter_hover_color" data-name="div_color_" data-id="7" id="div_color_7" onclick="checkboxHoverCategory(this.id)" style="background: brown;" title="Màu nâu"></div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4  col-sm-6 col-6">
                                            <input type="checkbox" name="color_8" id="color_8" value="color_8" class="hover_checkbox">
                                            <div class="app_container_filter_hover_color" data-name="div_color_" data-id="8" id="div_color_8" onclick="checkboxHoverCategory(this.id)" style="background: pink;" title="Màu hồng"></div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4  col-sm-6 col-6">
                                            <input type="checkbox" name="color_9" id="color_9" value="color_9" class="hover_checkbox">
                                            <div class="app_container_filter_hover_color" data-name="div_color_" data-id="9" id="div_color_9" onclick="checkboxHoverCategory(this.id)" style="background: orange;" title="Màu cam"></div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4  col-sm-6 col-6">
                                            <input type="checkbox" name="color_10" id="color_10" value="color_10" class="hover_checkbox">
                                            <div class="app_container_filter_hover_color" data-name="div_color_" data-id="10" id="div_color_10" onclick="checkboxHoverCategory(this.id)" style="background: gray;" title="Màu xám"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-2 col-2">
                                    <!-- Phần kích cỡ -->
                                    <div class="hover_size_list">
                                        <input type="checkbox" name="size_S" class="hover_size_list_input">
                                        <span class="hover_size_list_text">S</span>
                                    </div>
                                    <div class="hover_size_list">
                                        <input type="checkbox" name="size_M" class="hover_size_list_input">
                                        <span class="hover_size_list_text">M</span>
                                    </div>
                                    <div class="hover_size_list">
                                        <input type="checkbox" name="size_L" class="hover_size_list_input">
                                        <span class="hover_size_list_text">L</span>
                                    </div>
                                    <div class="hover_size_list">
                                        <input type="checkbox" name="size_XL" class="hover_size_list_input">
                                        <span class="hover_size_list_text">XL</span>
                                    </div>
                                    <div class="hover_size_list">
                                        <input type="checkbox" name="size_XXL" class="hover_size_list_input">
                                        <span class="hover_size_list_text">XXL</span>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-7 col-7">
                                    <!-- Phần khoảng giá -->
                                    <div class="hover_price_list">
                                        <input type="radio" name="input_price" value="200000" class="input_price_radio">
                                        <span class="hover_price_list_text">Dưới 200,000</span>
                                    </div>
                                    <div class="hover_price_list">
                                        <input type="radio" name="input_price" value="500000" class="input_price_radio">
                                        <span class="hover_price_list_text">Từ 200,000-500,000</span>
                                    </div>
                                    <div class="hover_price_list">
                                        <input type="radio" name="input_price" value="1000000" class="input_price_radio">
                                        <span class="hover_price_list_text">Từ 500,000-1,000,000</span>
                                    </div>
                                    <div class="hover_price_list">
                                        <input type="radio" name="input_price" value="2000000" class="input_price_radio">
                                        <span class="hover_price_list_text">Trên 1,000,000</span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="hover_button">Áp dụng</button>
                        </form>

                    </div>
                </div>

            </div>
            <div class="app_container_filter_r">
                <div class="app_container_filter_r_title">Sắp xếp theo: </div>
                <select name="" id="" class="app_container_filter_r_select">
                    <option value="">Mới nhất</option>
                    <option value="">Giá giảm dần</option>
                    <option value="">Giá tăng dần</option>
                    <option value="">Sale</option>
                </select>
            </div>
        </div>
        <div class="app_container_product_info">
            <div class="app_container_product_info_number">Hiển thị 24 trong 96 sản phẩm</div>
            <div class="app_container_product_info_page">Trang 1</div>
        </div>
        <div class="app_container_product">

            <div class="row">
                @foreach($product as $item)
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6">
                        <!-- Cần thay đổi data-name tùy thuộc vào tên list sản phẩm -->
                        <!-- id = 'data-name' + 'data-id' -->
                        <div class="product_item" data-id="{{ $item->id }}" data-name="product_category_" data-nameBot="product_category_bot_" id="product_category_{{ $item->id }}" onmouseover="Hoverevent(this.id)" onmouseout="Outevent(this.id)">
                            <div class="product_item_top">
                                <a href="{{ URL::to(to_slug($item->category_name).'/'.to_slug($item->subcategory_name).'/'.to_slug($item->product_name)) }}"><img src="{{ asset($item->product_avatar)}}" alt=""></a>
                                <a href="{{ URL::to(to_slug($item->category_name).'/'.to_slug($item->subcategory_name).'/'.to_slug($item->product_name)) }}" class="product_item_name">{{ $item->product_name }}</a>
                            @if($item->discount_price == 0)
                                <!-- Không giảm giá -->
                                    <div class="product_item_price">
                                        {{ formatPrice($item->product_price)}}
                                    </div>
                            @else
                                <!-- Giảm giá -->
                                    <div class="product_item_price product_item_price_flex">
                                        <div class="product_item_price_new">{{ formatPriceSale($item->product_price,$item->discount_price)}}</div>
                                        <div class="product_item_price_old">{{ formatPrice($item->product_price)}}</div>
                                    </div>
                                @endif
                            </div>
                            <!-- id = 'data-nameBot' + 'data-id' -->
                            <div class="product_item_bot" id="product_category_bot_{{ $item->id }}">
                                <div class="product_item_bot_l">
                                    <label for="input_checkbox_product" class="ti-shopping-cart product_item_bot_link"  onclick="checkboxProduct(this.id)"> <span>Mua nhanh</span></label>
                                </div>
                                <div class="product_item_bot_r">
                                    <a href="{{ URL::to(to_slug($item->category_name).'/'.to_slug($item->subcategory_name).'/'.to_slug($item->product_name)) }}" class="product_item_bot_link"><span class="ti-eye"></span>  <span>Xem chi tiết</span></a>
                                </div>
                            </div>
                            <!-- Yêu thích -->
                            <div class="product_item_favourite">
                                <!-- Chưa yêu thích -->
                                <span class="product_item_favourite_link"><span class="ti-heart product_item_favourite_noheart" data-id="{{ $item->id }}" data-name-no="new_noFavourite_" data-name-have="new_haveFavourite_" id="new_noFavourite_{{ $item->id }}" onclick="addFavourite(this.id)"></span></span>
                                <!-- <span class="product_item_favourite_link"><i class="far fa-heart product_item_favourite_heart" aria-hidden="true" id="Favourite_1" onclick="Favourite(this.id)"></i></span> -->
                                <!-- Đã yêu thích -->
                                <span class="product_item_favourite_link"><i class="fas fa-heart product_item_favourite_heart hidden_heart" aria-hidden="true" data-id="{{ $item->id }}" data-name-no="new_noFavourite_" data-name-have="new_haveFavourite_" id="new_haveFavourite_{{ $item->id }}" onclick="removeFavourite(this.id)"></i></span>

                            </div>
                        @if($item->discount_price == '0' || $item->discount_price == null)
                        @else
                            <!-- Giảm giá -->
                                <div class="product_item_sale">
                                    <div class="product_item_sale_percent">
                                        {{ $item->discount_price }}%
                                    </div>
                                    <div class="product_item_sale_percent_text">
                                        GIẢM
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row" style="margin: 20px auto">
                {{ $product->links() }}
            </div>
            {{--            <div class="app_container_product_page">--}}

            {{--                <ul class="app_container_product_page_list">--}}
            {{--                    <li class="app_container_product_page_item app_container_product_page_active"><a href="" class="app_container_product_page_link app_container_product_page_link_active">1</a></li>--}}
            {{--                    <li class="app_container_product_page_item"><a href="" class="app_container_product_page_link">2</a></li>--}}
            {{--                    <li class="app_container_product_page_item"><a href="" class="app_container_product_page_link">3</a></li>--}}
            {{--                    <li class="app_container_product_page_item"><a href="" class="app_container_product_page_link">4</a></li>--}}
            {{--                    <li class="app_container_product_page_item"><a href="" class="app_container_product_page_link">5</a></li>--}}
            {{--                </ul>--}}
            {{--            </div>--}}
        </div>
    </div>

    <!-- END CONTAINER -->

@endsection
