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
Route::get('/genre/{slug}', 'Frontend\GenreController@show')->name('genre.show');
Route::get('/film/{slug}', 'Frontend\FilmController@show')->name('film.show');

Route::post('/film/add/cart', 'Frontend\FilmController@addToCart')->name('film.add.cart');
Route::get('/cart', 'Frontend\CartController@getCart')->name('checkout.cart');
Route::get('/cart/item/{id}/remove', 'Frontend\CartController@removeItem')->name('checkout.cart.remove');
Route::get('/cart/clear', 'Frontend\CartController@clearCart')->name('checkout.cart.clear');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/checkout', 'Frontend\CheckoutController@getCheckout')->name('checkout.index');
    Route::post('/checkout/order', 'Frontend\CheckoutController@placeOrder')->name('checkout.place.order');

    Route::get('checkout/payment/complete', 'Frontend\CheckoutController@complete')->name('checkout.payment.complete');

    Route::get('account/orders', 'Frontend\AccountController@getOrders')->name('account.orders');
});

Auth::routes();
require 'admin.php';
