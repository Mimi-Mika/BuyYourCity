<?php

use Illuminate\Http\Request;
use Illuminate\Auth;

Use App\User;
Use App\Place;
Use App\Parameter;
Use App\History;
Use App\Image;

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

Route::group(['middleware' => 'cors'], function() {
	
	Route::post('register', 'Auth\RegisterController@register');
	Route::post('login', 'Auth\LoginController@login');
	Route::post('logout', 'Auth\LoginController@logout');
	Route::get('verifyemail/{name}/{string}', 'Auth\RegisterController@verifyEmail');

	Route::get('user/refresh', 'UserController@refresh');
	Route::get('user/ranking', 'UserController@ranking');
	Route::get('user/{user}/places', 'UserController@showPlaces');
	Route::get('user/{user}/image', 'UserController@showImage');
	Route::get('user/{user}/history', 'UserController@showHistory');
	Route::put('user/password', 'UserController@changePassword');
	Route::put('user/{user}/restore', 'UserController@restore');
	Route::get('user/redirect', 'UserController@redirectToFrontend');
	Route::get('user/count/total', 'UserController@countTotal');
	Route::get('user/count/ban', 'UserController@countBan');
	Route::get('user/count/playing', 'UserController@countPlaying');
	Route::get('user/count/admin', 'UserController@countAdmin');
	Route::get('user/count/notadmin', 'UserController@countNotAdmin');

	Route::get('place/available', 'PlaceController@available');
	Route::get('place/purchased', 'PlaceController@purchased');
	Route::get('place/{place}/image', 'PlaceController@showImage');
	Route::post('place/{place}/buy', 'PlaceController@buyPlace');
	Route::post('place/{place}/sell', 'PlaceController@sellPlace');
	Route::post('place/inradius', 'PlaceController@showInRadius');
	Route::get('place/count/total', 'PlaceController@countTotal');
	Route::get('place/count/available', 'PlaceController@countAvailable');
	Route::get('place/count/purchased', 'PlaceController@countPurchased');
	Route::put('place/{place}/restore', 'PlaceController@restore');


	Route::get('image/{image}/data', 'ImageController@getData');
	Route::get('image/user', 'ImageController@getUserImages');
	Route::get('image/place', 'ImageController@getPlaceImages');
	Route::post('image/upload', 'ImageController@upload');


	Route::get('history/sell/day', 'HistoryController@sellLastDay');
	Route::get('history/sell/week', 'HistoryController@sellLastWeek');
	Route::get('history/sell/month', 'HistoryController@sellLastMonth');
	Route::get('history/sell/year', 'HistoryController@sellLastYear');

	Route::get('history/buy/day', 'HistoryController@buyLastDay');
	Route::get('history/buy/week', 'HistoryController@buyLastWeek');
	Route::get('history/buy/month', 'HistoryController@buyLastMonth');
	Route::get('history/buy/year', 'HistoryController@buyLastYear');

	Route::resource('user', 'UserController', ['except' => ['create', 'edit']]);
	Route::resource('image', 'ImageController', ['except' => ['create', 'edit', 'destroy']]);
	Route::resource('history', 'HistoryController', ['except' => ['create', 'edit', 'update', 'destroy']]);
	Route::resource('place', 'PlaceController', ['except' => ['create', 'edit']]);
	Route::resource('parameter', 'ParameterController', ['except' => ['create', 'edit', 'destroy']]);

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


Route::get('routes', function(){
    $routeCollection = Route::getRoutes()->get();
    echo "<table id='routes-table' class='table table-bordered table-responsive'>";
        echo "<tr>";
            echo "<td width='10%'><h4>HTTP Method</h4></td>";
            echo "<td width='30%'><h4>Route</h4></td>";
            echo "<td width='35%'><h4>Corresponding Action</h4></td>";
            echo "<td width='15%'><h4>Middlewares</h4></td>";
        echo "</tr>";
        foreach ($routeCollection as $route) {
        	$middlewares = $route->gatherMiddleware();
            echo "<tr>";
                echo "<td>" . $route->methods()[0] . "</td>";
                echo "<td>http://api.buyyourcity.ovh/" . $route->uri . "</td>";
                echo "<td>" . $route->getActionName() . "</td>";
                echo "<td>";
                foreach ($middlewares as $key => $middleware) {
                	echo $middleware . ",";
                }
                echo "</td>";

            echo "</tr>";
        }
    echo "</table>";
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