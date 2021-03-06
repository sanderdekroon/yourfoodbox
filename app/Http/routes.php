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
Route::get('/bestelling/markt/{name}', 'CitiesController@setCity'); //@to-do: Integrate city selection with view
Route::get('/bestelling/markt', 'CitiesController@index'); //@to-do: Integrate city selection with view
Route::get('/bestelling/bevestigen', 'OrdersController@overview');
Route::get('/bestelling/plaatsen', 'OrdersController@confirmed');
Route::get('/bestelling', 'ProductsController@index');
Route::post('/bestelling', 'OrdersController@store');
Route::patch('/bestelling', 'OrdersController@update'); //@to-do: Transfer to OrderlinesController

// Manager
Route::get('/manager', 'ManagerController@index');
Route::get('/manager/orders', 'OrdersController@index');
Route::patch('/manager/orders', 'OrdersController@updateStatus');

Route::get('/manager/products', 'ManagerController@listProducts');
Route::post('/manager/products', 'ProductsController@store');
Route::get('/manager/products/{id}', 'ProductsController@edit');
Route::patch('/manager/products/{id}', 'ProductsController@update');


Route::get('/manager/ingredients', 'IngredientsController@index');
Route::get('/manager/ingredients/{id}', 'IngredientsController@show');
Route::patch('/manager/ingredients/{id}', 'IngredientsController@update');


// Users
Route::get('/account', 'UsersController@index');
Route::post('/account', 'UsersController@update');
