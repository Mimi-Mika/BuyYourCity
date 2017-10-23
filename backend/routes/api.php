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
* GUEST ROUTES WITHOUT AUTH
*/
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('verifyemail/{name}/{string}', 'Auth\RegisterController@verifyEmail');

/*
* USERS ROUTES WITH AUTH
*/
Route::group(['middleware' => 'auth:api'], function() {
	//USER
	Route::get('user/{id}', 'UserController@getUser');

	//PLACE
	Route::get('place/{id}', 'PlaceController@getPlace');

	//PARAMETER
	Route::get('parameter/{id}', 'ParameterController@getParameter');

	//HISTORY
	Route::get('history/{id}', 'HistoryController@getHistory');



	Route::post('logout', 'Auth\LoginController@logout');

});


/*
* ADMIN ROUTES WITH AUTH + ADMIN CHECK
*/
Route::group(['middleware' => ['auth:api', 'admin']], function() {
	Route::get('placeadmin/{id}', function($id) {return Place::find($id);});
});


/*
*TEST EMAIL :
 

Route::get('send_test_email', function(){
	Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message)
	{
		$message->to('pauly.matthieu@gmail.com');
	});
});


/*
*EXEMPLES:

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('place/{id}', function($id) {return Place::find($id);})->middleware('auth:api');
*/
