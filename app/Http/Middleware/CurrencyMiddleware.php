<?php

namespace App\Http\Middleware;

use App\Currency;
use Closure;
use Illuminate\Support\Str;
use Session;

class CurrencyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->checkRequest();

        return $next($request);
    }

    private function checkRequest(){
        if(request('currency')){
            if(Session::has('currency')){
                $old = Session::get('currency');
                if(Str::upper($old->code) != Str::upper(request('currency'))){
                    $new = Currency::whereCode(Str::upper(request('currency')))->first();
                    if(!empty($new)){
                        Session::forget('currency');
                        Session::put('currency', $new);
                    }
                }
            }else{
                $new = Currency::whereCode(Str::upper(request('currency')))->first();
                if(!empty($new)){
                    Session::put('currency', $new);
                }else{
                    $new = Currency::wherePrimary(1)->first();
                    Session::put('currency', $new);
                }
            }
        }else{
            if(!Session::has('currency')){
                $new = Currency::wherePrimary(1)->first();
                Session::put('currency', $new);
            }
        }
    }
}
