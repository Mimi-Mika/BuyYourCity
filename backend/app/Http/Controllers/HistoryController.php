<?php

namespace App\Http\Controllers;

use App\History;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HistoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $history = History::all();
        return $history;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'buySell' => 'STRING : buy or sell',
            'user_id' => 'INT : user id',
            'place_id' => 'INT : place id',]
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
            'buySell' => 'required|string',
            'user_id' => 'required|integer|exists:users,id',
            'place_id' => 'required|integer|exists:places,id',
        ]);

        try {
            $history = new History;
            $history->buySell = $request->buySell;
            $history->user_id = $request->user_id;
            $history->place_id = $request->place_id;
            $history->save();
        }
        catch (Exception $e) {
            \Log::info($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\History  $history
     * @return \Illuminate\Http\Response
     */
    public function show(History $history)
    {
        //return $history;
        return !$history ? response()->json(['error' => 'No contents.'], 204) : $history;

    }


//GET : /history/sell/day
    public function sellLastDay() {
        return History::where('buySell', 'sell')->where('created_at', '>=', Carbon::today())->get()->count();
    }
//GET : /history/sell/week
    public function sellLastWeek() {
        return History::where('buySell', 'sell')->where('created_at', '>=', Carbon::now()->startOfWeek())->get()->count();
    }
//GET : /history/sell/month
    public function sellLastMonth() {
        return History::where('buySell', 'sell')->where('created_at', '>=', Carbon::now()->startOfMonth())->get()->count();
    }
//GET : /history/sell/year
    public function sellLastYear() {
        return History::where('buySell', 'sell')->where('created_at', '>=', Carbon::now()->startOfYear())->get()->count();
    }


//GET : /history/buy/day
    public function buyLastDay() {
        return History::where('buySell', 'buy')->where('created_at', '>=', Carbon::today())->get()->count();
    }
//GET : /history/buy/week
    public function buyLastWeek() {
        return History::where('buySell', 'buy')->where('created_at', '>=', Carbon::now()->startOfWeek())->get()->count();
    }
//GET : /history/buy/month
    public function buyLastMonth() {
        return History::where('buySell', 'buy')->where('created_at', '>=', Carbon::now()->startOfMonth())->get()->count();
    }
//GET : /history/buy/year
    public function buyLastYear() {
        return History::where('buySell', 'buy')->where('created_at', '>=', Carbon::now()->startOfYear())->get()->count();
    }


}
