<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToIngredientsInProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingredients_in_products', function ($table) {
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('ingredient_id')->references('id')->on('ingredients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ingredients_in_products', function (Blueprint $table) {
            $table->dropForeign('ingredients_in_products_product_id_foreign');
            $table->dropForeign('ingredients_in_products_ingredient_id_foreign');
        });
    }
}
