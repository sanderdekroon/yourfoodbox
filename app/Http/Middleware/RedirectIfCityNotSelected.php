<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfCityNotSelected
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
        if (!$request->session()->has('selectedCity')) {
            return redirect('bestellen/markt');
        }

        return $next($request);
    }
}
