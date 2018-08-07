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

Auth::routes();

Route::get('/', 'MarketController@index');
Route::get('/user_check', 'SellerSettingsController@check');

Route::group(['middleware' => ['auth']], function (){
  //Admin routes
  Route::get('/j-admin/orders','AdminController@orders')->name('adminorders');
  Route::get('/j-admin/category','AdminController@addcategory')->name('addcategory');
  Route::get('/j-admin/category/addcategory','AdminController@addui')->name('addui');
  Route::post('/j-admin/category/addcat','AdminController@catpost')->name('catpost');
  Route::get('/j-admin/category/{category_id}/edit','AdminController@edit')->name('category.edit');
  Route::put('/j-admin/category/{category_id}/update','AdminController@update')->name('category.update');
  Route::delete('/j-admin/category/{category_id}/delete','AdminController@categorydelete')->name('category.delete');
  Route::get('/j-admin/users','AdminController@users')->name('adminusers');
  Route::get('/j-admin/users/{user_id}/verify','AdminController@userverify')->name('userverify');
  Route::put('/j-admin/users/{user_id}/verifycomplete','AdminController@userveirfycomplete')->name('userverifycomplete');
  Route::get('j-admin/allusers','AdminController@allusers')->name('allusers');
  Route::get('j-admin/allusers/{user_id}','AdminController@userinfo')->name('userinfo');
  Route::delete('j-admin/allusers/{user_id}/delete','AdminController@userdelete')->name('user.delete');
  Route::get('j-admin/allproducts','AdminController@allproducts')->name('allproducts');
  Route::get('j-admin/allproducts/{product_id}/info','AdminController@productinfo')->name('product.info');
  Route::delete('j-admin/allproducts/{product_id}/delete','AdminController@productdelete')->name('product.delete');
  Route::get('j-admin/category/{product_id}/subcategories','AdminController@subcategories')->name('product.subcategories');
  Route::get('j-admin/category/{product_id}/subcategories/{subcat_id}','AdminController@subcategoriesedit')->name('subcategories.edit');
  Route::put('j-admin/category/{product_id}/subcategories/{subcat_id}/edit','AdminController@subcatput')->name('subcategories.edit.put');
  Route::delete('j-admin/category/{product_id}/subcategories/{subcat_id}/delete','AdminController@subcatdelete')->name('subcategories.delete');
  Route::get('j-admin/category/{product_id}/addsubcategory','AdminController@subcategoryadd')->name('subadd');
  Route::post('j-admin/category/{product_id}/subcategories/addcomplete','AdminController@subcataddpost')->name('subcategories.add.post');
});

// Market Controllers
Route::get('/market', 'MarketController@index')->name('market');
Route::get('/market/product/{product_id}', 'MarketController@productInfo')->name('info');
Route::get('market/product/{product_id}/order', 'MarketController@order')->name('beforebuy');
Route::post('market/product/{product_id}/buy', 'MarketController@buy')->name('buy');
Route::get('market/vendors/{vendor_id}', 'MarketController@vendorinfo')->name('market_vendor');
Route::get('market/vendors/{vendor_id}/catalogs', 'MarketController@vendorcatalogs')->name('vendor_catalog');
Route::get('market/vendors', 'MarketController@vendors');
Route::get('market/customers', 'MarketController@customers');
Route::get('market/customers/{customer_id}', 'MarketController@customerinfo')->name('market_customer');
Route::get('market/products/category/{category_id}', 'MarketController@bigcategorypros')->name('bigpros');
Route::get('market/products/categories/{category_id}', 'MarketController@subcategorypros')->name('subpros');
Route::post('market/search', 'MarketController@search')->name('search');
Route::get("market/customers/{customer_id}/offer", 'MarketController@offer')->name('offer');
Route::post('market/customers{customer_id}/offer/complete', 'MarketController@customeroffer')->name('customeroffer');
Route::get('market/about','MarketController@about');


Route::group(['middleware' => ['auth','usersession']], function (){
    //customer
    Route::resource('/customer/cust_settings', 'CustomerSettingsController');
    Route::get('/customer/vendors', 'CustomerController@vendors');
    Route::get('/customer/orders', 'CustomerController@orders')->name('order');
    Route::get('customer/offers', 'CustomerController@offers')->name('offers');
    Route::get('customer/offers/{offer_id}', 'CustomerController@offeraccept')->name('offaccept');

    //seller
    Route::resource('/vendor/settings', 'SellerSettingsController');
    Route::get('/vendor/clients', 'SellerController@clients');
    Route::get('/vendor/orders', 'SellerController@orders')->name('orders');
    Route::get('/vendor/orders/{order_id}/verify', 'SellerController@orderverify')->name('verify');
    Route::put('/vendor/orders/{order_id}/verify', 'SellerController@verifycomplete')->name('verifycomplete');
    Route::resource('/vendor/catalogs', 'CatalogsController');
    Route::put('/vendor/settings/{seller_id}/edit', 'SellerSettingsController@update')->name('selleredit');
});
