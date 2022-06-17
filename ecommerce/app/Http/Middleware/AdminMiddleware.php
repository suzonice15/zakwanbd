<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use redirect;

class AdminMiddleware
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
        if($this->adminCheck()==false)
        {
            return redirect('/admin');

        }
        return $next($request);
    }
    public  function adminCheck(){
      $admin=Session::get('id');
        if(empty($admin)){
            return false;
        } else {
            return true;
        }
    }
}
