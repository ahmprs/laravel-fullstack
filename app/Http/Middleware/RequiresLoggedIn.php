<?php

namespace App\Http\Middleware;
use Session;
use App\Util as au;
use Closure;

class RequiresLoggedIn
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
        if ($user_id==''){
            return au::resp(0,[
                'err'=>'user is not logged in',
                'hint'=>'please login first',
            ]);
        }

        return $next($request);
        
    }
}
