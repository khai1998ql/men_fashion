@extends('admin.admin_layout')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.index') }}">Trang chủ</a>
            <span class="breadcrumb-item active">Danh sách đơn hàng mới</span>
        </nav>
        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Danh sách đơn hàng mới</h6>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p">Mã đơn hàng</th>
                            <th class="wd-10p">HTTT</th>
                            <th class="wd-15p">Tổng tiền</th>
                            <th class="wd-15p">Thời gian đặt</th>
                            <th class="wd-15p">Trạng thái</th>
                            <th class="wd-15p">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order as $key => $item)
                            <tr style="font-weight: bold; font-size: 14px">
                                <td>{{ $item->order_code }}</td>
                                <td>{{ strtoupper($item->payment_type) }}</td>
                                <td style="color: red">{{ formatPrice($item->order_total) }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                <td style="font-weight: bold;">
                                    @if($item->order_status == 0)
                                        <span class="badge badge-warning">Mới</span>
                                    @elseif($item->order_status == 1)
                                        <span class="badge badge-danger">Đã xác nhận</span>
                                    @elseif($item->order_status == 2)
                                        <span class="badge badge-primary">Đang gửi hàng</span>
                                    @elseif($item->order_status == 3)
                                        <span class="badge badge-success">Hoàn thành</span>
                                    @elseif($item->order_status == 4)
                                        {{--     Shop hủy   --}}
                                        <span class="badge badge-dark">Đã hủy</span>
                                    @elseif($item->order_status == 5)
                                        {{--     Khách hủy   --}}
                                        <span class="badge badge-dark">Đã hủy</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ URL::to('') }}" class="btn btn-sm btn-success">Chi tiết</a>
                                    <a href="" class="btn btn-sm btn-dark" id="delete">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->
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


