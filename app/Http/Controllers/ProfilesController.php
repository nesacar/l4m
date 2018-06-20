<?php

namespace App\Http\Controllers;

use App\Address;
use App\Http\Requests\CreateAddressRequest;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
}
