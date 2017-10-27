<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\History;

class HistoryController extends Controller
{
	protected function getHistory($id){
		\Log::info($id);
		$history = History::find($id);
		return !$history ? response()->json(['error' => 'No contents.'], 204) : $history;
	}
}
