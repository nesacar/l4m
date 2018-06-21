<?php

namespace App\Http\Controllers;

use App\Address;
use App\Customer;
use App\MenuLink;
use App\ShoppingCart;
use App\Theme;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * @var Theme
     */
    private $theme;

    public function __construct()
    {
        $this->middleware('auth');
        $this->theme = Theme::getTheme();
    }

    /**
     * Checkout step1 "adresa slanja"
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function step1(){
        $customer = Customer::checkCustomer();
        $menu = MenuLink::getMenu();
        return view('themes.' . $this->theme . '.pages.checkout.address', compact('menu', 'customer'));
    }

    /**
     * Checkout step1 update "adresa slanja"
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function step1Update(Request $request){
        session(['address' => request('address')]);
        return redirect('placanje/nacin-slanja')->with('message', 'Uspešno je odabrana adresa');
    }

    /**
     * Checkout step2 "način slanja"
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function step2(){
        $menu = MenuLink::getMenu();
        return view('themes.' . $this->theme . '.pages.checkout.shipping', compact('menu'));
    }

    /**
     * Checkout step2 update "način slanja"
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function step2Update(Request $request){
        session(['shipping' => request('shipping')]);
        return redirect('placanje/nacin-placanja')->with('message', 'Uspešno je odabran način slanja');
    }

    /**
     * Checkout step3 "način plaćanja"
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function step3(){
        $menu = MenuLink::getMenu();
        return view('themes.' . $this->theme . '.pages.checkout.payment', compact('menu'));
    }

    /**
     * Checkout step3 update "način plaćanja"
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function step3Update(){
        session(['payment' => request('payment')]);
        return redirect('placanje/potvrda-porudzbine')->with('message', 'Uspešno je odabran način plaćanja');
    }

    /**
     * Checkout step4 "potvrda porudžbine"
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function step4(){
        $menu = MenuLink::getMenu();
        $address = Address::find(session('address'));
        $cart = \Cart::content();
        return view('themes.' . $this->theme . '.pages.checkout.confirmation', compact('menu', 'address', 'cart'));
    }

    /**
     * Checkout step4 update "potvrda porudžbine"
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function step4Update(){
        ShoppingCart::store();
        return redirect('placanje/kraj')->with('message', 'Kupovina je uspešno završena');
    }

    public function step5(){
        $menu = MenuLink::getMenu();
        return view('themes.' . $this->theme . '.pages.checkout.checkout', compact('menu'));
    }
}
