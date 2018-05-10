<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMenuLinkRequest;
use App\Http\Requests\UploadImageRequest;
use App\Menu;
use App\MenuLink;
use Illuminate\Http\Request;
use File;

class MenuLinksController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function index(){
        $menu = Menu::find(request('id'));
        $menuLinks = $menu->menuLinks()->with('parent_menu')->orderBy('order', 'ASC')->get();
        return response()->json([
            'menu' => $menu,
            'menuLinks' => $menuLinks
        ]);
    }

    public function store(CreateMenuLinkRequest $request){
        $link = MenuLink::create(request()->except('image'));

        $link->attribute()->sync(request('att_ids'));
        $link->attributes(request('att_ids'));

        if(request('image')){ MenuLink::base64UploadImage($link->id, request('image')); }

        return response()->json([
            'link' => $link
        ]);
    }

    public function show($id){
        $link = MenuLink::find($id);

        return response()->json([
            'link' => $link,
            'att_ids' => $link->attribute()->pluck('attributes.id'),
        ]);
    }

    public function update(CreateMenuLinkRequest $request, $id){
        $link = MenuLink::find($id);
        $link->update(request()->except('image'));

        $link->attribute()->sync(request('att_ids'));
        $link->attributes(request('att_ids'));

        return response()->json([
            'link' => $link,
            'att_ids' => $link->attribute()->pluck('attributes.id'),
        ]);
    }

    public function destroy($id){
        $link = MenuLink::find($id);
        if($link->image) File::delete($link->image);
        $link->delete();

        return response()->json([
            'message' => 'deleted'
        ]);
    }

    public function sort($id){
        $menu = Menu::find($id);
        $links = $menu->menuLinks()->select('id', 'title')->with('children')->where('parent', 0)->orderBy('order', 'ASC')->get();

        return response()->json([
            'menu' => $menu,
            'links' => $links,
        ]);
    }

    public function saveOrder($id){
        $links = request('links');

        MenuLink::orderMenuLinks($links, 0);

        $menu = Menu::find($id);
        $links = $menu->menuLinks()->select('id', 'title')->with('children')->where('parent', 0)->orderBy('order', 'ASC')->get();

        return response()->json([
            'menu' => $menu,
            'links' => $links,
        ]);
    }

    public function lists(){
        $links = MenuLink::where('menu_links.publish', 1)->where('menu_links.parent', 0)->orderBy('menu_links.order', 'ASC')->pluck('menu_links.title', 'menu_links.id')->prepend('Bez nad kategorije', 0);

        return response()->json([
            'links' => $links
        ]);
    }

    public function uploadImage(UploadImageRequest $request, $id){
        $image = MenuLink::base64UploadImage($id, request('file'));

        return response()->json([
            'image' => $image
        ]);
    }
}
