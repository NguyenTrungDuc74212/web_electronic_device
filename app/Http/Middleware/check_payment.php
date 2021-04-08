<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use Cart;

class check_payment
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
        if (Session::get('id_customer')&&Session::get('id_shipping')) {
            return $next($request);
        }
        elseif(Session::get('id_customer')&&Session::get('cart'))
        {
           return redirect()->route('view_checkout');
        }
        return redirect()->route('trangchu');
    }
}
