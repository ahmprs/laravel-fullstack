<?php

namespace App\Http\Middleware;
use Closure;
use App\Util as u;

class OnlyAdmin
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
        if(!u::userIsAdmin())
        {
            return response(view('access-denied',['page_title'=>'Access Denied', 'root_url'=>'']));
        }
        return $next($request);
    }
}
