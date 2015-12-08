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
        $spaghetti->name = 'Spagehtti';
        $spaghetti->description = 'Lorem ipsum.';
        $spaghetti->city_id = 1;
        $spaghetti->save();
    }
}
