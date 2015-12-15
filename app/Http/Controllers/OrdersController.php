<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Order;
use App\Orderline;
use App\Product;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.moderator', ['only' => ['index'] ]);
        $this->middleware('select.city');
    }
    /**
     * Return all orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //@to-do add city limitation
        $orders = Order::where('status_id', '!=', 1)->get();

        foreach ($orders as $order) {
            $orderlines[$order->id] = $order->orderlines->toArray();
            $userData[$order->id] = User::findOrFail($order->user_id);
            $statusData[$order->id] = $order->status->toArray();
            $cityData[$order->id] = $order->city->toArray();
        }

        $productData = Product::where('week_no', date('W'))->get();

        return view('orders.overview', compact('orders', 'orderlines', 'userData', 'statusData', 'cityData', 'productData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $user = Auth::user();
        $order = $user->orders()->where('status_id', 1)->firstOrFail();
        
        Orderline::create([
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
        $user = Auth::user();
        $order = $user->orders()->where('status_id', 1)->firstOrFail();
        $orderLine = $order->orderlines()->where('product_id', $request->input('product_id'))->first();

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
        $user = Auth::user();
        $order = $user->orders()->where('status_id', 1)->firstOrFail();
        $orderLines = $order->orderlines;

        $userData = $order->user;

        foreach ($orderLines as $orderLine) {
            $productInfo[$orderLine->id] = $orderLine->product;
        }

        return view('bestellen.overview', compact('order', 'orderLines', 'productInfo', 'userData'));

    }

    public function confirmed(Request $request)
    {
        $user = Auth::user();
        $order = $user->orders()->where('status_id', 1)->firstOrFail();

        $order->status_id = 2;
        $order->save();
        
        return view('bestellen.confirm');

    }
}
