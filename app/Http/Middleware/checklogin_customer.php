<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Auth;
use Illuminate\Http\Request;

class checklogin_customer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Session::get('id_customer')&&Session::get('cart')){
            return $next($request);
        }
        elseif(Session::get('id_customer'))
        {
            return redirect()->back(); 
        }
        return redirect()->route('login_checkout');
    }
}
