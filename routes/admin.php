<?php

Route::group(['prefix'  =>  'admin'], function () {

    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login.post');
    Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/', function () {
            return view('admin.dashboard.index');
        })->name('admin.dashboard');

        Route::get('/settings', 'Admin\SettingController@index')->name('admin.settings');
        Route::post('/settings', 'Admin\SettingController@update')->name('admin.settings.update');

        Route::group(['prefix'  =>   'genres'], function() {

            Route::get('/', 'Admin\GenreController@index')->name('admin.genres.index');
            Route::get('/create', 'Admin\GenreController@create')->name('admin.genres.create');
            Route::post('/store', 'Admin\GenreController@store')->name('admin.genres.store');
            Route::get('/{id}/edit', 'Admin\GenreController@edit')->name('admin.genres.edit');
            Route::post('/update', 'Admin\GenreController@update')->name('admin.genres.update');
            Route::get('/{id}/delete', 'Admin\GenreController@delete')->name('admin.genres.delete');

        });

        Route::group(['prefix'  =>   'attributes'], function() {

            Route::get('/', 'Admin\AttributeController@index')->name('admin.attributes.index');
            Route::get('/create', 'Admin\AttributeController@create')->name('admin.attributes.create');
            Route::post('/store', 'Admin\AttributeController@store')->name('admin.attributes.store');
            Route::get('/{id}/edit', 'Admin\AttributeController@edit')->name('admin.attributes.edit');
            Route::post('/update', 'Admin\AttributeController@update')->name('admin.attributes.update');
            Route::get('/{id}/delete', 'Admin\AttributeController@delete')->name('admin.attributes.delete');

            Route::post('/get-values', 'Admin\AttributeValueController@getValues');
            Route::post('/add-values', 'Admin\AttributeValueController@addValues');
            Route::post('/update-values', 'Admin\AttributeValueController@updateValues');
            Route::post('/delete-values', 'Admin\AttributeValueController@deleteValues');
        });

        Route::group(['prefix'  =>   'brands'], function() {

            Route::get('/', 'Admin\BrandController@index')->name('admin.brands.index');
            Route::get('/create', 'Admin\BrandController@create')->name('admin.brands.create');
            Route::post('/store', 'Admin\BrandController@store')->name('admin.brands.store');
            Route::get('/{id}/edit', 'Admin\BrandController@edit')->name('admin.brands.edit');
            Route::post('/update', 'Admin\BrandController@update')->name('admin.brands.update');
            Route::get('/{id}/delete', 'Admin\BrandController@delete')->name('admin.brands.delete');

        });

        

        Route::group(['prefix' => 'films'], function () {

           Route::get('/', 'Admin\FilmController@index')->name('admin.films.index');
           Route::get('/create', 'Admin\FilmController@create')->name('admin.films.create');
           Route::post('/store', 'Admin\FilmController@store')->name('admin.films.store');
           Route::get('/edit/{id}', 'Admin\FilmController@edit')->name('admin.films.edit');
           Route::post('/update', 'Admin\FilmController@update')->name('admin.films.update');

           Route::post('images/upload', 'Admin\FilmImageController@upload')->name('admin.films.images.upload');
           Route::get('images/{id}/delete', 'Admin\FilmImageController@delete')->name('admin.films.images.delete');

           
        });

        Route::group(['prefix' => 'orders'], function () {
           Route::get('/', 'Admin\OrderController@index')->name('admin.orders.index');
           Route::get('/{order}/show', 'Admin\OrderController@show')->name('admin.orders.show');

           Route::get('attributes/load', 'Admin\FilmAttributeController@loadAttributes');
           Route::post('attributes', 'Admin\FilmAttributeController@productAttributes');
           Route::post('attributes/values', 'Admin\FilmAttributeController@loadValues');
           Route::post('attributes/add', 'Admin\FilmAttributeController@addAttribute');
           Route::post('attributes/delete', 'Admin\FilmAttributeController@deleteAttribute');

        });
    });
});
