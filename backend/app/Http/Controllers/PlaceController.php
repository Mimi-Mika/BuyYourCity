<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Use App\Place;
use App\User;

class PlaceController extends Controller
{
	//User & admin
	//Route::get('showPlace/{id}', 'PlaceController@show');
	protected function show($id){
		$place = Place::find($id);
		return !$place ? response()->json(['error' => 'No contents.'], 204) : $place;
	}

	//Route::get('showPlacesInRadius', 'PlaceController@showInRadius'); ==> in request "currentLatitude, currentLongitude, seeRadius"
	protected function showInRadius(Request $request){
		$places = Place::find($id);
		return !$places ? response()->json(['error' => 'No contents.'], 204) : $places;
	}

	//Route::get('showCurrentUserPlaces', 'PlaceController@showCurrentUserPlaces');
	protected function showCurrentUserPlaces(){
		$user = Auth::guard('api')->user();
		$places = Place::where('user_id', $user->id)->get();
		\Log::info($places);
		
    	return $places->toJson();
		//return !$places ? response()->json(['error' => 'No contents.'], 204) : $places;
	}
	//Route::update('sellPlace{id}', 'PlaceController@sellPlace');
	protected function sellPlace($id){
		$user = Auth::guard('api')->user()->get();
		$place = Place::find($id)->get();
		\Log::info($user);
		\Log::info($place);

		//return !$place ? response()->json(['error' => 'No contents.'], 204) : $place;
	}
	//Route::update('buyPlace{id}', 'PlaceController@buyPlace');
	protected function buyPlace($id){
		$user = Auth::guard('api')->user();
		$place = Place::find($id);
		return !$place ? response()->json(['error' => 'No contents.'], 204) : $place;
	}

	//Admin only
	//Route::get('showAllPlaces', 'PlaceController@showAll');
	//Route::get('showUserPlaces/{id}', 'PlaceController@showUserPlaces');
	//Route::post('addPlace', 'PlaceController@addPlace');
	//Route::post('addImg/', 'PlaceController@addImg');
	//Route::update('updatePlace/', 'PlaceController@updatePlace');
	//Route::post('deletePlace/{id}', 'PlaceController@deletePlace');
}
