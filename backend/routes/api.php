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


/*
* GUEST/PUBLIC ROUTES WITHOUT AUTH
*/

Route::get('user/refresh', 'UserController@refresh');


Route::group(['middleware' => 'cors'], function() {
	Route::post('register', 'Auth\RegisterController@register');
	Route::post('login', 'Auth\LoginController@login');
	Route::get('verifyemail/{name}/{string}', 'Auth\RegisterController@verifyEmail');

	Route::resource('history', 'HistoryController', ['except' => ['edit', 'update', 'destroy']]);
	Route::resource('parameter', 'ParameterController');
	Route::resource('place', 'PlaceController');
	Route::resource('user', 'UserController', ['except' => ['edit', 'update', 'destroy']]);
	Route::get('user/places/{user}', 'UserController@showPlaces');


	//refresh user infos with token

	//retourne la listes des lieux possedé
	//Route::get('place/purchased', 'PlaceController@');

	//retourne la liste des lieux libres
	////Route::get('place/available', 'PlaceController@');

});

/*
 * Logout route
 */
Route::group(['middleware' => ['auth:api', 'email', 'cors']], function() {
	Route::post('logout', 'Auth\LoginController@logout');
});


/*
* USERS ROUTES WITH AUTH
*/
Route::group(['middleware' => ['auth:api', 'email', 'ban', 'cors']], function() {

});


/*
* ADMIN ROUTES WITH AUTH + ADMIN CHECK
*/
Route::group(['middleware' => ['auth:api', 'admin', 'cors']], function() {

});

/*
*EXEMPLES:

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('place/{id}', function($id) {return Place::find($id);})->middleware('auth:api');
*/

/*

curl -d '{"key1":"value1", "key2":"value2"}' -H "Content-Type: application/json" -X POST http://localhost:3000/data


curl -X POST http://localhost:8000/register  -H "Accept: application/json"  -H "Content-Type: application/json"  -d '{"name": "test", "email": "test@test.com", "password": "test", "password_confirmation": "test"}'


curl -X POST http://localhost:8000/api/register -H "Accept: application/json" -H "Content-Type: application/json" -d '{"name": "John", "email": "john.doe@toptal.com", "password": "toptal123", "password_confirmation": "toptal123"}'
*/