<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriberNewsletterRequest;
use App\Subscriber;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{

    public function subscribe(SubscriberNewsletterRequest $request){
        Subscriber::createSubscriber();
        return back()->with('message', 'Uspešno ste se prijavili na našu Newsletter listu');
    }

    public function unSubscribe($verification){

    }
}
