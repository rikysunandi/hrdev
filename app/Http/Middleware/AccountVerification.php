<?php

namespace App\Http\Middleware;

use Closure;

class AccountVerification
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
        if($request->url() != route('set.password') && $request->url() != route('login'))
        {
            if($request->user()->email_verified_at == NULL)
            {
                return redirect('/setPassword');
            }
        }

        return $next($request);
    }
}
