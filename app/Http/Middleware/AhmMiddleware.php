<?php

namespace App\Http\Middleware;
use App\AhmUtil as au;
use Closure;

class AhmMiddleware
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
        // This logic is written for a 
        // simple test and has to be 
        // removed in a real application.
        if (au::getSession('id')==''){
            au::setSession('id', 1);
            return au::respAccessDenied();
        }else {
            au::setSession('id', '');
            return $next($request);
        }
    }
}
