<?php

namespace App\Http\Controllers;

use App\Place;
use App\History;
use App\Image;
use Response;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'name' => 'STRING',
            'latitude' => 'DOUBLE : -43.999681',
            'longitude' => 'DOUBLE : -68.591644',
            'pointsGiven' => 'INT',
            'pointsCost' => 'INT',]
        );
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
        ]);

        try {
            $place = new Place;
            $place->name = $request->name;
            $place->latitude = $request->latitude;
            $place->longitude = $request->longitude;
            $place->pointsGiven = $request->pointsGiven;
            $place->pointsCost = $request->pointsCost;
            $place->save();
        }
        catch (Exception $e) {
            \Log::info($e);
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        //
    }


	//Route::update('sellPlace{id}', 'PlaceController@sellPlace');
	public function sellPlace(Place $place) { 
		$user = Auth::guard('api')->user();
        //Controle if current user belongs place
        if ($place->user_id == $user->id){
            //Modify user_id on place table => user_id = 0
            $place->user_id = 0;    
            //Add points on user account
            $user->pointsAviable += $place->pointsCost*0.8;          //Replace 0.8 with global parameters value
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
        if ($place->user_id == 0) {
            //check if user have necessary point aviable
            if ($user->pointsAviable >= $place->pointsCost) {
                //Remove points on user account
                $user->pointsAviable -= $place->pointsCost;
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
            return response()->json(['error' => 'This not your place, Your can\'t sell it !!!!'], 403);
        }
    	$user = Auth::guard('api')->user();
    	$place = Place::find($id);
    	return !$place ? response()->json(['error' => 'No contents. Place not found.'], 204) : $place;
    }

    public function showImage(Place $place) {

        $image = Image::where('id', $place->image_id)->get()->first();
        
        $file = Storage::get($image->image_path);
        $type = Storage::mimeType($image->image_path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
