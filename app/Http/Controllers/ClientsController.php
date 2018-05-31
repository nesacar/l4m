<?php

namespace App\Http\Controllers;

use App\Category;
use App\Client;
use App\Product;
use App\Seo;
use App\Set;
use App\Theme;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    protected $theme;

    public function __construct(){
        $this->theme = Theme::getTheme();
    }

    /**
     * Return client homepage
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home($slug){
        $client = Client::with(['brand' => function($query){
            $query->where('logo', '<>', null);
        }])->where('slug', $slug)->first();

        if(empty($client)) return redirect('/');

        $products = $client->product()->withoutGlobalScope('attribute')->where('products.discount', '>', 0)->published()->take(4)->get();
        $posts = $client->post()->published()->take(3)->get();
        $template = 'home';
        return view('themes.' . $this->theme . '.pages.client.home', compact('client', 'products', 'posts', 'template'));
    }

    /**
     * Return client about page
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about($slug){
        $client = Client::with(['brand' => function($query){
            $query->where('logo', '<>', null);
        }])->where('slug', $slug)->first();
        $posts = $client->post()->published()->take(3)->get();
        $template = 'about';
        return view('themes.' . $this->theme . '.pages.client.about', compact('client', 'posts', 'template'));
    }

    /**
     * Return all products from client
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\V+iew
     */
    public function shop($slug){
        $client = Client::where('slug', $slug)->first();
        $category = $client->category->first();
        $data = Product::search($category, false, $client);
        Seo::shopCategory($category);
        $properties = Set::getProperties($category->set);
        $breadcrumb = $client->getBreadcrumb();
        $template = 'shop';
        return view('themes.' . $this->theme . '.pages.client.shop', compact('client', 'category', 'data', 'properties', 'breadcrumb', 'template'));
    }

    /**
     * Return all products from client with discount
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function action($slug){
        $client = Client::where('slug', $slug)->first();
        $category = $client->category->first();
        $data = Product::search($category, false, $client, true);
        Seo::shopCategory($category);
        $properties = Set::getProperties($category->set);
        $breadcrumb = $client->getBreadcrumb();
        $template = 'action';
        return view('themes.' . $this->theme . '.pages.client.shop', compact('client', 'category', 'data', 'properties', 'breadcrumb', 'template'));
    }

    public function blog($slug){
        $client = Client::where('slug', $slug)->first();
        //Seo::shopCategory($category);
        $posts = $client->post()->published()->paginate(9);
        $breadcrumb = $client->getBreadcrumb();
        $template = 'blog';
        return view('themes.' . $this->theme . '.pages.client.blog', compact('client', 'posts', 'breadcrumb', 'template'));
    }
}
