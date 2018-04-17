<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateThemeRequest;
use App\Theme;
use Illuminate\Http\Request;

class ThemesController extends Controller
{
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
        $theme->slug = str_slug($request->input('title'));
        $theme->publish = request('publish')? true : false;
        $theme->active = request('active')? true : false;
        $theme->update();

        return response()->json([
            'message' => 'done'
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
        $theme->title = request('title');
        $theme->slug = str_slug(request('title'));
        $theme->version = request('version');
        $theme->author = request('author');
        $theme->author_address = request('author_address');
        $theme->author_email = request('author_email');
        $theme->developer = request('developer');
        $theme->publish = request('publish')? true : false;
        $theme->active = request('active')? true : false;

        if(request('image')){
            self::base64UploadImage($theme, request('image'));
        }
        $theme->update();

        return response()->json([
            'message' => 'done'
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
        $image = Theme::base64UploadImage($theme, request('image'));

        return response()->json([
            'image' => $image
        ]);
    }
}
