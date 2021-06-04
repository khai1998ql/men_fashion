<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Response;
use Cart;

class ModalController extends Controller
{
    public function getProduct($id){
        $product = DB::table('products')->where('id', $id)->first();
        return view('frontend.pages.modal.product.index', compact('product'));
    }
    public function getSizeProductModal($product_id, $product_color){
        $dataSize = DB::table('product_detail')->where('product_id', $product_id)->where('slug_product_color', to_slug($product_color))->get();
        return view('frontend.pages.modal.product.product_size', compact('product_id', 'product_color', 'dataSize'));
    }
    public function getNumberProduct($product_id, $product_color, $product_size){
        $dataproduct = DB::table('product_detail')->where('product_id', $product_id)->where('slug_product_color', to_slug($product_color))->where('product_size', $product_size)->first();
        return Response::json(array(
            'dataproduct' => $dataproduct
        ));
    }
    public function addProductModal(Request $request){
        $id = $request->product_id;
        $product = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->where('products.id', $id)
            ->select('products.*', 'categories.category_name', 'subcategories.subcategory_name')
            ->first();
        $product_detail = DB::table('product_detail')->where('product_id', $id)->where('slug_product_color', $request->modalColorID)->first();
        $data = array();
        $data['id'] = $id;
        $data['name'] = $product->product_name;
        $data['qty'] = intval($request->modalQty);
        $data['price'] = $product->product_price;
        $data['weight'] = 1;
        $data['options']['size'] = $request->modalSizeID;
        $data['options']['color'] = $product_detail->product_color;
        $data['options']['avatar'] = $product->product_avatar;
        $data['options']['category_name'] = $product->category_name;
        $data['options']['subcategory_name'] = $product->subcategory_name;
        $data['options']['discount_price'] = $product->discount_price;
        $data['options']['max_number'] = intval($request->maxModalQty);
//        dd($data);
        Cart::add($data);
//        $notification = array(
//            'message' => 'Thêm sản phẩm vào giỏ hàng thành công!',
//            'alert_type' => 'success',
//        );
        return view('frontend.pages.modal.product.change_modal_cart');
    }
    public function getProductSearch($valueInput){
        $dataInput = explode(' ', $valueInput);
        $product = DB::table('products')
            ->join('categories', 'products.category_id','categories.id')
            ->join('subcategories', 'products.subcategory_id','subcategories.id')
            ->where('products.product_name', 'like', '%' . $valueInput . '%')
            ->orWhere('categories.category_name', 'like', '%' . $valueInput . '%')
            ->orWhere('subcategories.subcategory_name', 'like', '%' . $valueInput . '%')
            ->distinct()
            ->select('products.*', 'categories.category_name', 'subcategories.subcategory_name')
            ->limit(4)
            ->get();
//        dd($product);
        return view('frontend.pages.modal.search.data_search', compact('product'));
    }
}
