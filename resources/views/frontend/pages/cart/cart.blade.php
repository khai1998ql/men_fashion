@extends('frontend.layouts.frontend_layout')
@section('frontend_title')

    <title>Giỏ hàng</title>

@endsection
@section('frontend_css')
    <link rel="stylesheet" href="{{ asset('public/frontend/css/cart.css')}}">
@endsection
@section('frontend_js')
    <script src="{{ asset('public/frontend/js/cart.js')}}"></script>

@endsection

@section('frontend_content')
@php
@endphp
    <!-- CONTAINER -->

    <div class="container_fluid app_container">
        <div class="app_container_top">
            <ul class="app_container_top_ul">
                <li class="app_container_top_list app_container_top_list_active"><span class="app_container_top_link">Giỏ hàng</span></li>
                <li class="app_container_top_list_icon"><span class="ti-angle-right"></span></li>
                <li class="app_container_top_list"><span class="app_container_top_link">Giao hàng & thanh toán</span></li>
                <li class="app_container_top_list_icon"><span class="ti-angle-right"></span></li>
                <li class="app_container_top_list"><span class="app_container_top_link">Xác nhận</span></li>
            </ul>
        </div>
        <div class="container">
            <div class="app_container_content">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                        <div class="app_container_content_cart">
                            <div class="app_container_content_cart_top">
                                <div class="app_container_content_cart_heading">Giỏ hàng của bạn</div>
                                <div class="app_container_content_cart_text">Có <span id="content_cart_number">{{ Cart::count() }}</span> sản phẩm</div>
                            </div>
                            <div class="app_container_content_cart_table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sản phẩm</th>
                                            <th scope="col">Giá bán</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">#</th>
                                        </tr>
                                    </thead>

                                    <tbody id="content_tbody">
                                    @foreach(Cart::content() as $item)
                                        <tr id="{{ $item->rowId }}">
                                            <td>
                                                <div class="table_content_product">
                                                    <a href="{{ URL::to(to_slug($item->options->category_name). '/' . to_slug($item->options->subcategory_name). '/' . to_slug($item->name)) }}">
                                                        <img src="{{ URL::to($item->options->avatar) }}" alt="" class="table_product_img">
                                                    </a>
                                                    <div class="table_content_product_info">
                                                        <a href="{{ URL::to(to_slug($item->options->category_name). '/' . to_slug($item->options->subcategory_name). '/' . to_slug($item->name)) }}" class="table_content_product_info_name">
                                                            {{ $item->name }}
                                                        </a>
                                                        <div class="table_content_product_info_list">
                                                            <div class="table_content_product_info_list_heading">Màu</div>
                                                            <div class="table_content_product_info_list_br">:</div>
                                                            <div class="table_content_product_info_list_text">{{ $item->options->color }}</div>
                                                        </div>
                                                        <div class="table_content_product_info_list">
                                                            <div class="table_content_product_info_list_heading">Cỡ</div>
                                                            <div class="table_content_product_info_list_br">:</div>
                                                            <div class="table_content_product_info_list_text">{{ $item->options->size }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($item->options->discount_price == null || $item->options->discount_price == '0')
                                                <!-- Nếu không có khuyến mãi -->
                                                <div class="table_content_product_price">{{ formatPrice($item->price) }}</div>
                                                @else
                                                <!-- Nếu có khuyến mãi -->
                                                <div class="table_content_product_sale">
                                                    <div class="table_content_product_sale_new">
                                                        {{ formatPriceSale($item->price, intval($item->options->discount_price)) }}
                                                    </div>
                                                    <div class="table_content_product_sale_old">
                                                        {{ formatPrice($item->price) }}
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="table_content_product_number">
                                                    <input type="button" value="-" data-id="{{ $item->rowId }}" data-name="minusProduct_" data-target="numberProduct_" id="minusProduct_{{ $item->rowId }}" class="table_content_product_input_button" onclick="minusNumber(this.id)">
                                                    <input type="text" value="{{ $item->qty }}" min="1" class="table_content_product_input_text" data-max="{{ intval($item->options->max_number) }}" data-id="{{ $item->rowId }}" id="numberProduct_{{ $item->rowId }}" oninput="inputNumber(this.id)">
                                                    <input type="button" value="+" data-id="{{ $item->rowId }}" data-max="{{ intval($item->options->max_number) }}" data-name="plusProduct_" data-target="numberProduct_" id="plusProduct_{{ $item->rowId }}" class="table_content_product_input_button" onclick="plusNumber(this.id)">
                                                </div>

                                            </td>
                                            <td>
                                                <div class="table_content_product_button">
                                                    <div class="table_content_product_delete" data-qty="{{ intval($item->qty) }}" data-price="{{ intval($item->price) }}" data-value="{{ intval($item->price) * intval($item->qty) }}" data-id="{{ $item->rowId }}" id="deleteCart_{{ $item->rowId }}" onclick="deleteCart(this.id)"><span class="ti-trash"></span></div>
{{--                                                    <a href="" class="table_content_product_delete" data-rowId="{{ $item->rowId }}" id="deleteCart_{{ $item->rowId }}" onclick="deleteCart(this.id)"><span class="ti-trash"></span></a>--}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @php
                        $sum_sale = 0;
                        $sum_total = 0;
                        foreach (Cart::content() as $item){
                            if(intval($item->options->discount_price) > 0 && $item->options->discount_price != null){
                                $sum_sale += intval($item->price) * intval($item->qty) * intval($item->options->discount_price) / 100;
                            }
                        }
                        $sum_total = intval(Cart::total()) - $sum_sale;
                    @endphp
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                        <div class="app_container_content_order">
                            <div class="app_container_content_order_title">
                                Tổng giỏ hàng
                            </div>
                            <div id="content_value_cart">
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
                            </div>

                            <!-- <div class="app_container_content_order_list">
                                <div class="app_container_content_order_list_l">
                                    <div class="coupon_text">Mã giảm giá</div>
                                    <div class="coupon_code">
                                        <div class="coupon_code_text">(Sinh nhật Ecommerce)</div>
                                        <a href="" class="coupon_remove" title="Xóa coupon"><span class="ti-close"></span></a>
                                    </div>

                                </div>
                                <div class="app_container_content_order_list_r">
                                    456.789 đ
                                </div>
                            </div> -->

                            <div class="app_container_content_order_button">
                                <a href="{{ route('fe.index') }}" class="app_container_content_order_button_back">Tiếp tục mua hàng</a>
                                <a href="{{ route('cart.checkout') }}" class="app_container_content_order_button_checkout">Thanh toán</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- END CONTAINER -->
    <script type="text/javascript">
        function minusNumber(id){
            var idClick = '#' + id;
            var idData = $(idClick).attr('data-id');
            var targetData = $(idClick).attr('data-target');
            var idTarget = '#' + targetData + idData;
            // Lấy giá trị hiện tại
            var value = parseInt($(idTarget).val());
            // var value = $(idTarget).val();
            var newValue;
            if(value == 1){
                newValue = 1;
            }else{
                newValue = value - 1;
            }
            $(idTarget).val(newValue);
            $('#modal_number_' + idData).text(newValue);
            // Thay đổi atttribute trong div deleteCart_
            $('#deleteCart_' + idData).attr('data-qty', newValue);

            $.ajax({
               url: "{{ url('cart/changeNumber/') }}/" + idData + '/' + newValue,
               type: "GET",
               dataType: 'json',
               success:function (data){
                   $('#cart_price').text(data.changeNumber.cart_price);
                   $('#cart_sale').text(data.changeNumber.sum_sale);
                   $('#cart_total').text(data.changeNumber.sum_total);
                   $('#fe_count_product').text(data.changeNumber.count_number);
                   $('#fe_cart_count_product').text(data.changeNumber.count_number);
                   $('#content_cart_number').text(data.changeNumber.count_number);
                   $('#modal_cart_total_price').text(data.changeNumber.cart_price);

                   $('#modal_cart_total_price').attr('data-qty', newValue);
               }
            });
        }

        function plusNumber(id){
            var idClick = '#' + id;
            var idData = $(idClick).attr('data-id');
            var targetData = $(idClick).attr('data-target');
            var maxNumber = parseInt($(idClick).attr('data-max'));
            var idTarget = '#' + targetData + idData;
            // Lấy giá trị hiện tại
            var value = parseInt($(idTarget).val());
            // var value = $(idTarget).val();
            var newVal = value + 1;
            var newValue = (newVal <= maxNumber) ? newVal : maxNumber;
            $(idTarget).val(newValue);
            $('#modal_number_' + idData).text(newValue);

            // Thay đổi atttribute trong div deleteCart_
            $('#deleteCart_' + idData).attr('data-qty', newValue);

            $.ajax({
                url: "{{ url('cart/changeNumber/') }}/" + idData + '/' + newValue,
                type: "GET",
                dataType: 'json',
                success:function (data){
                    $('#cart_price').text(data.changeNumber.cart_price);
                    $('#cart_sale').text(data.changeNumber.sum_sale);
                    $('#cart_total').text(data.changeNumber.sum_total);
                    $('#fe_count_product').text(data.changeNumber.count_number);
                    $('#fe_cart_count_product').text(data.changeNumber.count_number);
                    $('#content_cart_number').text(data.changeNumber.count_number);
                    $('#modal_cart_total_price').text(data.changeNumber.cart_price);

                    $('#modal_cart_total_price').attr('data-qty', newValue);
                }
            });
        }

        function inputNumber(id){
            var idClick = '#' + id;
            var maxNumber = parseInt($(idClick).attr('data-max'));
            var idData = $(idClick).attr('data-id');
            // Lấy giá trị hiện tại
            var input = parseInt(document.getElementById(id).value);
            var newValue = (input <= maxNumber) ? input : maxNumber;
            $(idClick).val(newValue);
            $('#modal_number_' + idData).text(newValue);

            // Thay đổi atttribute trong div deleteCart_
            $('#deleteCart_' + idData).attr('data-qty', newValue);

            $.ajax({
                url: "{{ url('cart/changeNumber/') }}/" + idData + '/' + newValue,
                type: "GET",
                dataType: 'json',
                success:function (data){
                    $('#cart_price').text(data.changeNumber.cart_price);
                    $('#cart_sale').text(data.changeNumber.sum_sale);
                    $('#cart_total').text(data.changeNumber.sum_total);
                    $('#fe_count_product').text(data.changeNumber.count_number);
                    $('#fe_cart_count_product').text(data.changeNumber.count_number);
                    $('#content_cart_number').text(data.changeNumber.count_number);
                    $('#modal_cart_total_price').text(data.changeNumber.cart_price);

                    $('#modal_cart_total_price').attr('data-qty', newValue);
                }
            });
        }


    </script>
    <script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>
    <script>
        function deleteCart(id){


            var idClick = '#' + id;
            var dataId = $(idClick).attr('data-id');
            var totalNumber = parseInt($('#content_cart_number').text());
            var idInput = '#numberProduct_' + dataId;
            console.log(dataId);
            var numberPro = parseInt($(idInput).val());
            var newNumber = totalNumber - numberPro;

            //Lấy giá trị tổng trong modal cart
            var totalPriceCart = parseInt($('#modal_cart_total_price').attr('data-value'));
            // Lấy giá trị của từng rowId trong cart
            var qtyPro = parseInt($('#' + id).attr('data-qty'));
            var pricePro = parseInt($('#' + id).attr('data-price'));
            var singleCart = parseInt(qtyPro * pricePro);
            var newPriceCart = parseInt(totalPriceCart - singleCart);
            swal({
                title: "Xóa sản phẩm khỏi giỏ hàng?",
                // text: "Sau khi xóa, bạn có thể thêm lại!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ url('cart/deleteProduct/') }}/" + dataId,
                            type: "GET",
                            success:function (data){


                                // Xóa sản phẩm trong giỏ hàng hiện tại
                                $('#' + dataId).remove();
                                // Xóa sản phẩm trong giỏ hàng ở phần modal
                                $('#modal_cart_product_' + dataId).remove();

                                $('#content_value_cart').html($(data));
                                $('#fe_count_product').text(newNumber);
                                $('#fe_cart_count_product').text(newNumber);
                                $('#content_cart_number').text(newNumber);
                                // Lấy giá trị text hiện tại ở giá trị đơn hàng gàn vào tổng tạm tính trông phần modal cart
                                var total_modal = $('#cart_price').text();
                                $('#modal_cart_total_price').text(total_modal);

                                $('#modal_cart_total_price').attr('data-value', newPriceCart);
                            }
                        });
                    } else {
                        // swal("Không có gì thay đổi!");
                    }
                });
        }
    </script>
@endsection
