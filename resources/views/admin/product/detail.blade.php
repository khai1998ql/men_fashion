@extends('admin.admin_layout')

@section('admin_content')
    <link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" xmlns=""
          xmlns=""/>
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.index') }}">Trang chủ</a>
            <a class="breadcrumb-item" href="{{ route('admin.product.index') }}">Sản phẩm</a>
            <span class="breadcrumb-item active">Chi tiết sản phẩm</span>
        </nav>
        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Chi tiết sản phẩm<a href="{{ route('admin.product.index') }}" class="btn btn-sm btn-success" style="float: right">TẤT CẢ SP</a></h6>
                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" style="font-weight: bold">Tên sản phẩm: </label>
                                <div>{{ $product->product_name }}</div>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" style="font-weight: bold">Mã sản phẩm: </label>
                                <div>{{ $product->product_code }}</div>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" style="font-weight: bold">Giá bán: </label>
                                <div>{{ $product->product_price }}</div>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label" style="font-weight: bold">Danh mục sản phẩm: </label>
                                <div>{{ $product->category_name }}</div>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label" style="font-weight: bold">Danh mục con sản phẩm: </label>
                                <div>{{ $product->subcategory_name }}</div>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" style="font-weight: bold">Giảm giá: </label>
                                <div>{{ $product->discount_price }}</div>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" style="font-weight: bold">Mô tả sản phẩm: </label>
                                <div>{!! $product->product_content !!}</div>
                            </div>
                        </div><!-- col-12 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" style="font-weight: bold">Bảng danh sách sản phẩm theo màu, size, qty: </label>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">STT</th>
                                            <th scope="col">Màu</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Số lượng còn lại</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($product_detail as $key => $item)
                                        <tr>
                                            <td scope="row">{{ $key+1 }}</td>
                                            <td>{{ $item->product_color }}</td>
                                            <td>{{ $item->product_size }}</td>
                                            <td>{{ $item->product_qty }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- col-12 -->
                        <div class="col-lg-12" id="div_img_avatar" style="margin-bottom: 100px;">
                            <label class="form-control-label">Avatar: </label><br/>
                            <label class="custom-file" style="display:block;max-width: 400px !important;">
                                <img src="{{ URL::to($product->product_avatar) }}" alt="" style="max-width: 100px">
                            </label>
                        </div><!-- col -->
                        @php
                            $image = $product->product_images_big;
                            $images = explode('|', $image);
                        @endphp
                        <div class="col-lg-12">
                            <h5 style="color: red; margin-bottom: 20px">Hình ảnh sản phẩm</h5>
                        </div>
                        @foreach($images as $key => $item)
                            <div class="col-lg-3" id="div_img_{{ $key }}" style="margin-bottom: 20px;max-width: 20% !important;">
                                <label class="form-control-label">Hình {{ $key+1 }}: </label><br/>
                                <img src="{{ URL::to($item) }}" alt="" style="width: 100%">
                            </div><!-- col -->
                        @endforeach

                        @php
                            $image_color = $product->product_images_small;
                            $images_color = explode('|', $image_color);
                        @endphp
                        <div class="col-lg-12">
                            <h5 style="color: red; margin-bottom: 20px">Hình ảnh màu sắc sản phẩm</h5>
                        </div>
                        @foreach($images_color as $key => $item)
                            <div class="col-lg-3" id="div_img_{{ $key }}" style="margin-bottom: 20px;max-width: 20% !important;">
                                <label class="form-control-label">Hình {{ $key+1 }}: </label><br/>
                                <img src="{{ URL::to($item) }}" alt="" style="width: 100%">
                            </div><!-- col -->
                        @endforeach
                    </div><!-- row -->
                    <hr><br/>
                    <div class="row">
                        <div class="col-lg-4">
                            @if($product->hot_deal == 1)
                                <div class="badge badge-success">Active</div><span> Giảm giá</span>
                            @else
                                <div class="badge badge-danger">Inactive</div><span>Giảm giá</span>
                            @endif
                        </div><!-- col-3 -->
                        <div class="col-lg-4">
                            @if($product->hot_new == 1)
                                <div class="badge badge-success">Active</div><span> Giảm giá</span>
                            @else
                                <div class="badge badge-danger">Inactive</div><span>Giảm giá</span>
                            @endif
                        </div><!-- col-3 -->
                        <div class="col-lg-4">
                            @if($product->trend == 1)
                                <div class="badge badge-success">Active</div><span> Giảm giá</span>
                            @else
                                <div class="badge badge-danger">Inactive</div><span>Giảm giá</span>
                            @endif
                        </div><!-- col-3 -->
                    </div>
                    <br/><br/>
                    <div class="form-layout-footer" style="text-align: center">
                        <a href="{{ URL::to('admin/product/edit/'.$product->id) }}" class="btn btn-info">Sửa sản phẩm</a>
                        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Quay lại</a>
                        {{--                            <button class="btn btn-secondary">Cancel</button>--}}
                    </div><!-- form-layout-footer -->
                </div><!-- form-layout -->
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
@endsection


