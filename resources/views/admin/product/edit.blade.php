@extends('admin.admin_layout')

@section('admin_content')
    <link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" xmlns=""
          xmlns=""/>
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.index') }}">Trang chủ</a>
            <a class="breadcrumb-item" href="{{ route('admin.product.index') }}">Sản phẩm</a>
            <span class="breadcrumb-item active">Chỉnh sửa sản phẩm</span>
        </nav>
        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Chỉnh sửa sản phẩm</h6>
                <form action="{{ route('admin.product.updateInfo') }}" method="POST" class="" id="product_submit">
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Tên sản phẩm: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="product_name" value="{{ $product->product_name }}" placeholder="Nhập tên sản phẩm">
                                    @error('product_name')
                                    <div style="margin-top: 8px;color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Mã sản phẩm: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="product_code" value="{{ $product->product_code }}" placeholder="Nhập mã sản phẩm">
                                    @error('product_code')
                                    <div style="margin-top: 8px;color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Giá bán: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="product_price" value="{{ $product->product_price }}" placeholder="Nhập giá bán">
                                    @error('product_price')
                                    <div style="margin-top: 8px;color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Danh mục sản phẩm: <span class="tx-danger">*</span></label>
                                    <select name="category_id" id="category_id" onchange="getSubcategory()" class="form-control select2" data-placeholder="Chọn danh mục sản phẩm">
{{--                                        <option label="Chọn danh mục sản phẩm"></option>--}}
                                        @foreach($categories as $key => $item)
                                            <option value="{{ $item->id }}" @if($item->id == $product->category_id) selected @endif>{{ $item->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div style="margin-top: 8px;color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Danh mục con sản phẩm: <span class="tx-danger">*</span></label>
                                    <select name="subcategory_id" id="subcategory_id" class="form-control select2" data-placeholder="Chọn danh mục con sản phẩm">
{{--                                        <option label="Chọn danh mục con sản phẩm"></option>--}}
                                        @foreach($subcategories as $key => $item)
                                            <option value="{{ $item->id }}" @if($item->id == $product->subcategory_id) selected @endif>{{ $item->subcategory_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subcategory_id')
                                    <div style="margin-top: 8px;color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Giảm giá: </label>
                                    <input class="form-control" type="text" name="discount_price" value="{{ $product->discount_price }}" placeholder="Nhập giảm giá(%)">
                                    @error('discount_price')
                                    <div style="margin-top: 8px;color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Mô tả sản phẩm: <span class="tx-danger">*</span></label>
                                    <textarea class="form-control" name="product_content" id="summernote">{{ $product->product_content }}</textarea>
                                    @error('product_content')
                                    <div style="margin-top: 8px;color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- col-12 -->
                            @php
                                // Chuỗi để lấy id product_detail
                                $detailArray = array();



                            @endphp
                            @foreach($product_detail as $key => $item)
                                @php
                                    $detailArray[] = $item->id;
                                    // Array lưu giá gị collor, size,qty
                                    $detailIn = array();
                                    $detailIn['product_color'] = $item->product_color;
                                    $detailIn['product_size'] = $item->product_size;
                                    $detailIn['product_qty'] = $item->product_qty;
                                    $detailValue = implode(',', $detailIn);
                                @endphp
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Nhập (màu. size, qty):</label><br/>
                                        <input class="form-control" type="text" name="detail{{ $item->id }}" value="{{ $detailValue }}" id="input" data-role="tagsinput">
                                    </div>
                                </div><!-- col-6 -->

                            @endforeach
                            @php
                                $detailString = implode(',', $detailArray);
                            @endphp
                        </div><!-- row -->
                        <hr><br/>
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="ckbox">
                                    <input type="checkbox" name="hot_deal" @if($product->hot_deal == 1) checked @endif value="1"><span>Giảm giá</span>
                                </label>
                            </div><!-- col-3 -->
                            <div class="col-lg-3">
                                <label class="ckbox">
                                    <input type="checkbox" name="hot_new" @if($product->hot_new == 1) checked @endif value="1"><span>Mới</span>
                                </label>
                            </div><!-- col-3 -->
                            <div class="col-lg-3">
                                <label class="ckbox">
                                    <input type="checkbox" name="trend" @if($product->trend == 1) checked @endif value="1"><span>Xu hướng</span>
                                </label>
                            </div><!-- col-3 -->
                        </div>
                        <br/>
                        <div class="form-layout-footer" style="text-align: center">
                            <input name="product_info"  value="{{ $product->id }}" hidden>
                            <input name="detailString"  value="{{ $detailString }}" hidden>
                            <button type="submit" class="btn btn-info mg-r-5">Cập nhật</button>
                            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Quay lại</a>
                            {{--                            <button class="btn btn-secondary">Cancel</button>--}}
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
            </div><!-- card -->

        </div><!-- sl-pagebody -->
        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Thêm thuộc tính sản phẩm</h6>
                <form action="{{ route('admin.product.updateDetail') }}" method="POST" class="" id="product_submit">
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-25">

                            @for($i = 1; $i <= 30; $i++)
                                <div class="col-lg-3" style="max-width: 20%">
                                    <div class="form-group">
                                        <label class="form-control-label">Nhập (màu. size, qty):({{ $i }})</label><br/>
                                        <input class="form-control" type="text" name="detail{{ $i }}" value="" id="input" data-role="tagsinput">
                                    </div>
                                </div><!-- col-6 -->
                            @endfor

                        </div><!-- row -->
                        <hr><br/>

                        <br/>
                        <div class="form-layout-footer" style="text-align: center">
                            <input name="productDetail" value="{{ $product->id }}" hidden>
                            <button type="submit" class="btn btn-info mg-r-5">Thêm mới</button>
                            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Quay lại</a>
                            {{--                            <button class="btn btn-secondary">Cancel</button>--}}
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
            </div><!-- card -->

        </div><!-- sl-pagebody -->
        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h4 class="card-body-title">Chỉnh sửa hình ảnh sản phẩm</h4>
{{--                <h2 style="color: red; margin-top: 20px">Hình ảnh cũ</h2>--}}
                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-12">
                            <h5 style="color: red; margin-bottom: 20px">Avatar sản phẩm</h5>
                        </div>
                        <div class="col-lg-12" style="margin-bottom: 100px;">
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
                            <div class="col-lg-3" style="margin-bottom: 20px;max-width: 20% !important;">
                                <label class="form-control-label">Hình {{ $key+1 }}: </label><br/>
                                <img src="{{ URL::to($item) }}" alt="" style="width: 100%">
                            </div><!-- col -->
                        @endforeach

                        @php
                            $imageColor = $product->product_images_small;
                            $imagesColor = explode('|', $imageColor);
                        @endphp
                        <div class="col-lg-12">
                            <h5 style="color: red; margin-bottom: 20px">Hình ảnh màu sắc sản phẩm</h5>
                        </div>
                        @foreach($imagesColor as $key => $item)
                            <div class="col-lg-3" style="margin-bottom: 20px;max-width: 20% !important;">
                                <label class="form-control-label">Hình {{ $key+1 }}: </label><br/>
                                <img src="{{ URL::to($item) }}" alt="" style="width: 100%">
                            </div><!-- col -->
                        @endforeach
                    </div><!-- row -->
                    <hr><br/>
                </div><!-- form-layout -->
                <form action="{{ route('admin.product.updateImages') }}" method="POST" class="" id="product_submit" enctype="multipart/form-data">
                    @csrf
                    <h6 style="color: red; margin-top: 20px;margin-bottom: 20px">Hình ảnh mới</h6>
                    <div class="form-layout">
                        <div class="row mg-b-25">

                            <div class="col-lg-12" id="div_img_avatar" style="margin-bottom: 40px;">
                                <label class="form-control-label">Avatar: <span class="tx-danger">*</span></label><br/>
                                <label class="custom-file" style="display:block;max-width: 400px !important;">>
                                    <input type="file" id="file" class="custom-file-input" name="product_avatar" onchange="readURL0(this);">
                                    <span class="custom-file-control"></span>
                                    <img src="#" id="product_avatar" style="display: none">
                                    @error('product_avatar')
                                    <div style="margin-top: 8px;color: red;">{{ $message }}</div>
                                    @enderror
                                </label>
                            </div><!-- col -->
                            @for($i = 1; $i <= 30; $i++)
                                {{--                                style="margin-top: 30px; display: block;height:220px"--}}
                                <div class="col-lg-3" id="div_img_{{ $i }}" style="margin-bottom: 20px;max-width: 20% !important;">
                                    <label class="form-control-label">Hình {{ $i }}: </label><br/>
                                    <label class="custom-file" style="display:block;">
                                        <input type="file" id="file" class="custom-file-input" name="product_image_{{ $i }}" onchange="readURL{{ $i }}(this);">
                                        <span class="custom-file-control"></span>
                                        <img src="#" id="product_image_{{ $i }}" style="display: none">
                                    </label>
                                </div><!-- col -->
                            @endfor

                            <div class="col-lg-12">
                                <h5 style="color: red; margin-bottom: 20px; margin-top: 20px">Màu sản phẩm</h5>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Nhập màu sản phẩm:</label><br/>
                                    <input class="form-control" type="text" name="product_color_name" value="{{ old('product_color_name') }}" id="input" data-role="tagsinput" style="width: 100%">
                                </div>
                            </div><!-- col-6 -->
                            <div class="col-lg-12">
                                <h5 style="color: red; margin-bottom: 20px; margin-top: 20px">Hình ảnh sản phẩm theo từng màu</h5>
                            </div>
                            @for($i = 1; $i <= 10; $i++)
                                {{--                                style="margin-top: 30px; display: block;height:220px"--}}
                                <div class="col-lg-3" id="div_img_color_{{ $i }}" style="margin-bottom: 20px;max-width: 20% !important;">
                                    <label class="form-control-label">Màu {{ $i }}: </label><br/>
                                    <label class="custom-file" style="display:block;">
                                        <input type="file" id="file" class="custom-file-input" name="product_image_color_{{ $i }}" onchange="readURL_color{{ $i }}(this);">
                                        <span class="custom-file-control"></span>
                                        <img src="#" id="product_image_color_{{ $i }}" style="display: none">
                                    </label>
                                </div><!-- col -->
                            @endfor
                        </div><!-- row -->
                        <hr><br/>

                        <div class="form-layout-footer" style="text-align: center">
                            <input name="idProduct" value="{{ $product->id }}" hidden>
                            <input name="product_name" value="{{ $product->product_name }}" hidden>
                            <input name="idAvatar" value="{{ $product->product_avatar }}" hidden>
                            <input name="idImage" value="{{ $product->product_images_big }}" hidden>
                            <input name="idImageColor" value="{{ $product->product_image_color }}" hidden>
                            <input name="idImageSmall" value="{{ $product->product_images_small }}" hidden>
                            <button type="submit" class="btn btn-info mg-r-5">Thêm mới</button>
                            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Quay lại</a>
                            {{--                            <button class="btn btn-secondary">Cancel</button>--}}
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
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
    // Multi tag input
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

    <script type="text/javascript">
        function readURL0(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#product_avatar')
                        .attr('src', e.target.result)
                        .width(120)
                        .height(150);
                };
                reader.readAsDataURL(input.files[0]);
            }
            $('#div_img_avatar').css({'display' : 'block', 'height' : '220px'});
            $('#product_avatar').css({'display' : 'block', 'margin-top' : '-10px', 'margin-bottom' : '10px'});
        }
    </script>
    <script type="text/javascript">
        @for($i = 1; $i <= 30; $i++)
        function readURL{{ $i }}(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#product_image_{{ $i }}')
                        .attr('src', e.target.result)
                        .width(120)
                        .height(150);
                };
                reader.readAsDataURL(input.files[0]);

            }
            $('#div_img_{{ $i }}').css({'display' : 'block', 'height' : '220px'});
            $('#product_image_{{ $i }}').css({'display' : 'block', 'margin-top' : '5px', 'margin-bottom' : '10px'});
        };
        @endfor

    </script>
    <script type="text/javascript">
        @for($i = 1; $i <= 10; $i++)
        function readURL_color{{ $i }}(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#product_image_color_{{ $i }}')
                        .attr('src', e.target.result)
                        .width(120)
                        .height(150);
                };
                reader.readAsDataURL(input.files[0]);

            }
            $('#div_img_color_{{ $i }}').css({'display' : 'block', 'height' : '220px'});
            $('#product_image_color_{{ $i }}').css({'display' : 'block', 'margin-top' : '5px', 'margin-bottom' : '10px'});
        };
        @endfor

    </script>
    <script>
        function getSubcategory(){
            var category_id  = $('#category_id').val();
            // console.log(category_id);
            $.ajax({
                url: "{{ url('admin/product/getSubCate/') }}/"+category_id,
                type: "GET",
                dataType: "json",
                success:function (data){
                    // console.log(data.subcategories);
                    $('select[name="subcategory_id"]').empty();
                    $('select[name="subcategory_id"]').append('<option label="Chọn danh mục con sản phẩm"></option>');
                    $.each(data.subcategories, function (key, item){
                        $('select[name="subcategory_id"]').append('<option value="'+item.id+'">'+item.subcategory_name+'</option>');
                    })
                }
            })
        }
    </script>
@endsection


