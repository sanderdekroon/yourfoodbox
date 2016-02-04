<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ingredient;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IngredientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredient::get();

        return view('manager.list-ingredients', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredientUnitStatuses = $ingredient->getPossibleStatuses('unit');
        $ingredientTypeStatuses = $ingredient->getPossibleStatuses('type');
        $products = $ingredient->products;

        return view('manager.edit-ingredient', compact('ingredient', 'products', 'ingredientUnitStatuses', 'ingredientTypeStatuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $ingredient = Ingredient::findOrFail($id);

        $ingredient->name = $request->input('name');
        $ingredient->unit = $request->input('unit');
        $ingredient->type = $request->input('type');
        $ingredient->min_amount = $request->input('min_amount');
        if (!$ingredient->save()) {
            return redirect()->action('IngredientsController@show', [$id])->with('status', 'Ingredient update mislukt!');
        }

        return redirect()->action('IngredientsController@show', [$id])->with('status', 'Ingredient update geslaagd!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
