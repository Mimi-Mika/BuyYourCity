<?php

namespace App\Http\Controllers;

use App\Parameter;
use Illuminate\Http\Request;

class ParameterController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parameter = Parameter::all();
        return $parameter;
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
            'perimeter' => 'required|integer',
            'sellPercent' => 'required|integer',
            'seeRadius' => 'required|integer',
        ]);

        try {
            $parameter = new Parameter;
            $parameter->buySell = $request->buySell;
            $parameter->user_id = $request->user_id;
            $parameter->place_id = $request->place_id;
            $parameter->save();
        }
        catch (Exception $e) {
            \Log::info($e);
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Parameter  $parameter
     * @return \Illuminate\Http\Response
     */
    public function show(Parameter $parameter)
    {
        return !$parameter ? response()->json(['error' => 'No contents.'], 204) : $parameter;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Parameter  $parameter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parameter $parameter)
    {
        $request->validate([
            'name' => 'required|string',
            'perimeter' => 'required|integer',
            'sellPercent' => 'required|integer',
            'seeRadius' => 'required|integer',
        ]);

        try {
            $parameter->buySell = $request->buySell;
            $parameter->user_id = $request->user_id;
            $parameter->place_id = $request->place_id;
            $parameter->save();
        }
        catch (Exception $e) {
            \Log::info($e);
        }    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Parameter  $parameter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parameter $parameter)
    {
        //
    }
}
