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

    // COUPONS
    Route::group(['prefix' => 'coupons'], function (){
        Route::get('/', 'Admin\CouponsController@coupons')->name('admin.coupons.index');
        Route::post('/create', 'Admin\CouponsController@createCoupons')->name('admin.coupons.create');
        Route::get('/delete/{id}', 'Admin\CouponsController@deleteCoupons')->name('admin.coupons.delete');
        Route::get('/edit/{id}', 'Admin\CouponsController@editCoupons')->name('admin.coupons.edit');
        Route::post('/update', 'Admin\CouponsController@updateCoupons')->name('admin.coupons.update');
    });
    // COUPONS TYPE
    Route::group(['prefix' => 'coupons_type'], function (){
        Route::get('/', 'Admin\CouponsController@coupons_type')->name('admin.coupons_type.index');
        Route::post('/create', 'Admin\CouponsController@createCoupons_type')->name('admin.coupons_type.create');
        Route::get('/delete/{id}', 'Admin\CouponsController@deleteCoupons_type')->name('admin.coupons_type.delete');
        Route::get('/edit/{id}', 'Admin\CouponsController@editCoupons_type')->name('admin.coupons_type.edit');
        Route::post('/update', 'Admin\CouponsController@updateCoupons_type')->name('admin.coupons_type.update');
    });

    // ORDERS
    Route::group(['prefix' => 'orders'], function (){
        Route::get('/orders_new', 'Admin\OrdersController@orders_new')->name('admin.orders.new');
        Route::get('/orders_accept', 'Admin\OrdersController@orders_accept')->name('admin.orders.accept');
        Route::get('/orders_sent', 'Admin\OrdersController@orders_sent')->name('admin.orders.sent');
        Route::get('/orders_success', 'Admin\OrdersController@orders_success')->name('admin.orders.success');
        Route::get('/orders_cancel', 'Admin\OrdersController@orders_cancel')->name('admin.orders.cancel');
    });
});



// FRONTEND
Route::group(['prefix' => '/'], function (){
    Route::get('/', 'Frontend\FrontendController@index')->name('fe.index');
    Route::get('/logout', 'Frontend\FrontendController@logout')->name('fe.logout');
    Route::get('/index', 'Frontend\FrontendController@index');
    Route::get('/error', 'Frontend\FrontendController@error')->name('fe.error');
    // CART
    Route::group(['prefix' => '/cart'], function (){
        Route::get('/', 'Frontend\CartController@cartIndex')->name('cart.index');
        Route::post('/add', 'Frontend\CartController@cartAdd')->name('cart.add');
        Route::get('/changeNumber/{rowId}/{numberChange}', 'Frontend\CartController@changeNumberCart');
        Route::get('/checkout', 'Frontend\CartController@cartCheckout')->name('cart.checkout');
        Route::POST('/payment', 'Frontend\CartController@cartPayment')->name('cart.payment');

        // CHECKOUT
        Route::get('/checkout/inputCoupons/{coupons_code}', 'Frontend\CartController@inputCoupons');
        Route::get('/checkout/removeCoupons', 'Frontend\CartController@removeCoupons');
        Route::get('/checkout/addShipping/{chargeShipping}', 'Frontend\CartController@addShipping');

        // EMAIL
        Route::get('/email', 'Frontend\CartController@successEmail')->name('cart.successEmail');
    });

    // MODAL
    Route::group(['prefix' => '/modal'], function (){
        // PRODUCT
        Route::get('/getProduct/{id}', 'Frontend\ModalController@getProduct');
        Route::get('/product_size/{product_id}/{product_color}', 'Frontend\ModalController@getSizeProductModal');
        Route::get('/product_detail/{product_id}/{product_color}/{product_size}', 'Frontend\ModalController@getNumberProduct');
        Route::POST('/addProductModal', 'Frontend\ModalController@addProductModal')->name('modal.product.submit');
        Route::get('/deleteProduct/{rowId}', 'Frontend\ModalController@deleteProductCart');
        // SEARCH
        Route::get('/search/getProductSearch/{valueInput}', 'Frontend\ModalController@getProductSearch');
    });


    // ADDRESS
    Route::group(['prefix' => '/address'], function (){
        Route::get('/hcvn', 'Frontend\AddressController@hcvn');
        Route::get('/getDistricts/{provinces_id}', 'Frontend\AddressController@getDistricts');
        Route::get('/getWards/{districts_id}', 'Frontend\AddressController@getWards');
    });

    // CATEGORY
    Route::get('/{slug_category_name}', 'Frontend\CategoryController@Category');
    Route::get('/{slug_category_name}/{slug_subcategory_name}', 'Frontend\CategoryController@subCategory');
    // PRODUCT
    Route::get('/{slug_category_name}/{slug_subcategory_name}/{slug_product_name}', 'Frontend\ProductController@product');
    Route::get('/product/product_size/{product_id}/{product_color}', 'Frontend\ProductController@getSizeProduct');
    Route::get('/product/product_detail/{product_id}/{product_color}/{product_size}', 'Frontend\ProductController@getNumberProduct');

});

