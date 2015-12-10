<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\User;
use App\Order;
use App\Orderline;

class VerifyOrder
{

    /**
     * Merge the orders of a guest with an existing user order
     * @param  [type] $orderID   [description]
     * @param  [type] $sessionID [description]
     * @return bool
     */
    public function mergeOrders($orderID, $sessionID, $request)
    {
        $sessionOrder = Order::findOrFail($sessionID);
        $sessionOrderLines = $sessionOrder->orderlines()->get();

        foreach ($sessionOrderLines as $sessionOrderLine) {
            $sessionOrderLine->order_id = $orderID;
            $sessionOrderLine->save();
        }

        $guest = User::find($sessionOrder->user_id);
        $guest->delete();
        $sessionOrder->delete();

        $request->session()->put('order_id', $orderID);

        return true;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->has('order_id')) {
            $guest = new User();
            $guest->is_guest = true;
            $guest->name = 'Gast';

            if ($guest->save()) {
                $guestOrder = Order::create([
                    'user_id' => $guest->id,
                    'status' => 0,
                    'city_id' => $request->session()->get('selectedCity')['id']
                ]);

                $request->session()->put('user_id', $guest->id);
                $request->session()->put('order_id', $guestOrder->id);
            } else {
                abort(500);
            }

        } elseif (Auth::check()) {
            $databaseOrderID = Order::where('user_id', '=', Auth::id())->first();
            $sessionOrderID = $request->session()->get('order_id');

            if (!count($databaseOrderID)) {
                $userOrder = Order::create([
                    'user_id' => Auth::id(),
                    'status' => 0,
                    'city_id' => $request->session()->get('selectedCity')['id']
                ]);

                $this->mergeOrders($userOrder->id, $sessionOrderID, $request);
            }

            $databaseOrderID = Order::where('user_id', '=', Auth::id())->first();

            if ($databaseOrderID->id != $sessionOrderID) {
                $this->mergeOrders($databaseOrderID, $sessionOrderID, $request);
            }
        }

        return $next($request);
    }
}
