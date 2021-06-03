@php
    $product_images_small = $product->product_images_small;
    $data_small = explode('|', $product_images_small);

@endphp

<div class="app_modal_product_content_top carousel slide" id="carouselProduct" data-bs-interval="false"  data-bs-ride="carousel">
    <div class="app_modal_product_content_l">
        @foreach($data_small as $key => $item)
        <img src="{{ asset($item) }}" alt="" data-bs-target="#carouselProduct" data-bs-slide-to="{{ $key }}" class="@if($key == 0)  active @endif app_modal_product_images_small" @if($key == 0) aria-current="true" @endif aria-label="Slide {{ $key + 1 }}">
        @endforeach

    </div>
    <div class="app_modal_product_content_b carousel-inner">
        @foreach($data_small as $key => $item)
        <div class="carousel-item @if($key == 0) active @endif">
            <img src="{{ asset($item)}}" class="d-block w-100" alt="...">
        </div>
        @endforeach
    </div>
    <div class="app_modal_product_content_r">
        <label for="input_checkbox_product" class="app_modal_product_content_r_close"  >
            <span class="ti-close"></span>
        </label>
        <div class="app_modal_product_name" id="app_modal_product_name">{{ $product->product_name }}</div>
        <!-- Khi không có giảm giá -->
        @if($product->discount_price == 0 | $product->discount_price == null)
        <div class="app_modal_product_price">
            <span>{{ formatPrice($product->product_price) }}</span>
        </div>
        @else
        <!-- Khi có giảm giá -->
        <div class="app_modal_product_price_sale">
            <div class="app_modal_product_price_new">
                <span>{{ formatPriceSale($product->product_price, $product->discount_price) }}</span>
            </div>
            <div class="app_modal_product_price_old">
                <span>{{ formatPrice($product->product_price) }}</span>
            </div>
        </div>
        @endif
        <form action="{{ route('modal.product.submit') }}" method="POST" id="modal_product_form">
            @csrf
            <div class="app_modal_product_color">
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
                        <li class="app_modal_product_color_list" data-id-product="{{ $product->id }}" data-id="{{ to_slug($item['title_color']) }}" data-name="modal_product_color_" id="modal_product_color_{{ to_slug($item['title_color']) }}" @if($pro_detail_sum == 0)  data-disabled="true" @else data-disabled="false" @endif onclick="modalChangeBorderColor(this.id)" onmouseover="modalHoverBorderColor(this.id)" onmouseout="modalOutBorderColor(this.id)">
                            <div class="app_modal_product_color_radio" @if($pro_detail_sum == 0) style="background: url({{ URL::to('public/frontend/images/product/product_nano/soldout.png')  }}) no-repeat center center;background-size: contain;"  @endif>
                                <input type="radio" name="modalColorID" value="{{ to_slug($item['title_color']) }}" class="app_modal_product_color_radio_input" @if($pro_detail_sum == 0) disabled  @endif required>
                                <div class="app_modal_product_color_radio_btn @if($pro_detail_sum == 0) app_modal_product_soldout  @endif" style="background: url({{ URL::to($item['image_color']) }}) no-repeat center center;width: 25px;height: 30px;"
                                     data-bs-target="#carouselProduct" data-bs-slide-to="{{ $key }}" class="active app_modal_product_images_small" aria-current="true" aria-label="Slide {{ $key +1 }}"></div>
                            </div>
                            <div class="app_modal_product_color_list_title">
                                {{ $item['title_color'] }}
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>
            <div class="app_modal_product_size" id="app_modal_product_size">

            </div>
            <div class="app_modal_product_number">
                <input type="button" onclick="modalMinusQty()" class="app_modal_product_number_btn" value="-">
                <input type="text" oninput="modalInputQty()" name="modalQty" id="modalQty" value="1" min="1" class="app_modal_product_number_qty">
                <input type="button" onclick="modalPlusQty()" class="app_modal_product_number_btn" value="+">
            </div>
            <div class="modal_product_error">
                <div class="modal_product_error_list" id="modal_product_error_1">Vui lòng chọn kích thước!</div>
                <div class="modal_product_error_list" id="modal_product_error_2">Vui lòng chọn màu sác và kích thước!</div>
                <div class="modal_product_error_list" id="modal_product_error_3">Vui lòng chọn màu sắc!</div>
            </div>
            <div class="app_modal_product_button">
                <input type="hidden" name="maxModalQty" id="maxModalQty">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="button" class="app_modal_product_submit" onclick="submitModalProduct()">Thêm vào giỏ hàng</button>
            </div>
        </form>
    </div>
</div>
<div class="app_modal_product_content_bottom">
    <a href="" class="app_modal_product_content_bottom_link">Xem chi tiết</a>
</div>
