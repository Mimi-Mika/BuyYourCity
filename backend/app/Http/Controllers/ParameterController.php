<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parameter;

class ParameterController extends Controller
{
	protected function getParameter($id){
		\Log::info($id);
		$parameter = Parameter::find($id);
		return !$parameter ? response()->json(['error' => 'No contents.'], 204) : $parameter;
	}
}
