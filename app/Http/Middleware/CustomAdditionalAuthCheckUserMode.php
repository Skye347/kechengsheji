<?php

namespace App\Http\Middleware;

use JWTAuth;
use Closure;
use Illuminate\Support\Facades\Auth;

class CustomAdditionalAuthCheckUserMode
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
        if(Auth::Check()){
            return $next($request);
        }
        else{
            return redirect('/auth/login');
        }
    }
}
