<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMenuLinkRequest;
use App\Menu;
use App\MenuLink;
use Illuminate\Http\Request;

class MenuLinksController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function index(){
        app()->setLocale('sr');
        $menu = Menu::find(request('id'));
        $menuLinks = $menu->menuLinks()->orderBy('order', 'ASC')->get();
        return response()->json([
            'menu' => $menu,
            'menuLinks' => $menuLinks
        ]);
    }

    public function store(CreateMenuLinkRequest $request){
        app()->setLocale('sr');
        $link = new MenuLink();
        $link->menu_id = request('menu_id');
        $link->title = request('title');
        $link->link = request('link');
        $link->desc = request('desc');
        $link->sufix = request('sufix');
        request('publish')? $link->publish = 1 : $link->publish = 0;
        $link->save();

        return response()->json([
            'link' => $link
        ]);
    }

    public function show($id){
        request('locale')? $locale = request('locale') : $locale = 'sr';
        app()->setLocale($locale);
        $link = MenuLink::find($id);

        return response()->json([
            'link' => $link
        ]);
    }

    public function update(CreateMenuLinkRequest $request, $id){
        $link = MenuLink::find($id);
        $link->title = request('title');
        $link->link = request('link');
        $link->desc = request('desc');
        $link->sufix = request('sufix');
        $link->parent = request('parent');
        $link->order = request('order');
        $link->parent == 0? $link->level = 1 : $link->level = 2;
        $link->publish = request('publish')? 1 : 0;
        $link->update();

        return response()->json([
            'link' => $link
        ]);
    }

    public function destroy($id){
        MenuLink::destroy($id);

        return response()->json([
            'message' => 'deleted'
        ]);
    }

    public function sort($id){
        $menu = Menu::find($id);
        $links = $menu->menuLinks()->where('parent', 0)->orderBy('order', 'ASC')->get();
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
}
