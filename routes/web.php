<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
//Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/Admin', 'Admin\PanelController@index')->name('home')->middleware('auth');
//Route::group(['middleware' => ['auth','web']], function () {   //for auth LOGIN OR REGISTER
    //

Route::get('/Admin', 'Admin\PanelController@index')->name('home');
//Route::get('/Category', 'Admin\CategoryController@index')->name('Category');
//Route::get('Admin/Category/Create', 'Admin\CategoryController@create')->name('CategoryCreate');
//Route::get('Admin/Category/Create', 'Admin\CategoryController@Edit')->name('CategoryEdit');
//Route::post('Admin/Category/Store', 'Admin\CategoryController@store')->name('CategoryStore');
Route::resource('Categories', 'Admin\CategoryController');
Route::resource('Products', 'Admin\ProductController');
Route::resource('Experts', 'Admin\ExpertController');
Route::resource('Customers', 'Admin\CustomerController');
Route::resource('Orders', 'Admin\OrderController');
Route::resource('Orders', 'Admin\OrderController');
Route::resource('Sms', 'Admin\SmsmessageController');
///////////////////////////////////////////////////////////////site
//Route::get('Site', 'Site\HomeController2@index');
Route::get('/Site1', 'SiteHomeController@Index');
//Route::get('foo', 'Phtos\AdminController@method');


//Route::get('Admin/Category/Store', 'Admin\CategoryController@store')->name('CategoryStore');
//Route::get('/Product', 'Admin\ProductController@index')->name('Product');
//Route::get('Admin/Product/Create', 'Admin\ProductController@create')->name('ProductCreate');
//Route::post('Admin/Product/Store', 'Admin\ProductController@store')->name('ProductStore');


//});
