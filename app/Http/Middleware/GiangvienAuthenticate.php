<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class GiangvienAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = 'giangvien')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect('loginGV');
        }
        return $next($request);
    }
}
