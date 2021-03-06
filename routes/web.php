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

Route::match(['get','post'],'/admin','AdminController@login');

Auth::routes();

Route::get('/home','HomeController@index')->name('home');
Auth::routes();

Route::get('/home','HomeController@index')->name('home');

Route::get('/logout','AdminController@logout');

Route::group(['middleware' => ['auth']],function(){
  Route::get('/admin/dashboard','AdminController@dashboard');
  Route::get('/admin/settings','AdminController@settings');
  Route::get('/admin/check-pwd','AdminController@chkPassword');
  Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');
    
  // Categories Routes (Admin)
  Route::match(['get', 'post'],'/admin/add-category','CategoryController@addCategory');
  Route::match(['get', 'post'],'/admin/edit-category/{id}','CategoryController@editCategory');
  Route::match(['get', 'post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');
  Route::get('/admin/view-categories','CategoryController@viewCategories');
  
  // Products Routes (Admin)
  Route::match(['get', 'post'],'/admin/add-product','ProductController@addProduct');
  Route::match(['get', 'post'],'/admin/edit-product/{id}','ProductController@editProduct');
  Route::match(['get', 'post'],'/admin/delete-product/{id}','ProductController@deleteProduct');
  Route::get('/admin/view-products','ProductController@viewProducts');
});