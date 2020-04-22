<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;

class CheckAuth
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
		if($request->session()->has('key')){
			return $next($request);
		}
		else{
			return redirect()->route('unauthorized');
		}
        
    }
}
