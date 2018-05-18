<?php

namespace App\Http\Controllers;

use App\Product;
use App\ShoppingCart;
use App\ShoppingCartOld;
use App\Theme;
use Illuminate\Http\Request;
use Session;

class CartsController extends Controller
{
    protected $theme;
    protected $settings;

    public function __construct()
    {
        $this->theme = Theme::getTheme();
        //$this->middleware('auth')->only('store');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        //return \Cart::content();
        return view('themes.' . $this->theme . '.pages.cart');
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function add($id){
        $product = Product::withoutGlobalScope('attribute')->find($id);
        if(self::isExists($product) == false){
            $price = (float) $product->totalPrice;
            \Cart::add(['id' => $product->id, 'name' => $product->title, 'qty' => 1, 'price' => $price]);

            return response([
                'message' => 'added'
            ], 200);
        }
        return response([
            'message' => 'already exist'
        ], 422);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function remove($id){
        $product = Product::withoutGlobalScope('attribute')->find($id);
        if(!empty(\Cart::content())){
            foreach(\Cart::content() as $item){
                if($product->id == $item->id){
                    \Cart::remove($item->rowId);
                }
            }
        }

        return response([
            'message' => 'removed'
        ], 200);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(){
        $res = ShoppingCart::store();
        return redirect('/')->with('message', 'Korpa je sačuvana');
    }

    /**
     * @param $product
     * @return mixed
     */
    protected static function isExists($product){
        return \Cart::content()->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });
    }
}
