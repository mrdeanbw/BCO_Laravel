<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminVerification
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
                ! $request->user()->admin_verifier &&                 
                ! $request->user()->is_admin) {

            
            return redirect('members');
        }
        return $next($request);
    }
}
