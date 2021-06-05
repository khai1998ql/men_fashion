<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Cart;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Response;
use Session;
use Carbon\Carbon;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function cartIndex(){
        return view('frontend.pages.cart.cart');
    }
    public function cartAdd(Request $request){
        $id = $request->product_id;
        $product = DB::table('products')
                ->join('categories', 'products.category_id', 'categories.id')
                ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
                ->where('products.id', $id)
                ->select('products.*', 'categories.category_name', 'subcategories.subcategory_name')
                ->first();
        $product_detail = DB::table('product_detail')->where('product_id', $id)->where('slug_product_color', $request->colorID)->first();
        $data = array();
        $data['id'] = $id;
        $data['name'] = $product->product_name;
        $data['qty'] = intval($request->productQty);
        $data['price'] = $product->product_price;
        $data['weight'] = 1;
        $data['options']['size'] = $request->sizeID;
        $data['options']['color'] = $product_detail->product_color;
        $data['options']['avatar'] = $product->product_avatar;
        $data['options']['category_name'] = $product->category_name;
        $data['options']['subcategory_name'] = $product->subcategory_name;
        $data['options']['discount_price'] = $product->discount_price;
        $data['options']['max_number'] = intval($request->maxQty);
        Cart::add($data);
        $notification = array(
            'message' => 'Thêm sản phẩm vào giỏ hàng thành công!',
            'alert-type' => 'success',
        );
        return Redirect::route('cart.index')->with($notification);
    }
    public function changeNumberCart($rowId, $numberChange){
        Cart::update($rowId, intval($numberChange));
        $data = array();
        $data['numberChange'] = intval($numberChange);
        $sum_sale = 0;
        $sum_total = 0;
        foreach (Cart::content() as $item){
            if(intval($item->options->discount_price) > 0 && $item->options->discount_price != null){
                $sum_sale += intval($item->price) * intval($item->qty) * intval($item->options->discount_price) / 100;
            }
        }
        $sum_total = intval(Cart::total()) - $sum_sale;
        $data['cart_price'] = formatPrice(Cart::total());
        $data['cart_price_no'] = Cart::total();
        $data['sum_sale'] = formatPrice($sum_sale);
        $data['sum_total'] = formatPrice($sum_total);
        $data['count_number'] = Cart::count();
        return Response::json(array(
            'changeNumber' => $data,
        ));
    }
