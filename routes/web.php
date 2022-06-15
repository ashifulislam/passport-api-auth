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

Route::get('/', function ()
{
    return view('welcome');
});

Route::get('/starter',function()
{
    return view('admin.dashboard');
});

Route::group(['middleware' => ['auth']], function ()
{
    Route::get('/customer', 'App\Http\Controllers\Customer\CustomerController@index')->name('customer');
    Route::get('/admin', 'App\Http\Controllers\Admin\AdminController@index')->name('admin');
    Route::get('/superadmin','App\Http\Controllers\Superadmin\SuperAdminController@index')->name('superAdmin');
    Route::get('/admin/category','App\Http\Controllers\Admin\CategoryControler@addCategory')->name('admin.category');
    Route::post('admin/category/store','App\Http\Controllers\Admin\CategoryControler@store')->name('admin.category.store');
    Route::resource('products','App\Http\Controllers\Admin\ProductController');

});
Route::get('admin/product/search','App\Http\Controllers\Admin\ProductController@search')->name('admin.product.search');
// Route::get('/admin/product/view', 'App\Http\Controllers\Admin\ProductController@index_update'); 
// Route::get('/getProducts', 'App\Http\Controllers\Admin\ProductController@getProducts')->name('getProducts');
Route::get('/getProducts', 'App\Http\Controllers\Customer\CustomerController@getProducts')->name('getProducts');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

