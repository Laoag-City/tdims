<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfAdminIsUsed
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
        if($request->route()->parameter('user')->is_admin)
            return back();

        return $next($request);
    }
}
