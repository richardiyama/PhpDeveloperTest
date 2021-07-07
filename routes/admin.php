<?php

Route::group(['prefix'  =>  'admin'], function () {

    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login.post');
    Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/', function () {
            return view('admin.dashboard.index');
        })->name('admin.dashboard');

     

        Route::group(['prefix'  =>   'genres'], function() {

            Route::get('/', 'Admin\GenreController@index')->name('admin.genres.index');
            Route::get('/create', 'Admin\GenreController@create')->name('admin.genres.create');
            Route::post('/store', 'Admin\GenreController@store')->name('admin.genres.store');
            Route::get('/{id}/edit', 'Admin\GenreController@edit')->name('admin.genres.edit');
            Route::post('/update', 'Admin\GenreController@update')->name('admin.genres.update');
            Route::get('/{id}/delete', 'Admin\GenreController@delete')->name('admin.genres.delete');

        });

       

        

        Route::group(['prefix' => 'films'], function () {

           Route::get('/', 'Admin\FilmController@index')->name('admin.products.index');
           Route::get('/create', 'Admin\FilmController@create')->name('admin.products.create');
           Route::post('/store', 'Admin\FilmController@store')->name('admin.products.store');
           Route::get('/edit/{id}', 'Admin\FilmController@edit')->name('admin.products.edit');
           Route::post('/update', 'Admin\FilmController@update')->name('admin.products.update');

           Route::post('images/upload', 'Admin\FilmImageController@upload')->name('admin.products.images.upload');
           Route::get('images/{id}/delete', 'Admin\FilmImageController@delete')->name('admin.products.images.delete');

           
        });

        Route::group(['prefix' => 'orders'], function () {
           Route::get('/', 'Admin\OrderController@index')->name('admin.orders.index');
           Route::get('/{order}/show', 'Admin\OrderController@show')->name('admin.orders.show');
        });
    });
});