//    public function deleteProductCart($rowId){
//        return view('frontend.pages.cart.cart_delete', compact('rowId'));
//    }
    public function cartCheckout(){
        if(Cart::count() == 0){
            $notification = array(
                'message' => 'Không có sản phẩm trong giỏ hàng!',
                'alert-type' => 'error',
            );
            return Redirect::route('fe.index')->with($notification);
        }else{
            $data_provinces = file_get_contents(asset('public/hcvn/tinh_tp.json'));
            $provinces  = json_decode($data_provinces);
            return view('frontend.pages.cart.checkout', compact('provinces'));
        }

    }
    public function inputCoupons($coupons_code){
        $coupons = DB::table('coupons')->where('coupons_code', $coupons_code)->first();
        $data = array();
        if(!empty($coupons) > 0){
            if($coupons->coupons_count == 0){
                $data['message_type'] = 'error';
                $data['message'] = 'Mã giảm giá đã hết lượt sử dụng!';
            }else{
                $sum_sale = 0;
                $sum_total = 0;
                $charge_shipping = 0;
                $sum_coupons = 0;
                if(Session::has('shipping')){
                    $charge_shipping = intval(Session::get('shipping')['charge_shipping']);
                }
                foreach (Cart::content() as $item){
                    if(intval($item->options->discount_price) > 0 && $item->options->discount_price != null){
                        $sum_sale += intval($item->price) * intval($item->qty) * intval($item->options->discount_price) / 100;
                    }
                }
                if($coupons->coupons_type_id == 1){
                    $sum_coupons = intval($coupons->coupons_max);
                }else{
                    $sum_coupons = (intval(Cart::total()) <= intval($coupons->coupons_max)) ? intval(Cart::total()) : intval($coupons->coupons_max);
                }
                $sum_total = intval(Cart::total()) - $sum_sale + $charge_shipping - $sum_coupons;
                $data['message_type'] = 'success';
                $data['message'] = 'Thêm mã giảm giá thành công!';
                $data['sum_total'] = formatPrice($sum_total);
                $data['sum_coupons'] = formatPrice($sum_coupons);

                Session::put('coupons', array('coupons_value' => $sum_coupons));
            }
        }else{
            $data['message_type'] = 'error';
            $data['message'] = 'Mã giảm giá không tồn tại!';
        }
//        dd($data);
        return Response::json(array(
            'coupons' => $data,
        ));
    }

    public function removeCoupons(){
        $sum_sale = 0;
        $sum_total = 0;
        $charge_shipping = 0;
        if(Session::has('shipping')){
            $charge_shipping = intval(Session::get('shipping')['charge_shipping']);
        }
        foreach (Cart::content() as $item){
            if(intval($item->options->discount_price) > 0 && $item->options->discount_price != null){
                $sum_sale += intval($item->price) * intval($item->qty) * intval($item->options->discount_price) / 100;
            }
        }
        $sum_total = intval(Cart::total()) - $sum_sale + $charge_shipping;
        Session::forget('coupons');
        $data['message'] = 'Xóa mã giảm giá thành công!';
        $data['sum_total'] = formatPrice($sum_total);
        return Response::json(array(
            'coupons' => $data,
        ));
    }
    public function addShipping($chargeShipping){
        $sum_sale = 0;
        $sum_total = 0;
        $charge_shipping = 0;
        $sum_coupons = 0;
        $data = array();
        if(Session::has('shipping')){
            $data['message_type'] = 'error';
            $data['message'] = 'Phương thức giao hàng đã tồn tại!';
        }else{
            if(Session::has('coupons')){
                $sum_coupons = intval(Session::get('coupons')['coupons_value']);
            }
            foreach (Cart::content() as $item){
                if(intval($item->options->discount_price) > 0 && $item->options->discount_price != null){
                    $sum_sale += intval($item->price) * intval($item->qty) * intval($item->options->discount_price) / 100;
                }
            }
            $charge_shipping = intval($chargeShipping);
            $sum_total = intval(Cart::total()) - $sum_sale + $charge_shipping - $sum_coupons;
            $data['message_type'] = 'success';
            $data['message'] = 'Thêm phương thức giao hàng thành công!';
            $data['sum_total'] = formatPrice($sum_total);
            $data['charge_shipping'] = formatPrice($charge_shipping);

            Session::put('shipping', array('charge_shipping' => $chargeShipping));

        }
        return Response::json(array(
            'shipping' => $data,
        ));
    }
    public function cartPayment(Request $request){
        $rules = [
            'ship_name' => 'required|min:1|max:255',
            'ship_phone' => 'required|numeric|regex:/((0)+([0-9]{9})\b)/u',
            'ship_address' => 'required|min:1|max:255',
        ];
        $message = [
            'ship_name.required' => 'Họ và tên không được để trống!',
            'ship_name.min' => 'Họ và tên tối thiểu :min kí tự!',
            'ship_name.max' => 'Họ và tên tối đa :max kí tự!',
            'ship_phone.required' => 'Số điện thoại không được để trống!',
            'ship_phone.numeric' => 'Số điện thoại phải là số!',
            'ship_phone.regex' => 'Số điện thoại không hợp lệ!',
            'ship_address.required' => 'Địa chỉ không được để trống!',
            'ship_address.min' => 'Địa chỉ tối thiểu :min kí tự!',
            'ship_address.max' => 'Địa chỉ tối đa :max kí tự!',
        ];
        $this->validate($request, $rules, $message);

        $sum_sale = 0;
        $sum_total = 0;
        $charge_shipping = 0;
        $sum_coupons = 0;
        if(Session::has('coupons')){
            $sum_coupons = intval(Session::get('coupons')['coupons_value']);
        }
        if(Session::has('shipping')){
            $charge_shipping = intval(Session::get('shipping')['charge_shipping']);
        }
        foreach (Cart::content() as $item){
            if(intval($item->options->discount_price) > 0 && $item->options->discount_price != null){
                $sum_sale += intval($item->price) * intval($item->qty) * intval($item->options->discount_price) / 100;
            }
        }
        $sum_total = intval(Cart::total()) - $sum_sale + $charge_shipping - $sum_coupons;

        $data = array();
        $data['user_id'] = Auth::id();
        $data['order_code'] = mt_rand(100000, 999999);
        $data['payment_type'] = $request->checkout;
        $data['order_subtotal'] = Cart::total();
        $data['order_shipping'] = $request->shipping;
        $data['order_vat'] = 0;
        $data['order_sale'] = $sum_sale;
        $data['order_coupons'] = $sum_coupons;
        $data['order_total'] = $sum_total;
        $data['order_status'] = 0;
        $data['order_day'] =  Carbon::now()->day;
        $data['order_month'] = Carbon::now()->month;
        $data['order_year'] = Carbon::now()->year;
        $data['created_at'] = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
//        dd($data);
        $order_id = DB::table('orders')->insertGetId($data);

        $data_shipping = array();
        $data_shipping['order_id'] = $order_id;
        $data_shipping['ship_name'] = $request->ship_name;
        $data_shipping['ship_phone'] = $request->ship_phone;
        $data_shipping['ship_address'] = trim($request->ship_address) . ' ' . $request->ship_wards . ' ' . $request->ship_district . ' ' . $request->ship_province;
        $data_shipping['ship_deliveryTime'] = $request->ship_deliveryTime;
        $data_shipping['ship_note'] = $request->ship_note;

        $dataEmail = array();
        $dataEmail['order_id'] = $order_id;
        $dataEmail['ship_name'] = $request->ship_name;
        $dataEmail['ship_phone'] = $request->ship_phone;
        $dataEmail['ship_address'] = trim($request->ship_address) . ' ' . $request->ship_wards . ' ' . $request->ship_district . ' ' . $request->ship_province;
        $dataEmail['ship_deliveryTime'] = $request->ship_deliveryTime;
        $dataEmail['ship_note'] = $request->ship_note;
        $dataEmail['order_code'] = $data['order_code'];
        $dataEmail['email'] = Auth::user()->email;
        if($request->checkout == 'stripe'){
            $dataEmail['payment_type'] = 'Thanh toán bằng thẻ Stripe';
        }else if($request->checkout == 'cod'){
            $dataEmail['payment_type'] = 'Thanh toán khi nhận hàng';
        }
        DB::table('orders_shipping')->insert($data_shipping);

        foreach (Cart::content() as $item){
            $data_detail = array();
            $data_detail['order_id'] = $order_id;
            $data_detail['product_id'] = $item->id;
            $data_detail['product_name'] = $item->name;
            $data_detail['color'] = $item->options->color;
            $data_detail['size'] = $item->options->size;
            $data_detail['quantity'] = intval($item->qty);
            $data_detail['singleprice'] = intval($item->price);
            $data_detail['singlesale'] = intval($item->price) * intval($item->options->discount_price) / 100;
            $data_detail['totalprice'] = (intval($item->price) - intval($item->price) * intval($item->options->discount_price) / 100) * intval($item->qty);
            DB::table('orders_detail')->insert($data_detail);
//            dd($data_detail);
            DB::table('products')->where('id', $item->id)->update(['product_sold' => DB::raw('product_sold + ' . intval($item->qty))]);
            DB::table('product_detail')
                ->where('product_id', $item->id)
                ->where('product_color', $item->options->color)
                ->where('product_size', $item->options->size)
                ->update([
                    'product_detail_sold' => DB::raw('product_detail_sold + ' . intval($item->qty)),
                    'product_qty' => DB::raw('product_qty - ' . intval($item->qty)),
                ]);
        }

        if($request->checkout == 'stripe'){
            \Stripe\Stripe::setApiKey('sk_test_51HmVaRGuw3rAuQaWNQNzHC6SA6PbxkVW03UKILOknJeHAOY5cyzlcOZecGKvaghcEOV81TG1oQaQYyxLUDSvTV9R00OZX2v0av');
            $token = $_POST['stripeToken'];

            $charge = \Stripe\Charge::create([
                'amount' => $sum_total,
                'currency' => 'vnd',
                'description' => 'Thanh toán đợn hàng!',
                'source' => $token,
            ]);
//            dd($charge);
            $data_stripe = array();
            $data_stripe['order_id'] = $order_id;
            $data_stripe['stripe_payment_id'] = $charge->payment_method;
            $data_stripe['stripe_payment_amount'] = $charge->amount;
            $data_stripe['stripe_blnc_transaction'] = $charge->balance_transaction;
            $data_stripe['stripe_order_id'] = $charge->payment_method;
            DB::table('orders_pay_stripe')->insert($data_stripe);
//            dd($data_stripe);
        }
        Mail::to(Auth::user()->email)->send(new InvoiceMail($dataEmail));



        return view('frontend.pages.cart.success');

    }
    public function successEmail(){
        return view('frontend.pages.mail.invoice');
    }
}
