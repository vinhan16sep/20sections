<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function() {
    Route::group(array('namespace' => 'Api'), function() {
        // Brand Login
        Route::post('brand-login', 'LoginController@brandLogin');
        Route::post('brand-register', 'LoginController@brandRegister');

        /* Publisher Login */
        Route::post('publisher-login', 'LoginController@publisherLogin');
        Route::post('publisher-register', 'LoginController@publisherRegister');

        /* Check role */
        Route::get('check', 'LoginController@checkRole');

        Route::middleware('auth:api')->post('detail', 'UserController@detail');
        Route::middleware('auth:api')->post('check-role', 'LoginController@checkRole');
    });
});

/*
 * Demo routes for brand
 * In this part, we will build routers for Demo
 * Or whatever ...
 */
Route::post('/demo', 'DemoController@postDemo');
Route::get('/demos', 'DemoController@getDemos');
Route::put('/demo/{id}', 'DemoController@putDemo');
Route::delete('/demo/{id}', 'DemoController@deleteDemo');

Route::post('/user', 'UserController@signup');
Route::post('/user/signin', 'UserController@signin');

