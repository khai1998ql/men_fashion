<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
//Route::get('/', function () {
//    return view('frontend.pages.index');
//});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


// ADMIN
Route::group(['prefix' => 'admin'], function (){
    //    LOGIN, lOGOUT
    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
    Route::get('/home', 'Admin\AdminController@index')->name('admin.home');
    Route::get('/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Admin\LoginController@login');
    Route::get('/logout', 'Admin\AdminController@logout')->name('admin.logout');

    //    MENU
    Route::group(['prefix' => 'menu'], function (){
        Route::get('/', 'Admin\CategoryController@menu')->name('admin.menu.index');
        Route::post('/create', 'Admin\CategoryController@createMenu')->name('admin.menu.create');
        Route::get('/delete/{id}', 'Admin\CategoryController@deleteMenu')->name('admin.menu.delete');
        Route::get('/edit/{id}', 'Admin\CategoryController@editMenu')->name('admin.menu.edit');
        Route::post('/update', 'Admin\CategoryController@updateMenu')->name('admin.menu.update');
    });

    //    CATEGORY
    Route::group(['prefix' => 'category'], function (){
        Route::get('/', 'Admin\CategoryController@category')->name('admin.category.index');
        Route::post('/create', 'Admin\CategoryController@createCategory')->name('admin.category.create');
        Route::get('/delete/{id}', 'Admin\CategoryController@deleteCategory')->name('admin.category.delete');
        Route::get('/edit/{id}', 'Admin\CategoryController@editCategory')->name('admin.category.edit');
        Route::post('/update', 'Admin\CategoryController@updateCategory')->name('admin.category.update');
    });


    //    SUNCATEGORY
    Route::group(['prefix' => 'subcategory'], function (){
        Route::get('/', 'Admin\CategoryController@subcategory')->name('admin.subcategory.index');
        Route::post('/create', 'Admin\CategoryController@createsubCategory')->name('admin.subcategory.create');
        Route::get('/delete/{id}', 'Admin\CategoryController@deletesubCategory')->name('admin.subcategory.delete');
        Route::get('/edit/{id}', 'Admin\CategoryController@editsubCategory')->name('admin.subcategory.edit');
        Route::post('/update', 'Admin\CategoryController@updatesubCategory')->name('admin.subcategory.update');
    });

    //  PRODUCT
    Route::group(['prefix' => 'product'], function(){
        Route::get('/index', 'Admin\ProductController@product')->name('admin.product.index');
        Route::get('/add', 'Admin\ProductController@addProduct')->name('admin.product.add');
        Route::post('/create', 'Admin\ProductController@createProduct')->name('admin.product.create');
        Route::get('/delete/{id}', 'Admin\ProductController@deleteProduct')->name('admin.product.delete');
        Route::get('/edit/{id}', 'Admin\ProductController@editProduct')->name('admin.product.edit');
        Route::post('/updateInfo', 'Admin\ProductController@updateInfoProduct')->name('admin.product.updateInfo');
        Route::post('/updateDetail', 'Admin\ProductController@updateDetailProduct')->name('admin.product.updateDetail');
        Route::post('/updateImages', 'Admin\ProductController@updateImagesProduct')->name('admin.product.updateImages');
        Route::get('/detail/{id}', 'Admin\ProductController@productDetail')->name('admin.product.detail');
        Route::get('/sold', 'Admin\ProductController@soldProduct')->name('admin.product.sold');
        Route::get('/getSubCate/{id_category}', 'Admin\ProductController@getSubCategory');
        Route::get('/changeStatus/{id_category}', 'Admin\ProductController@changeStatusProduct');
    });

});



// FRONTEND
Route::group(['prefix' => '/'], function (){
    Route::get('/', 'Frontend\FrontendController@index')->name('fe.index');
    Route::get('/index', 'Frontend\FrontendController@index');
    Route::get('/error', 'Frontend\FrontendController@error')->name('fe.error');
    // CATEGORY
    Route::get('/{slug_category_name}', 'Frontend\CategoryController@Category');
    Route::get('/{slug_category_name}/{slug_subcategory_name}', 'Frontend\CategoryController@subCategory');
    // PRODUCT
    Route::get('/{slug_category_name}/{slug_subcategory_name}/{slug_product_name}', 'Frontend\ProductController@product');
    Route::get('/product/product_size/{product_id}/{product_color}', 'Frontend\ProductController@getSizeProduct');
    Route::get('/product/product_detail/{product_id}/{product_color}/{product_size}', 'Frontend\ProductController@getNumberProduct');
});

