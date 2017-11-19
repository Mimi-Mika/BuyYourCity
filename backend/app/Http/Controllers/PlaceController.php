<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $place = Place::all();
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
            'name'=>'STRING',
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
	public function sellPlace($id){
		$user = Auth::guard('api')->user();
		$place = Place::find($id);
		return !$place ? response()->json(['error' => 'No contents.'], 204) : $place;
	}
	//Route::update('buyPlace{id}', 'PlaceController@buyPlace');
	public function buyPlace($id){
		$user = Auth::guard('api')->user();
		$place = Place::find($id);
		return !$place ? response()->json(['error' => 'No contents.'], 204) : $place;
	}
}
