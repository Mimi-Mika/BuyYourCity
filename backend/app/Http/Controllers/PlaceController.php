<?php

namespace App\Http\Controllers;

use App\Place;
use App\History;
use App\Image;
use App\Parameter;
use App\User;

use Response;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;


class PlaceController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $place = Place::orderBy('name', 'asc')->get();
        return $place;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'pointsGiven' => 'required|integer',
            'pointsCost' => 'required|integer',
            'image_id' => 'integer',
        ]);

        try {
            $place = new Place;
            $place->name = $request->name;
            $place->latitude = $request->latitude;
            $place->longitude = $request->longitude;
            $place->pointsGiven = $request->pointsGiven;
            $place->pointsCost = $request->pointsCost;
            $place->image_id = $request->image_id;
            $place->save();
            return $place;
        }
        catch (Exception $e) {
            \Log::info($e);
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        return !$place ? response()->json(['error' => 'No contents.'], 204) : $place;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Place $place)
    {
        $request->validate([
            'name' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'pointsGiven' => 'required|integer',
            'pointsCost' => 'required|integer',
            'image_id' => 'integer',
        ]);

        try {
            $place->name = $request->name;
            $place->latitude = $request->latitude;
            $place->longitude = $request->longitude;
            $place->pointsGiven = $request->pointsGiven;
            $place->pointsCost = $request->pointsCost;
            $place->image_id = $request->image_id;
            $place->save();
        }
        catch (Exception $e) {
            \Log::info($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        try {
            if ($place->user_id != NULL) {
                $user = User::where('id', $place->user_id)->first();
                $user->pointsAvailable += $place->pointsCost;
                $place->user_id = NULL;
                $user->save();
            }
            $place->delete();
            $place->save();
        } catch (Exception $e) {
            \Log::info($e);
            return response()->json(['error' => $e], 404);
        }
        return response()->json(['ok' => 'Place soft deleted.'], 200);
    }

	//Route::update('sellPlace{id}', 'PlaceController@sellPlace');
	public function sellPlace(Place $place) { 
		$user = Auth::guard('api')->user();
        //Controle if current user belongs place
        if ($place->user_id == $user->id){
            //Modify user_id on place table => user_id = 0
            $place->user_id = NULL;    
            //Add points on user account
            $user->pointsAvailable += $place->pointsCost*0.8;          //Replace 0.8 with global parameters value
            //Add entry on table history
            $history = new History;
            $history->buySell = 'sell';
            $history->user_id = $user->id;
            $history->place_id = $place->id;
            $history->save();
            $user->save();
            $place->save();
        } 
        //else this place is not your's !
        else {
            return response()->json(['error' => 'This is not your place !'], 403);
        }
	}

	//Route::update('buyPlace{id}', 'PlaceController@buyPlace');
	public function buyPlace(Place $place){
        $user = Auth::guard('api')->user();
        //Controle if nobody belongs place
        if ($place->user_id == NULL) {
            //check if user have necessary point available
            if ($user->pointsAvailable >= $place->pointsCost) {
                //Remove points on user account
                $user->pointsAvailable -= $place->pointsCost;
                //Modify user_id on place table => user_id = user.id
                $place->user_id = $user->id;
                //Add entry on table history
                $history = new History;
                $history->buySell = 'buy';
                $history->user_id = $user->id;
                $history->place_id = $place->id;
                $history->save();
                $user->save();
                $place->save();    
            }
            else {
                return response()->json(['error' => 'You need more points for buy this place'], 403);
            }
        }
        else {
            return response()->json(['error' => 'This not your place, Your can\'t buy it !!!!'], 403);
        }
    	return $place;
    }

    public function showImage(Place $place) {

        $image = Image::where('id', $place->image_id)->get()->first();

        $path = storage_path('app/public/' . $image->image_path);

        if(!file_exists($path)) {
            abort(404);
        }

        $file = file_get_contents($path);
        $type = mime_content_type($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;

    }

    public function available () {
        return Place::where('user_id', NULL)->get();
    }

    public function purchased () {
        return Place::where('user_id', '<>', NULL)->get();
    }

    public function showInRadius(Request $request) {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $sql = "* , ((ACOS(SIN( " . $request->latitude . " * PI() / 180) * SIN( places.latitude * PI() / 180) + COS( " . $request->latitude . "  * PI() / 180) * COS( places.latitude * PI() / 180) * COS((" . $request->longitude . "  - places.longitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515 * 1.609344) as distance";
        
        $places = Place::selectRaw($sql);

        $parameter = Parameter::select('seeRadius')->where('id', env('DB_PARAMETER_ID', '1'))->first();

        \Log::info($parameter);

        $places->havingRaw('distance BETWEEN 0 AND ' . $parameter->seeRadius); // TODO replace $outer_radius with parameter->radius !!!!!

        return $places->get();
    }

    public function countAvailable () {
        return Place::where('user_id', NULL)->count();
    }

    public function countPurchased () {
        return Place::where('user_id', '<>', NULL)->count();
    }

    public function countTotal() {
        return Place::all()->count();
    }


    /**
     * Restore the current resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function restore(Place $place)
    {
        try {
            $place->deleted_at = NULL;
            $place->save();
        } catch (Exception $e) {
            return response()->json(['error' => $e], 404);
        }
        return response()->json(['ok' => 'Place restored.'], 200);
    }
}