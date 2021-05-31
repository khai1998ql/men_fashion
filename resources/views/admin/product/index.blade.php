@extends('admin.admin_layout')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.index') }}">Trang chủ</a>
            <a class="breadcrumb-item" href="{{ route('admin.product.index') }}">Sản phẩm</a>
            <span class="breadcrumb-item active">Danh sách sản phẩm</span>
        </nav>
        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Danh sách sản phẩm<a href="{{ route('admin.product.add') }}" class="btn btn-sm btn-warning" style="float: right">THÊM MỚI</a></h6>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p">Mã sản phẩm</th>
                            <th class="wd-15p">Hình ảnh</th>
                            <th class="wd-40p">Thông tin sản phẩm</th>
                            <th class="wd-10p">Trạng thái</th>
                            <th class="wd-20p">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $key => $item)
                            <tr>
                                <td>{{ $item->product_code }}</td>
                                <td><img src="{{ asset($item->product_avatar) }}" alt="" style="max-width: 70%;"></td>
                                <td>
                                    <span style="font-weight: bold">{{ $item->product_name }}</span>
                                    <br>- <span style="font-weight: bold">Danh mục: </span><span style="color: red; font-weight: bold">{{ $item->category_name }}</span>
                                    <br>- <span style="font-weight: bold">Danh mục con: </span><span style="color: red; font-weight: bold">{{ $item->subcategory_name }}</span>
                                    @php
                                        // Lấy số lượng sản phẩm còn lại
                                        $number = DB::table('product_detail')->select(DB::raw('SUM(product_qty) as qtyPro'))->where('product_id', $item->id)->first();
                                    @endphp
                                    <br>- <span style="font-weight: bold">Số lượng còn lại: </span><span style="color: red; font-weight: bold">{{ $number->qtyPro }}</span>
                                </td>
                                <td>
                                    <div id="product_status_{{ $item->id }}">
                                        @if($item->product_status == 1)
                                            <div class="badge badge-success">Active</div>
                                        @else
                                            <div class="badge badge-dark">Inactive</div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ URL::to('admin/product/detail/'.$item->id) }}" title="Xem chi tiết" class="btn btn-sm btn-info"><span class="ti-eye"></span></a>
                                    <a href="{{ URL::to('admin/product/edit/'.$item->id) }}" title="Sửa sản phẩm" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="{{ URL::to('admin/product/delete/'.$item->id) }}" title="Xóa sản phẩm" class="btn btn-sm btn-danger" id="delete"><span class="ti-trash"></span></a>
                                    <span id="product_action_{{ $item->id }}">
                                        @if($item->product_status == 1)
                                            <span class="btn btn-sm btn-success" onclick="productStatus(this.id)" id="product_status_btn_{{$item->id}}" data-status="1" data-id="{{ $item->id }}" title="Active" style="cursor: pointer">
                                                <span id="product_status_span_{{ $item->id }}" class="ti-thumb-up"></span>
                                            </span>
                                        @else
                                            <span class="btn btn-sm btn-dark" onclick="productStatus(this.id)" id="product_status_btn_{{$item->id}}" data-status="0" data-id="{{ $item->id }}" title="Inactive" style="cursor: pointer">
                                                <span id="product_status_span_{{ $item->id }}" class="ti-thumb-down"></span>
                                            </span>
                                        @endif
                                    </span>
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
    <script type="text/javascript">
        function productStatus(id){
            var idStatusBtn = '#' + id;
            var dataId = $(idStatusBtn).attr('data-id');
            var dataStatus = $(idStatusBtn).attr('data-status');
            var idStatus = 'product_status_' + dataId;
            var idAction = 'product_action_' + dataId;
            if(dataStatus == 1){
                $(idStatusBtn).attr('data-status', 0);
                document.getElementById(idStatus).innerHTML =   '<div class="badge badge-dark">Inactive</div>';
                document.getElementById(idAction).innerHTML =   '<span class="btn btn-sm btn-dark" onclick="productStatus(this.id)" id="product_status_btn_'+dataId+'" data-status="0" data-id="'+dataId+'" title="Inactive" style="cursor: pointer">'
                                                                        +'<span id="product_status_span_'+dataId+'" class="ti-thumb-down"></span>'
                                                                +'</span>';
            }else{
                $(idStatusBtn).attr('data-status', 1);
                document.getElementById(idStatus).innerHTML = '<div class="badge badge-success">Active</div>';
                document.getElementById(idAction).innerHTML =   '<span class="btn btn-sm btn-success" onclick="productStatus(this.id)" id="product_status_btn_'+dataId+'" data-status="1" data-id="'+dataId+'" title="Active" style="cursor: pointer">'
                    +'<span id="product_status_span_'+dataId+'" class="ti-thumb-up"></span>'
                    +'</span>';
            }
            $.ajax({
                url: "{{ url('admin/product/changeStatus/') }}/"+dataId,
                type: "GET",
                dataType: "json",
                success:function (data){
                    var message = data.notification.message;
                    toastr.success(message);
                }
            })
        }
    </script>
@endsection


