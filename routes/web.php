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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('users', 'UsersController');

Route::any('/wx','wxController@index');

Route::get('/sort','UserController@sort');


Route::get('/redis/test','UserController@redis');
Route::get('/mail','UserController@mail');
Route::get('/send','UserController@send');
Route::get('/login','UserController@login');
Route::get('/event','UserController@event');
Route::get('/age','UserController@age');
Route::get('/redis','UserController@studyRedis');
Route::get('/search','UserController@search');
Route::get('/show','UserController@show');


Route::get('/test/a','TestController@a');
Route::get('/test/b','TestController@b');