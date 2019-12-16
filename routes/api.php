<?php

//use Illuminate\Http\Request;
use Http\Controllers\UsersController;

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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
/*
Route::resource('/users', 'UserController')->only([
    'store', 'update'
]);
 */
Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('user', 'UserController@store');
    Route::put('user', 'UserController@update');
});

Route::group([
    'middleware' => 'api',
    'prefix'     => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout');
    Route::get('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
});
