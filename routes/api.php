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
//Login:: localhost/api/oauth/token
Route::middleware('auth:api')->get('/user', function (Request $request) {
    Route::resource('products', 'API\ProductController');
});

Route::group(['namespace' => 'API'], function () {
        Route::post('register', 'RegisterController');
        Route::post('login', 'LoginController');
				Route::post('logout', 'LogoutController')->middleware('auth:api');
				
});


