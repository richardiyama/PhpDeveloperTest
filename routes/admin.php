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

            Route::get('/', 'GenreController@index')->name('admin.genres.index');
            Route::get('/create', 'GenreController@create')->name('admin.genres.create');
            Route::post('/store', 'GenreController@store')->name('admin.genres.store');
            Route::get('/{id}/edit', 'GenreController@edit')->name('admin.genres.edit');
            Route::post('/update', 'GenreController@update')->name('admin.genres.update');
            Route::get('/{id}/delete', 'GenreController@delete')->name('admin.genres.delete');

        });

       

        

        Route::group(['prefix' => 'films'], function () {

           Route::get('/', 'FilmController@index')->name('admin.films.index');
           Route::get('/create', 'FilmController@create')->name('admin.films.create');
           Route::post('/store', 'FilmController@store')->name('admin.films.store');
           Route::get('/edit/{id}', 'FilmController@edit')->name('admin.films.edit');
           Route::post('/update', 'FilmController@update')->name('admin.films.update');

           Route::post('images/upload', 'FilmImageController@upload')->name('admin.films.images.upload');
           Route::get('images/{id}/delete', 'FilmImageController@delete')->name('admin.films.images.delete');

           
        });

        Route::group(['prefix' => 'orders'], function () {
           Route::get('/', 'OrderController@index')->name('admin.orders.index');
           Route::get('/{order}/show', 'OrderController@show')->name('admin.orders.show');
        });
    });
});
