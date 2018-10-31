<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function (Router $router) {
    $router->post('login', 'AuthController@login');


});
Route::group(['prefix' => 'v1', 'namespace' => 'Api',
    'middleware' => ['refresh.token']
], function (Router $router) {
    $router->post('list', 'UserController@getList');

});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
