<?php

namespace App\Http\Middleware;
use Closure;
use App\Util as u;

class RequitesBeingAdmin
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
            return u::resp(0, [
                "err"=>"Access Denied",
                "hint"=>"Sign in as a promoted user"
            ]);
        }
        return $next($request);
    }
}
