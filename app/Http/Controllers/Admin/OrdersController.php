<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $order = DB::table('orders')->where('order_status', 4)->get();
        return view('admin.orders.index', compact('order'));
    }

}
