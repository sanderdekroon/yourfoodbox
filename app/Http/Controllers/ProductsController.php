<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Order;
use App\Product;
use App\Ingredient;
use App\Http\Requests;
use App\IngredientsInProduct;
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
     * Searches for the $needle in a multidimensional $haystack with fieldnames of $field
     * @param  string $needle   The phrase (ingredient) to look for
     * @param  array $haystack  Multidimensional array to search
     * @param  string $field    Name of the field where to search the $needle
     * @return boolean/integer  Returns the position of the array where the needle was found or false on failure.
     */
    private function ingredientSearch($needle, $haystack, $field)
    {
        return array_search($needle, array_column($haystack, $field));
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

    public function store(Request $request)
    {
        $ingredients = Ingredient::get()->toArray();

        $newProduct = new Product;
        $newProduct->week_no = $request->input('week_no');
        $newProduct->year = $request->input('year');
        $newProduct->name = $request->input('name');
        $newProduct->description = $request->input('description');
        $newProduct->city_id = 1;
        $newProduct->save();

        foreach ($request->input('ingredient-list') as $inputIngredient) {
            $ingredientSearch = array_search($inputIngredient, array_column($ingredients, 'name'));

            if ($ingredientSearch === false) {
                $newIngredient = new Ingredient;
                $newIngredient->name = $inputIngredient;
                $newIngredient->unit = 'stuks';
                $newIngredient->type = 'groente';
                $newIngredient->min_amount = 1;

                if (!$newIngredient->save()) {
                    abort(500);
                }

                $attachIngredientToProduct = new IngredientsInProduct;
                $attachIngredientToProduct->product_id = $newProduct->id;
                $attachIngredientToProduct->ingredient_id = $newIngredient->id;
                $attachIngredientToProduct->save();

            } else {
                $attachIngredientToProduct = new IngredientsInProduct;
                $attachIngredientToProduct->product_id = $newProduct->id;
                $attachIngredientToProduct->ingredient_id = $ingredients[$ingredientSearch]['id'];
                $attachIngredientToProduct->save();
            }
        }

        return redirect('manager/products');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $ingredientsInProduct = $product->ingredients->all();
        $allIngredients = Ingredient::all();

        return view('manager.edit-product', compact('product', 'ingredientsInProduct', 'allIngredients'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $allIngredients = Ingredient::get()->toArray();
        $ingredientsInProduct = $product->ingredients->toArray();

        $product->update($request->all());

        foreach ($ingredientsInProduct as $ingredient) {
            if (array_search($ingredient['name'], $request->input('ingredient-list')) === false) {
                IngredientsInProduct::where('product_id', $id)->where('ingredient_id', $ingredient['id'])->delete();
            }
        }

        foreach ($request->input('ingredient-list') as $inputIngredient) {
            if (is_int($this->ingredientSearch($inputIngredient, $ingredientsInProduct, 'name'))) {

            } elseif (is_int($this->ingredientSearch($inputIngredient, $allIngredients, 'name'))) {
                $attachIngredientToProduct = new IngredientsInProduct;
                $attachIngredientToProduct->product_id = $id;
                $attachIngredientToProduct->ingredient_id = $allIngredients[array_search($inputIngredient, array_column($allIngredients, 'name'))]['id'];
                $attachIngredientToProduct->save();
            } else {
                $newIngredient = new Ingredient;
                $newIngredient->name = $inputIngredient;
                $newIngredient->unit = 'stuks';
                $newIngredient->type = 'groente';
                $newIngredient->min_amount = 1;
                $newIngredient->save();

                $attachIngredientToProduct = new IngredientsInProduct;
                $attachIngredientToProduct->product_id = $id;
                $attachIngredientToProduct->ingredient_id = $newIngredient->id;
                $attachIngredientToProduct->save();
            }
        }

        return redirect()->action('ProductsController@edit', [$id])->with('status', 'Ingredient update is geslaagd!');
    }
}
