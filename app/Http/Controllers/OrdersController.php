<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Order;
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
        $orders = Order::where('status', '>', 0)->get();

        foreach ($orders as $order) {
            $orderlines[$order->id] = $order->orderlines->toArray();
            $userData[$order->id] = User::findOrFail($order->user_id);
        }

        return view('orders.overview', compact('orders', 'orderlines', 'userData'));
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

        return redirect('bestelling');
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
        
        return redirect('bestelling');
    }

    public function overview(Request $request)
    {
        $orderID = $request->session()->get('order_id');
        $order = Order::findOrFail($orderID)->first();
        $orderLines = $order->orderlines;

        $userData = $order->user;

        foreach ($orderLines as $orderLine) {
            $productInfo[$orderLine->id] = $orderLine->product;
        }

        return view('bestellen.overview', compact('order', 'orderLines', 'productInfo', 'userData'));

    }

    public function confirmed(Request $request)
    {
        $orderID = $request->session()->get('order_id');

        $order = Order::first($orderID);
        if (!count($order)) {
            abort(500);
        } elseif ($order->status != 0) {
            abort(500);
        }

        $order->status = 1;
        $order->save();
        $request->session()->forget('order_id');
        
        return view('bestellen.confirm');

    }
}
