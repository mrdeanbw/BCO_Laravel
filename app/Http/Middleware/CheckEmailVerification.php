<?php

namespace App\Http\Middleware;

use Closure;

class CheckEmailVerification
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
        if ($request->user() && 
                ! $request->user()->email_verified &&                 
                ! $request->user()->is_admin) {

            
            return redirect('member/verify?t=nv');
        }

        return $next($request);
    }
}
