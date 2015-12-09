<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ratatouille = new App\Product;
        $ratatouille->week_no = date('W');
        $ratatouille->year = 2015;
        $ratatouille->name = 'Ratatouille';
        $ratatouille->description = 'Ratatouille is een Frans gerecht van gestoofde groenten, dat vooral in de Provence veel wordt bereid.';
        $ratatouille->city_id = 1;
        $ratatouille->save();

        $spaghetti = new App\Product;
        $spaghetti->week_no = date('W');
        $spaghetti->year = 2015;
        $spaghetti->name = 'Spaghetti';
        $spaghetti->description = 'Lorem ipsum.';
        $spaghetti->city_id = 1;
        $spaghetti->save();

        $visgerecht = new App\Product;
        $visgerecht->week_no = date('W');
        $visgerecht->year = 2015;
        $visgerecht->name = 'Visgerecht';
        $visgerecht->description = 'Lorem ipsum.';
        $visgerecht->city_id = 2;
        $visgerecht->save();

        $testgerecht = new App\Product;
        $testgerecht->week_no = date('W');
        $testgerecht->year = 2015;
        $testgerecht->name = 'Test gerecht';
        $testgerecht->description = 'Lorem ipsum.';
        $testgerecht->city_id = 2;
        $testgerecht->save();
    }
}
