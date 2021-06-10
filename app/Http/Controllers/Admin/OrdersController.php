<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function orders_new(){
        $order = DB::table('orders')->where('order_status', 0)->get();
        return view('admin.orders.index', compact('order'));
    }
    public function orders_accept(){
        $order = DB::table('orders')->where('order_status', 1)->get();
        return view('admin.orders.index', compact('order'));
    }
    public function orders_sent(){
        $order = DB::table('orders')->where('order_status', 2)->get();
        return view('admin.orders.index', compact('order'));
    }
    public function orders_success(){
        $order = DB::table('orders')->where('order_status', 3)->get();
        return view('admin.orders.index', compact('order'));
    }
    public function orders_cancel(){
        $order = DB::table('orders')->where('order_status', 4)->orwhere('order_status', 5)->get();
        return view('admin.orders.index', compact('order'));
    }
    public function deleteOrders($orders_id){
        $order = DB::table('orders')->where('id', $orders_id)->first();
        if($order->payment_type == 'stripe'){
            DB::table('orders_pay_stripe')->where('order_id', $orders_id)->delete();
        }
        DB::table('orders_detail')->where('order_id', $orders_id)->delete();
        DB::table('orders_shipping')->where('order_id', $orders_id)->delete();
        DB::table('orders')->where('id', $orders_id)->delete();
        $notification = [
            'message' => 'Xóa đơn hàng thành công!',
            'alert-type' => 'success',
        ];
        return Redirect::back()->with($notification);
    }
    public function viewOrders($orders_id){
        $orders = DB::table('orders')->where('id', $orders_id)->first();
//                ->join('orders_detail', 'orders.id', '=', 'orders_detail.order_id')
//                ->join('orders_shipping', 'orders.id', '=', 'orders_shipping.order_id')
//                ->join('orders_pay_stripe', 'orders.id', '=', 'orders_pay_stripe.order_id')
//                ->select('orders.*', 'orders_detail.')
        $orders_detail = DB::table('orders_detail')->where('order_id', $orders_id)->get();
        $orders_shipping = DB::table('orders_shipping')->where('order_id', $orders_id)->first();
        if($orders->payment_type == 'stripe'){
            $orders_pay_stripe = DB::table('orders_pay_stripe')->where('order_id', $orders_id)->first();
            return view('admin.orders.view', compact('orders', 'orders_detail', 'orders_shipping', 'orders_pay_stripe'));
        }else{
            return view('admin.orders.view', compact('orders', 'orders_detail', 'orders_shipping'));
        }
    }
    public function statusOrders($orders_id, $status_number){
        DB::table('orders')->where('id', $orders_id)->update(['order_status' => $status_number]);
        $notification = [
            'message' => 'Cập nhật trạng thái đơn hàng thành công!',
            'alert-type' => 'success',
        ];
        return Redirect::back()->with($notification);
    }
}
