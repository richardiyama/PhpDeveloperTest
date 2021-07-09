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

Route::view('/', 'frontend.pages.homepage');
Route::get('/category/{id}', 'GenreController@show')->name('genre.show');
Route::get('/product/{id}', 'FilmController@show')->name('film.show');

Route::post('/product/add/cart', 'FilmController@addToCart')->name('film.add.cart');
Route::get('/cart', 'CartController@getCart')->name('checkout.cart');
Route::get('/cart/item/{id}/remove', 'CartController@removeItem')->name('checkout.cart.remove');
Route::get('/cart/clear', 'CartController@clearCart')->name('checkout.cart.clear');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/checkout', 'CheckoutController@getCheckout')->name('checkout.index');
    Route::post('/checkout/order', 'CheckoutController@placeOrder')->name('checkout.place.order');

    Route::get('checkout/payment/complete', 'CheckoutController@complete')->name('checkout.payment.complete');

    Route::get('account/orders', 'AccountController@getOrders')->name('account.orders');
});

Auth::routes();
require 'admin.php';
