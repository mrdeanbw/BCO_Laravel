<?php

namespace App\Http\Middleware;

use Closure;

class CheckSubscription
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
                ! $request->user()->subscribed('main') && 
                ! $request->user()->onTrial() &&
                ! $request->user()->is_admin) {

            // This user is not a paying customer or an admin...
            return redirect('subscriptions/choose');
        }

        return $next($request);
    }
}
