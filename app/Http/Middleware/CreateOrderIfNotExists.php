<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Order;

class CreateOrderIfNotExists
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
        $user = Auth::user();
        $selectedCity = $request->session()->get('selectedCity');
        $order = $user->orders()->where('status_id', 1)->get();

        if (!count($order)) {
            Order::create([
                'user_id' => $user->id,
                'status_id' => 1,
                'city_id' => $selectedCity['id']
            ]);
        }

        return $next($request);
    }
}
