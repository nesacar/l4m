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
        $links = $menu->menuLinks()->with(['children' => function($query){
            $query->select('id', 'title as text');
        }])->where('parent', 0)->select('id', 'title as text')->orderBy('order', 'ASC')->get();
        $last = MenuLink::orderBy('order', 'ASC')->first();
        if(empty($last)){
            $id = 1;
        }else{
            $id = $last->id + 1;
        }

        return response()->json([
            'menu' => $menu,
            'links' => $links,
            'lastId' => $id
        ]);
    }

    public function saveOrder($id){
        app()->setLocale('en');
        $menu = Menu::find($id);
        if(!empty(request('links'))){
            foreach (request('links') as $link){
                $old = MenuLink::find($link['id']);
                if(empty($old)){
                    $new = new MenuLink();
                    $new->menu_id = $id;
                    $new->type = 0;
                    $new->order = $link['order'];
                    $new->title = $link['title'];
                    $new->save();
                }else{
                    $old->order = $link['order'];
                    $old->update();
                }
            }
        }

        $links = $menu->menuLinks()->orderBy('order', 'ASC')->get();
        $last = MenuLink::orderBy('order', 'ASC')->first();
        if(empty($last)){
            $id = 1;
        }else{
            $id = $last->id + 1;
        }

        return response()->json([
            'menu' => $menu,
            'links' => $links,
            'lastId' => $id
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
