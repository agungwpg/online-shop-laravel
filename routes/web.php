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



Route::get('/',function(){
  return view('user.welcome');
});
Route::get('/login', function () {
    return view('user.login');
});
Route::post('/dologin','UserController@dologin')->name('dologin');
Route::post('/dologin-cart','UserController@dologincart')->name('dologin-cart');

Route::get('/dashboard-admin',function(){
  return view('admin.component.master');
})->name('dashboard');
Route::get('/logout','UserController@logout')->name('logout');

Route::get('/register',function(){
  return view('user.register');
})->name('register');

Route::post('/doregister','UserController@register')->name('doregister');

Route::get('confirmation-list',function(){
  return view('user.myshop.confirmation-list');
})->name('confirmationlist');

Route::get('action-confirmation/{id_conf}/{type}','ShopController@actionconfirmation')->name('c-action');

//-----------------------user--------------------
Route::get('/myshop/dashboard',function(){
  return view('user.myshop.dashboard');
})->name('myshop-dashboard');
Route::get('/myshop/add-product',function(){
  return view('user.myshop.add-product');
})->name('add-product');
Route::get('/myshop/detail-product/{id}','ProductController@detail')->name('detail-product-my');
Route::post('/myshop/do-add-product','ProductController@do_addproduct')->name('do-add-product');
Route::post('/myshop/do-edit-product/{id}','ProductController@do_editproduct')->name('do-edit-product');
Route::get('/detail-product/{id}','ProductController@detailproduct')->name('detail-product');
Route::post('/addcart/{id}','ProductController@addcart')->name('addcart');

Route::get('search/{name}/{category}','ShopController@searchitem')->name('searchitem');
Route::get('category/{category}','ShopController@categoryitem')->name('categoryitem');
Route::get('show-cart',function(){

  return view("user.product.cart");
})->name('show-cart');

Route::post('cartAction/{action}/{id}/{jumlah}','ShopController@cartAction')->name('cartAction');

Route::get('contactDetail',function(){
  return view('user.product.fill-detail-order');
})->name('contactDetail');

Route::post('doOrder','ShopController@doOrder')->name('doOrder');

Route::get('detail-transfer/{id_order}',function($id_order){
  $total = \Cart::getTotal();
  \Cart::clear();
  return view('user.product.detail-transfer',compact('total','id_order'));
})->name('detail-transfer');

Route::get('confirm-payment',function(){
  return view('user.product.confirm-payment');
})->name('confirm-payment');


Route::post('doconfirmpayment','ShopController@doconfirm')->name('doconfirm');
Route::get('orderhistory',function(){
  return view('user.myshop.orderhistory');
})->name('orderhistory');

Route::get('orderhistorydetail/{id}',function($id){
  return view('user.myshop.orderhistorydetail',compact('id'));
});
//-----------------------cashier-------------------

Route::get('cashier',function(){
  //\Cart::clear();
  return view('cashier.cashier');
})->name('cashier');

Route::get('transaction','ShopController@checkoutcashier')->name('transaction');

Route::post('deletecart/{id}','ShopController@deletecart')->name('deletecart');

//-------------------content--------------------
Route::get('showcategory',function(){
    return view('admin.content.categories.showkategories');
})->name('showcategory');
Route::post('addcategory','ContentController@addcategory')->name('addcategory');
Route::put('editcategory','ContentController@editcategory')->name('editcategory');
Route::get('deletecategory/{id}','ContentController@deletecategory')->name('deletecategory');

Route::get('showslides',function(){
    return view('admin.content.slides.slides');
})->name('showslides');
Route::post('addslides','ContentController@addslides')->name('addslides');
Route::put('editslides','ContentController@editslides')->name('editslides');
Route::get('deleteslides/{id}','ContentController@deleteslides')->name('deleteslides');

Route::get('showusers',function(){
    return view('admin.content.users.users');
})->name('showusers');
Route::post('addusers','ContentController@addusers')->name('addusers');
Route::put('editusers','ContentController@editusers')->name('editusers');
Route::get('deleteusers/{id}','ContentController@deleteusers')->name('deleteusers');
