@extends('admin.admin_layout')

@section('admin_content')
    <link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" xmlns=""
          xmlns=""/>
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.index') }}">Trang chủ</a>
            <a class="breadcrumb-item" href="{{ route('admin.product.index') }}">Sản phẩm</a>
            <span class="breadcrumb-item active">Thêm mới sản phẩm</span>
        </nav>
        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Thêm mới sản phẩm<a href="{{ route('admin.product.index') }}" class="btn btn-sm btn-success" style="float: right">TẤT CẢ SP</a></h6>
                <form action="{{ route('admin.product.create') }}" method="POST" class="" id="product_submit" enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Tên sản phẩm: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="product_name" value="{{ old('product_name') }}" placeholder="Nhập tên sản phẩm" required>
                                    @error('product_name')
                                    <div style="margin-top: 8px;color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Mã sản phẩm: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="product_code" value="{{ old('product_code') }}" placeholder="Nhập mã sản phẩm" required>
                                    @error('product_code')
                                    <div style="margin-top: 8px;color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Giá bán: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="product_price" value="{{ old('product_price') }}" placeholder="Nhập giá bán" required>
                                    @error('product_price')
                                    <div style="margin-top: 8px;color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Danh mục sản phẩm: <span class="tx-danger">*</span></label>
                                    <select name="category_id" id="category_id" onchange="getSubcategory()" class="form-control select2" data-placeholder="Chọn danh mục sản phẩm" required>
                                        <option label="Chọn danh mục sản phẩm"></option>
                                        @foreach($categories as $key => $item)
                                        <option value="{{ $item->id }}">{{ $item->category_name }}</option>
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
                                    <select name="subcategory_id" id="subcategory_id" class="form-control select2" data-placeholder="Chọn danh mục con sản phẩm" required>
                                        <option label="Chọn danh mục con sản phẩm"></option>
                                    </select>
                                    @error('subcategory_id')
                                    <div style="margin-top: 8px;color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Giảm giá: </label>
                                    <input class="form-control" type="text" name="discount_price" value="0" placeholder="Nhập giảm giá(%)">
                                    @error('discount_price')
                                    <div style="margin-top: 8px;color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Mô tả sản phẩm: <span class="tx-danger">*</span></label>
                                    <textarea class="form-control" name="product_content" id="summernote" required>{{ old('product_content') }}</textarea>
                                    @error('product_content')
                                    <div style="margin-top: 8px;color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- col-12 -->
                            <div class="col-lg-12">
                                <h5 style="color: red; margin-bottom: 20px; margin-top: 20px">Chi tiết sản phẩm theo (màu, size, qty)</h5>
                            </div>
                            @for($i = 1; $i <= 30; $i++)
                                <div class="col-lg-3" style="max-width: 20%">
                                    <div class="form-group">
                                        <label class="form-control-label">Nhập (màu. size, qty):({{ $i }})</label><br/>
                                        <input class="form-control" type="text" name="detail{{ $i }}" value="{{ old('detail'.$i) }}" id="input" data-role="tagsinput">
                                    </div>
                                </div><!-- col-6 -->
                            @endfor
                            <div class="col-lg-12">
                                <h5 style="color: red; margin-bottom: 20px; margin-top: 20px">Avatar sản phẩm</h5>
                            </div>
                            <div class="col-lg-12" id="div_img_avatar" style="margin-bottom: 40px;">
                                <label class="form-control-label">Avatar: <span class="tx-danger">*</span></label><br/>
                                <label class="custom-file" style="display:block;max-width: 400px !important;">>
                                    <input type="file" id="file" class="custom-file-input" name="product_avatar" onchange="readURL0(this);" required>
                                    <span class="custom-file-control"></span>
                                    <img src="#" id="product_avatar" style="display: none">
                                    @error('product_avatar')
                                    <div style="margin-top: 8px;color: red;">{{ $message }}</div>
                                    @enderror
                                </label>
                            </div><!-- col -->
                            <div class="col-lg-12">
                                <h5 style="color: red; margin-bottom: 20px">Hình ảnh sản phẩm</h5>
                            </div>

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
                                    <input class="form-control" type="text" name="product_color_name" value="{{ old('product_color_name') }}" id="input" data-role="tagsinput" style="width: 100%" required>
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
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="ckbox">
                                    <input type="checkbox" name="hot_deal" value="1"><span>Giảm giá</span>
                                </label>
                            </div><!-- col-3 -->
                            <div class="col-lg-3">
                                <label class="ckbox">
                                    <input type="checkbox" name="hot_new" value="1"><span>Mới</span>
                                </label>
                            </div><!-- col-3 -->
                            <div class="col-lg-3">
                                <label class="ckbox">
                                    <input type="checkbox" name="trend" value="1"><span>Xu hướng</span>
                                </label>
                            </div><!-- col-3 -->
                        </div>
                        <br/>
                        <div class="form-layout-footer" style="text-align: center">
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


