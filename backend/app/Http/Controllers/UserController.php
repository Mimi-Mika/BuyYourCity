<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends ApiController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Get(
     *     path="/user",
     *     description="Returns user overview.",
     *     operationId="user.index",
     *     produces={"application/json"},
     *     tags={"user"},
     *     @SWG\Response(
     *         response=200,
     *         description="User overview.",
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="User not found"
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     ),
     *     security={
     *       {"bearerAuth": {}}
     *     }
     * )
     */

    public function index()
    {
        $user = User::all();
        return $user;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/user/create",
     *     description="Return URL to create new user.",
     *     operationId="user.create",
     *     produces={"application/json"},
     *     tags={"user"},
     *     @SWG\Response(
     *         response=200,
     *         description="That's URL to create new user.",
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     ),
     *     security={
     *       {"bearerAuth": {}}
     *     }
     * )
     */
    public function create()
    {
        return response()->json([
            'ulr' => 'http://api.buyyourcity.ovh/register',]
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
        return response()->json([
            'ulr' => 'http://api.buyyourcity.ovh/register',]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     * 
     * @SWG\Get(
     *     path="/user/{petId}",
     *     summary="Find user by ID",
     *     description="Returns a single user",
     *     operationId="show",
     *     tags={"user"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="ID of user to return",
     *         in="path",
     *         name="userId",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(ref="#/definitions/User")
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid ID supplied"
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Pet not found"
     *     ),
     *     security={
     *       {"api_key": {}}
     *     }
     * )
     */
    public function show(User $user)
    {
        return !$user ? response()->json(['error' => 'No contents.'], 204) : $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
