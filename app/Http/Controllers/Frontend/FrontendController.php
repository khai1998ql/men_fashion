<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class FrontendController extends Controller
{
    public function index(){
        $productNew = DB::table('products')->where('hot_new', 1)
                    ->join('categories', 'products.category_id', 'categories.id')
                    ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
                    ->where('products.product_status', 1)
                    ->select('products.*', 'categories.category_name', 'subcategories.subcategory_name')
                    ->orderBy('products.id')
                    ->limit(12)
                    ->get();
        $productHot = DB::table('products')
                    ->join('categories', 'products.category_id', 'categories.id')
                    ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
                    ->where('products.product_status', 1)
                    ->select('products.*', 'categories.category_name', 'subcategories.subcategory_name')
                    ->orderBy('products.product_sold')
                    ->limit(12)->get();
        return view('frontend.pages.index', compact('productNew', 'productHot'));
    }
    public function error(){
        return view('frontend.pages.error');
    }
    public function logout(){
        Auth::logout();
        return Redirect::route('fe.index');
    }
}
