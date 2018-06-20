<?php

namespace App\Http\Middleware;

use App\Setting;
use Closure;
use Session;

class SetPrimaryCategory
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
        if(!\Session::has('primary')){
            \Session::put('primary', 'zene');
            \Session::put('category_id', 5);
        }

        return $next($request);
    }
}
