<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthOrigin
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
            if ($request->user()->level==1||$request->user()->level==2){
                return $next($request);
            }
        }
        return abort(401,'This action is unauthorized.');


    }
}
