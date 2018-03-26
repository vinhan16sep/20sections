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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

// Password reset routes
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::prefix('20s-admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    // Log admin out
    Route::get('/adminLogout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // Password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});


Route::group(['middleware' => ['auth:admin']], function () {
    Route::prefix('20s-admin')->group(function(){
        Route::namespace('admin')->group(function () {
            /*=======================================
            =            Category Routes            =
            =======================================*/
            
            Route::resource('category', 'CategoryController');
            Route::post('category/update/{id}', 'CategoryController@update')->name('category.update');
            Route::post('category/remove', 'CategoryController@remove');
            Route::post('category/active', 'CategoryController@active');
            Route::get('category/{search?}/{page?}', 'CategoryController@index');
            
            /*=====  End of Category Routes  ======*/
            
            /*=======================================
            =            Branding Routes            =
            =======================================*/
            
            Route::resource('branding', 'BrandingController');
            Route::post('branding/update/{id}', 'BrandingController@update')->name('branding.update');
            Route::post('branding/remove', 'BrandingController@remove');
            Route::post('branding/active', 'BrandingController@active');
            
            /*=====  End of Branding Routes  ======*/
            
            /*======================================
            =            Product Routes            =
            ======================================*/
            
            Route::get('product/over-view', 'ProductController@overView')->name('product.overView');
            Route::resource('product', 'ProductController');
            Route::post('product/selectBranding', 'ProductController@selectBranding');
            Route::post('product/removeImage', 'ProductController@removeImage');
            Route::post('product/update/{id}', 'ProductController@update')->name('product.update');
            Route::post('product/remove', 'ProductController@remove');
            Route::post('product/active', 'ProductController@active');

            /*=====  End of Product Routes  ======*/
            

            /*===========================================
            =            Register Mod Routes            =
            ===========================================*/
            
            Route::get('register', 'ModeratorController@showRegisterForm');
            Route::post('register', 'ModeratorController@register')->name('mod.register');
            
            /*=====  End of Register Mod Routes  ======*/

            /*====================================
            =            Brand Routes            =
            ====================================*/
            
            Route::get('brand/register', 'BrandController@showRegisterForm');
            Route::post('brand/register', 'BrandController@brandRegister')->name('brand.register');
            
            /*=====  End of Brand Routes  ======*/
            
            
        });
    });
});