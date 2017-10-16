<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Place;

class PlaceController extends Controller
{
	protected function getPlace($id){
		\Log::info($id);
		$place = Place::find($id);
		return !$place ? response()->json(['error' => 'No contents.'], 204) : $place;
	}
}
