@extends('admin.admin_layout')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.index') }}">Trang chủ</a>
            <span class="breadcrumb-item active">Phiếu giảm giá</span>
        </nav>
        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Danh sách phiếu giảm giá<a href="" class="btn btn-sm btn-warning" style="float: right" data-toggle="modal" data-target="#exampleModal">THÊM MỚI</a></h6>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-10p">STT</th>
                            <th class="wd-15p">Mã phiếu giảm giá</th>
                            <th class="wd-25p">Tên phiếu giảm giá</th>
                            <th class="wd-25p">Loại phiếu giảm giá</th>
                            <th class="wd-10p">Giá trị</th>
                            <th class="wd-10p">Giá trị giảm tối đa</th>
                            <th class="wd-15p">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($coupons as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->coupons_code }}</td>
                                <td>{{ $item->coupons_name }}</td>
                                <td>
                                    @php
                                        $coupons_ty = DB::table('coupons_type')->where('id', $item->coupons_type_id)->first();
                                    @endphp
                                    {{ $coupons_ty->coupon_type_name }}
                                </td>
                                <td>{{ $item->coupons_discount }}</td>
                                <td>{{ $item->coupons_max }}</td>
                                <td>
                                    <button id="{{ $item->id }}"  class="btn btn-info" data-toggle="modal" data-id="{{ $item->id }}" data-target="#exampleModal1" onclick="categoryEdit(this.id)">Sửa</button>
                                    <a href="{{ URL::to('admin/coupons/delete/'.$item->id) }}" class="btn btn-danger" id="delete">Xóa</a>
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
    <!-- Modal Thêm menu -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới phiếu giảm giá</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.coupons.create') }}" method="POST">
                    @csrf
                    <div class="modal-body pd-20">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã phiếu giảm giá</label>
                            <input type="text" class="form-control" id="" aria-describedby="emailHelp" name="coupons_code" placeholder="Mã phiếu giảm giá">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên phiếu giảm giá</label>
                            <input type="text" class="form-control" id="" aria-describedby="emailHelp" name="coupons_name" placeholder="Tên phiếu giảm giá">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Loại phiếu giảm giá</label>
                            <select name="coupons_type_id" id="" class="form-control">
                                <option label="Chọn loại phiếu giảm giá"></option>
                                @foreach($coupons_type as $key => $item)
                                    <option value="{{ $item->id }}">{{ $item->coupon_type_name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá trị giảm giá</label>
                            <input type="text" class="form-control" id="" aria-describedby="emailHelp" name="coupons_discount" placeholder="Giá trị giảm giá">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giảm giá tối đa</label>
                            <input type="text" class="form-control" id="" aria-describedby="emailHelp" name="coupons_max" placeholder="Nhập giá giảm tối đa(vnđ)">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Sửa menu-->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa danh mục</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.coupons.update') }}" method="POST">
                    @csrf
                    <div class="modal-body pd-20">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã phiếu giảm giá</label>
                            <input type="text" class="form-control" id="coupons_code" aria-describedby="emailHelp" name="coupons_code" placeholder="Mã phiếu giảm giá">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên phiếu giảm giá</label>
                            <input type="text" class="form-control" id="coupons_name" aria-describedby="emailHelp" name="coupons_name" placeholder="Tên phiếu giảm giá">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Loại phiếu giảm giá</label>
                            <select name="coupons_type_id" id="coupons_type_id" class="form-control">
                                <option label="Chọn loại phiếu giảm giá"></option>
                                @foreach($coupons_type as $key => $item)
                                    <option value="{{ $item->id }}">{{ $item->coupon_type_name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá trị giảm giá</label>
                            <input type="text" class="form-control" id="coupons_discount" aria-describedby="emailHelp" name="coupons_discount" placeholder="Giá trị giảm giá">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giảm giá tối đa</label>
                            <input type="text" class="form-control" id="coupons_max" aria-describedby="emailHelp" name="coupons_max" placeholder="Nhập giá giảm tối đa">

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="coupons_id_old" name="coupons_id_old">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Sửa</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        function categoryEdit(id){
            $.ajax({
                url: "{{ url('admin/coupons/edit/') }}/"+id,
                type: "GET",
                dataType: "json",
                success:function (data){
                    $('#coupons_code').val(data.coupons.coupons_code);
                    $('#coupons_name').val(data.coupons.coupons_name);
                    $('#coupons_type_id').val(data.coupons.coupons_type_id);
                    $('#coupons_discount').val(data.coupons.coupons_discount);
                    $('#coupons_max').val(data.coupons.coupons_max);
                    $('#coupons_id_old').val(data.coupons.id);
                }
            })
        }
    </script>



@endsection


