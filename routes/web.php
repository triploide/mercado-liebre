<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::resource('products', 'ProductsController');
Route::post('products/{id}/images', 'ProductsController@images');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
/*
Route::get('register/{id}/edit', 'Auth/RegisterController@edit'); // vista al form de edit
Route::patch('register/{id}', 'Auth/RegisterController@update'); // action del form
*/

Route::get('/home', 'HomeController@index');


Route::get('auth/github', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{driver}/callback', 'Auth\AuthController@handleProviderCallback');
