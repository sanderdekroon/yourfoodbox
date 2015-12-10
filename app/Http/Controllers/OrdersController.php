<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Order;
use Carbon\Carbon;
use App\Orderline;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['index'] ]);
        $this->middleware('auth.moderator', ['only' => ['index'] ]);
    }
    /**
     * Return all orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->get();

        foreach ($orders as $order) {
            $orderlines[$order->id] = $order->orderlines->toArray();
        }

        return view('orders.overview', compact('orders', 'orderlines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $order = Order::findOrFail($request->session()->get('order_id'));
        $d = Orderline::create([
            'order_id' => $order->id,
            'product_id' => $request->input('product_id'),
            'amount' => $request->input('amount')
        ]);

        return redirect('bestellen');
                
    }

    /**
     * Update an existing orderline
     *
     * @param  OrderRequest $request The HTTP request
     * @return response
     */
    public function update(OrderRequest $request)
    {
        $orderLine = Orderline::where('order_id', '=', $request->session()->get('order_id'))
                                ->where('product_id', '=', $request->input('product_id'))
                                ->first();

        if (!$orderLine->count()) {
            abort(500);
        }

        $orderLine->amount = $request->input('amount');
        if (!$orderLine->save()) {
            abort(500);
        }
        
        return redirect('bestellen');
                
    }
}
