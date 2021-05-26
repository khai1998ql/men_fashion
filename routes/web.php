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
    Route::get('home', 'Admin\AdminController@index')->name('admin.home');
    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login');
    Route::get('logout', 'Admin\AdminController@logout')->name('admin.logout');

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


});



// FRONTEND

Route::get('/', 'Frontend\FrontendController@index')->name('fe.index');
Route::get('/index', 'Frontend\FrontendController@index');
