<div class="shopping_cart_product">
@if(Cart::count() == 0)
    <!-- Nếu không có sản phẩm trong giỏ hàng -->
        <hr style="margin-top: 20px;margin-bottom: 20px;">
        <span>Hiện chưa có sản phẩm trong giỏ hàng.</span>
@else
    <!-- Nếu có sản phẩm trong giỏ hàng -->
        @foreach(Cart::content() as $item)
            <div id="modal_cart_product_{{ $item->rowId }}">
                <hr style="margin-top: 20px;margin-bottom: 20px;">
                <div class="shopping_cart_product_list">
                    <div class="shopping_cart_product_list_img">
                        <a href="{{ URL::to(to_slug($item->options->category_name). '/' . to_slug($item->options->subcategory_name). '/' . to_slug($item->name)) }}"><img src="{{ URL::to($item->options->avatar) }}" alt=""></a>
                    </div>
                    <div class="shopping_cart_product_list_content">
                        <a href="{{ URL::to(to_slug($item->options->category_name). '/' . to_slug($item->options->subcategory_name). '/' . to_slug($item->name)) }}" class="shopping_cart_product_list_content_link">
                            {{ $item->name }} - {{ $item->options->color }} - {{ $item->options->size }}
                        </a>
                        <div class="shopping_cart_product_list_price">
                            <span>{{ formatPrice($item->price) }}</span><span style="font-weight: 800;"> x </span> <span id="modal_number_{{ $item->rowId }}">{{ $item->qty }}</span>
                        </div>
                        <span class="shopping_cart_product_list_content_remove" data-qty="{{ intval($item->qty) }}" data-price="{{ intval($item->price) }}" data-value="{{ intval($item->price) * intval($item->qty) }}" data-id="{{ $item->rowId }}" id="modalRemove_{{ $item->rowId }}" onclick="modalRemoveCart(this.id)">Xóa</span>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
<div class="span_hr_big"></div>
<div class="shopping_cart_total">
    <span>Tổng tiền tạm tính:</span>
    <span class="shopping_cart_total_price" data-value="{{ Cart::total() }}" id="modal_cart_total_price">{{ formatPrice(Cart::total()) }}</span>
</div>
