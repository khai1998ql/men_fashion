<div class="app_modal_product_content_top carousel slide" id="carouselProduct" data-bs-interval="false"  data-bs-ride="carousel">
    <div class="app_modal_product_content_l">
        <img src="{{ asset('public/frontend/images/product/product_small/p1.jpg')}}" alt="" data-bs-target="#carouselProduct" data-bs-slide-to="0" class="active app_modal_product_images_small" aria-current="true" aria-label="Slide 1">
        <img src="{{ asset('public/frontend/images/product/product_small/p2.jpg')}}" alt="" data-bs-target="#carouselProduct" data-bs-slide-to="1" class="app_modal_product_images_small" aria-label="Slide 2">
        <img src="{{ asset('public/frontend/images/product/product_small/p3.jpg')}}" alt="" data-bs-target="#carouselProduct" data-bs-slide-to="2" class="app_modal_product_images_small" aria-label="Slide 3">
        <img src="{{ asset('public/frontend/images/product/product_small/p4.jpg')}}" alt="" data-bs-target="#carouselProduct" data-bs-slide-to="3" class="app_modal_product_images_small" aria-label="Slide 4">

    </div>
    <div class="app_modal_product_content_b carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('public/frontend/images/product/product_small/p1.jpg')}}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('public/frontend/images/product/product_small/p2.jpg')}}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('public/frontend/images/product/product_small/p3.jpg')}}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('public/frontend/images/product/product_small/p4.jpg')}}" class="d-block w-100" alt="...">
        </div>
    </div>
    <div class="app_modal_product_content_r">
        <label for="input_checkbox_product" class="app_modal_product_content_r_close"  >
            <span class="ti-close"></span>
        </label>
        <div class="app_modal_product_name" id="app_modal_product_name"></div>
        <!-- Khi không có giảm giá -->
        <!-- <div class="app_modal_product_price">
            <span>900,000 <span>đ</span></span>
        </div> -->
        <!-- Khi có giảm giá -->
        <div class="app_modal_product_price_sale">
            <div class="app_modal_product_price_new">
                <span>270,000 <soan>đ</soan></span>
            </div>
            <div class="app_modal_product_price_old">
                <span>450,000 <span>đ</span></span>
            </div>
        </div>
        <form action="">
            <div class="app_modal_product_color">
                <ul>
                    <li class="app_modal_product_color_list" data-id="1" data-name="modal_product_color_" id="modal_product_color_1" onclick="modalChangeBorderColor(this.id)" onmouseover="modalHoverBorderColor(this.id)" onmouseout="modalOutBorderColor(this.id)">
                        <div class="app_modal_product_color_radio">
                            <input type="radio" name="modalColorID" value="1" class="app_modal_product_color_radio_input">
                            <div class="app_modal_product_color_radio_btn" style="background: url({{ asset('public/frontend/images/product/product_nano/p1.jpg')}}) no-repeat center center;width: 25px;height: 30px;"
                                 data-bs-target="#carouselProduct" data-bs-slide-to="0" class="active app_modal_product_images_small" aria-current="true" aria-label="Slide 1"></div>
                        </div>
                        <div class="app_modal_product_color_list_title">
                            Màu đen vàng
                        </div>
                    </li>
                    <!-- Nếu hết màu sản phầm -->
                    <li class="app_modal_product_color_list" data-id="2" data-name="modal_product_color_" id="modal_product_color_2" onclick="modalChangeBorderColor(this.id)" onmouseover="modalHoverBorderColor(this.id)" onmouseout="modalOutBorderColor(this.id)">
                        <div class="app_modal_product_color_radio" style="background: url({{ URL::to('public/frontend/images/product/product_nano/soldout.png')  }}) no-repeat center center;background-size: contain;">
                            <input type="radio" name="modalColorID" value="2" class="app_modal_product_color_radio_input">
                            <div class="app_modal_product_color_radio_btn app_modal_product_soldout" style="background: url({{ asset('public/frontend/images/product/product_nano/p2.jpg')}}) no-repeat center center;width: 25px;height: 30px;"
                                 data-bs-target="#carouselProduct" data-bs-slide-to="1" class="active app_modal_product_images_small" aria-current="true" aria-label="Slide 2"></div>
                        </div>
                        <div class="app_modal_product_color_list_title">
                            Màu đen vàng
                        </div>
                    </li>
                    <li class="app_modal_product_color_list" data-id="3" data-name="modal_product_color_" id="modal_product_color_3" onclick="modalChangeBorderColor(this.id)" onmouseover="modalHoverBorderColor(this.id)" onmouseout="modalOutBorderColor(this.id)">
                        <div class="app_modal_product_color_radio">
                            <input type="radio" name="modalColorID" value="3" class="app_modal_product_color_radio_input">
                            <div class="app_modal_product_color_radio_btn" style="background: url({{ asset('public/frontend/images/product/product_nano/p3.jpg')}}) no-repeat center center;width: 25px;height: 30px;"
                                 data-bs-target="#carouselProduct" data-bs-slide-to="2" class="active app_modal_product_images_small" aria-current="true" aria-label="Slide 3"></div>
                        </div>
                        <div class="app_modal_product_color_list_title">
                            Màu đen vàng
                        </div>
                    </li>
                    <li class="app_modal_product_color_list" data-id="4" data-name="modal_product_color_" id="modal_product_color_4" onclick="modalChangeBorderColor(this.id)" onmouseover="modalHoverBorderColor(this.id)" onmouseout="modalOutBorderColor(this.id)">
                        <div class="app_modal_product_color_radio">
                            <input type="radio" name="modalColorID" value="4" class="app_modal_product_color_radio_input">
                            <div class="app_modal_product_color_radio_btn" style="background: url({{ asset('public/frontend/images/product/product_nano/p4.jpg')}}) no-repeat center center;width: 25px;height: 30px;"
                                 data-bs-target="#carouselProduct" data-bs-slide-to="3" class="active app_modal_product_images_small" aria-current="true" aria-label="Slide 4"></div>
                        </div>
                        <div class="app_modal_product_color_list_title">
                            Màu đen vàng
                        </div>
                    </li>
                </ul>
            </div>
            <div class="app_modal_product_size">
                <ul>
                    <li class="app_modal_product_size_list" data-id="S" data-name="modal_product_size_" id="modal_product_size_S" onclick="modalChangeBorderSize(this.id)" onmouseover="modalHoverBorderSize(this.id)" onmouseout="modalOutBorderSize(this.id)">
                        <div class="app_modal_product_size_radio">
                            <input type="radio" name="modalSizeID" value="S" class="app_modal_product_size_radio_input">
                            <div class="app_modal_product_size_radio_btn">S</div>
                        </div>
                    </li>
                    <!-- Nếu kích thước hết -->
                    <li class="app_modal_product_size_list" data-id="M" data-name="modal_product_size_" id="modal_product_size_M" onclick="modalChangeBorderSize(this.id)" onmouseover="modalHoverBorderSize(this.id)" onmouseout="modalOutBorderSize(this.id)">
                        <div class="app_modal_product_size_radio" style="background: url({{ URL::to('public/frontend/images/product/product_nano/soldout.png')  }}) no-repeat center center;background-size: contain;">
                            <input type="radio" name="modalSizeID" value="M" class="app_modal_product_size_radio_input">
                            <div class="app_modal_product_size_radio_btn">M</div>
                        </div>
                    </li>
                    <li class="app_modal_product_size_list" data-id="L" data-name="modal_product_size_" id="modal_product_size_L" onclick="modalChangeBorderSize(this.id)" onmouseover="modalHoverBorderSize(this.id)" onmouseout="modalOutBorderSize(this.id)">
                        <div class="app_modal_product_size_radio">
                            <input type="radio" name="modalSizeID" value="L" class="app_modal_product_size_radio_input">
                            <div class="app_modal_product_size_radio_btn">L</div>
                        </div>
                    </li>
                    <li class="app_modal_product_size_list" data-id="XL" data-name="modal_product_size_" id="modal_product_size_XL" onclick="modalChangeBorderSize(this.id)" onmouseover="modalHoverBorderSize(this.id)" onmouseout="modalOutBorderSize(this.id)">
                        <div class="app_modal_product_size_radio">
                            <input type="radio" name="modalSizeID" value="XL" class="app_modal_product_size_radio_input">
                            <div class="app_modal_product_size_radio_btn">XL</div>
                        </div>
                    </li>
                    <li class="app_modal_product_size_list" data-id="XXL" data-name="modal_product_size_" id="modal_product_size_XXL" onclick="modalChangeBorderSize(this.id)" onmouseover="modalHoverBorderSize(this.id)" onmouseout="modalOutBorderSize(this.id)">
                        <div class="app_modal_product_size_radio">
                            <input type="radio" name="modalSizeID" value="XXL" class="app_modal_product_size_radio_input">
                            <div class="app_modal_product_size_radio_btn">XXL</div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="app_modal_product_number">
                <input type="button" onclick="modalMinusQty()" class="app_modal_product_number_btn" value="-">
                <input type="text" oninput="modalInputQty()" name="modalQty" id="modalQty" value="1" min="1" max="" class="app_modal_product_number_qty">
                <input type="button" onclick="modalPlusQty()" class="app_modal_product_number_btn" value="+">
            </div>
            <div class="app_modal_product_button">
                <button type="submit" class="app_modal_product_submit">Thêm vào giỏ hàng</button>
            </div>
        </form>
    </div>
</div>
<div class="app_modal_product_content_bottom">
    <a href="" class="app_modal_product_content_bottom_link">Xem chi tiết</a>
</div>
