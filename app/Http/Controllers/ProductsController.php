<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('select.city');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $selectedCity = $request->session()->get('selectedCity');
        $products = Product::where('city_id', '=', $selectedCity['id'])->get();

        return view('bestellen.index', compact('products', 'selectedCity'));
    }
}
