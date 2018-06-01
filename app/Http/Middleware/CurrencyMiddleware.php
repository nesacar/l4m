<?php

namespace App\Http\Middleware;

use App\Currency;
use Closure;

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
            if(session()->has('currency')){
                $old = session('currency');
                if(strtoupper($old->code) != strtoupper(request('currency'))){
                    $new = Currency::whereCode(strtoupper(request('currency')))->first();
                    if(!empty($new)){
                        session()->forget('currency');
                        session(['currency' => $new]);
                    }
                }
            }else{
                $new = Currency::whereCode(strtoupper(request('currency')))->first();
                if(!empty($new)){
                    session(['currency' => $new]);
                }else{
                    $new = Currency::wherePrimary(1)->first();
                    session(['currency' => $new]);
                }
            }
        }else{
            if(!session()->has('currency')){
                $new = Currency::wherePrimary(1)->first();
                session(['currency' => $new]);
            }
        }
    }
}
