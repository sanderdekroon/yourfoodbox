<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('/reset', 'HomeController@reset');

// Authentication
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');

// Registration
Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');

// Pages
Route::resource('pages', 'PagesController');

// Ordering
Route::get('/bestellen/markt/{name}', 'CitiesController@setCity');
Route::get('/bestellen/markt', 'CitiesController@index');
Route::get('/bestellen/bevestigen', 'OrdersController@overview');
Route::get('/bestellen/{name}', 'ProductsController@show');
Route::get('/bestellen', 'ProductsController@index');
Route::post('/bestellen', 'OrdersController@store');
Route::patch('/bestellen', 'OrdersController@update');

// Orders
Route::get('/orders', 'OrdersController@index');

//Dev, please ignore.
Route::get('/destroySession', 'CitiesController@destroyCity');
