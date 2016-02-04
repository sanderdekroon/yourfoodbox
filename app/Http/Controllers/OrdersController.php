<?php

namespace App\Http\Controllers;

use Mail;
use Auth;
use App\User;
use App\Order;
use App\Status;
use Carbon\Carbon;
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
        $this->middleware('auth.moderator', ['only' => ['index', 'updateStatus'] ]);
        $this->middleware('select.city');
        $this->middleware('check.order', ['except' => ['confirmed']]);
    }

    /**
     * Return all orders and add option to change status or order.
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
            $cityData[$order->id] = $order->city->toArray();
        }

        $statusData = Status::all();
        $productData = Product::where('week_no', date('W'))->get();

        return view('manager.overview', compact('orders', 'orderlines', 'userData', 'statusData', 'cityData', 'productData'));
    }

    /**
     * Store a newly created order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $user = Auth::user();
        $order = $user->orders()->where('status_id', 1)->firstOrFail();
        $orderLine = $order->orderlines()->where('product_id', $request->input('product_id'))->first();
        if (count($orderLine)) {
            $orderLine->amount = $request->input('amount');
            $orderLine->save();
        } else {
            Orderline::create([
                'order_id' => $order->id,
                'product_id' => $request->input('product_id'),
                'amount' => $request->input('amount')
            ]);
        }
        
        $data = [
            'succes' => true,
            'product_id' => $request->input('product_id'),
            'amount' => $request->input('amount'),
            'order_id' => $order->id
        ];

        return response()->json($data);
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

    /**
     * Generate an order overview for the user
     * @param  Request $request The incomming request
     * @return response
     */
    public function overview(Request $request)
    {
        $user = Auth::user();
        $order = $user->orders()->where('status_id', 1)->firstOrFail();
        $orderLines = $order->orderlines;
        $city = $order->city;

        $currentDate = Carbon::now();
        $monday = $currentDate->startOfWeek();
        $openingDayDate = $monday->addDays($city->openingDay-1)->format('l d F');

        $userData = $order->user;

        foreach ($orderLines as $orderLine) {
            $productInfo[$orderLine->id] = $orderLine->product;
        }

        return view('bestellen.overview', compact('order', 'orderLines', 'productInfo', 'userData', 'city', 'openingDayDate'));

    }

    /**
     * Confirm an order. Send an e-mail to the user and return a confirmation view.
     * @param  Request $request The incomming request
     * @return response
     */
    public function confirmed(Request $request)
    {
        $user = Auth::user();
        $order = $user->orders()->where('status_id', 1)->first();
        if (!count($order)) {
            return redirect('/bestelling');
        }

        $order->status_id = 2;
        if ($order->save()) {
            $orderLines = $order->orderlines;
            Mail::send('emails.order', compact('order', 'orderLines', 'user'), function ($m) use ($user) {
                $m->from('kratenklaar@dekroon.xyz', 'Krat en Klaar');

                $m->to($user->email, $user->name)->subject('Bestelling geplaatst');
            });
            return view('bestellen.confirm');
        }
        return abort(500);
    }


    public function updateStatus(Request $request)
    {
        $statuses = Status::where('id', $request->input('status'))->firstOrFail();
        $order = Order::findOrFail($request->input('order_id'));

        switch ($statuses->id) {
            case '3':
                $user = $order->user()->first();
                Mail::send('emails.order-ready', compact('order', 'orderLines', 'user'), function ($m) use ($user) {
                    $m->from('kratenklaar@dekroon.xyz', 'Krat en Klaar');
                    $m->to($user->email, $user->name)->subject('Bestelling gereed!');
                });
                break;
            case '5':
                $user = $order->user()->first();
                Mail::send('emails.order-cancelled', compact('order', 'orderLines', 'user'), function ($m) use ($user) {
                    $m->from('kratenklaar@dekroon.xyz', 'Krat en Klaar');
                    $m->to($user->email, $user->name)->subject('Bestelling geannuleerd');
                });
                break;
        }
        
        $order->status_id = $request->input('status');
        $order->save();

        return redirect('/manager/orders');
    }
}
