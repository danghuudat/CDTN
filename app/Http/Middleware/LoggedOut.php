<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class LoggedOut
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
        if (Auth::check()){
            if (Auth::user()->level==1 || Auth::user()->level==2){
                return redirect('admin');
            }else{
                return redirect('/');
            }

        };
        return $next($request);
    }
}
