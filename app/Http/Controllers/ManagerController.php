<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Ingredient;
use App\Http\Requests;
use App\IngredientsInProduct;
use App\Http\Controllers\Controller;

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.moderator');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manager.index');
    }

    public function listProducts()
    {
        $products = Product::orderBy('year', 'desc')->orderBy('week_no', 'desc')->get();
        $ingredients = Ingredient::get();

        return view('manager.list-products', compact('products', 'ingredients'));
    }

    public function listIngredients()
    {
        $ingredients = Ingredient::get();

        return view('manager.list-ingredients', compact('ingredients'));
    }
}
