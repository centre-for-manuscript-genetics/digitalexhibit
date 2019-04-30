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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'Grids\GridController@show');

Route::get('/general/{slug}', 'BasicController@show');
Route::get('/museum/general/{slug}', 'BasicController@showLimited');

Route::get('/museum', 'Grids\GridController@showLimited');
Route::get('/museum/{slug}', 'Grids\GridController@showLimited');

Route::get('/{slug}', 'Grids\GridController@show');

