<?php

namespace App\Http\Controllers;

use App\Box;
use App\Http\Requests\CreateBoxRequest;
use App\Http\Requests\UploadImageRequest;
use Illuminate\Http\Request;
use File;

class BoxesController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boxes = Box::with('Block')->orderBy('boxes.created_at', 'DESC')->paginate(50);

        return response()->json([
            'boxes' => $boxes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBoxRequest $request)
    {
        $box = Box::create(request()->except('image'));
        $box->publish = request('publish')?: false;
        $box->update();

        if(request('image')){ Box::base64UploadImage($box->id, request('image')); }

        return response()->json([
            'box' => $box
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function show(Box $box)
    {
        return response()->json([
            'box' => $box
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function update(CreateBoxRequest $request, Box $box)
    {
        $box->update(request()->except('image'));
        $box->publish = request('publish')?: false;
        $box->update();

        return response()->json([
            'box' => $box
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(Box $box)
    {
        if($box->image) File::delete($box->image);
        $box->delete();

        return response()->json([
            'message' => 'deleted'
        ]);
    }

    /**
     * Upload image
     *
     * @param UploadImageRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(UploadImageRequest $request, $id){
        $image = Box::base64UploadImage($id, request('file'));

        return response()->json([
            'image' => $image
        ]);
    }
}
