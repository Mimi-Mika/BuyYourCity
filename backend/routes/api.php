<?php

use Illuminate\Http\Request;
use Illuminate\Auth;

Use App\User;
Use App\Place;
Use App\Parameter;
Use App\History;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/*
* GUEST ROUTES WITHOUT AUTH
*/
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');


/*
* USERS ROUTES WITH AUTH
*/
Route::group(['middleware' => 'auth:api'], function() {
	Route::get('place/{id}', function($id) {return Place::find($id);});
});
//Route::get('place/{id}', function($id) {return Place::find($id);})->middleware('auth:api');


/*
* ADMIN ROUTES WITH AUTH + ADMIN CHECK
*/
Route::group(['middleware' => ['auth:api', 'admin']], function() {
	Route::get('placeadmin/{id}', function($id) {return Place::find($id);});
});