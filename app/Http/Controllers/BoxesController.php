<?php

namespace App\Http\Controllers;

use App\Box;
use App\Http\Requests\CreateBlockRequest;
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
        $boxes = Box::select('boxes.id', 'boxes.title', 'boxes.publish', 'boxes.created_at')->with('Block')->orderBy('boxes.created_at', 'DESC')->paginate(50);

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
    public function store(CreateBlockRequest $request)
    {
        $box = Box::create(request()->all());
        $box->slug = request('slug')?: request('title');
        $box->publish = request('publish')?: false;
        $box->update();

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
    public function update(CreateBlockRequest $request, Box $box)
    {
        $box->update(request()->all());
        $box->slug = request('slug')?: request('title');
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
}
