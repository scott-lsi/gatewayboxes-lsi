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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/export', 'ExportController@exportOrders');

    Route::get('userreg', 'UsersController@create');
    Route::post('userreg', 'UsersController@store');
    Route::get('/users/{companyid?}', 'UsersController@index');
    Route::get('/users/{userid}/edit', 'UsersController@edit');
    Route::get('users/user/{user}', 'UsersController@show');
    Route::get('users/user/{user}/edit', 'UsersController@edit');
    Route::post('users/user/{user}', 'UsersController@update');
    Route::post('users/user/{user}/delete', 'UsersController@destroy');

    Route::resource('company', 'CompanyController');

    Route::get('/products', 'ProductController@index');
    Route::get('/products/trashed', 'ProductController@getTrashed');
    Route::get('/products/{type}', 'ProductController@getProductsByType');
    Route::resource('product', 'ProductController');
    Route::get('product/personaliser/{id}/{gatewaymulti?}', 'ProductController@personaliser');
    Route::get('productepa/{id?}', 'ProductController@getExternalPricingAPI');
    Route::get('image-gallery', 'GalleryImageController@index');
    Route::get('terms', 'TermController@index');

    // Credit App
    Route::get('credit', 'CreditController@index');
    Route::post('credit', 'CreditController@postCreditApp');

    // Contact Us
    Route::get('contact', 'ContactController@index');
    Route::post('contact', 'ContactController@postContactUs');

    Route::get('basket', 'CartController@index');
    Route::post('basket/add/{gatewaymulti?}', 'CartController@add');
    Route::get('basket/destroy', 'CartController@destroy');
    Route::get('basket/redir/{id?}/{gatewaymultiId?}', 'CartController@gatewayRedir');
    Route::get('basket/remove-item/{rowId}', 'CartController@getRemoveItem');
    Route::post('basket/update-qty/{rowId}', 'CartController@postUpdateQty');
    Route::post('basket/post-to-print', 'CartController@postToPrint');
    Route::get('complete', 'CartController@getComplete');

    Route::get('/orders/{id}', 'OrderController@getOrders');
    Route::get('/order/{id}', 'OrderController@getOrder');
    Route::get('/logout', 'HomeController@logout');
});
