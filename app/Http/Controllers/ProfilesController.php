<?php

namespace App\Http\Controllers;

use App\Address;
use App\Customer;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateAddressRequest;
use App\MenuLink;
use App\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilesController extends Controller
{
    public $theme;

    public function __construct()
    {
        $this->middleware('auth')->except(['emailConfirmation']);
        $this->theme = Theme::getTheme();
    }

    /**
     * method used to show customer profile page with two forms for change password and address
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function profile(){
        $customer = Customer::where('user_id', auth()->id())->first();
        if(empty($customer)) return redirect('/');
        $address = Address::where('customer_id', $customer->id)->first();
        $menu = MenuLink::getMenu();
        return view('themes.'.$this->theme.'.pages.user.profile', compact('customer', 'address', 'menu'));
    }


    /**
     * method used to create new address
     *
     * @param CreateAddressRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createAddress(CreateAddressRequest $request){
        $array = request()->all();
        $array['customer_id'] = auth()->user()->customer->id;
        Address::create($array);
        if(request('profile')){
            return redirect('profile')->with('message', 'Adresa je uspešno kreirana');
        }else{
            return redirect('placanje/adresa-slanja');
        }
    }

    /**
     * method used to edit customer address
     *
     * @param CreateAddressRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editAddress(CreateAddressRequest $request, $id){
        $address = Address::find($id);
        $customer = Customer::where('user_id', auth()->id())->first();
        if($address->customer_id != $customer->id) return redirect('profile');
        $address->update(request()->all());
        return redirect('profile')->with('message', 'Adresa je uspešno izmenjena');
    }

    /**
     * method used to confirm registration from email
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function emailConfirmation($slug){
        $customer = Customer::where('activation', $slug)->first();
        $customer->update(['active' => 1]);

        auth()->loginUsingId($customer->user->id, true);

        return redirect('profile');
    }

    /**
     * method used to change customer profile password
     *
     * @param ChangePasswordRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function changePassword(ChangePasswordRequest $request){
        if (!Hash::check(request('old_password'), auth()->user()->password)) {
            return back()->withErrors(array('old_password' => 'Pogrešno ste uneli staru lozinku'));
        }
        auth()->user()->update(['password' => Hash::make(request('password'))]);
        return back()->with('message', 'Lozinka je uspešno promenjena');
    }
}
