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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

        if(!file_exists($path)) {
            abort(404);
        }
        $type = mime_content_type($path);
        $content = file_get_contents($path);
        return response($content, 200)->header('Content-Type', $type);
    }
}
