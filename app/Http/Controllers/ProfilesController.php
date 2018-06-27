<?php

namespace App\Http\Controllers;

use App\Address;
use App\Customer;
use App\Http\Requests\CreateAddressRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['emailConfirmation']);
    }

    public function profile(){
        return 'profil';
    }

    public function createAddress(CreateAddressRequest $request){
        $array = request()->all();
        $array['customer_id'] = auth()->user()->customer->id;
        Address::create($array);
        return redirect('placanje/adresa-slanja');
    }

    public function emailConfirmation($slug){
        $customer = Customer::where('activation', $slug)->first();
        $customer->update(['active' => 1]);

        auth()->loginUsingId($customer->user->id, true);

        return redirect('profile');
    }
}
