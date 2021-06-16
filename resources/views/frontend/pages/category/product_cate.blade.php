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
                    <label for="input_checkbox_product" class="ti-shopping-cart product_item_bot_link" id="{{ $item->id }}"  onclick="checkboxProduct(this.id)"> <span>Mua nhanh</span></label>
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
