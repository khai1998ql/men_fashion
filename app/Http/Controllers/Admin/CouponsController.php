<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class CouponsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // COUPONS TYPE

    public function coupons_type(){
        $coupons_type = DB::table('coupons_type')->get();
        return view('admin.coupons.coupons_type', compact('coupons_type'));
    }
    public function createCoupons_type(Request $request){
        $rules = [
            'coupon_type_name' => 'required|min:1|max:255|unique:coupons_type',
            'coupon_type_character' => 'required|min:1|max:1|unique:coupons_type',
        ];
        $message = [
            'coupon_type_name.required' => 'Tên loại phiếu giảm giá không được để trống!',
            'coupon_type_name.min' => 'Tên loại phiếu giảm giá ít nhất:min kí tự!',
            'coupon_type_name.max' => 'Tên loại phiếu giảm giá nhiều nhất :max kí tự!',
            'coupon_type_name.unique' => 'Tên loại phiếu giảm giá <:input> đã tồn tại!',

            'coupon_type_character.required' => 'Kí tự phiếu giảm giá không được để trống!',
            'coupon_type_character.min' => 'Kí tự phiếu giảm giá ít nhất:min kí tự!',
            'coupon_type_character.max' => 'Kí tự phiếu giảm giá nhiều nhất :max kí tự!',
            'coupon_type_character.unique' => 'Kí tự phiếu giảm giá <:input> đã tồn tại!',
        ];
        $this->validate($request,$rules,$message);
        $data = array();
        $data['coupon_type_name'] = $request->coupon_type_name;
        $data['coupon_type_character'] = $request->coupon_type_character;
        DB::table('coupons_type')->insert($data);
        $notification = array(
            'message' => 'Thêm mới loại phiếu giảm giá thành công!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function deleteCoupons_type($id){
        DB::table('coupons_type')->where('id', $id)->delete();
        $notification = array(
            'message' => 'Xóa loại phiếu giảm giá thành công!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function editCoupons_type($id){
        $coupons_type = DB::table('coupons_type')->where('id', $id)->first();
        return Response::json(array(
            'coupons_type' => $coupons_type,
        ));
    }
    public function updateCoupons_type(Request $request){
        $id = $request->coupon_type_id;
        $data = array();
        $data['coupon_type_name'] = $request->coupon_type_name;
        $data['coupon_type_character'] = $request->coupon_type_character;
        DB::table('coupons_type')->where('id', $id)->update($data);
        $notification = array(
            'message' => 'Cập nhật loại phiếu giảm giá thành công!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    // COUPONS

    public function coupons(){
        $coupons = DB::table('coupons')->get();
        $coupons_type = DB::table('coupons_type')->get();
        return view('admin.coupons.coupons', compact('coupons', 'coupons_type'));
    }
    public function createCoupons(Request $request){
        $rules = [
            'coupons_code' => 'required|min:1|max:15|unique:coupons',
            'coupons_name' => 'required|min:1|max:255|unique:coupons',
            'coupons_discount' => 'required|numeric|min:1',
            'coupons_max' => 'required|numeric|min:1',
            'coupons_type_id' => 'required',
        ];
        $message = [
            'coupons_code.required' => 'Mã phiếu giảm giá không được để trống!',
            'coupons_code.min' => 'Mã phiếu giảm giá tối thiểu :min kí tự!',
            'coupons_code.max' => 'Mã phiếu giảm giá tối đa :max kí tự!',
            'coupons_code.unique' => 'Mã phiếu giảm giá <:input> đã tồn tại!',

            'coupons_name.required' => 'Tên phiếu giảm giá không được để trống!',
            'coupons_name.min' => 'Tên phiếu giảm giá tối thiểu :min kí tự!',
            'coupons_name.max' => 'Tên phiếu giảm giá tối đa :max kí tự!',
            'coupons_name.unique' => 'Tên phiếu giảm giá <:input> đã tồn tại!',

            'coupons_discount.required' => 'Giá trị giảm không được để trống!',
            'coupons_discount.min' => 'Giá trị giảm tối thiểu :min!',
            'coupons_discount.numeric' => 'Giá trị giảm phải là số!',

            'coupons_max.required' => 'Giá trị giảm lớn nhất không được để trống!',
            'coupons_max.min' => 'Giá trị giảm lớn nhất tối thiểu :min!',
            'coupons_max.numeric' => 'Giá trị giảm lớn nhất phải là số!',

            'coupons_type_id.required' => 'Loại phiếu giảm giá cần được chọn!',
        ];
        $this->validate($request,$rules,$message);
        $data = array();
        $data['coupons_code'] = $request->coupons_code;
        $data['coupons_name'] = $request->coupons_name;
        $data['coupons_discount'] = $request->coupons_discount;
        $data['coupons_max'] = $request->coupons_max;
        $data['coupons_type_id'] = $request->coupons_type_id;
        DB::table('coupons')->insert($data);
        $notification = array(
            'message' => 'Thêm mới phiếu giảm giá thành công!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function deleteCoupons($id){
        DB::table('coupons')->where('id', $id)->delete();
        $notification = array(
            'message' => 'Xóa phiếu giảm giá thành công!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function editCoupons($id){
        $coupons = DB::table('coupons')->where('id', $id)->first();
        return Response::json(array(
            'coupons' => $coupons,
        ));
    }
    public function updateCoupons(Request $request){
        $rules = [
            'coupons_code' => 'required|min:1|max:15',
            'coupons_name' => 'required|min:1|max:255',
            'coupons_discount' => 'required|numeric|min:1',
            'coupons_max' => 'required|numeric|min:1',
            'coupons_type_id' => 'required',
        ];
        $message = [
            'coupons_code.required' => 'Mã phiếu giảm giá không được để trống!',
            'coupons_code.min' => 'Mã phiếu giảm giá tối thiểu :min kí tự!',
            'coupons_code.max' => 'Mã phiếu giảm giá tối đa :max kí tự!',

            'coupons_name.required' => 'Tên phiếu giảm giá không được để trống!',
            'coupons_name.min' => 'Tên phiếu giảm giá tối thiểu :min kí tự!',
            'coupons_name.max' => 'Tên phiếu giảm giá tối đa :max kí tự!',

            'coupons_discount.required' => 'Giá trị giảm không được để trống!',
            'coupons_discount.min' => 'Giá trị giảm tối thiểu :min!',
            'coupons_discount.numeric' => 'Giá trị giảm phải là số!',

            'coupons_max.required' => 'Giá trị giảm lớn nhất không được để trống!',
            'coupons_max.min' => 'Giá trị giảm lớn nhất tối thiểu :min!',
            'coupons_max.numeric' => 'Giá trị giảm lớn nhất phải là số!',

            'coupons_type_id.required' => 'Loại phiếu giảm giá cần được chọn!',
        ];
        $this->validate($request,$rules,$message);
        $id = $request->coupons_id_old;
        $data = array();
        $data['coupons_code'] = $request->coupons_code;
        $data['coupons_name'] = $request->coupons_name;
        $data['coupons_discount'] = $request->coupons_discount;
        $data['coupons_max'] = $request->coupons_max;
        $data['coupons_type_id'] = $request->coupons_type_id;
        DB::table('coupons')->where('id', $id)->update($data);
        $notification = array(
            'message' => 'Cập nhật phiếu giảm giá thành công!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
