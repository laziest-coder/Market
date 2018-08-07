<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class CheckUserRole
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
        if(Auth::user()->role == 'seller'){
          return redirect('/vendor/orders');
        }elseif (Auth::user()->role == 'customer') {
          return redirect('/customer/orders');
        }
        return $next($request);
    }
}
