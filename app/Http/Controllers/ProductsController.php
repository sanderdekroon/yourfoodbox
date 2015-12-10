<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use App\Product;
use App\Ingredient;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('select.city');
        $this->middleware('verify.order');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request $request The current HTTP request
     * @return response
     */
    public function index(Request $request)
    {
        $selectedCity = $request->session()->get('selectedCity');
        $orderID = $request->session()->get('order_id');
        $products = Product::where('city_id', '=', $selectedCity['id'])
                            ->where('week_no', '=', date('W'))
                            ->get();

        if (!$products->count()) {
            abort(404);
        }

        $order = Order::findOrFail($orderID);
        $orderLines = $order->orderlines->toArray();

        return view('bestellen.index', compact('products', 'selectedCity', 'order', 'orderLines'));
    }

    /**
     * Display a product and it's ingredients
     *
     * @param  String  $name    The name of the product from the URL
     * @param  Request $request The current HTTP request
     * @return response         Return the product view
     */
    public function show($name, Request $request)
    {
        $selectedCity = $request->session()->get('selectedCity');
        $product = Product::where('name', '=', $name)
                        ->where('week_no', '=', date('W'))
                        ->where('city_id', '=', $selectedCity['id'])
                        ->first();

        if (!$product->count()) {
            abort(404);
        }

        $ingredients = $product->ingredients->toArray();
        return view('bestellen.show', compact('product', 'ingredients'));
    }
}
