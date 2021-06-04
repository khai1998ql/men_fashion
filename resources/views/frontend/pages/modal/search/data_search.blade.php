<div class="app_modal_search_product">
    @foreach($product as $item)
    <div class="app_modal_search_product_list">
        <div class="app_modal_search_product_list_img">
            <a href="{{ URL::to(to_slug($item->category_name) . '/' .to_slug($item->subcategory_name) . '/' . to_slug($item->product_name)) }}"><img src="{{ asset($item->product_avatar)}}" alt=""></a>
        </div>
        <div class="app_modal_search_product_list_content">
            <a href="{{ URL::to(to_slug($item->category_name) . '/' .to_slug($item->subcategory_name) . '/' . to_slug($item->product_name)) }}" class="app_modal_search_product_list_content_name">{{ $item->product_name }}</a>
            @if($item->discount_price == 0 || $item->discount_price == null)
            <span class="app_modal_search_product_list_content_price">{{ formatPrice($item->product_price) }}</span>
            @else
            <div class="app_modal_search_product_list_content_sale">
                <div class="app_modal_search_product_list_content_sale_new">
                    {{ formatPriceSale($item->product_price, $item->discount_price) }}
                </div>
                <div class="app_modal_search_product_list_content_sale_old">
                    {{ formatPrice($item->product_price) }}
                </div>
            </div>
            @endif
        </div>

    </div>
    <hr>
    @endforeach
</div>
