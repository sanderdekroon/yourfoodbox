<?php

namespace App;

use DB;
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

    /**
     * Get the possible statuses for either the column 'unit' or 'type'.
     *
     * @param  String $field The column name
     * @return Array         An array with the possible statuses
     */
    public static function getPossibleStatuses($field)
    {
        $type = DB::select(DB::raw('SHOW COLUMNS FROM ingredients WHERE Field = "'.$field.'"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach (explode(',', $matches[1]) as $value) {
            $values[] = trim($value, "'");
        }
        return $values;
    }
}
