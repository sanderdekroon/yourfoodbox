<?php

use App\IngredientsInProduct;
use Illuminate\Database\Seeder;

class IngredientsInProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Add Ingredients to Ratatouille
        $i = 1;
        while ($i < 8) {
            $ingredientInProduct = new App\IngredientsInProduct;
            $ingredientInProduct->product_id = 1;
            $ingredientInProduct->ingredient_id = $i;
            $ingredientInProduct->save();
            $i++;
        }
        
    }
}
