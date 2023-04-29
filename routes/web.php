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


Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login-submit', 'LoginController@loginSubmit')->name('login-submit');
Route::get('/logout', 'LoginController@index')->name('logout');

Route::group([
    'middleware' => 'auth.user'
], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/danh-sach-cua-hang', 'StoreController@index');
    Route::get('/danh-sach-san-pham', 'ProductController@index');
    Route::get('/stores', 'StoreController@listOfStore');
    Route::post('/stores/save', 'StoreController@storeSave');
    Route::get('/products', 'ProductController@listOfProduct');
    Route::post('/products/save', 'ProductController@productSave');
    Route::get('/total-data', 'DashboardController@totalData');
    Route::get('/stores/delete', 'StoreController@storeDelete');
    Route::get('/product/delete', 'ProductController@productDelete');
});
