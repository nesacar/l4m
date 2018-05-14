<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateThemeRequest;
use App\Theme;
use Illuminate\Http\Request;
use File;

class ThemesController extends Controller
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
        $themes = Theme::select('*')->orderBy('created_at', 'DESC')->paginate(3);

        return response()->json([
            'themes' => $themes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateThemeRequest $request)
    {
        $theme = Theme::create($request->all());

        return response()->json([
            'theme' => $theme,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function show(Theme $theme)
    {
        return response()->json([
            'theme' => $theme
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function update(CreateThemeRequest $request, Theme $theme)
    {
        $theme->update(request()->all());

        return response()->json([
            'theme' => $theme,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theme $theme)
    {
        if(!empty($theme->image)) File::delete($theme->image);
        Theme::destroy($theme->id);

        return response()->json([
            'message' => 'deleted'
        ]);
    }

    public function uploadImage($id){
        $theme = Theme::find($id);
        $theme->update(['image' => $theme->storeImage('file')]);

        return response()->json([
            'image' => $theme->image,
        ]);
    }
}
