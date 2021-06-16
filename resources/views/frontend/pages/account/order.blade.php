@extends('frontend.layouts.frontend_layout')
@section('frontend_title')

    <title>Thông tin tài khoản</title>

@endsection
@section('frontend_css')
    <link rel="stylesheet" href="{{ asset('public/frontend/css/order.css')}}">
@endsection

@section('frontend_content')

    <!-- CONTAINER -->

    <div class="container app_container">
        <div class="app_container_titile">Đơn hàng</div>
        <div class="app_container_navbar">
            <a href="{{ route('fe.profile.info') }}" class="app_container_navbar_list">Thông tin cá nhân</a>
            <a href="{{ route('fe.profile.password') }}" class="app_container_navbar_list">Thay đổi mật khẩu</a>
            <a href="{{ route('fe.profile.order') }}" class="app_container_navbar_list app_container_navbar_active">Đơn hàng</a>
            <a href="{{ route('fe.profile.wishlist') }}" class="app_container_navbar_list">Sản phẩm yêu thích</a>
        </div>
        <div class="app_container_title">
            <div class="app_container_title_text">Đơn hàng (<span>0</span>)</div>
            <select name="" id="" class="app_container_title_select">
                <option value="">Tất cả</option>
                <option value="">Trong 7 ngày</option>
                <option value="">Trong 30 ngày</option>
                <option value="">Trong 6 tháng</option>
                <option value="">Trong 1 năm</option>
            </select>
        </div>
        <div class="app_container_content">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Mã đơn hàng</th>
                    <th scope="col">Ngày mua</th>
                    <th scope="col" style="max-width: 400px !important;">Sản phẩm</th>
                    <th scope="col">Tổng tiền</th>
                    <th scope="col">Trạng thái đơn</th>
                    <th scope="col">Hành động</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($orders as $item)
                        <tr>
                            <td>{{ $item->order_code }}</td>
                            <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                            <td style="max-width: 400px !important;">
                                @php
                                    $order_detail = DB::table('orders_detail')->where('order_id', $item->id)->get();
                                @endphp
                                @foreach($order_detail as $itemDetail)
                                    @php
                                        $product = DB::table('products')
                                                    ->join('categories', 'products.category_id', 'categories.id')
                                                    ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
                                                    ->select('products.product_name', 'categories.category_name', 'subcategories.subcategory_name')
                                                    ->where('products.id', $itemDetail->product_id)
                                                    ->first();
                                    @endphp
                                    <a href="{{ URL::to(to_slug($product->category_name).'/'.to_slug($product->subcategory_name).'/'.to_slug($product->product_name)) }}" class="app_container_content_product_link">{{ $itemDetail->product_name }} - Màu {{ $itemDetail->color }} - Size {{ $itemDetail->size }} - SL: ({{ $itemDetail->quantity }})</a><br>
                                @endforeach
                            </td>
                            <td style="font-weight: 700;">{{ formatPrice($item->order_total) }}</td>
                            <td>
                                @if($item->order_status == 0)
                                    <span class="badge bg-warning">Mới</span>
                                @elseif($item->order_status == 1)
                                    <span class="badge bg-danger">Đã xác nhận</span>
                                @elseif($item->order_status == 2)
                                    <span class="badge bg-primary">Đang gửi hàng</span>
                                @elseif($item->order_status == 3)
                                    <span class="badge bg-success">Hoàn thành</span>
                                @elseif($item->order_status == 4)
                                    {{--     Shop hủy   --}}
                                    <span class="badge bg-dark">Hệ thống hủy</span>
                                @elseif($item->order_status == 5)
                                    {{--     Khách hủy   --}}
                                    <span class="badge bg-dark">Khách hủy</span>
                                @endif
                            </td>
                            <td>
                                @if($item->order_status == 0)
                                <a href="{{ URL::to('orders/cancel/'.$item->order_code) }}" class="btn btn-dark" id="cancelOrders">Hủy đơn</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- END CONTAINER -->

@endsection
