<?php

namespace App\Http\Controllers;

use App\User;
use App\Place;
use App\Image;
use App\History;
use Response;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



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
        return User::orderBy('name', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @SWG\Post(
     *     path="/user",
     *     description="Return URL to create new user.",
     *     operationId="user.store",
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'pointsAviable' => 'required|numeric',
            'ban' => 'required|boolean',
            'validEmail' => 'required|boolean',
            'admin' => 'required|boolean',
            'image_id' => 'required|numeric',
        ]);
        //\Log::info($user->id);
        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->pointsAviable = $request->pointsAviable;
            $user->ban = $request->ban;
            $user->validEmail = $request->validEmail;
            $user->admin = $request->admin;
            $user->image_id = $request->image_id;
            $user->save();
        }
        catch (Exception $e) {
            return $e;
            \Log::info($e);
        }
    }

    /**
     * Remove the current resource from storage. 
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {   
        try {
            $places = Place::where('user_id', $user->id);

            if ($places->count() > 0) {
                foreach ($places as $key => $place) {
                    $user->pointsAviable += $place->pointsCost;
                    $place->user_id = NULL;
                    $place->save();
                }
            }
            $user->api_token = NULL;
            $user->delete();
            $user->save();
        } catch (Exception $e) {
            \Log::info($e);
            return response()->json(['error' => $e], 404);
        }
        return response()->json(['ok' => 'User soft deleted.'], 200);
    }

    /**
     * Restore the current resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function restore(User $user)
    {
        try {
            $user->deleted_at = NULL;
            $user->save();
        } catch (Exception $e) {
            \Log::info($e);
            return response()->json(['error' => $e], 404);
        }
        return response()->json(['ok' => 'User restored.'], 200);
    }

    /**
     * Display all places from current user.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function showPlaces(User $user) {
        return Place::where('user_id', $user->id)->get()->isEmpty() ? response()->json(['error' => 'No contents.'], 204) : Place::where('user_id', $user->id)->get();
    }

    /**
     * Return current user infos with  token.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function refresh(Request $request) {
        $user = Auth::guard('api')->user();
        if ($user->get()->isEmpty()) { \Log::info('KO'); }
        else { return $user; }
        //return Auth::guard('api')->user()->get()->isEmpty() ? response()->json(['error' => 'No contents.'], 204) : Auth::guard('api')->user();
    }

    public function showImage(User $user) {
        
        $image = Image::where('id', $user->image_id)->get()->first();

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

    public function ranking(){
        return User::orderBy('pointsAviable', 'desc')->get();
    }

    public function showHistory(User $user) {
        return History::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
    }

    public function changePassword(Request $request) {
        $user = Auth::guard('api')->user();
        
        \Log::info($user->name);
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);
        try {
            $user->password = bcrypt($request->password);
            $user->save();
        } catch (Exception $e) {
            \Log::info($e);
        }
    }

    public function redirectToFrontend() {
        $url = 'http://google.com';
        // redirects to http://google.com
        return redirect('http://www.buyyourcity.ovh');

        //return redirect('http://www.api.buyyourcity.ovh');
    }

    public function countTotal() {
        return User::all()->count();
    }

    public function countBan() {
        return User::where('ban', 1)->count();
    }

    public function countPlaying() {
        return User::where('ban', 0)->count();
    }
}