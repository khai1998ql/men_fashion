@php
    Cart::remove($rowId);
    $sum_sale = 0;
    $sum_total = 0;
    foreach (Cart::content() as $item){
        if(intval($item->options->discount_price) > 0 && $item->options->discount_price != null){
            $sum_sale += intval($item->price) * intval($item->qty) * intval($item->options->discount_price) / 100;
        }
    }
    $sum_total = intval(Cart::total()) - $sum_sale;
@endphp


<div class="app_container_content_order_list">
    <div class="app_container_content_order_list_l">
        Giá trị đơn hàng
    </div>
    <div class="app_container_content_order_list_r" id="cart_price">
        {{ formatPrice(Cart::total()) }}
    </div>
</div>
<div class="app_container_content_order_list">
    <div class="app_container_content_order_list_l">
        Giảm giá
    </div>
    <div class="app_container_content_order_list_r" id="cart_sale">
        {{ formatPrice($sum_sale) }}
    </div>
</div>
<div class="app_container_content_order_list">
    <div class="app_container_content_order_list_l">
        Tổng tiền thanh toán
    </div>
    <div class="app_container_content_order_list_r" id="cart_total">
        {{ formatPrice($sum_total) }}
    </div>
</div>
