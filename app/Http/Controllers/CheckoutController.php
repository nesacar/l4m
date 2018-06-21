<?php

namespace App\Http\Controllers;

use App\Customer;
use App\MenuLink;
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

    public function step1(){
        $customer = Customer::checkCustomer();
        $menu = MenuLink::getMenu();
        return view('themes.' . $this->theme . '.pages.checkout.address', compact('menu', 'customer'));
    }

    public function step1Update(Request $request){
        session(['address_id' => 'id']);
        return redirect('placanje/nacin-slanja')->with('message', 'Uspešno je odabrana adresa');
    }

    public function step2(){
        $menu = MenuLink::getMenu();
        return view('themes.' . $this->theme . '.pages.checkout.shipping', compact('menu'));
    }

    public function step3(){
        $menu = MenuLink::getMenu();
        return view('themes.' . $this->theme . '.pages.checkout.payment', compact('menu'));
    }

    public function step4(){
        $menu = MenuLink::getMenu();
        return view('themes.' . $this->theme . '.pages.checkout.confirmation', compact('menu'));
    }

    public function step5(){
        $menu = MenuLink::getMenu();
        return view('themes.' . $this->theme . '.pages.checkout.checkout', compact('menu'));
    }
}
