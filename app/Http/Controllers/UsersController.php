<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Order;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders()->where('status_id', '!=', 1)->get();

        foreach ($orders as $order) {
            $orderLines[$order->id] = $order->orderLines;
            $statusData[$order->id] = $order->status;
            $cityData[$order->id] = $order->city;

            foreach ($orderLines[$order->id] as $orderLine) {
                $productData[$orderLine->id] = $orderLine->product;
            }
        }

        return view('account.overview', compact('user', 'orders', 'orderLines', 'cityData', 'productData', 'statusData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
