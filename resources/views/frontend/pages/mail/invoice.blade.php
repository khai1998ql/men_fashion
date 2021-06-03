<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Đặt hàng thành công</title>
</head>
<body>
<?php
    //    use CarbonCarbon;
    use Carbon\Carbon;

    $dt = Carbon::now('Asia/Ho_Chi_Minh');
    $date1 = $dt->addDays(3)->toDateString();
//        dd($date1);
    $date = date('d-m-Y', strtotime($date1));
//        dd($date);

//    // Xử lý phần Cart
    $sum_sale = 0;
    $sum_total = 0;
    $charge_shipping = 0;
    $sum_coupons = 0;
    if(Session::has('coupons')){
        $sum_coupons = intval(Session::get('coupons')['coupons_value']);
    }
    if(Session::has('shipping')){
        $charge_shipping = intval(Session::get('shipping')['charge_shipping']);
    }
    foreach (Cart::content() as $item){
        if(intval($item->options->discount_price) > 0 && $item->options->discount_price != null){
            $sum_sale += intval($item->price) * intval($item->qty) * intval($item->options->discount_price) / 100;
        }
    }
    $sum_total = intval(Cart::total()) - $sum_sale + $charge_shipping - $sum_coupons;
?>

    <div  style="width: 100%;background: rgb(242,242,242)">
        <div class="container" style="max-width: 600px;border: 2px solid dodgerblue;background: white; display: block; margin: 0 auto;">
            <h1 style="color: black; font-weight: bold; text-align: center; margin-top: 30px">ECOMMERCE SHOP</h1>
            <hr style="border: none; height: 5px; width: 100%; background-color: dodgerblue">
            <div class="" style="padding: 10px 10px">
                <div>
                    <h3>Cảm ơn quý khách đã đặt hàng tại website chúng tôi!</h3>
                    <p>Đơn hàng  <span style="color: #02acea; font-weight: bold; font-size: 18px">{{ $info['order_code'] }}</span>  đã được tiếp nhận và đang trong quá trình xử lý.</p>
                </div>
                <div style="display: flex; ">
                    <div style="flex: 1">
                        <h3>Thông tin thanh toán</h3>
                        <p>Họ tên: <span>{{ $info['ship_name'] }}</span> </p>
                        <p>Số điện thoại: <span>{{ $info['ship_phone'] }}</span></p>
                        <p>Email: <span>{{ $info['email'] }}</span></p>
                    </div>
                    <div style="flex: 1; max-width: 50%">
                        <h3>Địa chỉ giao hàng</h3>
                        <p>Địa chỉ: <span>{{ $info['ship_address'] }}</span></p>

                    </div>
                </div>
                <div>
                    <div>
                        <p><span style="font-weight: bold">Phương thức thanh toán: </span>{{ $info['payment_type'] }}</p>
                        <p><span style="font-weight: bold">Thời gian giao hàng dự kiến: </span>{{ $date }}</p>
                        <p><span style="font-weight: bold">Khung giờ giao hàng: </span>{{ $info['ship_deliveryTime'] }}</p>
                        <p><span style="font-weight: bold">Trạng thái đơn hàng: </span>Mới</p>
                    </div>
                </div>
                <div style="width: 100%;">
                    <table style="width: 100%;">
                        <thead style="font-size: 18px">
                        <tr style="background-color: deepskyblue">
                            <th colspan="3" style="border: 0px solid white;padding: 10px 0;color: white">Sản phẩm</th>
                            <th colspan="1.5" style="border: 0px solid white;padding: 10px 0;color: white">Đơn giá</th>
                            <th colspan="0.5" style="border: 0px solid white;padding: 10px 0;color: white">SL</th>
                            <th colspan="1.5" style="border: 0px solid white;padding: 10px 0;color: white">Thành tiền</th>
                        </tr>
                        </thead>
                        <tbody style="font-size: 16px">
                        @foreach(Cart::content() as $item)
                            <tr style="background-color: whitesmoke">
                                <td colspan="3" style="border: 0px solid white;padding: 10px 10px">{{ $item->name }} - {{ $item->options->color }} - {{ $item->options->size }}</td>
                                <td colspan="1" style="text-align: center;border: 0px solid white;padding: 10px 10px">{{ formatPrice($item->price) }}</td>
                                <td colspan="1" style="text-align: center;border: 0px solid white;padding: 10px 10px">{{ $item->qty }}</td>
                                <td colspan="1" style="text-align: center;border: 0px solid white;padding: 10px 10px">{{ formatPriceSale($item->price, intval($item->options->discount_price)) }}</td>
                            </tr>
                        @endforeach
                        <tr style="background-color: ghostwhite">
                            <td colspan="5" style="text-align: right">Tổng tạm tính: </td>
                            <td style="text-align: center">{{ formatPrice(Cart::total()) }}</td>
                        </tr>
                        <tr style="background-color: ghostwhite">
                            <td colspan="5" style="text-align: right">Khuyến mãi: </td>
                            <td style="text-align: center">{{ formatPrice($sum_sale) }}</td>
                        </tr>
                        @if(Session::has('coupon'))
                            <tr style="background-color: ghostwhite">
                                <td colspan="5" style="text-align: right">Mã giảm giá: </td>
                                <td style="text-align: center">{{ formatPrice($sum_coupons) }}</td>
                            </tr>
                        @else
                        @endif
                        @if(Session::has('shipping'))
                            <tr style="background-color: ghostwhite">
                                <td colspan="5" style="text-align: right">Phí vận chuyển: </td>
                                <td style="text-align: center">{{ formatPrice($charge_shipping) }}</td>
                            </tr>
                        @else
                        @endif
                        <tr style="background-color: whitesmoke">
                            <td colspan="5" style="text-align: right"><span style="font-weight: bold">Tổng giá trị đơn hàng: </span> </td>
                            <td style="text-align: center">{{ formatPrice($sum_total) }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div style="padding: 0 20px; margin-top: 20px; font-size: 16px">
                    <div class="col-lg-12">
                        <div style="border: 3px dotted dodgerblue; padding: 20px 30px">
                            {{ $info['ship_note'] }}
                        </div><br/><br/>
                    </div>

                </div>
            </div>

        </div>
    <div>
        <?php
            if(Session::has('coupons')){
                Session::forget('coupons');
            }
            if(Session::has('shipping'))   {
                Session::forget('shipping');
            }
            Cart::destroy();
        ?>
    </div>
</body>
</html>
