@extends('admin.admin_layout')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.index') }}">Trang chủ</a>
            @if($orders->order_status == 0)
                <a class="breadcrumb-item" href="{{ route('admin.orders.new') }}">Đơn hàng mới</a>
                <span class="breadcrumb-item active">Chi tiết đơn hàng</span>
            @elseif($orders->order_status == 1)
                <a class="breadcrumb-item" href="{{ route('admin.orders.accept') }}">Đơn hàng đã xác nhận</a>
                <span class="breadcrumb-item active">Chi tiết đơn hàng</span>
            @elseif($orders->order_status == 2)
                <a class="breadcrumb-item" href="{{ route('admin.orders.sent') }}">Đơn hàng đang gửi</a>
                <span class="breadcrumb-item active">Chi tiết đơn hàng</span>
            @elseif($orders->order_status == 3)
                <a class="breadcrumb-item" href="{{ route('admin.orders.success') }}">Đơn hàng hoàn thành</a>
                <span class="breadcrumb-item active">Chi tiết đơn hàng</span>
            @elseif($orders->order_status == 4)
                {{--     Shop hủy   --}}
                <a class="breadcrumb-item" href="{{ route('admin.orders.cancel') }}">Đơn hàng đã hủy</a>
                <span class="breadcrumb-item active">Chi tiết đơn hàng</span>
            @elseif($orders->order_status == 5)
                {{--     Khách hủy   --}}
                <a class="breadcrumb-item" href="{{ route('admin.orders.cancel') }}">Đơn hàng đã hủy</a>
                <span class="breadcrumb-item active">Chi tiết đơn hàng</span>
            @endif

        </nav>
        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Chi tiết đơn hàng</h6>
                <br>
                <div class="table-wrapper">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">Thông tin chi tiết <strong>Đơn hàng</strong></div>
                                <div class="card-body">
                                    <table class="table">
                                        <tr>
                                            <th>Mã đơn hàng :</th>
                                            <th>{{ $orders->order_code }}</th>
                                        </tr>
                                        <tr>
                                            <th>Loại thanh toán :</th>
                                            <th>
                                                @if($orders->payment_type == 'stripe')
                                                    Thanh toán qua Stripe
                                                @elseif($orders->payment_type == 'cod')
                                                    Thanh toán khi nhận hàng
                                                @endif
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Tổng tính:</th>
                                            <th>{{ $orders->order_subtotal }}</th>
                                        </tr>
                                        <tr>
                                            <th>Giảm giá :</th>
                                            <th>{{ $orders->order_sale }}</th>
                                        </tr>
                                        <tr>
                                            <th>Mã giảm giá :</th>
                                            <th>{{ $orders->order_coupons }}</th>
                                        </tr>
                                        <tr>
                                            <th>Phí vận chuyển :</th>
                                            <th>{{ $orders->order_shipping }}</th>
                                        </tr>
                                        <tr>
                                            <th>Tỏng đơn hàng :</th>
                                            <th>{{ $orders->order_total }}</th>
                                        </tr>
                                        <tr>
                                            <th>Trạng thái :</th>
                                            <th>
                                                @if($orders->order_status == 0)
                                                    <span class="badge badge-warning">Mới</span>
                                                @elseif($orders->order_status == 1)
                                                    <span class="badge badge-danger">Đã xác nhận</span>
                                                @elseif($orders->order_status == 2)
                                                    <span class="badge badge-primary">Đang gửi hàng</span>
                                                @elseif($orders->order_status == 3)
                                                    <span class="badge badge-success">Hoàn thành</span>
                                                @elseif($orders->order_status == 4)
                                                    {{--     Shop hủy   --}}
                                                    <span class="badge badge-dark">Hệ thống hủy</span>
                                                @elseif($orders->order_status == 5)
                                                    {{--     Khách hủy   --}}
                                                    <span class="badge badge-dark">Khách hủy</span>
                                                @endif
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Ngày đặt hàng :</th>
                                            <th>{{ date('H:i:s d-m-Y', strtotime($orders->created_at)) }}</th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">Thông tin chi tiết <strong>Khách hàng</strong></div>
                                <div class="card-body">
                                    <table class="table">
                                        <tr>
                                            <th>Tên khách hàng :</th>
                                            <th>{{  }}</th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- card -->

        </div><!-- sl-pagebody -->
        <footer class="sl-footer">
            <div class="footer-left">
                <div class="mg-b-2">Học viện Công nghệ Bưu chính Viễn thông</div>
                <div>Khoa Công nghệ thông tin</div>
            </div>
        </footer>
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
@endsection


