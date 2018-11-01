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

Route::get('/mail','UserController@mail');
Route::get('/send','UserController@send');
Route::get('/login','UserController@login');
Route::get('/event','UserController@event');
Route::get('/age','UserController@age');