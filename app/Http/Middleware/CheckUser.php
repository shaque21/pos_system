<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUser
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
        if(isset(auth()->user()->role_id)){
            if(auth()->user()->role_id != 1){
                return redirect('/admin/orders');
            }
        }
        return $next($request);
    }
}
