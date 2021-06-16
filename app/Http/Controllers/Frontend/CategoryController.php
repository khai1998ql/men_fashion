<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function Category($slug_category_name){

        $category = DB::table('categories')->where('slug_category_name', $slug_category_name)->first();
        if(!empty($category)){
            return view('frontend.pages.category.category', compact( 'category', 'slug_category_name'));
        }else{
            return Redirect::Route('fe.error');
        }

    }
    public function subCategory($slug_category_name,$slug_subcategory_name){
        $product = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->where('categories.slug_category_name', $slug_category_name)
            ->where('subcategories.slug_subcategory_name', $slug_subcategory_name)
            ->where('products.product_status', '1')
            ->select('products.*', 'categories.category_name', 'subcategories.subcategory_name')
            ->paginate(12);
        $category = DB::table('categories')->where('slug_category_name', $slug_category_name)->first();
        $subcategory = DB::table('subcategories')->where('slug_subcategory_name', $slug_subcategory_name)->first();
        if(!empty($category) && !empty($subcategory)){
            return view('frontend.pages.category.subcategory', compact('product', 'category', 'subcategory'));
        }else{
            return Redirect::Route('fe.error');
        }

    }
    public function sortProductCategory($slug_category_name, $sort){

        $data = explode('|', $sort);
//        dd($data);
        $product = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->where('categories.slug_category_name', $slug_category_name)
            ->where('products.product_status', '1')
            ->select('products.*', 'categories.category_name', 'subcategories.subcategory_name')
            ->orderBy('products.'.$data[0], $data[1])
            ->paginate(4);
        if(Session::has('product_cate')){
            Session::forget('product_cate');
        }
        Session::put('product_cate', array('value' => $sort));
        return view('frontend.pages.category.product_cate', compact('product'));
    }
}
