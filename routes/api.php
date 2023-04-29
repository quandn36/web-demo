<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group([
    'prefix' => 'v1/auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        Route::get('get-store', 'Apis\StoreApi@listStore');
        Route::post('get-store/save', 'Apis\StoreApi@storeSave');
        Route::get('get-products', 'Apis\ProductApi@ListProducts');
        Route::get('get-units', 'Apis\UnitApi@listOfUnit');
        Route::post('product-save', 'Apis\ProductApi@productSave');
        Route::get('get-total-data', 'Apis\DashboardApi@getTotalData');
        Route::get('delete-store', 'Apis\StoreApi@deleteStore');
        Route::get('delete-product', 'Apis\ProductApi@deleteProduct');
    });
});
