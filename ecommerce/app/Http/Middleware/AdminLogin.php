<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class AdminLogin
{

    public function handle($request, Closure $next)
    {
        if(Session::get('id')==null){
            redirect('/admin');
        }
        return $next($request);
    }
}
