<?php

namespace App\Http\Middleware;

use Closure;

class administrador
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
        if (\Session::get('usuario') -> rol_id != 4)
            return $next($request);
        return redirect('/admin/caja');
    }
}
