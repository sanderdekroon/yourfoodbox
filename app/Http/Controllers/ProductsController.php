<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Order;
use App\Product;
use App\Ingredient;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('select.city');
        $this->middleware('check.order');
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
        $products = $selectedCity->products()->where('week_no', date('W'))->get();
        foreach ($products as $product) {
            $ingredients[$product->id] = $product->ingredients->toArray();
        }

        if (!$products->count()) {
            abort(404, 'Geen producten gevonden!');
        }

        $user = Auth::user();
        $order = $user->orders()->where('status_id', 1)->firstOrFail();
        $orderLines = $order->orderlines->toArray();

        return view('bestellen.index', compact('products', 'selectedCity', 'order', 'orderLines', 'ingredients'));
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
        $product = $selectedCity->products()->where('name', $name)->where('week_no', date('W'))->firstOrFail();
        $ingredients = $product->ingredients->toArray();

        $user = Auth::user();
        $order = $user->orders()->where('status_id', 1)->firstOrFail();
        $orderLines = $order->orderlines->toArray();

        return view('bestellen.show', compact('product', 'ingredients', 'orders', 'orderLines'));
    }
}
