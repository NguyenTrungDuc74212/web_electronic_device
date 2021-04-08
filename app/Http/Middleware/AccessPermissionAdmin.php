<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Gate;

class AccessPermissionAdmin
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
        if (Gate::denies('admin')) {
            return redirect()->route('trangchuadmin');
        }
        return $next($request); 
    }
}
