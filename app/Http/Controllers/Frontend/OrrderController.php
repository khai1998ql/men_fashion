<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OrrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function cancalOrder($order_code){
        $check = DB::table('orders')->where('order_code',$order_code)->first();
        if(!empty($check)){
            if($check->order_status == 0){
                DB::table('orders')->where('order_code',$order_code)->update(['order_status' => 5]);
                $notification = [
                    'message' => 'Hủy đơn hàng thành công!',
                    'alert-type' => 'success',
                ];
                return Redirect::back()->with($notification);
            }else{
                $notification = [
                    'message' => 'Giá trị không hợp lệ!',
                    'alert-type' => 'error',
                ];
                return Redirect::back()->with($notification);
            }
        }else{
            return Redirect::route('fe.error');
        }
    }
}
