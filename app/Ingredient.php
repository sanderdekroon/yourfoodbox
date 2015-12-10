<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    
    /**
     * A product has/belongs to ingredients.
     *
     * Makes it possible to find all ingredients by a product:
     * $product = App\Product::findOrFail($id);
     * $product->ingredients()->get()->toArray();
     * **OR** $product->ingredients->toArray();
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('App\Product', 'ingredients_in_products', 'ingredient_id', 'product_id');
    }
}
