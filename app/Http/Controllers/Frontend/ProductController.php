<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Response;

class ProductController extends Controller
{
    public function product($slug_category_name,$slug_subcategory_name,$slug_product_name){
        $product = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->where('categories.slug_category_name', $slug_category_name)
            ->where('subcategories.slug_subcategory_name', $slug_subcategory_name)
            ->where('products.product_status', '1')
            ->where('products.slug_product_name', $slug_product_name)
            ->select('products.*', 'categories.category_name', 'subcategories.subcategory_name')
            ->first();
        if(!empty($product)){
            return view('frontend.pages.product.product', compact('product'));
        }else{
            return Redirect::Route('fe.error');
        }

    }
    public function getSizeProduct($product_id, $product_color){
        $dataSize = DB::table('product_detail')->where('product_id', $product_id)->where('slug_product_color', to_slug($product_color))->get();
        return view('frontend.pages.product.product_size', compact('product_id', 'product_color', 'dataSize'));
    }
    public function getNumberProduct($product_id, $product_color, $product_size){
        $dataproduct = DB::table('product_detail')->where('product_id', $product_id)->where('slug_product_color', to_slug($product_color))->where('product_size', $product_size)->first();
        return Response::json(array(
            'dataproduct' => $dataproduct
        ));
    }

}
