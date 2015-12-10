<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'week_no', 'year', 'name', 'description', 'city_id'
    ];

    /**
     * A product belongs to a city.
     *
     * Makes it possible to find a city by a product:
     * $product = App\Product::findOrFail($id);
     * $product->city()->get()->toArray();
     * **OR** $product->city->toArray();
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\City');
    }


    /**
     * A product has/belongs to ingredients.
     *
     * Makes it possible to find all ingredients by a product:
     * $product = App\Product::findOrFail($id);
     * $product->ingredients()->get()->toArray();
     * **OR** $product->ingredients->toArray();
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ingredients()
    {
        return $this->belongsToMany('App\Ingredient', 'ingredients_in_products', 'product_id', 'ingredient_id');
    }
}
