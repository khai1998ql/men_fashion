<ul>
    @foreach($dataSize as $item)
    <li class="app_modal_product_size_list" data-id="{{ $item->product_size }}" data-name="modal_product_size_" data-id-product="{{ $item->product_id }}" id="modal_product_size_{{ $item->product_size }}" @if($item->product_qty == 0) data-disabled="true" @else data-disabled="false" @endif onclick="modalChangeBorderSize(this.id)" onmouseover="modalHoverBorderSize(this.id)" onmouseout="modalOutBorderSize(this.id)">
        <div class="app_modal_product_size_radio" @if($item->product_qty == 0) style="background: url({{ URL::to('public/frontend/images/product/product_nano/soldout.png')  }}) no-repeat center center;background-size: contain;" @endif>
            <input type="radio" name="modalSizeID" value="{{ $item->product_size }}" class="app_modal_product_size_radio_input" @if($item->product_qty == 0) disabled @endif required>
            <div class="app_modal_product_size_radio_btn">{{ $item->product_size }}</div>
        </div>
    </li>
    @endforeach
</ul>
