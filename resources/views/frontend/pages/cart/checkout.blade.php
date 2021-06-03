@extends('frontend.layouts.frontend_layout')
@section('frontend_title')

    <title>Giỏ hàng</title>

@endsection
@section('frontend_css')
    <link rel="stylesheet" href="{{ asset('public/frontend/css/checkout.css')}}">
@endsection
@section('frontend_js')
    <script src="{{ asset('public/frontend/js/checkout.js')}}"></script>

@endsection

@section('frontend_content')
@php
    $sum_sale = 0;
    $sum_total = 0;
    $charge_shipping = 0;
    $sum_coupons = 0;
    if(Session::has('shipping')){
        $charge_shipping = intval(Session::get('shipping')['charge_shipping']);
    }
    foreach (Cart::content() as $item){
        if(intval($item->options->discount_price) > 0 && $item->options->discount_price != null){
            $sum_sale += intval($item->price) * intval($item->qty) * intval($item->options->discount_price) / 100;
        }
    }
    if(Session::has('coupons')){
        $sum_coupons = intval(Session::get('coupons')['coupons_value']);
    }
    $sum_total = intval(Cart::total()) - $sum_sale + $charge_shipping - $sum_coupons;
@endphp
    <!-- CONTAINER -->

    <div class="container_fluid app_container">
        <div class="app_container_top">
            <ul class="app_container_top_ul">
                <li class="app_container_top_list"><a href="{{ route('cart.index') }}" class="app_container_top_link">Giỏ hàng</a></li>
                <li class="app_container_top_list_icon"><span class="ti-angle-right"></span></li>
                <li class="app_container_top_list app_container_top_list_active"><span class="app_container_top_link">Giao hàng & thanh toán</span></li>
                <li class="app_container_top_list_icon"><span class="ti-angle-right"></span></li>
                <li class="app_container_top_list"><span class="app_container_top_link">Xác nhận</span></li>
            </ul>
        </div>
        <div class="container">
            <div class="app_container_content">
                <form action="{{ route('cart.payment') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-xl-7 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="app_container_content_title">
                                Giao hàng & thanh toán
                            </div>
                            <div class="app_container_content_shipping">
                                <div class="app_container_content_info">
                                    <div class="app_container_content_info_address">
                                        <div class="app_container_content_info_titile">Địa chỉ giao hàng</div>
                                        <div class="app_container_content_info_list">
                                            <div class="app_container_content_info_list_name">
                                                Họ và tên <span class="info_required">*</span>
                                            </div>
                                            <input type="text" name="ship_name" value="{{ old('ship_name') }}" class="app_container_content_info_list_input" required>
                                            @error('ship_name')
                                            <span style="padding-top: 5px; color: red; font-size: 1.2rem; display: block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="app_container_content_info_list">
                                            <div class="app_container_content_info_list_name">
                                                Số điện thoại <span class="info_required">*</span>
                                            </div>
                                            <input type="text" name="ship_phone" value="{{ old('ship_phone') }}" class="app_container_content_info_list_input" required>
                                            @error('ship_phone')
                                            <span style="padding-top: 5px; color: red; font-size: 1.2rem; display: block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="app_container_content_info_list">
                                            <div class="app_container_content_info_list_name">
                                                Tỉnh / Thành phố <span class="info_required">*</span>
                                            </div>
                                            <select name="ship_province" id="province" class="app_container_content_info_list_input" value="{{ old('ship_province') }}" onchange="changeProvince(this.id)" required>
                                                <option label="Chọn Tỉnh / Thành phố"></option>
                                                @foreach($provinces as $key => $item)
                                                <option value="{{ $item->name_with_type }}" data-id="{{ $item->code }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="app_container_content_info_list">
                                            <div class="app_container_content_info_list_name">
                                                Huyện / Quận <span class="info_required">*</span>
                                            </div>
                                            <select name="ship_district" id="district" class="app_container_content_info_list_input" onchange="changeDistrict(this.id)" required>
                                                <option label="Chọn Huyện / Quận"></option>
                                            </select>
                                        </div>
                                        <div class="app_container_content_info_list">
                                            <div class="app_container_content_info_list_name">
                                                Xã / Phường / Thị trấn <span class="info_required">*</span>
                                            </div>
                                            <select name="ship_wards" id="wards" class="app_container_content_info_list_input" required>
                                                <option label="Chọn Xã / Phường / Thị trấn"></option>
                                            </select>
                                        </div>
                                        <div class="app_container_content_info_list">
                                            <div class="app_container_content_info_list_name">
                                                Địa chỉ <span class="info_required">*</span>
                                            </div>
                                            <input type="text" name="ship_address" value="{{ old('ship_address') }}" class="app_container_content_info_list_input">
                                            @error('ship_address')
                                            <span style="padding-top: 5px; color: red; font-size: 1.2rem; display: block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="app_container_content_info_list">
                                            <div class="app_container_content_info_list_name">
                                                Khung giờ giao hàng <span class="info_required">*</span>
                                            </div>
                                            <select name="ship_deliveryTime" value="{{ old('ship_deliveryTime') }}" id="" class="app_container_content_info_list_input" required>
                                                <option label="Chọn thời gian giao hàng"></option>
                                                <option value="Giờ hành chính">Giờ hành chính</option>
                                                <option value="Ngoài giờ hành chính">Ngoài giờ hành chính</option>
                                            </select>
                                        </div>
                                        <div class="app_container_content_info_list">
                                            <div class="app_container_content_info_list_name">
                                                Ghi chú
                                            </div>
                                            <textarea name="ship_note" id="" value="{{ old('ship_note') }}" rows="3" class="app_container_content_info_list_input"></textarea>
                                        </div>
                                    </div>
                                    <div class="app_container_content_info_checkout">
                                        <div class="app_container_content_info_titile">Phương thức thanh toán</div>
                                        <label for="checkout_cod" id="info_checkout_cod" class="app_container_content_info_checkout_list">
                                            <input type="radio" name="checkout" id="checkout_cod" value="cod" class="app_container_content_info_checkout_radio" checked>
                                            <div class="app_container_content_info_checkout_text">Thanh toán khi nhận hàng</div>
                                        </label>
                                        <label for="checkout_stripe" class="app_container_content_info_checkout_list">
                                            <input type="radio" name="checkout" id="checkout_stripe" value="stripe" class="app_container_content_info_checkout_radio">
                                            <div class="app_container_content_info_checkout_text">Thanh toán qua Stripe</div>

                                        </label>
                                        <div class="checkout_vnpay_content" id="checkout_vnpay_content">
                                            <div class="form-row">
                                                <label for="card-element">
                                                    Credit or debit card
                                                </label>
                                                <div id="card-element">
                                                    <!-- A Stripe Element will be inserted here. -->
                                                </div>

                                                <!-- Used to display form errors. -->
                                                <div id="card-errors" role="alert"></div>
                                            </div>
{{--                                            <div>--}}
{{--                                                @if ($errors->any())--}}
{{--                                                    <div class="alert alert-danger">--}}
{{--                                                        <ul>--}}
{{--                                                            @foreach ($errors->all() as $error)--}}
{{--                                                                <li>{{ $error }}</li>--}}
{{--                                                            @endforeach--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                    <div class="app_container_content_info_shipping">
                                        <div class="app_container_content_info_titile">Chọn phương thức giao hàng</div>
                                        <div class="">
                                            <label for="shipping_normal" class="app_container_content_info_shipping_list" >
                                                <div class="app_container_content_info_shipping_flex_l">
                                                    <input type="radio" id="shipping_normal" onclick="addShipping(this.id)" value="30000" name="shipping" class="app_container_content_info_checkout_radio" @if(Session::has('shipping')) checked @endif required>
                                                    <div class="app_container_content_info_checkout_text">Giao hàng tiêu chuẩn</div>
                                                </div>
                                                <div class="app_container_content_info_shipping_flex_r">
                                                    30.000 đ
                                                </div>
                                            </label>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="app_container_content_left">
                                <div class="app_container_content_cart">
                                    <div class="app_container_content_cart_top">
                                        <div class="app_container_content_cart_top_l">
                                            Giỏ hàng của bạn
                                        </div>
                                        <div class="app_container_content_cart_top_r">
                                            {{ Cart::count() }} sản phẩm
                                        </div>
                                    </div>
                                    @foreach(Cart::content() as $item)
                                    <div class="app_container_content_cart_list">
                                        <div class="app_container_content_cart_list_info">
                                            <img src="{{ URL::to($item->options->avatar) }}" alt="" class="app_container_content_cart_list_info_img">
                                            <div class="app_container_content_cart_list_info_content">
                                                <div class="app_container_content_cart_list_info_content_name">{{ $item->name }}</div>
                                                <div class="app_container_content_cart_list_info_content_select"><span class="info_content_name">Màu: </span> {{ $item->options->color }}</div>
                                                <div class="app_container_content_cart_list_info_content_select"><span class="info_content_name">Size: </span>{{ $item->options->size }}</div>
                                                <div class="app_container_content_cart_list_info_content_select"><span class="info_content_name">Số lượng: </span>{{ $item->qty }}</div>
                                            </div>
                                        </div>
                                        @if($item->options->discount_price == 0 || $item->options->discount_price == null)
                                        <!-- Nếu không khuyến mãi -->
                                        <div class="app_container_content_cart_list_price">
                                            {{ formatPrice($item->price) }}
                                        </div>
                                        @else
                                        <!-- Nếu có khuyến mãi -->
                                        <div class="app_container_content_cart_list_sale">
                                            <div class="app_container_content_cart_list_sale_new">
                                                {{ formatPriceSale($item->price, $item->options->discount_price) }}
                                            </div>
                                            <div class="app_container_content_cart_list_sale_old">
                                                {{ formatPrice($item->price) }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                                <div class="app_container_content_coupon" id="content_coupon_code">
                                    <input type="text" class="app_container_content_coupon_input" name="coupons_code" id="content_coupon_code_input" @if(Session::has('coupons')) placeholder="Đã sử dụng mã giảm giá!" readonly @else placeholder="Nhập mã giảm giá!"  @endif >
                                    <input type="button" class="app_container_content_coupon_button" value="Áp dụng" onclick="inputCoupons()">
                                </div>
{{--                                <div class="app_container_content_coupon">--}}
{{--                                    <input type="text" class="app_container_content_coupon_input" placeholder="Nhập mã miễn phí ship">--}}
{{--                                    <input type="button" class="app_container_content_coupon_button" value="Áp dụng">--}}
{{--                                </div>--}}
                                <div class="app_container_content_money">
                                    <div class="app_container_content_money_text">
                                        Thành tiền
                                    </div>
                                    <div class="app_container_content_money_number">
                                        {{ formatPrice(Cart::total()) }}
                                    </div>
                                </div>
                                <div class="app_container_content_money">
                                    <div class="app_container_content_money_text">
                                        Giảm giá
                                    </div>
                                    <div class="app_container_content_money_number">
                                        {{ formatPrice($sum_sale) }}
                                    </div>
                                </div>
                                <div class="app_container_content_money content_money_coupons" id="content_money_coupons" style="@if(Session::has('coupons')) display: flex @else display:none  @endif">
                                    <div class="app_container_content_money_text">
                                        Phiểu giảm giá<span onclick="removeCoupons()" class="ti-close" style="color: red; margin-left: 10px;background: white" title="Xóa phiếu giảm giá"></span>
                                    </div>
                                    <div class="app_container_content_money_number" id="content_money_coupons_value">
                                        @if(Session::has('coupons')) {{ formatPrice(intval(Session::get('coupons')['coupons_value'])) }} @endif
                                    </div>
                                </div>
                                <div class="app_container_content_money content_money_shipping" id="content_money_shipping" style="@if(Session::has('shipping')) display: flex @else display:none  @endif">
                                    <div class="app_container_content_money_text">
                                        Phí giao hàng
                                    </div>
                                    <div class="app_container_content_money_number" id="content_money_shipping_value">
                                        @if(Session::has('shipping')) {{ formatPrice(intval(Session::get('shipping')['charge_shipping'])) }} @endif
                                    </div>
                                </div>
                                <div class="app_container_content_money">
                                    <div class="app_container_content_money_total_text">
                                        Tổng tiền
                                        <p class="money_total_text">(Đã bao gồm thuế và VAT)</p>
                                    </div>
                                    <div class="app_container_content_money_total_number" id="checkout_sum_total">
                                        {{ formatPrice($sum_total) }}
                                    </div>
                                </div>
                                <button type="submit" class="app_container_content_submit">Thanh toán</button>

                            </div>

                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>

    <!-- END CONTAINER -->
{{--    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>--}}
    <script type="text/javascript">
        function changeProvince(id){
            var idProvinces = $('#' + id).find('option:selected').attr('data-id');
            $.ajax({
                url: "{{ url('address/getDistricts/') }}/" + idProvinces,
                type: "GET",
                dataType: "json",
                success:function (data){
                    $('select[name="ship_district"]').empty();
                    $('select[name="ship_wards"]').empty();
                    $('select[name="ship_district"]').append('<option label="Chọn Huyện / Quận"></option>');
                    $.each(data.districts, function (key, item){
                        $('select[name="ship_district"]').append('<option value="'+ item.name_with_type +'" data-id="'+ item.code +'">'+ item.name_with_type +'</option>');
                    })

                }
            })
        }

        function changeDistrict(id){
            var idDistrict = $('#' + id).find('option:selected').attr('data-id');
            // console.log(idDistrict);
            $.ajax({
                url: "{{ url('address/getWards/') }}/" + idDistrict,
                type: "GET",
                dataType: "json",
                success:function (data){
                    $('select[name="ship_wards"]').empty();
                    $('select[name="ship_wards"]').append('<option label="Chọn Xã / Phường / Thị trấn"></option>');
                    $.each(data.wards, function (key, item){
                        $('select[name="ship_wards"]').append('<option value="'+ item.name_with_type +'" data-id="'+ item.code +'">'+ item.name_with_type +'</option>');
                    })
                }
            });
        }

        function inputCoupons(){
            // Lấy giá trị nhập vào
            var textInput = $('#content_coupon_code_input').val();
            // remove input coupons
            $('#content_coupon_code_input').val('');
            // console.log(textInput);
            $.ajax({
                url: "{{ url('cart/checkout/inputCoupons/') }}/" + textInput,
                type: "GET",
                dataType: "json",
                success:function (data){
                    if(data.coupons.message_type == 'error'){
                        toastr.error(data.coupons.message);
                    }else{
                        $('#content_money_coupons_value').text(data.coupons.sum_coupons);
                        $('#content_money_coupons').css({'display' : 'flex'});
                        $('#content_coupon_code_input').prop({'readonly' : true, 'placeholder' : 'Đã sử dụng mã giảm giá!'});
                        $('#checkout_sum_total').text(data.coupons.sum_total);
                        toastr.success(data.coupons.message);
                    }

                }
            })
        }
        function removeCoupons(){
            $.ajax({
                url: "{{ url('cart/checkout/removeCoupons') }}/",
                type: "GET",
                dataType: "json",
                success:function (data){
                    $('#content_money_coupons').css({'display' : 'none'});
                    $('#content_coupon_code_input').prop( {'placeholder' : 'Nhập mã giảm giá!', 'readonly' : false});
                    $('#checkout_sum_total').text(data.coupons.sum_total);
                    toastr.success(data.coupons.message);
                }
            })
        }
        function addShipping(id){
            // var chargeShipping = $('input:radio[name="shipping"]:checked').val();
            var chargeShipping = $('#' + id).val();
            console.log(chargeShipping);
            $.ajax({
                url: "{{ url('cart/checkout/addShipping/') }}/" + chargeShipping,
                type: "GET",
                dataType: "json",
                success:function (data){
                    console.log(data.shipping);
                    if(data.shipping.message_type == 'error'){
                        toastr.error(data.shipping.message);
                    }else{
                        $('#content_money_shipping_value').text(data.shipping.charge_shipping);
                        $('#content_money_shipping').css({'display' : 'flex'});
                        $('#checkout_sum_total').text(data.shipping.sum_total);
                        toastr.success(data.shipping.message);
                    }
                }
            })
        }

    </script>
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">
        // Create a Stripe client.

    </script>
@endsection
