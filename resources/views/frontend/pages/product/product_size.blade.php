<ul>
    @foreach($dataSize as $item)
    <li class="product_size_list" data-id="{{ $item->product_size }}" data-name="product_size_" data-id-product="{{ $item->product_id }}" id="product_size_{{ $item->product_size }}" @if($item->product_qty == 0) data-disabled="true" @else data-disabled="false" @endif onclick="changeBorderSize(this.id)" onmouseover="hoverBorderSize(this.id)" onmouseout="outBorderSize(this.id)">
        <div class="app_modal_product_size_radio" @if($item->product_qty == 0) style="background: url({{ URL::to('public/frontend/images/product/product_nano/soldout.png')  }}) no-repeat center center;background-size: contain;" @endif>
            <input type="radio" name="sizeID" value="{{ $item->product_size }}" class="product_size_radio_input" @if($item->product_qty == 0) disabled @endif>
            <div class="app_modal_product_size_radio_btn">{{ $item->product_size }}</div>
        </div>
    </li>
    @endforeach
</ul>
<div class="app_modal_product_size_note">
    Chọn size <i class="far fa-question-circle"></i>
</div>
