<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;

class UserController extends Controller
{
    protected function getUser($id){
    	\Log::info($id);
    	//$user = User::get(['id', 'name', ])->where('id',$id);
    	$user = User::select('id', 'name')->find($id);
    	return !$user ? response()->json(['error' => 'No contents.'], 204) : $user;
    }
}