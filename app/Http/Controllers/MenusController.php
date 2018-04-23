<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function index(){
        $menus = Menu::orderBy('created_at', 'DESC')->paginate(3);

        return response()->json([
            'menus' => $menus,
        ]);
    }

    public function store(Request $request){
        app()->setLocale('sr');
        $menu = Menu::create(request()->all());
        request('slug')? $menu->slug = str_slug(request('slug')) : $menu->slug = str_slug(request('title'));
        request('publish')? $menu->publish = true : $menu->publish = false;
        $menu->save();

        return response()->json([
            'menu' => $menu
        ]);
    }

    public function show($id){
        $menu = Menu::find($id);

        return response()->json([
            'menu' => $menu
        ]);
    }

    public function update(Request $request, $id){
        $menu = Menu::find($id);
        $menu->update(request()->all());
        request('slug')? $menu->slug = str_slug(request('slug')) : $menu->slug = str_slug(request('title'));
        request('publish')? $menu->publish = true : $menu->publish = false;
        $menu->update();

        return response()->json([
            'menu' => $menu
        ]);
    }

    public function destroy($id){
        $menu = Menu::find($id);
        Menu::destroy($menu->id);

        return response()->json([
            'message' => 'deleted'
        ]);
    }
}
