<?php

namespace App\Http\Middleware;
use Session;
use App\Util as au;
use Closure;

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
        $user_id = Session::get('user_id','');
        $user_access_level = Session::get('user_id','');

        if ($user_id==''){
            return au::resp(0,[
                'err'=>'user is not logged in',
                'hint'=>'please login first',
            ]);
        }

        if ($user_access_level==''){
            return au::resp(0,[
                'err'=>'user is not logged in',
                'hint'=>'please login first',
            ]);
        }

        if ($user_access_level != '100'){
            return au::resp(0,[
                'err'=>'user is not logged in as admin',
                'hint'=>'please login as admin first',
            ]);
        }
        return $next($request);
    }
}
