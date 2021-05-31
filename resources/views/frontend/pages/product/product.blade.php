@extends('frontend.layouts.frontend_layout')
@section('frontend_title')

    <title>{{ $product->product_name }}</title>

@endsection
@section('frontend_css')
    <link rel="stylesheet" href="{{ asset('public/frontend/css/product.css')}}">
    <!-- Carousel -->
    <link rel="stylesheet" href="{{ asset('public/frontend/OwlCarousel/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/frontend/OwlCarousel/dist/assets/owl.theme.default.min.css')}}">
@endsection
@section('frontend_js')
    <!-- OWlcarousel -->
    <script src="{{ asset('public/frontend/OwlCarousel/dist/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('public/frontend/js/product.js')}}"></script>

@endsection

@section('frontend_content')

    <!-- CONTAINER -->

    <div class="container app_container">
        <div class="app_container_top">
            <a href="{{ route('fe.index') }}" class="app_container_top_to"><i class="fas fa-home"></i> Trang chủ</a>
            <a href="{{ URL::to('/'. to_slug($product->category_name).'/'. to_slug($product->subcategory_name)) }}" class="app_container_top_to">{{ $product->subcategory_name }}</a>
            <span class="app_container_top_from">{{ $product->product_name }}</span>
        </div>
        <!-- Chi tiết sản phẩm -->
        <div class="app_container_product">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="app_container_product_images">
                        <div class="app_container_product_images_big_content">
                            <div class="app_container_product_images_big">
                                <img src="{{ URL::to($product->product_avatar)  }}" alt="" id="product_images_big" class="product_images_big">
                                <div class="app_container_product_images_big_zoom" id="product_images_big_zoom"></div>
                            </div>

                        </div>
                        <div class="app_container_product_images_small">
                            <div class="owl-one owl-carousel owl-theme owl-loaded">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage">
                                        @php
                                            $product_images_big = $product->product_images_big;
                                            $dataImages = explode('|', $product_images_big);

                                        @endphp
                                        <!-- id = image_(id_product)_(Tên đuôi ảnh) -->
                                        @foreach($dataImages as $item)
                                            @php
                                                $dataImage = explode('/', $item);
                                                $dataName = explode('.',$dataImage[count($dataImage) -1]);
                                                $id_image = 'image_' . $product->id . '_' . $dataName[0];
                                            @endphp
                                        <div class="owl-item">

                                            <img src="{{ asset($item)}}" onclick="changeImage(this.id)" id="{{ $id_image }}" data-target-image="{{ asset($item)}}" alt="" class="app_container_product_images_small_img">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="owl-nav">
                                <div class="owl-prev customPrevBtn app_container_product_images_small_prev"><i class="fas fa-arrow-circle-left"></i></div>
                                <div class="owl-next customNextBtn app_container_product_images_small_next"><i class="fas fa-arrow-circle-right"></i></div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="app_container_product_info">
                        <div class="app_container_product_info_name">
                            {{ $product->product_name }}
                        </div>
                        <div class="app_container_product_info_code">
                            <div class="app_container_product_info_code_text">Mã sản phẩm: </div>
                            <div class="app_container_product_info_code_name">{{ $product->product_code }}</div>
                        </div>
                        @if($product->discount_price == '0' || $product->discount_price == null)
                        <div class="app_container_product_info_price">
                            {{ formatPrice($product->product_price) }}
                        </div>
                        @else
                        <div class="app_container_product_info_sale">
                            <div class="app_container_product_info_sale_new">{{ formatPriceSale($product->product_price, $product->discount_price) }}</div>
                            <div class="app_container_product_info_sale_old">{{ formatPrice($product->product_price) }}</div>
                        </div>
                        @endif
                        <form action="" id="product_form">
                            <div class="product_color owl-dots">
                                <ul>
                                    @php
                                        $product_image_color = $product->product_image_color;
                                        $product_color_name = $product->product_color_name;
                                        $data_image_color = explode('|', $product_image_color);
                                        $data_color_name = explode(',', $product_color_name);
                                        $count = (count($data_image_color) > count($data_color_name)) ? count($data_color_name) : count($data_image_color);
                                        $dataImageTarget = array();
                                        for($i = 0; $i < $count; $i++){
                                            $dataImageTarget[$i]['image_color'] = $data_image_color[$i];
                                            $dataImageTarget[$i]['title_color'] = $data_color_name[$i];
                                        }
                                    @endphp
                                    @foreach($dataImageTarget as $key => $item)
                                        @php
                                            $product_id = $product->id;
                                            $product_color = $item['title_color'];
                                            $pro_detail = DB::table('product_detail')->where('product_id', $product_id)->where('product_color', $product_color)->select(DB::raw('sum(product_qty) as sum'))->first();

                                            $pro_detail_sum = intval($pro_detail->sum);
                                        @endphp
                                        <li class="product_color_list owl-dot" data-id-product="{{ $product->id }}" data-id="{{ $item['title_color'] }}" data-name="product_color_" id="product_color_{{ $item['title_color'] }}" @if($pro_detail_sum == 0)  data-disabled="true" @else data-disabled="false" @endif onclick="changeBorderColor(this.id)" onmouseover="hoverBorderColor(this.id)" onmouseout="outBorderColor(this.id)">
                                            <div class="app_modal_product_color_radio" @if($pro_detail_sum == 0) style="background: url({{ URL::to('public/frontend/images/product/product_nano/soldout.png')  }}) no-repeat center center;background-size: contain;"  @endif>
                                                <input type="radio" name="colorID" value="{{ $item['title_color'] }}" class="product_color_radio_input"  @if($pro_detail_sum == 0) disabled  @endif>
                                                <div class="product_color_radio_btn @if($pro_detail_sum == 0) app_modal_product_soldout  @endif"  style="background: url({{ URL::to($item['image_color']) }}) no-repeat center center;width: 25px;height: 30px;"
                                                     data-bs-target="#carouselProduct" data-bs-slide-to="{{ $key }}" class="active product_images_small" aria-current="true" aria-label="Slide {{ $key+1 }}"></div>
                                            </div>
                                            <div class="product_color_list_title">
                                                {{ $item['title_color'] }}
                                            </div>
                                        </li>
                                    @endforeach
                                    <!-- Nếu hết màu sản phầm -->
{{--                                    <li class="product_color_list owl-dot" data-id="2" data-name="product_color_" id="product_color_2"  onclick="changeBorderColor(this.id)" onmouseover="hoverBorderColor(this.id)" onmouseout="outBorderColor(this.id)">--}}
{{--                                        <div class="product_color_radio" style="background: url({{ URL::to('public/frontend/images/product/product_nano/soldout.png')  }}) no-repeat center center;background-size: contain;">--}}
{{--                                            <input type="radio" name="colorID" value="2" class="product_color_radio_input">--}}
{{--                                            <div class="product_color_radio_btn app_modal_product_soldout" style="background: url('{{ asset('public/frontend/images/product/product_nano/p2.jpg')}}') no-repeat center center;width: 25px;height: 30px;"--}}
{{--                                                 data-bs-target="#carouselProduct" data-bs-slide-to="1" class="active product_images_small" aria-current="true" aria-label="Slide 2"></div>--}}
{{--                                        </div>--}}
{{--                                        <div class="product_color_list_title">--}}
{{--                                            Màu hồng--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
                                </ul>
                            </div>
                            <div class="product_size" id="product_size">

                            </div>
                            <div class="product_number">
                                <input type="button" onclick="MinusQty()" class="product_number_btn" value="-">
                                <input type="text" oninput="InputQty()" name="productQty" id="productQty" value="1" min="1" class="product_number_qty">
                                <input type="button" onclick="PlusQty()" class="product_number_btn" value="+">
                            </div>
                            <div class="product_error">
                                <div class="product_error_list" id="product_error_1">Vui lòng chọn kích thước!</div>
                                <div class="product_error_list" id="product_error_2">Vui lòng chọn màu sác và kích thước!</div>
                                <div class="product_error_list" id="product_error_3">Vui lòng chọn màu sắc!</div>
                            </div>
                            <div class="app_container_product_info_submit">
                                <input type="hidden" name="maxQty" id="maxQty">
                                <button type="submit" class="product_submit">Thêm vào giỏ hàng</button>
                            </div>

                        </form>
                        <!-- Thông tin thêm -->
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item accordion-item_product">
                                <h2 class="accordion-header" id="headingOne_product">
                                    <button class="accordion-button accordion-button_product collapsed collapsed_product" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        CHI TIẾT SẢN PHẨM
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne_product" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <!-- Content -->
                                        <div class="product_info_content">
                                            {!! $product->product_content !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item accordion-item_product">
                                <h2 class="accordion-header" id="headingTwo_product">
                                    <button class="accordion-button accordion-button_product collapsed collapsed_product" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        GỢI Ý PHỐI ĐỒ
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo_product" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <!-- Content -->
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item accordion-item_product">
                                <h2 class="accordion-header" id="headingThree_product">
                                    <button class="accordion-button accordion-button_product collapsed collapsed_product" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        GIAO HÀNG VÀ TRẢ HÀNG
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree_product" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <!-- Content -->
                                        <div class="product_info_shipping">
                                            <div class="product_info_shipping_list">
                                                <span class="ti-shopping-cart-full"></span>
                                                <div class="product_info_shipping_list_text">
                                                    Đơn hàng có hóa đơn thanh toán nguyên giá từ 500k hoặc đơn hàng đã thanh toán bằng hình thức chuyển khoản, qua ví điện tử online: áp dụng freeship (phí ship 0 đồng)
                                                </div>
                                            </div>
                                            <div class="product_info_shipping_list">
                                                <span class="ti-shopping-cart-full"></span>
                                                <div class="product_info_shipping_list_text">
                                                    Đơn hàng có hóa đơn thanh toán từ 500k trở lên và có chứa sản phẩm giảm giá: áp dụng phí ship 20.000đ
                                                </div>
                                            </div>
                                            <div class="product_info_shipping_list">
                                                <span class="ti-shopping-cart-full"></span>
                                                <div class="product_info_shipping_list_text">
                                                    Đơn hàng có hóa đơn thanh toán dưới 500k: Áp dụng thu phí ship 30.000đ
                                                </div>
                                            </div>
                                            <div class="product_info_shipping_list">
                                                <span class="ti-shopping-cart-full"></span>
                                                <div class="product_info_shipping_list_text">
                                                    Đơn hàng nội thành Hà Nội cần ship nhanh trong 6h: áp dụng thu phí ship 40.000đ
                                                </div>
                                            </div>
                                            <div class="product_info_shipping_list">
                                                <span class="ti-shopping-cart-full"></span>
                                                <div class="product_info_shipping_list_text">
                                                    Toàn bộ đơn hàng online đều không áp dụng đồng kiểm (xem hàng trước khi nhận)
                                                </div>
                                            </div>
                                            <div class="product_info_shipping_list">
                                                <span class="ti-shopping-cart-full"></span>
                                                <div class="product_info_shipping_list_text">
                                                    Khách hàng thanh toán, nhận hàng đều được áp dụng chính sách đổi trả theo quy định đổi trả của công ty.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item accordion-item_product">
                                <h2 class="accordion-header" id="headingFour_product">
                                    <button class="accordion-button accordion-button_product collapsed collapsed_product" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        CHẤT LIỆU VÀ CHĂM SÓC
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour_product" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <!-- Content -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sản phẩm cùng loại -->
        <div class="app_container_product_related">
            <div class="app_container_product_related_top">
                <div class="app_container_product_related_title">Sản phẩm liên quan</div>
                <div class="app_container_product_related_move">
                    <div class="owl-prev2 customPrevBtn2 "><i class="fas fa-chevron-left"></i></div>
                    <div class="owl-next2 customNextBtn2"><i class="fas fa-chevron-right"></i></div>
                </div>
            </div>


            <div class="owl-two owl-carousel owl-theme owl-loaded">
                <div class="owl-stage-outer">
                    <div class="owl-stage">
                        <div class="owl-item">
                            <div class="product_item" data-id="1" data-name="product_related_" data-nameBot="product_related_bot_" id="product_related_1" onmouseover="Hoverevent(this.id)" onmouseout="Outevent(this.id)">
                                <div class="product_item_top">
                                    <a href=""><img src="{{ asset('public/frontend/images/product/avatar_b/p1.jpg')}}" alt=""></a>
                                    <a href="" class="product_item_name">Áo polo coolmax Germany TP065</a>
                                    <!-- Không giảm giá -->
                                    <div class="product_item_price">
                                        <!-- 380,000 <span class="price_d">đ</span> -->
                                    </div>
                                    <!-- Giảm giá -->
                                    <div class="product_item_price product_item_price_flex">
                                        <div class="product_item_price_new">200,000 <span class="price_d">đ</span></div>
                                        <div class="product_item_price_old">380,000 <span class="price_d">đ</span></div>
                                    </div>
                                </div>
                                <!-- id = 'data-nameBot' + 'data-id' -->
                                <div class="product_item_bot" id="product_related_bot_1">
                                    <div class="product_item_bot_l">
                                        <label for="input_checkbox_product" class="ti-shopping-cart product_item_bot_link"  onclick="checkboxProduct(this.id)"> <span>Mua nhanh</span></label>
                                    </div>
                                    <div class="product_item_bot_r">
                                        <a href="" class="product_item_bot_link"><span class="ti-eye"></span>  <span>Xem chi tiết</span></a>
                                    </div>
                                </div>
                                <!-- Yêu thích -->
                                <div class="product_item_favourite">
                                    <!-- Chưa yêu thích -->
                                    <span class="product_item_favourite_link"><span class="ti-heart product_item_favourite_noheart" data-id="1" data-name-no="related_noFavourite_" data-name-have="related_haveFavourite_" id="related_noFavourite_1" onclick="addFavourite(this.id)"></span></span>
                                    <!-- <span class="product_item_favourite_link"><i class="far fa-heart product_item_favourite_heart" aria-hidden="true" id="Favourite_1" onclick="Favourite(this.id)"></i></span> -->
                                    <!-- Đã yêu thích -->
                                    <span class="product_item_favourite_link"><i class="fas fa-heart product_item_favourite_heart hidden_heart" aria-hidden="true" data-id="1" data-name-no="related_noFavourite_" data-name-have="related_haveFavourite_" id="related_haveFavourite_1" onclick="removeFavourite(this.id)"></i></span>

                                </div>
                                <!-- Giảm giá -->
                                <div class="product_item_sale">
                                    <div class="product_item_sale_percent">
                                        10%
                                    </div>
                                    <div class="product_item_sale_percent_text">
                                        GIẢM
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-item">
                            <div class="product_item" data-id="2" data-name="product_related_" data-nameBot="product_related_bot_" id="product_related_2" onmouseover="Hoverevent(this.id)" onmouseout="Outevent(this.id)">
                                <div class="product_item_top">
                                    <a href=""><img src="{{ asset('public/frontend/images/product/avatar_b/p1.jpg')}}" alt=""></a>
                                    <a href="" class="product_item_name">Áo polo coolmax Germany TP065</a>
                                    <!-- Không giảm giá -->
                                    <div class="product_item_price">
                                        <!-- 380,000 <span class="price_d">đ</span> -->
                                    </div>
                                    <!-- Giảm giá -->
                                    <div class="product_item_price product_item_price_flex">
                                        <div class="product_item_price_new">200,000 <span class="price_d">đ</span></div>
                                        <div class="product_item_price_old">380,000 <span class="price_d">đ</span></div>
                                    </div>
                                </div>
                                <!-- id = 'data-nameBot' + 'data-id' -->
                                <div class="product_item_bot" id="product_related_bot_2">
                                    <div class="product_item_bot_l">
                                        <label for="input_checkbox_product" class="ti-shopping-cart product_item_bot_link"  onclick="checkboxProduct(this.id)"> <span>Mua nhanh</span></label>
                                    </div>
                                    <div class="product_item_bot_r">
                                        <a href="" class="product_item_bot_link"><span class="ti-eye"></span>  <span>Xem chi tiết</span></a>
                                    </div>
                                </div>
                                <!-- Yêu thích -->
                                <div class="product_item_favourite">
                                    <!-- Chưa yêu thích -->
                                    <span class="product_item_favourite_link"><span class="ti-heart product_item_favourite_noheart" data-id="2" data-name-no="related_noFavourite_" data-name-have="related_haveFavourite_" id="related_noFavourite_2" onclick="addFavourite(this.id)"></span></span>
                                    <!-- <span class="product_item_favourite_link"><i class="far fa-heart product_item_favourite_heart" aria-hidden="true" id="Favourite_1" onclick="Favourite(this.id)"></i></span> -->
                                    <!-- Đã yêu thích -->
                                    <span class="product_item_favourite_link"><i class="fas fa-heart product_item_favourite_heart hidden_heart" aria-hidden="true" data-id="2" data-name-no="related_noFavourite_" data-name-have="related_haveFavourite_" id="related_haveFavourite_2" onclick="removeFavourite(this.id)"></i></span>

                                </div>
                                <!-- Giảm giá -->
                                <div class="product_item_sale">
                                    <div class="product_item_sale_percent">
                                        10%
                                    </div>
                                    <div class="product_item_sale_percent_text">
                                        GIẢM
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-item">
                            <div class="product_item" data-id="3" data-name="product_related_" data-nameBot="product_related_bot_" id="product_related_3" onmouseover="Hoverevent(this.id)" onmouseout="Outevent(this.id)">
                                <div class="product_item_top">
                                    <a href=""><img src="{{ asset('public/frontend/images/product/avatar_b/p1.jpg')}}" alt=""></a>
                                    <a href="" class="product_item_name">Áo polo coolmax Germany TP065</a>
                                    <!-- Không giảm giá -->
                                    <div class="product_item_price">
                                        <!-- 380,000 <span class="price_d">đ</span> -->
                                    </div>
                                    <!-- Giảm giá -->
                                    <div class="product_item_price product_item_price_flex">
                                        <div class="product_item_price_new">200,000 <span class="price_d">đ</span></div>
                                        <div class="product_item_price_old">380,000 <span class="price_d">đ</span></div>
                                    </div>
                                </div>
                                <!-- id = 'data-nameBot' + 'data-id' -->
                                <div class="product_item_bot" id="product_related_bot_3">
                                    <div class="product_item_bot_l">
                                        <label for="input_checkbox_product" class="ti-shopping-cart product_item_bot_link"  onclick="checkboxProduct(this.id)"> <span>Mua nhanh</span></label>
                                    </div>
                                    <div class="product_item_bot_r">
                                        <a href="" class="product_item_bot_link"><span class="ti-eye"></span>  <span>Xem chi tiết</span></a>
                                    </div>
                                </div>
                                <!-- Yêu thích -->
                                <div class="product_item_favourite">
                                    <!-- Chưa yêu thích -->
                                    <span class="product_item_favourite_link"><span class="ti-heart product_item_favourite_noheart" data-id="3" data-name-no="related_noFavourite_" data-name-have="related_haveFavourite_" id="related_noFavourite_3" onclick="addFavourite(this.id)"></span></span>
                                    <!-- <span class="product_item_favourite_link"><i class="far fa-heart product_item_favourite_heart" aria-hidden="true" id="Favourite_1" onclick="Favourite(this.id)"></i></span> -->
                                    <!-- Đã yêu thích -->
                                    <span class="product_item_favourite_link"><i class="fas fa-heart product_item_favourite_heart hidden_heart" aria-hidden="true" data-id="3" data-name-no="related_noFavourite_" data-name-have="related_haveFavourite_" id="related_haveFavourite_3" onclick="removeFavourite(this.id)"></i></span>

                                </div>
                                <!-- Giảm giá -->
                                <div class="product_item_sale">
                                    <div class="product_item_sale_percent">
                                        10%
                                    </div>
                                    <div class="product_item_sale_percent_text">
                                        GIẢM
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-item">
                            <div class="product_item" data-id="4" data-name="product_related_" data-nameBot="product_related_bot_" id="product_related_4" onmouseover="Hoverevent(this.id)" onmouseout="Outevent(this.id)">
                                <div class="product_item_top">
                                    <a href=""><img src="{{ asset('public/frontend/images/product/avatar_b/p1.jpg')}}" alt=""></a>
                                    <a href="" class="product_item_name">Áo polo coolmax Germany TP065</a>
                                    <!-- Không giảm giá -->
                                    <div class="product_item_price">
                                        <!-- 380,000 <span class="price_d">đ</span> -->
                                    </div>
                                    <!-- Giảm giá -->
                                    <div class="product_item_price product_item_price_flex">
                                        <div class="product_item_price_new">200,000 <span class="price_d">đ</span></div>
                                        <div class="product_item_price_old">380,000 <span class="price_d">đ</span></div>
                                    </div>
                                </div>
                                <!-- id = 'data-nameBot' + 'data-id' -->
                                <div class="product_item_bot" id="product_related_bot_4">
                                    <div class="product_item_bot_l">
                                        <label for="input_checkbox_product" class="ti-shopping-cart product_item_bot_link"  onclick="checkboxProduct(this.id)"> <span>Mua nhanh</span></label>
                                    </div>
                                    <div class="product_item_bot_r">
                                        <a href="" class="product_item_bot_link"><span class="ti-eye"></span>  <span>Xem chi tiết</span></a>
                                    </div>
                                </div>
                                <!-- Yêu thích -->
                                <div class="product_item_favourite">
                                    <!-- Chưa yêu thích -->
                                    <span class="product_item_favourite_link"><span class="ti-heart product_item_favourite_noheart" data-id="4" data-name-no="related_noFavourite_" data-name-have="related_haveFavourite_" id="related_noFavourite_4" onclick="addFavourite(this.id)"></span></span>
                                    <!-- <span class="product_item_favourite_link"><i class="far fa-heart product_item_favourite_heart" aria-hidden="true" id="Favourite_1" onclick="Favourite(this.id)"></i></span> -->
                                    <!-- Đã yêu thích -->
                                    <span class="product_item_favourite_link"><i class="fas fa-heart product_item_favourite_heart hidden_heart" aria-hidden="true" data-id="4" data-name-no="related_noFavourite_" data-name-have="related_haveFavourite_" id="related_haveFavourite_4" onclick="removeFavourite(this.id)"></i></span>

                                </div>
                                <!-- Giảm giá -->
                                <div class="product_item_sale">
                                    <div class="product_item_sale_percent">
                                        10%
                                    </div>
                                    <div class="product_item_sale_percent_text">
                                        GIẢM
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-item">
                            <div class="product_item" data-id="5" data-name="product_related_" data-nameBot="product_related_bot_" id="product_related_5" onmouseover="Hoverevent(this.id)" onmouseout="Outevent(this.id)">
                                <div class="product_item_top">
                                    <a href=""><img src="{{ asset('public/frontend/images/product/avatar_b/p1.jpg')}}" alt=""></a>
                                    <a href="" class="product_item_name">Áo polo coolmax Germany TP065</a>
                                    <!-- Không giảm giá -->
                                    <div class="product_item_price">
                                        <!-- 380,000 <span class="price_d">đ</span> -->
                                    </div>
                                    <!-- Giảm giá -->
                                    <div class="product_item_price product_item_price_flex">
                                        <div class="product_item_price_new">200,000 <span class="price_d">đ</span></div>
                                        <div class="product_item_price_old">380,000 <span class="price_d">đ</span></div>
                                    </div>
                                </div>
                                <!-- id = 'data-nameBot' + 'data-id' -->
                                <div class="product_item_bot" id="product_related_bot_5">
                                    <div class="product_item_bot_l">
                                        <label for="input_checkbox_product" class="ti-shopping-cart product_item_bot_link"  onclick="checkboxProduct(this.id)"> <span>Mua nhanh</span></label>
                                    </div>
                                    <div class="product_item_bot_r">
                                        <a href="" class="product_item_bot_link"><span class="ti-eye"></span>  <span>Xem chi tiết</span></a>
                                    </div>
                                </div>
                                <!-- Yêu thích -->
                                <div class="product_item_favourite">
                                    <!-- Chưa yêu thích -->
                                    <span class="product_item_favourite_link"><span class="ti-heart product_item_favourite_noheart" data-id="5" data-name-no="related_noFavourite_" data-name-have="related_haveFavourite_" id="related_noFavourite_5" onclick="addFavourite(this.id)"></span></span>
                                    <!-- <span class="product_item_favourite_link"><i class="far fa-heart product_item_favourite_heart" aria-hidden="true" id="Favourite_1" onclick="Favourite(this.id)"></i></span> -->
                                    <!-- Đã yêu thích -->
                                    <span class="product_item_favourite_link"><i class="fas fa-heart product_item_favourite_heart hidden_heart" aria-hidden="true" data-id="5" data-name-no="related_noFavourite_" data-name-have="related_haveFavourite_" id="related_haveFavourite_5" onclick="removeFavourite(this.id)"></i></span>

                                </div>
                                <!-- Giảm giá -->
                                <div class="product_item_sale">
                                    <div class="product_item_sale_percent">
                                        10%
                                    </div>
                                    <div class="product_item_sale_percent_text">
                                        GIẢM
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END CONTAINER -->
    <script type="text/javascript">
        function changeBorderColor(id){
            // console.log(id);
            var idColor = '#' + id;
            var dataId = $(idColor).attr('data-id');
            var dataName = $(idColor).attr('data-name');
            var idInput = '#' + 'input_color_' + idColor;
            var disableInput = $(idColor).attr('data-disabled');
            var idProduct = $(idColor).attr('data-id-product');
            // console.log(dataId);
            $('.product_color_list').css('border', '2px solid transparent');
            if(disableInput == 'false'){
                $(idColor).css({'border' : '2px solid red'});
                // Gán giá trị từ numberId đễ input radio check
                // $('input:radio[name=colorID][value='+numberId+']').prop('checked',true);
                $('[name=colorID]').val([dataId]);
                var myRadio = $('input[name=colorID]:checked').val();
                // console.log(myRadio);
                // console.log(idProduct);
                $('#productQty').val(1);
                $.ajax({
                    url: "{{ url('product/product_size/') }}/" + idProduct + '/' + myRadio,
                    type: "GET",
                    success:function (data){
                        $('#product_size').html(data);
                    }
                });
            }else{
                $(idColor).css({'border' : '2px solid transparent'});
                // Lấy giá trị khi đã check
                var myRadio = $('input[name=colorID]:checked').val();
                if(myRadio != null){

                    var isChecked = '#' + dataName + myRadio;
                    $(isChecked).css({'border' : '2px solid red'});
                }
            }

        }
    </script>
    <script type="text/javascript">
        function changeBorderSize(id){
            var idClick = '#' + id;
            var dataId = $(idClick).attr('data-id');
            var dataName = $(idClick).attr('data-name');
            var disableInput = $(idClick).attr('data-disabled');
            var idProduct = $(idClick).attr('data-id-product');
            var colorProduct = $('input:radio[name=colorID]').val();
            console.log(idProduct);
            console.log(colorProduct);
            $('.product_size_list').css({'border' : '2px solid transparent'});
            if(disableInput == 'false'){
                var sizeProduct = $(idClick).attr('data-id');
                console.log(sizeProduct);
                $(idClick).css({'border' : '2px solid red'});
                $('input:radio[name=sizeID][value='+dataId+']').prop('checked','true');
                $('#productQty').val(1);
                $.ajax({
                    url: "{{ url('product/product_detail') }}/" + idProduct + '/' + colorProduct + '/' + sizeProduct,
                    type: "GET",
                    dataType: "json",
                    success:function (data){
                        console.log(data.dataproduct.product_qty);
                        $('#maxQty').val(data.dataproduct.product_qty);
                        $('#productQty').attr('max', data.dataproduct.product_qty);

                    }
                })
            }else{
                $(idClick).css({'border' : '2px solid transparent'});
                var myRadio = $('input[name=sizeID]:checked').val();
                if(myRadio != null){
                    // console.log(myRadio);
                    var isChecked = '#' + dataName + myRadio;
                    $(isChecked).css({'border' : '2px solid red'});
                }
            }

        }
    </script>
@endsection
