<?php

namespace App\Http\Controllers;

use App\Image;
use Response;

use Illuminate\Http\Request;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Image::All();
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
            'path' => 'required|string',
            'description' => 'required|string',
        ]);

        try {
            $image = new Image;
            $image->path = $request->path;
            $image->description = $request->description;
            $image->save();
        }
        catch (Exception $e) {
            \Log::info($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        return !$image ? response()->json(['error' => 'No contents.'], 204) : $image;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Image $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        $request->validate([
            'image_path' => 'required|string',
            'description' => 'required|string',
        ]);

        try {
            $image->image_path = $request->image_path;
            $image->description = $request->description;
            $image->save();
        }
        catch (Exception $e) {
            \Log::info($e);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getData(Image $image) {
        $path = '/var/www/html/BuyYourCity/backend/storage/app/public/' . $image->image_path;
        \Log::info($path);
        if(!file_exists($path)) {
            abort(404);
        }
        $type = mime_content_type($path);
        $content = file_get_contents($path);
        return response($content, 200)->header('Content-Type', $type);
    }

    public function upload (Request $request) {
        
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'string',
        ]);

        $imageName = time().'.'.$request->image->getClientOriginalExtension();
 
        $request->image->move('/var/www/html/BuyYourCity/backend/storage/app/public/', $imageName);

        try {
            $image = new Image;
            $image->image_path = $imageName;
            $image->description = $request->type;
            $image->save();
        }
        catch (Exception $e) {
            \Log::info($e);
            return $e;
        }
        return $image;
    }

    public function getUserImages() {
        return Image::where('description', 'user')->get();
    }


    public function getPlaceImages() {
        return Image::where('description', 'place')->get();
    }

}
